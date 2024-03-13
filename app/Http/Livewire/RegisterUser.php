<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Utils\Utils;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RegisterUser extends Component
{
    public $name;
    public $email;
    public $password;
    public $confirmPassword;

    protected $rules = [
        'name' => 'required',
        'email' =>'required|email',
        'password'=> 'required|min:6',
        'confirmPassword' => 'required|same:password',
    ];

    public function submit()
    {
        $this->validate();
        DB::beginTransaction();
        try {
            User::create([
                'name'=>$this->name,
                'email'=>$this->email,
                'password'=>password_hash($this->password, PASSWORD_DEFAULT),
            ]);
            DB::commit();
            $this->emit('registered', Utils::responseTemplate(201, "Register Success"));
        } catch (\Exception $e) {
            DB::rollBack();
            $this->emit('registered', Utils::responseTemplate(401, "Email Already Exists"));
        }


    }
    public function render()
    {
        return view('livewire.register-user');
    }
}

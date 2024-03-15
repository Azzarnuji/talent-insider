<?php

namespace App\Http\Livewire;

use App\Utils\Utils;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LoginUser extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email' =>'required|email',
        'password'=> 'required|min:6',
    ];

    public function submit()
    {
        $this->validate();
        DB::beginTransaction();
        try {
            $isLogin = Auth::attempt(['email' => $this->email, 'password' => $this->password]);
            DB::commit();
            if (!$isLogin) {
                $this->emit('login', Utils::responseTemplate(401,"Username / password is wrong...."));
                return;
            }
            $this->emit('login', Utils::responseTemplate(200,"Login Success",['token'=>Utils::generateToken(Auth::user())]));
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->emit('login', Utils::responseTemplate(500,$th->getMessage()));
        }
    }
    public function render()
    {
        return view('livewire.login-user');
    }
}

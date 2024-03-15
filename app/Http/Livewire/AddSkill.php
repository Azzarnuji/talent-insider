<?php

namespace App\Http\Livewire;

use App\Models\Skills;
use App\Models\SkillsUserDescription;
use App\Models\User;
use App\Models\UserSkills;
use App\Utils\Utils;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AddSkill extends Component
{
    public $user = null;
    public $active = false;
    protected $listeners = ['addSkillState'];
    public $listAvailableSkills = [];
    public $selectedSkill = null;
    public $descriptionSkill = null;
    public function addSkillState($state)
    {
        $this->active = $state;
    }
    public function mount(){
        $this->user = auth()->user();
        try {
            $this->listAvailableSkills = Skills::all();
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function submit(){
        DB::beginTransaction();
        try{
            $checkIfSkillExistOnUser = User::find($this->user->id)->skills()->where('skills_id', $this->selectedSkill)->exists();
            if($checkIfSkillExistOnUser == false){
                $userSkillInsert = UserSkills::create([
                    'user_id'=>$this->user->id,
                    'skills_id'=>$this->selectedSkill
                ]);
                SkillsUserDescription::create([
                    // 'user_id'=>$this->user->id,
                    'skills_user_id'=>$userSkillInsert->id,
                    'description'=>$this->descriptionSkill
                ]);
                DB::commit();
                $this->emit('skillAdded', Utils::responseTemplate(200, 'Skill Added Successfully'));
            }else{
                $this->emit('skillAdded', Utils::responseTemplate(409, 'Skill Already Exist'));
            }
        }catch(\Exception $e){
            dd($e);
            DB::rollBack();
        }
    }
    public function render()
    {
        return view('livewire.add-skill');
    }
}

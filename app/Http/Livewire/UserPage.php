<?php

namespace App\Http\Livewire;

use App\Models\Skills;
use App\Models\User;
use App\Models\UserSkills;
use App\Utils\Utils;
use Livewire\Component;

class UserPage extends Component
{
    public $user = null;
    public $addSkill = false;
    protected $listeners = ['addSkillState', 'updateData', 'deleteSkill'];
    public $mySkills = [];
    public function mount(){
        $this->user = auth()->user();
        $this->mySkills = User::find($this->user->id)->skills()->get()->all();
        // dd(User::find($this->user->id)->skills()->get()->all());
    }
    public function addSkillState($active){
        $this->addSkill = $active;
    }
    public function deleteSkill($id){
        UserSkills::where(['user_id'=>$this->user->id, 'skills_id'=>$id])->delete();
        $this->emit('skillDeleted', Utils::responseTemplate(200, 'Skill Deleted Successfully'));
        $this->updateData();
    }
    public function updateData(){
        $this->mySkills = User::find($this->user->id)->skills()->get()->all();
    }
    public function render()
    {
        return view('livewire.user-page');
    }
}

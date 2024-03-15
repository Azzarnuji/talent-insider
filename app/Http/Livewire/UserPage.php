<?php

namespace App\Http\Livewire;

use App\Models\Skills;
use App\Models\SkillsUserDescription;
use App\Models\User;
use App\Models\UserSkills;
use App\Utils\Utils;
use Livewire\Component;

class UserPage extends Component
{
    public $user = null;
    public $addSkill = false;
    public $editSkill = false;
    public $editSkillId = null;
    protected $listeners = ['addSkillState', 'updateData', 'deleteSkill','editSkillState'];
    private $mySkills;
    public $searchValue = null;
    public $filterValue = null;
    private function updateOrSetPropertyMySkills(){
        $user = User::find($this->user->id);
        $this->mySkills = $user->skills_user()->with(['skills_model', 'skills_user_description'])->paginate(5)->withPath('/dashboard');
    }
    private function getSearhValue(){
        if($this->searchValue == null || $this->searchValue == ""){
            $this->updateOrSetPropertyMySkills();
        }else{
            $user = User::find($this->user->id);
            $getIdSkill = Skills::where('nama_skill', 'like', '%'.$this->searchValue.'%')->get()->all();
            if($getIdSkill == null){
                $this->mySkills = [];
            }else{
                $getSkillDetail = UserSkills::with('skills_user_description')->limit(100)->get()->all();
                $filterArray = array_search($getIdSkill->id, array_column($getSkillDetail, 'skills_id'));
                $result = $getSkillDetail[$filterArray];
                $this->mySkills = $result;
            }
            dd($this->mySkills);
        }
    }
    private function getFilterValue(){
        $user = User::find($this->user->id);
        switch($this->filterValue){
            case "latest":
                $this->mySkills = $user->skills_user()->with(['skills_model', 'skills_user_description'])->latest()->paginate(5)->withPath('/dashboard');
                break;
            case "oldest":
                $this->mySkills = $user->skills_user()->with(['skills_model', 'skills_user_description'])->oldest()->paginate(5)->withPath('/dashboard');
                break;
            default:
                $this->mySkills = $user->skills_user()->with(['skills_model', 'skills_user_description'])->paginate(5)->withPath('/dashboard');
                break;

        }
    }
    public function mount(){
        $this->user = auth()->user();
        $this->filterValue ="null";
        $this->searchValue = "";
        $this->updateOrSetPropertyMySkills();
    }
    public function addSkillState($active){
        $this->addSkill = $active;
        $this->updateOrSetPropertyMySkills();
    }
    public function editSkillState($active, $idSkill){
        $this->editSkill = $active;
        $this->editSkillId = $idSkill;
        $this->updateOrSetPropertyMySkills();
    }
    public function deleteSkill($id){
        UserSkills::find($id)->delete();
        $this->emit('skillDeleted', Utils::responseTemplate(200, 'Skill Deleted Successfully'));
        $this->updateOrSetPropertyMySkills();

    }
    public function updateData(){
        $this->updateOrSetPropertyMySkills();
    }

    public function updatedSearchValue(){
        $this->getSearhValue();
    }
    public function updatedFilterValue(){
        $this->getFilterValue();
        $this->emit('filterUpdated',true);
    }
    public function render()
    {
        return view('livewire.user-page',['mySkills'=>$this->mySkills]);
    }
}

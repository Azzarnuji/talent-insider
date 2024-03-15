<?php

namespace App\Http\Livewire;

use App\Models\Skills;
use App\Models\SkillsUserDescription;
use App\Models\User;
use App\Models\UserSkills;
use App\Utils\Utils;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditSkill extends Component
{
    public $user = null;
    protected $listener = ['editSkillState'];
    public $active = false;
    public $idSkill = null;
    public $oldData = null;
    public $listAvailableSkills = null;
    // public $oldDescription = null;
    public $selectedSkill = null;
    public $descriptionSkill = null;
    public function mount(){
        $this->user = auth()->user();
        try {
            $this->listAvailableSkills = Skills::all();
        } catch (\Exception $e) {
            dd($e);
        }
        $this->descriptionSkill = SkillsUserDescription::where(['skills_user_id'=>$this->idSkill])->first()->description;
        $this->selectedSkill = UserSkills::find($this->idSkill)->skills_model()->first()->id;
        // dd($this->descriptionSkill);
    }
    public function editSkillState($active){
        $this->active = $active;
    }

    public function submit(){
        try {
            $updateSkillUser = UserSkills::where(['user_id'=>$this->user->id, 'skills_id'=>$this->idSkill])->update([
                'skills_id'=>$this->selectedSkill
            ]);
            SkillsUserDescription::where(['skills_user_id'=>$this->idSkill])->update([
                'skills_user_id'=>$this->idSkill,
                'description'=>$this->descriptionSkill
            ]);
            DB::commit();
            $this->emit('skillUpdated', Utils::responseTemplate(200, 'Skill Updated Successfully'));
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
        }
        // $checkIfSkillExistOnUser = User::find($this->user->id)->skills()->where('skills_id', $this->selectedSkill)->exists();
        // if($checkIfSkillExistOnUser == false){
        //     $updateSkillUser = UserSkills::where(['user_id'=>$this->user->id, 'skills_id'=>$this->idSkill])->update([
        //         'skills_id'=>$this->selectedSkill
        //     ]);
        //     SkillsUserDescription::where(['skills_user_id'=>$this->idSkill])->update([
        //         'skills_user_id'=>$updateSkillUser->id,
        //         'description'=>$this->descriptionSkill
        //     ]);
        //     DB::commit();
        //     $this->emit('skillUpdated', Utils::responseTemplate(200, 'Skill Updated Successfully'));
        // }else{
        //     $this->emit('skillUpdated', Utils::responseTemplate(409, 'Skill Already Exist'));
        // }
    }
    public function render()
    {
        return view('livewire.edit-skill');
    }
}

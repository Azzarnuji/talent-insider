<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SkillsUserDescription;
class UserSkills extends Model
{
    use HasFactory;
    protected $table = 'skills_user';
    public $timestamps = true;
    protected $guarded = ['id'];

    public function skills_model()
    {
        return $this->hasOne(Skills::class, 'id', 'skills_id');
    }
    public function skills_user_description(){
        return $this->hasOne(SkillsUserDescription::class, 'skills_user_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillsUserDescription extends Model
{
    use HasFactory;
    protected $table = 'skills_user_descriptions';
    protected $guarded = ['id'];
    public $timestamps = true;

}

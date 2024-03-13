<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSkills extends Model
{
    use HasFactory;
    protected $table = 'skills_user';
    public $timestamps = true;
    protected $guarded = ['id'];

    public function skills()
    {
        return $this->belongToMany(UserSkills::class);
    }
}

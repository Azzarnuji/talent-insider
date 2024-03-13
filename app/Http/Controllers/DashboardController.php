<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index(){
        $data = [
            'title'=>"Dashboard",
        ];
        return view('Dashboard.Dashboard', $data);
    }

    public function addSkill(){
        $data = [
            'title'=>"Add Skill",
        ];
        return view('Dashboard.AddSkill', $data);
    }
}

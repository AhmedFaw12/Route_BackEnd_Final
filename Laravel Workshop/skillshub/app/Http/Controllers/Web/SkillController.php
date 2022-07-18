<?php

namespace App\Http\Controllers\Web;

use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SkillController extends Controller
{
    public function show($id){
        $data["skill"] = Skill::findOrFail($id);
        $data['exams'] = $data['skill']->exams()->active()->get();
        return view("web.skills.show")->with($data);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Cat;
use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SkillController extends Controller
{
    public function index(){
        $data["skills"] = Skill::orderBy('id', "DESC")->paginate(10);
        $data["cats"] = Cat::select('id', 'name')->get();
        return view("admin.skills.index")->with($data);
    }

    public function store(Request $request){

        $request->validate([
            'name_ar' => "required|string|max:50",
            'name_en' => "required|string|max:50",
            'img' =>"required|image|mimes:png,jpg|max:2048",//2048kB = 2MB
            'cat_id' => "required|exists:cats,id",
        ]);

        // $path = Storage::disk('uploads')->putFile("skills", $request->file('img'));//return path of image
        $path = Storage::putFile("skills", $request->file('img'));//return path of image

        Skill::create([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
            'img' =>$path,
            'cat_id' => $request->cat_id,
        ]);
        $request->session()->flash("msg", "row added successfully");
        $type = true;
        $request->session()->flash("type", "$type");
        return back();
    }

    public function update(Request $request){

        $request->validate([
            'id' => "required|exists:skills,id",
            'name_ar' => "required|string|max:50",
            'name_en' => "required|string|max:50",
            'img' => "nullable|image|mimes:png,jpg|max:2048",
            'cat_id' => "required|exists:cats,id",
        ]);

        $skill =Skill::findOrFail($request->id);
        $path = $skill->img;
        if($request->hasFile('img')){
            Storage::delete($path);
            $path = Storage::putFile("skills", $request->file('img'));
        }


        $skill->update([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
            'img' => $path,
            'cat_id' => $request->cat_id,
        ]);

        $request->session()->flash("msg", "row updated successfully");
        $type = true;
        $request->session()->flash("type", "$type");

        return back();
    }

    public function toggle(Skill $skill){
        $skill->update([
            'active' => !$skill->active,
        ]);

        return back();
    }

    public function delete(Skill $skill, Request $request){

        try {
            $path = $skill->img;
            $skill->delete();
            Storage::delete($path);
            $msg = "row deleted successfully";
            $type = true;
        } catch (Exception $e) {
            $msg = "can't delete this row";
            $type = false;
        }

        $request->session()->flash("msg", "$msg");
        $request->session()->flash("type", "$type");
        return back();
    }
}

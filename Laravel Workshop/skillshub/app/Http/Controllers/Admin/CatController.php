<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use PhpParser\Node\Stmt\TryCatch;

class CatController extends Controller
{
    public function index(){
        // $data["cats"] = Cat::get();
        $data["cats"] = Cat::orderBy('id', "DESC")->paginate(10);
        return view("admin.cats.index")->with($data);
    }

    public function store(Request $request){

        $request->validate([
            'name_ar' => "required|string|max:50",
            'name_en' => "required|string|max:50",
        ]);

        Cat::create([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
        ]);
        $request->session()->flash("msg", "row added successfully");
        $type = true;
        $request->session()->flash("type", "$type");
        return back();
    }

    public function update(Request $request){

        $request->validate([
            'id' => "required|exists:cats,id",
            'name_ar' => "required|string|max:50",
            'name_en' => "required|string|max:50",
        ]);

        Cat::findOrFail($request->id)->update([

            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
        ]);
        $request->session()->flash("msg", "row updated successfully");
        $type = true;
        $request->session()->flash("type", "$type");

        return back();
    }

    public function toggle(Cat $cat){
        $cat->update([
            'active' => !$cat->active,
        ]);

        return back();
    }

    public function delete(Cat $cat, Request $request){

        try {
            $cat->delete();
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

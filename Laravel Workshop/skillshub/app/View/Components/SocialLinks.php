<?php

namespace App\View\Components;

use App\Models\Setting;
use Illuminate\View\Component;

class SocialLinks extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $data["sett"] = Setting::select("facebook", "youtube", "instagram", "linkedin", "twitter")->first();
        return view('components.social-links')->with($data);
    }
}

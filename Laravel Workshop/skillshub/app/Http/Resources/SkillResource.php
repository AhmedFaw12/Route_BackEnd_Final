<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SkillResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name_ar' => $this->name("ar"),
            'name_en' => $this->name("en"),
            'img' => asset("uploads/$this->img") ,
            'active' => $this->active,
            'exams' => ExamResource::collection($this->whenLoaded("exams")),
        ];
    }
}

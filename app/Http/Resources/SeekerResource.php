<?php
// app/Http/Resources/SeekerResource.php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SeekerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'accepted' => $this->accepted,
            'image'=> $this->image,
            'file_path' => $this->resume->file_path ?? null,

        ];
    }
}
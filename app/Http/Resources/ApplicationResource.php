<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [ 'id' => $this->id,
            'job_id' => $this->job,
            'specialist_id' => $this->specialist,
            'seeker_id'=>$this->seeker,
            'application_status' => $this->application_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'Matching_percentage'=>$this->Matching_percentage,
            'file_path' => $this->seeker->resume->file_path ?? null,

        ];
    }
}

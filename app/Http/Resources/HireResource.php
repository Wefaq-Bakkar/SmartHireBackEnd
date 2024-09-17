<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HireResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'offer_id' => $this->offer_id,
            'job_title'=> $this->offer->interview->application->job->title,
            'seeker_id' => $this->seeker,
            'specialist_id' => $this->specialist,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'salary' => $this->salary,
            'employment_type' => $this->employment_type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
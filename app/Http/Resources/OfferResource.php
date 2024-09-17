<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'interview_id' => $this->interview,
            'job_title' => $this->interview->application->job->title,

            'seeker_id' => $this->seeker,
            'specialist_id' => $this->specialist,
            'status' => $this->status,
            'salary' => $this->salary,
            'startdate' => $this->startdate,
            'expiredate' => $this->expiredate,
            'employment_type' => $this->employment_type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
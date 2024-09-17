<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InterviewResource extends JsonResource
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
            'application_id' => [
                'id' => $this->application->id,
                'job_id' => $this->application->job,
                'seeker_id' => $this->application->seeker_id,
                'specialist_id' => $this->application->specialist_id,
                'application_status' => $this->application->application_status,
                'created_at' => $this->application->created_at,
                'updated_at' => $this->application->updated_at,
                'Matching_percentage' => $this->application->Matching_percentage,
            ],
            'seeker_id' => $this->seeker,
            'specialist_id' => $this->specialist,
            'date_from' => $this->date_from,
            'date_to' => $this->date_to,
            'location' => $this->location,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
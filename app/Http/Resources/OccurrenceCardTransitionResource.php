<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OccurrenceCardTransitionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'step' => $this->step,
            'doc_due_date' => $this->doc_due_date,
            'user' => OccurrenceCardUserResource::make($this->whenLoaded('user'))
        ];
    }
}

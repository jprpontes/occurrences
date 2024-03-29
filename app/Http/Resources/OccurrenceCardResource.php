<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OccurrenceCardResource extends JsonResource
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
            'title' => $this->title,
            'person_id' => $this->person_id,
            'contract_id' => $this->contract_id,
            'transition' => OccurrenceCardTransitionResource::collection($this->whenLoaded('transitions'))[0]
        ];
    }
}

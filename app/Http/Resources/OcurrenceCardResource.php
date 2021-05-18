<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OcurrenceCardResource extends JsonResource
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
            'person_id' => $this->person_id,
            'contract_id' => $this->contract_id,
            'transition' => OcurrenceCardTransictionResource::collection($this->whenLoaded('transitions'))[0]
        ];
    }
}

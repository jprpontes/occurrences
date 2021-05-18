<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OcurrenceCardTransictionResource extends JsonResource
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
            'doc_due_date' => $this->doc_due_date,
            'user' => OcurrenceCardUserResource::make($this->whenLoaded('user'))
        ];
    }
}

<?php

namespace Modules\Vendor\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
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
            'Offer Start At Date'=> $this->start,
            'Offer Start Since'=> $this->created_at->diffForHumans(),
            'Offer End At Date'=> $this->end,
            'Offer Value With Type'=> $this->value .' '. $this->type,
        ];
    }
}

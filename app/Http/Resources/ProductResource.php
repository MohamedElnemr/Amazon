<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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

            // Product
            'id'=>$this->id,
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'qty'=>$this->qty,

            // Relation Product with Category
            'NameCategory' => $this->when($this->category()->exists(), $this->Category->test),

            // Relation Product with Stores
            'NameStore' => $this->when($this->store()->exists(), $this->Store->test),
        ];
    }
}

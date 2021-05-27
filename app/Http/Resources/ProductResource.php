<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // Either we can use this approach or we can use approach number 2
        /*
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => [
                'id' => $this->id,
                'name' => $this->name,
            ],
            'price' => $this->price,
            'description' => $this->description,
        ];*/

        // Approach no 2: use resource inside the resource
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => new CategoryResource($this->category),
            'price' => $this->price,
            'description' => $this->description,
        ];

    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'category_id' => $this->category_id,
            'name' => $this->name,
            'parent_category' => $this->parent_category,
            'description' => $this->description,
            'slug' => $this->slug,
            'image' => $this->image,
            'image_url' => $this->getImage(),
            'parent' => $this->parent
        ];
    }
}

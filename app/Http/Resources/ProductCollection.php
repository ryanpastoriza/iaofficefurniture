<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCollection extends JsonResource
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
            'product_id' => $this->product_id,
            'category' => $this->category,
            'price' => $this->price,
            'on_demand' => $this->on_demand,
            'product_code' => $this->product_code,
            'product_name' => $this->product_name,
            'product_description' => $this->product_description,
            'featured_image' => $this->featured_image,
            'slug' => $this->slug,
            'featured' => $this->featured,
            'directory' => [
                'images' => $this->getStorageUrl()
            ],
            // 'dimension' => $this->dimension,
            // 'materials' => $this->materials,
            'status' => $this->status
        ];
    }
}

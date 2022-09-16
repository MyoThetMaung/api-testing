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
    public function stock_status($stock){
        if($stock > 20){
            return 'avaliable';
        }else if($stock > 0 && $stock <= 20){
            return 'few';
        }else if($stock ===  0){
            return 'out of stock';
        }
    }
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'show_price' => $this->price. ' MMK',
            'stock' => $this->stock,
            'stock_status' => $this->stock_status($this->stock),
            'date' => $this->created_at->format("d M Y"),
            'time' => $this->created_at->format("h i A"),
            'owner' => new UserResource($this->user),
            'photos' => PhotoResource::collection($this->photos)

        ];
    }
}

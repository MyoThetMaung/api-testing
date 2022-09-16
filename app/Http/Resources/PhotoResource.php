<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class PhotoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //"http://127.0.0.1:8000/storage/q9xMImU6c1WPLe1cmQRuExkY1jkoIuldb8xqowTO.jpg"
        return asset(Storage::url($this->name));
    }
}

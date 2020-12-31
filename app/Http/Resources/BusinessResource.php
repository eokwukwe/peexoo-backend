<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class BusinessResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'phone1' => $this->phone_1,
            'phone2' => $this->phone_2,
            'address' => $this->address,
            'description' => $this->description,
            'views' => $this->when(Auth::user(), $this->views),
            'website' => $this->website,
            'active' =>$this->when(Auth::user(), (bool) $this->active),
            'businessCategories' => $this->when(
                Auth::user(),
                CategoryResource::collection($this->categories)
            ),
            'createdAt'   => [
                'forHuman'  => $this->created_at->diffForHumans(),
                'timestamp' => $this->created_at
            ],
        ];
    }
}

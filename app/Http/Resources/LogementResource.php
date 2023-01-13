<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class LogementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'type' => $this->type,
            'description' => $this->description,
            'pays' => $this->pays,
            'ville' => $this->ville,
            'quartier' => $this->quartier,
            'prix' => $this->prix,
            'proprietaire' => UserResource::make($this->proprio),
            'medias' => MediaResource::collection($this->medias),
            'dateEnregistrement' => $this->created_at,
        ];
    }
}

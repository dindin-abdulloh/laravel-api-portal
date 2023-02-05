<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostDetailResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'news_content' => $this->news_content,
            // 'author' => $this->author,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'author' => $this->whenLoaded('writer'),
            'comment' => $this->whenLoaded('comments', function(){
                return collect($this->comments)->each(function($com){
                    $com->comentator;
                    return $com;
                });
            }),

            'comment_total' => $this->whenLoaded('comments', function(){
                return $this->comments->count();
            })
        ];
    }
}

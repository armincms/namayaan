<?php

namespace Armincms\Namayaan\Http\Controllers;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MediaCollection extends ResourceCollection
{ 
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {  
        return $this->collection->map(function($media) { 
            return [
                'id'    => $media->id,
                'name'  => $media->name,
                'label' => $media->label,
                'group' => $media->group, 
                'gallery' => $media->getMedia('gallery')->map(function($image) use ($media) {
                    return $media->getConversions($image, ['main', 'cover', 'thumbnail']);
                }),
            ];
        })->toArray();
    }  
}

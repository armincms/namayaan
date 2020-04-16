<?php

namespace Armincms\Namayaan\Http\Controllers;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LinkCollection extends ResourceCollection
{ 
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {  
        return $this->collection->map(function($link) {
            $link['data'] = new MediaCollection($link['data']);
            return $link;
        })->toArray();
    }  
}

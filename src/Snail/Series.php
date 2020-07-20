<?php 

namespace Armincms\Namayaan\Snail;

use Illuminate\Http\Request; 
use Armincms\Snail\Properties\HasMany;  

class Series extends Movie
{ 
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'Armincms\\Alhazen\\AlhazenSeries'; 

    /**
     * Get the properties displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function properties(Request $request)
    {
        return collect(parent::properties($request))->map(function($property) { 
            return $property->attribute == 'links' 
                        ? HasMany::make('Episodes', 'episodes', Episode::class) 
                        : $property;
        })->all();
    }  
}
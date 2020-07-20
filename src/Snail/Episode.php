<?php 

namespace Armincms\Namayaan\Snail;
 
use Illuminate\Http\Request;
use Armincms\Snail\Properties\Integer; 

class Episode extends Movie
{ 
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'Armincms\\Alhazen\\AlhazenEpisode';  

    /**
     * Get the properties displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function properties(Request $request)
    {
        return array_merge(parent::properties($request), [
        	Integer::make('Season', 'detail->season'),

        	Integer::make('Episode', 'detail->episode'), 
        ]);
    }
}
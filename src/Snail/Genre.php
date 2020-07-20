<?php 

namespace Armincms\Namayaan\Snail;

use Illuminate\Http\Request;
use Armincms\Snail\Http\Request\SnailRequest;
use Armincms\Snail\Properties\BelongsTo; 
use Armincms\Snail\Properties\Text; 
use Armincms\Snail\Properties\ID;
use Armincms\Snail\Schema;
use Armincms\RawData\Common;

class Genre extends Schema
{ 
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'Armincms\\Alhazen\\AlhazenGenre';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * Get the properties displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function properties(Request $request)
    {
        return [ 
            ID::make(),
  
            Text::make('Name'),  

            Text::make('Abstract')
                ->hideFromIndex(),   
        ];
    }  
}
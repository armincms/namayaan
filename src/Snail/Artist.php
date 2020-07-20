<?php 

namespace Armincms\Namayaan\Snail;

use Illuminate\Http\Request; 
use Armincms\Snail\Properties\Text; 
use Armincms\Snail\Properties\ID;
use Armincms\Snail\Schema; 

class Artist extends Schema
{ 
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'Armincms\\Alhazen\\AlhazenArtist';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'fullname';

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
  
            Text::make('Name', 'fullname'),  

            Text::make('StageName', 'stagename'),    
        ];
    }  
}
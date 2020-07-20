<?php 

namespace Armincms\Namayaan\Snail;

use Illuminate\Http\Request;
use Armincms\Snail\Http\Request\SnailRequest;
use Armincms\Snail\Properties\Collection;
use Armincms\Snail\Properties\BelongsTo; 
use Armincms\Snail\Properties\HasMany; 
use Armincms\Snail\Properties\Boolean; 
use Armincms\Snail\Properties\Integer; 
use Armincms\Snail\Properties\Text; 
use Armincms\Snail\Properties\ID;
use Armincms\Snail\Schema;
use Armincms\RawData\Common;

class Movie extends Schema
{ 
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'Armincms\\Alhazen\\AlhazenMovie';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The relationships that should be eager loaded when performing an index query.
     *
     * @var array
     */
    public static $with = ['genres'];

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

            Text::make('Label'), 

            Text::make('Name'),  

            Text::make('Language')
                ->displayUsing(function($language, $resource, $attribute) { 
                    return __(Common::locales()
                                ->sortBy('regional_locale')
                                ->pluck('name', 'locale')
                                ->get($resource->{$attribute}));
                }),  

            BelongsTo::make('Company', 'company', Company::class)
                ->nullable(),

            HasMany::make('Genres', 'genres', Genre::class)
                ->nullable(),

            HasMany::make('Artists', 'artists', Artist::class)
                ->nullable()
                ->hideFromIndex(),

            Text::make('Story'), 

            Text::make('Abstract'), 

            Text::make('Abstract'), 

            Collection::make('Names')
                ->asArray()
                ->hideFromIndex(), 

            Collection::make('Links')
                ->displayUsing(function($links) {
                    return collect($links)->map(function($link) {
                        return array_merge($link['attributes'], [
                            'media' => $link['layout']
                        ]);
                    })->sortBy('media');
                })
                ->asArray()
                ->hideFromIndex(), 

            Collection::make('Gallery', function() {
                    return $this->getMedia('gallery')->map(function($media) {
                        return $this->getConversions($media, ['thumbnail', 'main']);
                    })->filter();
                })
                ->asArray(), 

            Boolean::make('Coming Soon', function() {
                    return data_get($this->detail, 'coming_soon');
                }),

            Text::make('Release Date', 'detail->release_date')
                ->nullable(),

            Integer::make('Duration', 'detail->duration')
                ->nullable(),

            Integer::make('Min Age', 'detail->audience->min')
                ->nullable(),

            Integer::make('Max Age', 'detail->audience->max')
                ->nullable(),

            Collection::make('Countries', 'detail->countries')
                ->displayUsing(function($codes) { 
                    return Common::countries()
                                ->pluck('name', 'code')
                                ->only((array) $codes);
                })
                ->asArray(),

            Collection::make('Languages', 'detail->languages')
                ->displayUsing(function($locales) { 
                    return Common::locales()
                                ->sortBy('regional_locale')
                                ->pluck('name', 'locale')
                                ->only((array) $locales) 
                                ->map(function($language) {
                                    return __($language);
                                });
                })
                ->asArray(),
        ];
    }  
}
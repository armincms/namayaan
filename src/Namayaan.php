<?php

namespace Armincms\Namayaan;
  
use Armincms\Taggable\Tag;
use Illuminate\Http\Request;   
use Armincms\Nova\ConfigResource;
use Armincms\Alhazen\AlhazenGenre;
use Whitecube\NovaFlexibleContent\Flexible;
use OwenMelbz\RadioField\RadioButton;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use OptimistDigital\MultiselectField\Multiselect;
use Armincms\Alhazen\Media;

class Namayaan extends ConfigResource
{     
    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __("Namayaan");
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $genres = AlhazenGenre::get()->pluck("name", "id");
        $tags = Tag::get()->pluck("tag", "id");

        return [
             Flexible::make(__("Links"), "_namayaan_links_")
                ->addLayout(__("Group"), 'group', [
                    Text::make(__("Lable"), 'label')
                        ->required()
                        ->rules('required'), 

                    Multiselect::make(__("Media"), 'media')
                        ->options([
                            'series' => __("Series"),
                            'movie' => __("Movie"),
                        ])
                        ->required()
                        ->rules('required'), 

                    Multiselect::make(__("Genre"), 'genre')
                        ->options($genres),  

                    Multiselect::make(__("Tag"), 'tag')
                        ->options($tags),   
                ])
                ->button(__("Add Group")), 
        ];
    } 

    public static function availableLinks()
    {
        return collect(static::option('_namayaan_links_'))->map->attributes->map(function($attributes) {
            $attributes = collect($attributes)->map(function($attribute) {
                $array = json_decode($attribute, true);

                if(json_last_error() === JSON_ERROR_NONE) {
                    $attribute = collect($array)->map(function($value) {
                        return is_numeric($value) ? intval($value) : strval($value);
                    })->all();
                }  

                return $attribute;
            });  

            return static::mergeMedias($attributes);
        })->filter()->all();
    }

    public static function mergeMedias($attributes)
    {
        $medias = Media::limit(10)->latest()
                    ->hasTags((array) $attributes->get('tag'))
                    ->hasGenres((array) $attributes->get('genre')) 
                    ->typeOf((array) $attributes->get('media'))
                    ->get(); 

        return $medias->count() ? $attributes->put('data', $medias) : [];
    }
}

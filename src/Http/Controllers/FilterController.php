<?php 

namespace Armincms\Namayaan\Http\Controllers;
 
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Armincms\Alhazen\Media; 

class FilterController extends Controller
{  
    public function index(Request $request)
    {
        $medias = Media::latest()
                    ->hasTags((array) $request->get('tag'))
                    ->hasGenres((array) $request->get('genre')) 
                    ->typeOf((array) $request->get('media')) 
                    ->paginate($request->per_page ?: 5)
                    ->appends('per_page', $request->per_page);

         
        return new MediaCollection($medias);
    } 
}

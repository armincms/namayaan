<?php 

namespace Armincms\Namayaan\Http\Controllers;
 
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Armincms\Alhazen\AlhazenGenre; 

class GenreController extends Controller
{  
    public function index(Request $request)
    {
        return [
            'data' => AlhazenGenre::latest()->get()->map([$this, 'toArray']),
        ]; 
    } 

    public function toArray($genre)
    {
        return [
            'genreId' => $genre->id,
            'label' => $genre->name,
        ];
    }
}

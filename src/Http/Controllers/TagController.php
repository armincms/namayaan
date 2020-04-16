<?php 

namespace Armincms\Namayaan\Http\Controllers;
 
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Armincms\Taggable\Tag; 

class TagController extends Controller
{  
    public function index(Request $request)
    {
        return [
            'data' => Tag::latest()->get()->map([$this, 'toArray']),
        ]; 
    } 

    public function toArray($tag)
    {
        return [
            'tagId' => $tag->id,
            'label' => $tag->tag,
        ];
    }
}

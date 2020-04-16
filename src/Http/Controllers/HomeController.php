<?php 

namespace Armincms\Namayaan\Http\Controllers;
 
use App\Http\Controllers\Controller;
use Armincms\TruthOrDare\Game;
use Illuminate\Http\Request;
use Armincms\RawData\Common;
use Armincms\Namayaan\Namayaan;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{  
    public function index(Request $request)
    {
        $path   = LengthAwarePaginator::resolveCurrentPath();
        $links  = collect(Namayaan::availableLinks()); 
        $path   = LengthAwarePaginator::resolveCurrentPath();
        $perPage= intval($request->per_page)?: 10;
        $offset = ($request->page ? $request->page - 1 : 0) * $perPage;  

         
        return new LinkCollection((new LengthAwarePaginator(
        	$links->slice($offset, $perPage), $links->count(), $perPage, $request->page, compact('path')
        ))->appends('per_page', $request->per_page));
    } 
}

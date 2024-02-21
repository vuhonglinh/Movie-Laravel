<?php

namespace Modules\MucLuc\src\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Modules\Categories\src\Models\Category;
use Modules\Countries\src\Models\Country;
use Modules\Genres\src\Models\Genre;

class MucLucController extends BaseController
{
    public function __construct()
    {
    }

    public function categories(Category $category)
    {
        $titlePage = $category->name;
        $movies = $category->movies()->paginate(18);
        return view('mucluc::main', compact('titlePage', 'movies'));
    }


    public function countries(Country $country)
    {
        $titlePage = $country->name;
        $movies = $country->movies()->paginate(18);
        return view('mucluc::main', compact('titlePage', 'movies'));
    }


    public function genres(Genre $genre)
    {
        $titlePage = $genre->name;
        $movies = $genre->movies()->paginate(18);
        return view('mucluc::main', compact('titlePage', 'movies'));
    }
}

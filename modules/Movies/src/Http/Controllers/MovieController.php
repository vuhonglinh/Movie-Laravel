<?php

namespace Modules\Movies\src\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Modules\Categories\src\Repositories\CategoriesRepositoryInterface;
use Modules\Countries\src\Repositories\CountriesRepositoryInterface;
use Modules\Genres\src\Repositories\GenresRepositoryInterface;
use Modules\Movies\src\Http\Requests\MovieRequest;
use Modules\Movies\src\Repositories\MoviesRepositoryInterface;
use Yajra\DataTables\DataTables;

class MovieController extends BaseController
{
    private $moviesRepo;
    private $categoriesRepo;
    private $genresRepo;
    private $countriesRepo;
    public function __construct(
        MoviesRepositoryInterface $moviesRepo,
        CategoriesRepositoryInterface $categoriesRepo,
        CountriesRepositoryInterface $countriesRepo,
        GenresRepositoryInterface $genresRepo
    ) {
        $this->moviesRepo = $moviesRepo;
        $this->categoriesRepo = $categoriesRepo;
        $this->countriesRepo = $countriesRepo;
        $this->genresRepo = $genresRepo;
    }

    public function index()
    {
        return view('movies::list');
    }
    public function data()
    {
        $movies = $this->moviesRepo->getAllMovies()->get();
        return DataTables::of($movies)
            ->editColumn('thumbnail', function ($movie) {
                return '<img width="50px" height="70px" src="' . $movie->thumbnail . '" alt="">';
            })
            ->editColumn('comments', function ($movie) {
                return '<a href="' . route('admin.comments.index', $movie) . '" class="main__table-btn main__table-btn--view open-modal">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21.92,11.6C19.9,6.91,16.1,4,12,4S4.1,6.91,2.08,11.6a1,1,0,0,0,0,.8C4.1,17.09,7.9,20,12,20s7.9-2.91,9.92-7.6A1,1,0,0,0,21.92,11.6ZM12,18c-3.17,0-6.17-2.29-7.9-6C5.83,8.29,8.83,6,12,6s6.17,2.29,7.9,6C18.17,15.71,15.17,18,12,18ZM12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14Z"></path></svg>
                </a>';
            })
            ->editColumn('number', function ($movie) {
                $movieCurrent = $this->moviesRepo->find($movie->id);
                $episodes = $movieCurrent->episodes->count();
                return '<p class="main__title-stat">' . $episodes . '</p>';
            })
            ->editColumn('is_series', function ($movie) {
                if ($movie->is_series == 1) {
                    //Là phim bộ
                    return '<a href="' . route('admin.episodes.index', $movie->id) . '" class="main__table-btn main__table-btn--view open-modal">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21.92,11.6C19.9,6.91,16.1,4,12,4S4.1,6.91,2.08,11.6a1,1,0,0,0,0,.8C4.1,17.09,7.9,20,12,20s7.9-2.91,9.92-7.6A1,1,0,0,0,21.92,11.6ZM12,18c-3.17,0-6.17-2.29-7.9-6C5.83,8.29,8.83,6,12,6s6.17,2.29,7.9,6C18.17,15.71,15.17,18,12,18ZM12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14Z"></path></svg>
                    </a>';
                }
                return '<p class="text-danger">Không</p>';
            })
            ->editColumn('release_date', function ($movie) {
                return Carbon::parse($movie->release_date)->format('d-m-Y');
            })
            ->editColumn('category_id', function ($movie) {
                $categories = $this->moviesRepo->find($movie->id);
                $string = "";
                foreach ($categories->categories as $category) {
                    $string .= '<p><a href="' . route('admin.categories.edit', $category->id) . '" class="main__table-text--gold">' . $category->name . '</a></p>';
                }
                return $string;
            })
            ->editColumn('genre_id', function ($movie) {
                $genres = $this->moviesRepo->find($movie->id);
                $string = "";
                foreach ($genres->genres as $genre) {
                    $string .= '<p><a href="' . route('admin.genres.edit', $genre->id) . '" class="main__table-text--red">' . $genre->name . '</a></p>';
                }
                return $string;
            })
            ->editColumn('country_id', function ($movie) {
                $countries = $this->moviesRepo->find($movie->id);
                $string = "";
                foreach ($countries->countries as $country) {
                    $string .= '<p><a href="' . route('admin.countries.edit', $country->id) . '" class="main__table-text--green">' . $country->name . '</a></p>';
                }
                return $string;
            })
            ->addColumn('edit', function ($movie) {
                return '<a href="' . route('admin.movies.edit', $movie->id) . '" class="main__table-btn main__table-btn--edit">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22,7.24a1,1,0,0,0-.29-.71L17.47,2.29A1,1,0,0,0,16.76,2a1,1,0,0,0-.71.29L13.22,5.12h0L2.29,16.05a1,1,0,0,0-.29.71V21a1,1,0,0,0,1,1H7.24A1,1,0,0,0,8,21.71L18.87,10.78h0L21.71,8a1.19,1.19,0,0,0,.22-.33,1,1,0,0,0,0-.24.7.7,0,0,0,0-.14ZM6.83,20H4V17.17l9.93-9.93,2.83,2.83ZM18.17,8.66,15.34,5.83l1.42-1.41,2.82,2.82Z"/></svg>
                </a>';
            })
            ->addColumn('delete', function ($movie) {
                return '<a onclick="return confirm(\'Bạn có muốn xóa không?\')"
                href="' . route('admin.movies.delete', $movie->id) . '" class="main__table-btn main__table-btn--delete open-modal">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18ZM20,6H16V5a3,3,0,0,0-3-3H11A3,3,0,0,0,8,5V6H4A1,1,0,0,0,4,8H5V19a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V8h1a1,1,0,0,0,0-2ZM10,5a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V6H10Zm7,14a1,1,0,0,1-1,1H8a1,1,0,0,1-1-1V8H17Zm-3-1a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z"/></svg>
                </a>';
            })
            ->editColumn('created_at', function ($movie) {
                return Carbon::parse($movie->created_at)->format('H:i:s d-m-Y');
            })
            ->editColumn('star', function ($movie) {
                return $movie->averageRating();
            })
            ->rawColumns(['comments', 'number', 'thumbnail', 'is_series', 'country_id', 'genre_id', 'category_id', 'edit', 'delete', 'created_at', 'star'])
            ->toJson();
    }
    public function add()
    {
        $categories = $this->categoriesRepo->getAll();
        $countries = $this->countriesRepo->getAll();
        $genres = $this->genresRepo->getAll();
        return view('movies::add', compact('categories', 'countries', 'genres'));
    }

    public function create(MovieRequest $request)
    {
        if ($request->movie_url) {
            $movie_url = $request->movie_url;
            $is_series = 0;
        } else {
            $movie_url = null;
            $is_series = 1;
        }
        $movie = $this->moviesRepo->create([
            "thumbnail" => $request->thumbnail,
            "name" => $request->name,
            "slug" => $request->slug,
            "description" => $request->description,
            "release_date" => $request->release_date,
            "directors" => $request->directors,
            "quality" => $request->quality,
            "trailer_url" => $request->trailer_url,
            "movie_url" => $movie_url,
            'is_series' => $is_series,
        ]);

        //Quốc gia
        $countryIds = $request->country_id;
        $movie->countries()->attach($countryIds);

        //Danh mục
        $categoryIds = $request->category_id;
        $movie->categories()->attach($categoryIds);

        //Thể loại
        $genreIds = $request->genre_id;
        $movie->genres()->attach($genreIds);

        return redirect(route('admin.movies.index'))->with('mess', __('movies::messages.create.success'));
    }

    public function edit($id)
    {
        $movie = $this->moviesRepo->find($id);
        $categoryIds = $movie->categories->pluck('id')->toArray();
        $countryIds = $movie->countries->pluck('id')->toArray();
        $genreIds = $movie->genres->pluck('id')->toArray();
        //Danh sách biến thể
        $categories = $this->categoriesRepo->getAll();
        $countries = $this->countriesRepo->getAll();
        $genres = $this->genresRepo->getAll();
        return view('movies::edit', compact('movie', 'categories', 'countries', 'genres', 'countryIds', 'categoryIds', 'genreIds'));
    }
    public function update(MovieRequest $request, $id)
    {
        $movie = $this->moviesRepo->find($id);
        if ($request->movie_url) {
            $movie_url = $request->movie_url;
            $is_series = 0;
        } else {
            $movie_url = null;
            $is_series = 1;
        }
        $this->moviesRepo->update($id, [
            "thumbnail" => $request->thumbnail,
            "name" => $request->name,
            "slug" => $request->slug,
            "description" => $request->description,
            "release_date" => $request->release_date,
            "directors" => $request->directors,
            "quality" => $request->quality,
            "trailer_url" => $request->trailer_url,
            "movie_url" => $movie_url,
            'is_series' => $is_series,
        ]);
        //Quốc gia
        $countryIds = $request->country_id;
        $movie->countries()->sync($countryIds);

        //Danh mục
        $categoryIds = $request->category_id;
        $movie->categories()->sync($categoryIds);

        //Thể loại
        $genreIds = $request->genre_id;
        $movie->genres()->sync($genreIds);
        return back()->with('mess', __('movies::messages.update.success'));
    }

    public function delete($id)
    {
        $this->moviesRepo->delete($id);
        return back()->with('mess', __('movies::messages.delete.success'));
    }
}

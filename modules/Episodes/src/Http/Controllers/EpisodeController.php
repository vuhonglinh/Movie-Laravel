<?php

namespace Modules\Episodes\src\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Carbon;
use Modules\Episodes\src\Http\Requests\EpisodeRequest;
use Modules\Episodes\src\Repositories\EpisodesRepositoryInterface;
use Modules\Movies\src\Repositories\MoviesRepositoryInterface;
use Yajra\DataTables\DataTables;

class EpisodeController extends BaseController
{
    private $episodesRepo;
    private $moviesRepo;
    public function __construct(EpisodesRepositoryInterface $episodesRepo, MoviesRepositoryInterface $moviesRepo)
    {
        $this->episodesRepo = $episodesRepo;

        $this->moviesRepo = $moviesRepo;
    }

    public function index($id)
    {
        $movie = $this->moviesRepo->find($id);
        return view('episodes::list', compact('movie'));
    }


    public function data($id)
    {
        $movie = $this->moviesRepo->find($id);
        $episodes = $movie->episodes;
        return DataTables::of($episodes)
            ->addColumn('edit', function ($episodes) {
                return '<a href="' . route('admin.episodes.edit', $episodes->id) . '" class="main__table-btn main__table-btn--edit">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22,7.24a1,1,0,0,0-.29-.71L17.47,2.29A1,1,0,0,0,16.76,2a1,1,0,0,0-.71.29L13.22,5.12h0L2.29,16.05a1,1,0,0,0-.29.71V21a1,1,0,0,0,1,1H7.24A1,1,0,0,0,8,21.71L18.87,10.78h0L21.71,8a1.19,1.19,0,0,0,.22-.33,1,1,0,0,0,0-.24.7.7,0,0,0,0-.14ZM6.83,20H4V17.17l9.93-9.93,2.83,2.83ZM18.17,8.66,15.34,5.83l1.42-1.41,2.82,2.82Z"/></svg>
                </a>';
            })
            ->addColumn('delete', function ($episodes) {
                return '<a onclick="return confirm(\'Bạn có muốn xóa không?\')"
                href="' . route('admin.episodes.delete', $episodes->id) . '" class="main__table-btn main__table-btn--delete open-modal">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18ZM20,6H16V5a3,3,0,0,0-3-3H11A3,3,0,0,0,8,5V6H4A1,1,0,0,0,4,8H5V19a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V8h1a1,1,0,0,0,0-2ZM10,5a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V6H10Zm7,14a1,1,0,0,1-1,1H8a1,1,0,0,1-1-1V8H17Zm-3-1a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z"/></svg>
                </a>';
            })
            ->editColumn('movie', function ($episodes) use ($movie) {
                return '<a href="' . route('admin.movies.edit', $movie->id) . '">' . $movie->name . '</a>';
            })
            ->editColumn('created_at', function ($episodes) {
                return Carbon::parse($episodes->created_at)->format('d-m-Y H:i:s');
            })
            ->rawColumns(['movie', 'edit', 'delete', 'created_at'])
            ->toJson();
    }
    public function add($id)
    {
        $movie = $this->moviesRepo->find($id);
        $episodes = $movie->episodes->pluck('number')->toArray();
        if (empty($episodes)) {
            $episodes = [0];
        }
        return view('episodes::add', compact('episodes'));
    }

    public function create(EpisodeRequest $request, $id)
    {
        $episodes = $this->episodesRepo->create($request->except('_token'));
        $episodes->movies()->attach($id);
        return redirect(route('admin.episodes.index', $id))->with('mess', __('episodes::messages.create.success'));
    }

    public function edit($id)
    {
        $episode = $this->episodesRepo->find($id);
        $movie = $episode->movies()->first();

        $movieCurrent = $this->moviesRepo->find($movie->id);
        $episodes = $movie->episodes->pluck('number')->toArray();
        return view('episodes::edit', compact('episode', 'episodes', 'movie'));
    }
    public function update(EpisodeRequest $request, $id)
    {
        $this->episodesRepo->update($id, $request->except('_token'));
        return back()->with('mess', __('episodes::messages.update.success'));
    }

    public function delete($id)
    {
        $this->episodesRepo->delete($id);
        return back()->with('mess', __('episodes::messages.delete.success'));
    }
}

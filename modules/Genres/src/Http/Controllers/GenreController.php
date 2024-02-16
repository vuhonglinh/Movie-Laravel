<?php

namespace Modules\Genres\src\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Carbon;
use Modules\Genres\src\Http\Requests\GenreRequest;
use Modules\Genres\src\Repositories\GenresRepositoryInterface;
use Yajra\DataTables\DataTables;

class GenreController extends BaseController
{
    private $genresRepo;
    public function __construct(GenresRepositoryInterface $genresRepo)
    {
        $this->genresRepo = $genresRepo;
    }

    public function index()
    {
        return view('genres::list');
    }


    public function data()
    {
        $genres = $this->genresRepo->getAll();
        return DataTables::of($genres)
            ->addColumn('edit', function ($genre) {
                return '<a href="' . route('admin.genres.edit', $genre->id) . '" class="main__table-btn main__table-btn--edit">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22,7.24a1,1,0,0,0-.29-.71L17.47,2.29A1,1,0,0,0,16.76,2a1,1,0,0,0-.71.29L13.22,5.12h0L2.29,16.05a1,1,0,0,0-.29.71V21a1,1,0,0,0,1,1H7.24A1,1,0,0,0,8,21.71L18.87,10.78h0L21.71,8a1.19,1.19,0,0,0,.22-.33,1,1,0,0,0,0-.24.7.7,0,0,0,0-.14ZM6.83,20H4V17.17l9.93-9.93,2.83,2.83ZM18.17,8.66,15.34,5.83l1.42-1.41,2.82,2.82Z"/></svg>
                </a>';
            })
            ->addColumn('delete', function ($genre) {
                return '<a onclick="return confirm(\'Bạn có muốn xóa không?\')"
                href="' . route('admin.genres.delete', $genre->id) . '" class="main__table-btn main__table-btn--delete open-modal">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18ZM20,6H16V5a3,3,0,0,0-3-3H11A3,3,0,0,0,8,5V6H4A1,1,0,0,0,4,8H5V19a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V8h1a1,1,0,0,0,0-2ZM10,5a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V6H10Zm7,14a1,1,0,0,1-1,1H8a1,1,0,0,1-1-1V8H17Zm-3-1a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z"/></svg>
                </a>';
            })
            ->editColumn('created_at', function ($genre) {
                return Carbon::parse($genre->created_at)->format('d-m-Y H:i:s');
            })
            ->rawColumns(['edit', 'delete', 'created_at'])
            ->toJson();
    }
    public function add()
    {
        return view('genres::add');
    }

    public function create(GenreRequest $request)
    {
        $this->genresRepo->create($request->except('_token'));
        return redirect(route('admin.genres.index'))->with('mess', __('genres::messages.create.success'));
    }

    public function edit($id)
    {
        $genre = $this->genresRepo->find($id);
        return view('genres::edit', compact('genre'));
    }
    public function update(GenreRequest $request, $id)
    {
        $this->genresRepo->update($id, $request->except('_token'));
        return back()->with('mess', __('genres::messages.update.success'));
    }

    public function delete($id)
    {
        $this->genresRepo->delete($id);
        return back()->with('mess', __('genres::messages.delete.success'));
    }
}

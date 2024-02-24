<?php

namespace Modules\Comments\src\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Routing\Controller as BaseController;
use Modules\Comments\src\Repositories\CommentsRepositoryInterface;
use Modules\Movies\src\Models\Movie;
use Modules\Movies\src\Repositories\MoviesRepositoryInterface;
use Yajra\DataTables\DataTables;

class CommentController extends BaseController
{
    private $commentsRepo;
    private $moviesRepo;
    public function __construct(CommentsRepositoryInterface $commentsRepo, MoviesRepositoryInterface $moviesRepo)
    {
        $this->commentsRepo = $commentsRepo;
        $this->moviesRepo = $moviesRepo;
    }

    public function index(Movie $movie)
    {
        return view('comments::list');
    }

    public function data(Movie $movie)
    {
        $comments = $movie->comments;
        return DataTables::of($comments)
            ->addColumn('delete', function ($comment) {
                return '<a onclick="return confirm(\'Bạn có muốn xóa không?\')"
                href="' . route('admin.comments.delete', $comment->id) . '" class="main__table-btn main__table-btn--delete open-modal">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18ZM20,6H16V5a3,3,0,0,0-3-3H11A3,3,0,0,0,8,5V6H4A1,1,0,0,0,4,8H5V19a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V8h1a1,1,0,0,0,0-2ZM10,5a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V6H10Zm7,14a1,1,0,0,1-1,1H8a1,1,0,0,1-1-1V8H17Zm-3-1a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z"/></svg>
                </a>';
            })
            ->editColumn('movie', function ($comment) {
                return '<a href="' . route('admin.movies.edit', $comment->movies->id) . '" >' . $comment->movies->name . '</a>';
            })
            ->editColumn('created_at', function ($comment) {
                return Carbon::parse($comment->created_at)->format('d-m-Y H:i:s');
            })
            ->editColumn('customer', function ($comment) {
                return '<a href="" >' . $comment->customers->name . '</a>';
            })
            ->rawColumns(['movie', 'created_at', 'customer', 'delete'])
            ->toJson();
    }

    public function delete($id)
    {
        $this->commentsRepo->delete($id);
        return back()->with('mess', __('movies::messages.delete.success'));
    }
}

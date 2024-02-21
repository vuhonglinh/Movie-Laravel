<?php

namespace Modules\TrangChu\src\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Modules\Movies\src\Repositories\MoviesRepositoryInterface;
use Modules\TrangChu\src\Repositories\TrangChuRepositoryInterface;

class TrangChuController extends BaseController
{
    private $trangChuRepo;
    private $moviesRepo;
    public function __construct(TrangChuRepositoryInterface $trangChuRepo, MoviesRepositoryInterface $moviesRepo)
    {
        $this->trangChuRepo = $trangChuRepo;
        $this->moviesRepo = $moviesRepo;
    }

    public function index()
    {
        $danhSachPhimMoi = $this->trangChuRepo->danhSachPhimMoi();
        return view('trangchu::main', compact('danhSachPhimMoi'));
    }
}

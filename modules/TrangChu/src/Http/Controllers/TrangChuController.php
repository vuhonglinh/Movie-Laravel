<?php

namespace Modules\TrangChu\src\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Modules\Movies\src\Repositories\MoviesRepositoryInterface;
use Modules\Packages\src\Repositories\PackagesRepositoryInterface;
use Modules\TrangChu\src\Repositories\TrangChuRepositoryInterface;

class TrangChuController extends BaseController
{
    private $trangChuRepo;
    private $moviesRepo;

    private $packagesRepo;
    public function __construct(
        TrangChuRepositoryInterface $trangChuRepo,
        MoviesRepositoryInterface $moviesRepo,
        PackagesRepositoryInterface $packagesRepo
    ) {
        $this->trangChuRepo = $trangChuRepo;
        $this->moviesRepo = $moviesRepo;
        $this->packagesRepo = $packagesRepo;
    }

    public function index()
    {
        $danhSachPhimMoi = $this->trangChuRepo->danhSachPhimMoi();
        $danhSachPhim = $this->trangChuRepo->danhSachPhimDanhGiaCao();

        $danhSachGoi = $this->packagesRepo->getAllPackages();
        return view('trangchu::main', compact('danhSachPhimMoi', 'danhSachPhim','danhSachGoi'));
    }
}

<?php

namespace Modules\TimKiem\src\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Modules\TimKiem\src\Repositories\TimKiemRepositoryInterface;

class TimKiemController extends BaseController
{
    private $timKiemRepo;
    public function __construct(TimKiemRepositoryInterface $timKiemRepo)
    {
        $this->timKiemRepo = $timKiemRepo;
    }

    public function index(Request $request)
    {
        $name = $request->name;

        $movies = $this->timKiemRepo->getSearch($name);
        return view('timkiem::main', compact('movies', 'name'));
    }
}

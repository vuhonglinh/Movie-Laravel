<?php

namespace Modules\Dashboard\src\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class DashboardController extends BaseController
{
    public function __construct()
    {
    }

    public function index()
    {
        
        return view('dashboard::dashboard');
    }
}

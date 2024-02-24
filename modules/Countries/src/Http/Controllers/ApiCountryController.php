<?php

namespace Modules\Countries\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Countries\src\Repositories\CountriesRepositoryInterface;
use App\Http\Resources\Countries;
use Modules\Countries\src\Models\Country;

class ApiCountryController extends Controller
{
    /**
     * Hiển thị danh sách
     */
    public function index(Request $request)
    {
        $countries = Country::orderBy('id', 'desc');
        if ($countries->count() > 0) {
            $status = 200;
        } else {
            $status = 404;
        }
        $countries = $countries->paginate(3);
        $data = new Countries($countries, $status);

        return $data;
    }

    /**
     * Thêm mới
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Hiển thị chi tiết 
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Cập nhật 
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Xóa
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace Modules\Movies\src\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\MovieCollection;
use App\Http\Resources\MovieResource;
use Illuminate\Http\Request;
use Modules\Movies\src\Http\Requests\MovieRequest;
use Modules\Movies\src\Models\Movie;

class ApiMovieController extends Controller
{
    /**
     * Hiển thị danh sách
     */
    public function index()
    {
        $data = Movie::orderBy('id', 'desc')->with('genres')->paginate(4);
        if ($data->count() < 0) {
            $statusCode = 404;
            $statusText = 'Not Found';
        } else {
            $statusCode = 200;
            $statusText = 'success';
        }
        $data = new MovieCollection($data, $statusCode, $statusText);

        return $data;
    }

    /**
     * Thêm mới
     */
    public function store(MovieRequest $request)
    {
        $data = Movie::create($request->all());
        if (!$data) {
            $response = [
                'status' => 500,
                'message' => 'Server error'
            ];
        } else {
            $response = [
                'status' => 201,
                'message' => 'Created',
                'data' => $data
            ];
        }
        return $response;
    }

    /**
     * Hiển thị chi tiết 
     */
    public function show($id)
    {
        $data = Movie::with('genres')->find($id);

        if (!$data) {
            $statusCode = 404;
            $statusText = 'Not Found';
        } else {
            $statusCode = 200;
            $statusText = 'Success';
        }
        $data = new MovieResource($data);
        $response = [
            'status' => $statusCode,
            'message' => $statusText,
            'data' => $data
        ];
        return $response;
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

<?php

namespace Modules\Categories\src\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Carbon;
use Modules\Categories\src\Http\Requests\CategoryRequest;
use Modules\Categories\src\Models\Category;
use Modules\Categories\src\Repositories\CategoriesRepositoryInterface;
use Yajra\DataTables\DataTables;

class ApiCategoryController extends BaseController
{
    private $categoriesRepo;
    public function __construct(CategoriesRepositoryInterface $categoriesRepo)
    {
        $this->categoriesRepo = $categoriesRepo;
    }

    public function index()
    {
        $data = $this->categoriesRepo->getAllCategories();
        if ($data->count() > 0) {
            $response = [
                'status' => 200,
                'data' => $data
            ];
        } else {
            $response = [
                'status' => 204,
                'message' => __('categories::messages.create.failure'),
            ];
        }
        return $response;
    }

    public function detail($id)
    {
        $data = $this->categoriesRepo->find($id);
        if ($data) {
            $response = [
                'status' => 200,
                'data' => $data
            ];
        } else {
            $response = [
                'status' => 204,
            ];
        }
        return $response;
    }

    public function create(CategoryRequest $request)
    {
        $data = $this->categoriesRepo->create($request->all());

        if ($data) {
            $response = [
                'status' => 201,
                'message' => __('categories::messages.create.success'),
                'data' => $data
            ];
        } else {
            $response = [
                'status' => 204,
                'message' => __('categories::messages.create.failure'),
            ];
        }
        return $response;
    }


    public function update(CategoryRequest $request, $id)
    {
        $category = $this->categoriesRepo->find($id);
        if (!$category) {
            $response = [
                'status' => 204,
                'message' => __('categories::messages.update.failure'),
            ];
        } else {
            $method = $request->method();
            if ($method == 'PUT') {
                $this->categoriesRepo->update($id, $request->all());
                $response = [
                    'status' => 201,
                    'message' => __('categories::messages.update.success'),
                    'data' => $category
                ];
            } else {
                $this->categoriesRepo->update($id, $request->all());
                $response = [
                    'status' => 201,
                    'message' => __('categories::messages.update.success'),
                    'data' => $category
                ];
            }
        }
        return $response;
    }

    public function delete($id)
    {
        $category = $this->categoriesRepo->delete($id);
        if ($category) {
            $response = [
                'status' => 201,
                'message' => __('categories::messages.delete.success'),
            ];
        } else {
            $response = [
                'status' => 204,
                'message' => __('categories::messages.delete.failure'),
            ];
        }

        return $response;
    }
}

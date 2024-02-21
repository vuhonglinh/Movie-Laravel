<?php

namespace Modules\Packages\src\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Carbon;
use Modules\Packages\src\Http\Requests\PackageRequest;
use Modules\Packages\src\Repositories\PackagesRepositoryInterface;
use Yajra\DataTables\DataTables;

class PackageController extends BaseController
{
    private $packagesRepo;
    public function __construct(PackagesRepositoryInterface $packagesRepo)
    {
        $this->packagesRepo = $packagesRepo;
    }

    public function index()
    {
        return view('packages::list');
    }


    public function data()
    {
        $packages = $this->packagesRepo->getAll();
        return DataTables::of($packages)
            ->addColumn('edit', function ($package) {
                return '<a href="' . route('admin.packages.edit', $package->id) . '" class="main__table-btn main__table-btn--edit">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22,7.24a1,1,0,0,0-.29-.71L17.47,2.29A1,1,0,0,0,16.76,2a1,1,0,0,0-.71.29L13.22,5.12h0L2.29,16.05a1,1,0,0,0-.29.71V21a1,1,0,0,0,1,1H7.24A1,1,0,0,0,8,21.71L18.87,10.78h0L21.71,8a1.19,1.19,0,0,0,.22-.33,1,1,0,0,0,0-.24.7.7,0,0,0,0-.14ZM6.83,20H4V17.17l9.93-9.93,2.83,2.83ZM18.17,8.66,15.34,5.83l1.42-1.41,2.82,2.82Z"/></svg>
                </a>';
            })
            ->addColumn('delete', function ($package) {
                return '<a onclick="return confirm(\'Bạn có muốn xóa không?\')"
                href="' . route('admin.packages.delete', $package->id) . '" class="main__table-btn main__table-btn--delete open-modal">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18ZM20,6H16V5a3,3,0,0,0-3-3H11A3,3,0,0,0,8,5V6H4A1,1,0,0,0,4,8H5V19a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V8h1a1,1,0,0,0,0-2ZM10,5a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V6H10Zm7,14a1,1,0,0,1-1,1H8a1,1,0,0,1-1-1V8H17Zm-3-1a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z"/></svg>
                </a>';
            })
            ->editColumn('created_at', function ($package) {
                return Carbon::parse($package->created_at)->format('d-m-Y H:i:s');
            })
            ->editColumn('price', function ($package) {
                return number_format($package->price, 0, '.', '.').' VNĐ';
            })
            ->editColumn('duration', function ($package) {
                return $package->duration . " Ngày";
            })
            ->rawColumns(['edit', 'delete', 'created_at', 'price'])
            ->toJson();
    }
    public function add()
    {
        return view('packages::add');
    }

    public function create(PackageRequest $request)
    {
        if ($request->price) {
            $price = $request->price;
        } else {
            $price = 0;
        }
        $this->packagesRepo->create([
            'name' => $request->name,
            'price' => $price,
            'duration' => $request->duration
        ]);
        return redirect(route('admin.packages.index'))->with('mess', __('packages::messages.create.success'));
    }

    public function edit($id)
    {
        $package = $this->packagesRepo->find($id);
        return view('packages::edit', compact('package'));
    }
    public function update(PackageRequest $request, $id)
    {
        $this->packagesRepo->update($id, $request->except('_token'));
        return back()->with('mess', __('packages::messages.update.success'));
    }

    public function delete($id)
    {
        $this->packagesRepo->delete($id);
        return back()->with('mess', __('packages::messages.delete.success'));
    }
}

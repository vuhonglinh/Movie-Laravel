<?php

namespace Modules\Roles\src\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Modules\Roles\src\Http\Requests\RoleRequest;
use Modules\Roles\src\Models\Module;
use Modules\Roles\src\Repositories\RolesRepositoryInterface;
use Yajra\DataTables\DataTables;

class RoleController extends BaseController
{
    private $rolesRepo;
    public function __construct(RolesRepositoryInterface $rolesRepo)
    {
        $this->rolesRepo = $rolesRepo;
    }

    public function index()
    {
        return view('roles::list');
    }


    public function data()
    {
        $roles = $this->rolesRepo->getAllRoles();
        return DataTables::of($roles)
            ->editColumn('permissions', function ($role) {
                return '<a href="' . route('admin.roles.permissions', $role->id) . '" class="main__table-btn main__table-btn--view">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21.92,11.6C19.9,6.91,16.1,4,12,4S4.1,6.91,2.08,11.6a1,1,0,0,0,0,.8C4.1,17.09,7.9,20,12,20s7.9-2.91,9.92-7.6A1,1,0,0,0,21.92,11.6ZM12,18c-3.17,0-6.17-2.29-7.9-6C5.83,8.29,8.83,6,12,6s6.17,2.29,7.9,6C18.17,15.71,15.17,18,12,18ZM12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14Z"></path></svg>
            </a>';
            })
            ->addColumn('edit', function ($role) {
                return '<a href="' . route('admin.roles.edit', $role->id) . '" class="main__table-btn main__table-btn--edit">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22,7.24a1,1,0,0,0-.29-.71L17.47,2.29A1,1,0,0,0,16.76,2a1,1,0,0,0-.71.29L13.22,5.12h0L2.29,16.05a1,1,0,0,0-.29.71V21a1,1,0,0,0,1,1H7.24A1,1,0,0,0,8,21.71L18.87,10.78h0L21.71,8a1.19,1.19,0,0,0,.22-.33,1,1,0,0,0,0-.24.7.7,0,0,0,0-.14ZM6.83,20H4V17.17l9.93-9.93,2.83,2.83ZM18.17,8.66,15.34,5.83l1.42-1.41,2.82,2.82Z"/></svg>
                </a>';
            })
            ->addColumn('delete', function ($role) {
                return '<a onclick="return confirm(\'Bạn có muốn xóa không?\')"
                href="' . route('admin.roles.delete', $role->id) . '" class="main__table-btn main__table-btn--delete open-modal">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18ZM20,6H16V5a3,3,0,0,0-3-3H11A3,3,0,0,0,8,5V6H4A1,1,0,0,0,4,8H5V19a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V8h1a1,1,0,0,0,0-2ZM10,5a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V6H10Zm7,14a1,1,0,0,1-1,1H8a1,1,0,0,1-1-1V8H17Zm-3-1a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z"/></svg>
                </a>';
            })
            ->editColumn('created_at', function ($role) {
                return Carbon::parse($role->created_at)->format('d-m-Y H:i:s');
            })
            ->rawColumns(['permissions', 'edit', 'delete', 'created_at'])
            ->toJson();
    }
    public function add()
    {
        return view('roles::add');
    }

    public function create(RoleRequest $request)
    {
        $this->rolesRepo->create([
            'name' => $request->name,
            'user_id' => auth()->user()->id,
            'description' => $request->description
        ]);
        return redirect(route('admin.roles.index'))->with('mess', __('roles::messages.create.success'));
    }

    public function edit($id)
    {
        $role = $this->rolesRepo->find($id);
        return view('roles::edit', compact('role'));
    }
    public function update(RoleRequest $request, $id)
    {
        $this->rolesRepo->update($id, $request->except('_token'));
        return back()->with('mess', __('roles::messages.update.success'));
    }

    public function delete($id)
    {
        $this->rolesRepo->delete($id);
        return back()->with('mess', __('roles::messages.delete.success'));
    }


    public function permissions($id)
    {
        $modules = Module::all();
        $roleListArr = [
            'view' => 'Xem',
            'add' => 'Thêm',
            'edit' => 'Sửa',
            'delete' => 'Xóa',
        ];
        $roleArr = json_decode($this->rolesRepo->find($id)->permissions, true);
        return view('roles::permissions', compact('modules', 'roleListArr', 'roleArr'));
    }

    public function postPermissions(Request $request, $id)
    {
        $this->rolesRepo->update($id, [
            'permissions' => json_encode($request->role),
        ]);
        return back()->with('mess', __('roles::messages.permissions.success'));
    }
}

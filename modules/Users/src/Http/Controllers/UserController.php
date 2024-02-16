<?php

namespace Modules\Users\src\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Carbon;
use Modules\Users\src\Http\Requests\UserRequest;
use Modules\Users\src\Repositories\UsersRepositoryInterface;
use Yajra\DataTables\DataTables;

class UserController extends BaseController
{
    private $usersRepo;
    public function __construct(UsersRepositoryInterface $usersRepo)
    {
        $this->usersRepo = $usersRepo;
    }

    public function index()
    {
        return view('users::list');
    }


    public function data()
    {
        $users = $this->usersRepo->getAllUsers();
        return DataTables::of($users)
            ->addColumn('edit', function ($user) {
                return '<a href="' . route('admin.users.edit', $user->id) . '" class="main__table-btn main__table-btn--edit">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22,7.24a1,1,0,0,0-.29-.71L17.47,2.29A1,1,0,0,0,16.76,2a1,1,0,0,0-.71.29L13.22,5.12h0L2.29,16.05a1,1,0,0,0-.29.71V21a1,1,0,0,0,1,1H7.24A1,1,0,0,0,8,21.71L18.87,10.78h0L21.71,8a1.19,1.19,0,0,0,.22-.33,1,1,0,0,0,0-.24.7.7,0,0,0,0-.14ZM6.83,20H4V17.17l9.93-9.93,2.83,2.83ZM18.17,8.66,15.34,5.83l1.42-1.41,2.82,2.82Z"/></svg>
                </a>';
            })
            ->addColumn('delete', function ($user) {
                return '<a onclick="return confirm(\'Bạn có muốn xóa không?\')"
                href="' . route('admin.users.delete', $user->id) . '" class="main__table-btn main__table-btn--delete open-modal">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18ZM20,6H16V5a3,3,0,0,0-3-3H11A3,3,0,0,0,8,5V6H4A1,1,0,0,0,4,8H5V19a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V8h1a1,1,0,0,0,0-2ZM10,5a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V6H10Zm7,14a1,1,0,0,1-1,1H8a1,1,0,0,1-1-1V8H17Zm-3-1a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z"/></svg>
                </a>';
            })
            ->editColumn('created_at', function ($user) {
                return Carbon::parse($user->created_at)->format('d-m-Y H:i:s');
            })
            ->rawColumns(['edit', 'delete', 'created_at'])
            ->toJson();
    }
    public function add()
    {
        return view('users::add');
    }

    public function create(UserRequest $request)
    {
        $this->usersRepo->create($request->except('_token'));
        return redirect(route('admin.users.index'))->with('mess', __('users::messages.create.success'));
    }

    public function edit($id)
    {
        $user = $this->usersRepo->find($id);
        return view('users::edit', compact('user'));
    }
    public function update(UserRequest $request, $id)
    {
        $this->usersRepo->update($id, $request->except('_token'));
        return back()->with('mess', __('users::messages.update.success'));
    }

    public function delete($id)
    {
        $this->usersRepo->delete($id);
        return back()->with('mess', __('users::messages.delete.success'));
    }
}

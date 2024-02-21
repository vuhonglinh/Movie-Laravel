<?php

namespace Modules\Profile\src\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Profile\src\Http\Requests\ChangeInfoRequest;
use Modules\Profile\src\Http\Requests\ChangePasswordRequest;
use Modules\Profile\src\Repositories\ProfileRepositoryInterface;

class ProfileController extends BaseController
{
    private $profileRepo;
    public function __construct(ProfileRepositoryInterface $profileRepo)
    {
        $this->profileRepo = $profileRepo;
    }

    public function index()
    {
        $user = Auth::user();
        return view('profile::index', compact('user'));
    }


    public function changeInfo(ChangeInfoRequest $request)
    {
        $id = auth()->user()->id;
        $this->profileRepo->update($id, $request->except('_token'));
        return back()->with('mess', __('profile::messages.update.success'));
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $id = auth()->user()->id;
        $this->profileRepo->update($id, [
            'password' => Hash::make($request->confirmpass)
        ]);
        return back()->with('mess', __('profile::messages.change.password'));
    }
}

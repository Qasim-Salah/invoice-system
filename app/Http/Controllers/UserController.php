<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use App\Models\Role as RoleModel;
use App\Models\User as UserModel;


class UserController extends Controller
{

    public function index()
    {
        $users = UserModel::latest()->paginate(PAGINATION_COUNT);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = RoleModel::all();

        return view('users.create', compact('roles'));
    }

    public function store(UsersRequest $request)
    {
        $requests = $request->validated();
        $requests['password'] = bcrypt($request->password);
        UserModel::create($requests);

        return redirect()->route('users.index')->with('success', 'تم اضافة المستخدم بنجاح');
    }

    public function edit($id)
    {
        $roles = RoleModel::all();
        $users = UserModel::findOrfail($id);
        return view('users.edit', compact('users', 'roles'));
    }

    public function update(UsersRequest $request, $id)
    {

        $user = UserModel::findOrfail($id);
        $requests = $request->validated();
        $requests['password'] = bcrypt($request->password);

        $user->update($requests);
        return redirect()->route('users.index')->with('success', 'تم تحديث معلومات المستخدم بنجاح');
    }

    public function destroy($id)
    {
        if (UserModel::findOrfail($id)->delete()) {
            return redirect()->route('users')->with('success', 'تم حذف المستخدم بنجاح');
        }
        return redirect()->route('users.index')->with(['error' => 'هناك خطأ ما ']);

    }
}

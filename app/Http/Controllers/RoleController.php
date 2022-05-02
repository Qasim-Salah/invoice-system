<?php

namespace App\Http\Controllers;

use App\Http\Requests\RolesRequest;
use App\Models\Role as RoleModel;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = RoleModel::all();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(RolesRequest $request)
    {
        $this->process(new RoleModel, $request);

        return redirect()->route('roles.index')->with(['success' => 'تم ألاضافة بنجاح']);

    }

    public function edit($id)
    {
        $role = RoleModel::findOrFail($id);
        return view('roles.edit', compact('role'));
    }

    public function update($id, RolesRequest $request)
    {

        $role = RoleModel::findOrFail($id);
        $role = $this->process($role, $request);

            return redirect()->route('roles.index')->with(['success' => 'تم التحديث بنجاح']);

    }

    protected function process(RoleModel $role, Request $r)
    {
        $role->name = $r->name;
        $role->permissions = json_encode($r->permissions);
        $role->save();
        return $role;
    }

}

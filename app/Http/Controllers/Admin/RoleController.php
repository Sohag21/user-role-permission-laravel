<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::whereNotIn('name', ['admin'])->get();
        return view('backend.roles.index', compact('roles'));
    }

    public function create(){
        return view('backend.roles.create');
    }

    public function store(Request $request){
        $validated = $request->validate(['name' => ['required', 'min:3']]);
        Role::create($validated);
        return to_route('admin.roles.index')->with('message','Role Added Successfully');
    }

    public function edit(Role $role){
        $permissions = Permission::all();
        return view('backend.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role){
        $validated = $request->validate(['name' => ['required', 'min:3']]);
        $role->update($validated);
        return to_route('admin.roles.index')->with('info','Role Updated Successfully');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return back()->with('error', 'Role Deleted!');
    }

    public function givePermissions(Request $request, Role $role)
    {
        if($role->hasPermissionTo($request->permission)){
            return back()->with('info', 'Permission Exists');
        }

        $role->givePermissionTo($request->permission);
        return back()->with('message', 'Permission Added!');
    }

    public function removePermissions(Role $role, Permission $permission)
    {
        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
            return back()->with('error', 'Permission Removed');
        }
        return back()->with('info', 'Permission Not Exists');
    }


}

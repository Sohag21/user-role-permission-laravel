<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::all();
        return view('backend.permissions.index', compact('permissions'));
    }

    public function create(){
        return view('backend.permissions.create');
    }

    public function store(Request $request){
        $validated = $request->validate(['name' => ['required', 'min:3']]);
        Permission::create($validated);
        return to_route('admin.permissions.index')->with('message', 'Permission added successfully!');
    }

    public function edit(Permission $permission){
        $roles = Role::all();
        return view('backend.permissions.edit', compact('permission', 'roles'));
    }

    public function update(Request $request, Permission $permission){
        $validated = $request->validate(['name' => ['required', 'min:3']]);
        $permission->update($validated);

        return to_route('admin.permissions.index')->with('info', 'Permission updated successfully!');
    }

    public function destroy(Permission $permission){
        $permission->delete();

        return back()->with('error', 'Permission Deleted!');
    }

    public function giveRoles(Request $request, Permission $permission)
    {
        if($permission->hasRole($request->role)){
            return back()->with('info', 'Role Exists');
        }

        $permission->assignRole($request->role);
        return back()->with('message', 'Role Assigned!');
    }

    public function removeRoles(Permission $permission, Role $role)
    {
        if($permission->hasRole($role)){
            $permission->removeRole($role);
            return back()->with('error', 'Role Removed');
        }
        return back()->with('info', 'Role Not Exists');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permissiones = Permission::all();
        //  dd($permissions->toArray());
        return view('admin.permissions.index', compact('permissiones'));
    }


    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'module' => 'required',
        'action' => 'required',
        'name' => 'required|unique:permissions,name',
    ]);

    Permission::create($request->only('module', 'action', 'name'));

    return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
}



    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'module' => 'required',
            'action' => 'required',
            'name' => 'required|unique:permissions,name,' . $permission->id,
        ]);
    
        $permission->update($request->only('module', 'action', 'name'));
    
        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
    }
    
    public function toggleStatus(Permission $permission)
    {
        // current status को पलट दें (True को False, False को True)
        $permission->is_active = !$permission->is_active;
        $permission->save();

        // JSON response वापस करें
        return response()->json([
            'success' => true,
            'is_active' => $permission->is_active,
            'message' => 'Permission status updated successfully.'
        ]);
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
    }
}

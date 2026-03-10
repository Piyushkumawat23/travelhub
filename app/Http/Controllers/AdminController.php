<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{



    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Agar role 'user' hai toh deny
            if ($user->role === 'user') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->withErrors(['email' => 'You do not have admin access.']);
            }

            // ✅ Har role ke liye ek hi dashboard route
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid login credentials.']);
    }

    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'user') {
            return redirect('/')->with('error', 'You do not have permission to access admin dashboard.');
            
        }

        // Role ka naam nikaalo
        $roleName = $user->role;

        if ($roleName === 'admin') {
            // Agar admin hai to sabhi permissions allow kar do
            $permissiones = Permission::pluck('name')->toArray();
        } else {
            // Normal roles ke liye sirf unke permissions
            $role = Role::where('name', $roleName)->first();
            $permissiones = $role ? $role->permissions->pluck('name')->toArray() : [];
        }

        return view('admin.dashboard', compact('user', 'permissiones'));
    }


    public function StaffsIndex()
    {
        $roles  = Role::all();
        $excluded_roles = ['admin', 'user']; 

        // not show admin
        $staffs = User::whereNotIn('role', $excluded_roles)->get();
        
        // allow admin auth
        
        // $staffs = User::where('role', '!=', 'user')->get();
        return view('admin.staffs.index', compact('roles', 'staffs'));
    }


    public function StaffsCreate()
    {
        $roles = Role::all(); // Sabhi roles fetch karenge
        $permissiones = Permission::all();
        return view('admin.staffs.create', compact('roles', 'permissiones'));
    }

    public function StaffsStore(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|string|exists:roles,name', // Validate with roles table
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role, // Role name save hoga
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'User created successfully.');
    }

    // public function StaffsEdit($id)
    // {
    //     $staff = User::findOrFail($id);
    //     $roles = Role::all();
    //     $permissiones = Permission::all(); // <-- real models

    //     $role = Role::where('name', $staff->role)->first();

    //     if ($role && $role->name === 'admin') {
    //         $staffPermissions = $permissiones->pluck('id')->toArray();
    //     } else {
    //         $staffPermissions = $role ? $role->permissions->pluck('id')->toArray() : [];
    //     }

    //     return view('admin.staffs.edit', compact('staff', 'roles', 'permissiones', 'staffPermissions'));
    // }

    public function StaffsEdit($id)
    {
        $staff = User::findOrFail($id);
        $roles = Role::all();
        // $permissions = Permission::all();
        $permissions = Permission::where('is_active', true)->get();

        // Group permissions by module and action
        $groupedPermissions = [];
        foreach ($permissions as $perm) {
            $module = $perm->module ?: 'general';
            $action = $perm->action ?: 'view';
            $groupedPermissions[$module][$action] = $perm;
        }

        // Ensure default actions exist
        foreach ($groupedPermissions as $module => &$actions) {
            foreach (['view', 'add', 'edit', 'delete'] as $action) {
                if (!isset($actions[$action])) {
                    $actions[$action] = null;
                }
            }
        }

        // Staff's role permissions
        $role = Role::where('name', $staff->role)->first();
        $staffPermissions = $role ? $role->permissions->pluck('id')->map(fn($id) => (int)$id)->toArray() : [];

        return view('admin.staffs.edit', compact(
            'staff',
            'roles',
            'groupedPermissions',
            'staffPermissions'
        ));
    }





    public function StaffsUpdate(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role'  => 'required|string|exists:roles,name',
            'permissions' => 'array'
        ]);

        $staff = User::findOrFail($id);
        $staff->update([
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ]);

        // ✅ Role ke sath permissions sync karo (sabhi staff jinke paas ye role hai unpe apply hoga)
        $role = Role::where('name', $request->role)->first();
        if ($role) {
            $role->permissions()->sync($request->permissions ?? []);
        }

        return redirect()->route('staffs.index')->with('success', 'Staff updated successfully.');
    }
}

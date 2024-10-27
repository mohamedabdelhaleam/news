<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Models\Admin;
use App\Rules\UniqueUsername;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:add admins,admin'])->only(['create', 'store']);
        $this->middleware(['permission:edit admins,admin'])->only(['edit', 'update']);
        $this->middleware(['permission:delete admins,admin'])->only(['destroy']);
    }
    public function index()
    {
        $admins = Admin::get();
        return view('admin.admins.index', compact('admins'));
    }
    public function create()
    {
        $roles = Role::all();
        return view('admin.admins.create', compact('roles', 'branches'));
    }
    public function store(StoreAdminRequest $request)
    {
        $admin = Admin::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        $role = Role::find($request->role);

        $admin->assignRole($role);

        return redirect()->route('admin.admins.index')->with('success', 'Admin Added successfully.');
    }
    public function edit(Admin $admin)
    {
        $roles = Role::all();
        return view('admin.admins.edit', compact('admin', 'roles'));
    }

    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        $admin->update([
            'name' => $request->name,
            'username' => $request->username,
            'password' => $request->password ? Hash::make($request->password) : $admin->password,
            'branch_id' => $request->branch
        ]);
        $role = Role::find($request->role);
        $admin->syncRoles([]);
        $admin->assignRole($role);

        return redirect()->route('admin.admins.index')->with('success', 'Admin updated successfully.');
    }
    public function destroy(Admin $admin)
    {
        if (auth('admin')->user()->id == $admin->id) {
            return redirect()->route('admin.admins.index')->with('error', 'You can not delete yourself.');
        }
        $role = Role::where("name", "super_admin")->first();
        if ($role->users()->count() == 1 && $admin->hasRole('super_admin')) {
            return redirect()->route('admin.admins.index')->with('error', 'Last Super Admin can not be deleted.');
        }
        if ($admin->hasRole('super_admin') && !auth('admin')->user()->hasRole("super_admin")) {
            return redirect()->route('admin.admins.index')->with('error', 'You can not delete Super Admin.');
        }
        $admin->delete();
        return redirect()->route('admin.admins.index')->with('success', 'Admin deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:add roles,admin'])->only(['create', 'store']);
        $this->middleware(['permission:edit roles,admin'])->only(['edit', 'update']);
        $this->middleware(['permission:delete roles,admin'])->only(['destroy']);
    }
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }
    public function store(StoreRoleRequest $request)
    {
        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'admin',
        ]);
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }
        return redirect()->route('admin.roles.index')->with('success', 'تمت الاضافة بنجاح');
    }
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update([
            'name' => $request->name,
        ]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        } else {
            $role->syncPermissions([]);
        }

        return redirect()->route('admin.roles.index')->with('success', 'تم التعديل بنجاح');
    }
    public function destroy(Role $role)
    {
        if ($role->users()->count() > 0) {
            return redirect()->route('admin.roles.index')->with('error', ' يوجد مشرفون بهذا الدور. احذف المسؤولين أولاً.');
        }
        if ($role->name == 'super_admin') {
            return redirect()->route('admin.roles.index')->with('error', 'لا يمكن حذف هذا الدور.');
        }
        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'تم الحذف بنجاح');
    }
}

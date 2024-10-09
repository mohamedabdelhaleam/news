<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Branch;
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
    public function index(Request $request)
    {

        $query = Admin::query();
        if (request('search')) {
            $search = request("search");
            $query->where("name", 'LIKE', "%{$search}%")->orWhere("username", 'LIKE', "%{$search}%")->orWhereHas('roles', function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%");
            })->orWhereHas('branch', function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%");
            });
        }

        $admins = $query->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'collection' => view("admin.admins.partials.admins", compact("admins"))->render(),
                'pagination' => (string)  $admins->appends(['search' => request('search')])->links(),
            ]);
        }

        return view('admin.admins.index', compact('admins'));
    }
    public function create()
    {
        $roles = Role::all();
        $branches = Branch::all();
        return view('admin.admins.create', compact('roles', 'branches'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', new UniqueUsername],
            'password' => ['required', 'confirmed', Password::defaults()],
            'role' => ['required', 'exists:roles,id'],
            'branch' => ['nullable', 'exists:branches,id'],
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'branch_id' => $request->branch
        ]);

        $role = Role::find($request->role);

        $admin->assignRole($role);

        return redirect()->route('admin.admins.index')->with('success', 'Admin Added successfully.');
    }
    public function edit(Admin $admin)
    {
        $roles = Role::all();
        $branches = Branch::all();
        return view('admin.admins.edit', compact('admin', 'roles', 'branches'));
    }

    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'required',
                'string',
                'max:255',
                new UniqueUsername($admin->id)
            ],
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'role' => ['required', 'exists:roles,id'],
            'branch' => ['nullable', 'exists:branches,id'],
        ]);

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

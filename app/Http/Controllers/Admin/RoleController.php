<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use App\Models\Admin\Role;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    public function index()
    {

        if(!Gate::allows('roles')){
            return view('admin.errors.notAllowed');
        }

        return view('admin.roles.index', [
            'roles' => Role::paginate(10),
        ]);
    }

    public function create()
    {
        if (! Gate::allows('roles.create')) {
            return view('admin.errors.notAllowed');
        }
        return view('admin.roles.create');
    }

    public function store(RoleRequest $request)
    {

        $role = Role::create($request->validated());

        foreach ($request->post('permissions', []) as $permission) {

            $role->permissions()->create([
                'permission' => $permission,
            ]);
        }

        Toastr()->success('تم إضافة اوامر وصلاحيات جديدة بنجاح');
        return redirect()->route('admin.roles.index');
    }

    public function edit(Role $role)
    {
        if (! Gate::allows('roles.edit')) {
            return view('admin.errors.notAllowed');
        }

        return view('admin.roles.edit', compact('role'));
    } //end of edit

    public function update(RoleRequest $request, Role $role)
    {

        $role->update($request->validated());

        $role->permissions()->delete();

        foreach ($request->post('permissions', []) as $permission) {

            $role->permissions()->create([
                'permission' => $permission,
            ]);
        }

        Toastr()->success('تم التعديل على  اوامر وصلاحيات بنجاح');
        return redirect()->route('admin.roles.index');
    } //end of update

    public function destroy(Role $role)
    {

        if (! Gate::allows('roles.destroy')) {
            return view('admin.errors.notAllowed');
        }

        $role->delete();
        Toastr()->success('تم حذف اوامر وصلاحيات  بنجاح');
        return redirect()->route('admin.roles.index');

    }
}

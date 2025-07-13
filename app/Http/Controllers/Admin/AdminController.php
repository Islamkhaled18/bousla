<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\Admin\Admin;
use App\Models\Admin\Role;

class AdminController extends Controller
{
    public function index()
    {

        // if (! Gate::allows('admins')) {
        //     return view('admin.errors.notAllowed');
        // }

        $admins = Admin::get();
        return view('admin.admins.index', compact('admins'));
    } //end of index

    public function create()
    {

        // if (! Gate::allows('admins.create')) {
        //     return view('admin.errors.notAllowed');
        // }
        $roles = Role::all();
        return view('admin.admins.create', compact('roles'));
    } //end of create

    public function store(AdminRequest $request)
    {

        $request->merge(['password' => bcrypt($request->password)]);
        Admin::create($request->validated());

        Toastr()->success('تم إضافة مشرف بنجاح');
        return redirect()->route('admin.admins.index');
    } //end of store

    public function edit(Admin $admin)
    {
        // if (! Gate::allows('admins.edit')) {
        //     return view('admin.errors.notAllowed');
        // }

        $roles = Role::get();
        return view('admin.admins.edit', compact('admin', 'roles'));

    } //end of Ediit

    public function update(AdminRequest $request, Admin $admin)
    {

        //password
        $data = $request->validated();

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $admin->update($data);

        Toastr()->success('تم التعديل على المشرف بنجاح');
        return redirect()->route('admin.admins.index');

    } //end of update

    public function destroy(Admin $admin)
    {
        // if (! Gate::allows('admins.destroy')) {
        //     return view('admin.errors.notAllowed');
        // }
        $admin->delete();
        Toastr()->success('تم الحذف بنجاح');
        return redirect()->route('admin.admins.index');
    } //end of destroy
}

<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AboutusRequest;
use App\Models\Admin\Aboutus;
use Illuminate\Support\Facades\Gate;

class AboutusController extends Controller
{
    public function index()
    {
        if (! Gate::allows('about_us')) {
            return view('admin.errors.notAllowed');
        }
        $about_us = Aboutus::paginate(10);
        return view('admin.about_us.index', compact('about_us'));
    } //end of index

    public function create()
    {
        if (! Gate::allows('about_us.create')) {
            return view('admin.errors.notAllowed');
        }
        return view('admin.about_us.create');
    } //end of create

    public function store(AboutusRequest $request)
    {
        Aboutus::create($request->validated());
        Toastr()->success('تم إضافة  عن المنظمه جديده بنجاح');
        return redirect()->route('admin.about_us.index');

    } //end of store

    public function edit(Aboutus $about_u)
    {
        if (! Gate::allows('about_us.edit')) {
            return view('admin.errors.notAllowed');
        }
        return view('admin.about_us.edit', compact('about_u'));
    } //end of edit

    public function update(AboutusRequest $request, Aboutus $about_u)
    {
        $about_u->update($request->validated());
        Toastr()->success('تم التعديل على عن المنظمه بنجاح');
        return redirect()->route('admin.about_us.index');
    } //end of update

    public function destroy(Aboutus $about_u)
    {

        $about_u->delete();

        Toastr()->success('تم حذف عن المنظمه بنجاح');
        return redirect()->route('admin.about_us.index');
    } //end of destroy
}

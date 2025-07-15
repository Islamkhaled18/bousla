<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TermConditionRequest;
use App\Models\Admin\TermCondition;
use Illuminate\Support\Facades\Gate;

class TermConditionController extends Controller
{
    public function index()
    {
        if (! Gate::allows('terms')) {
            return view('admin.errors.notAllowed');
        }
        $terms = TermCondition::paginate(10);
        return view('admin.terms.index', compact('terms'));
    } //end of index

    public function create()
    {
        if (! Gate::allows('terms.create')) {
            return view('admin.errors.notAllowed');
        }
        return view('admin.terms.create');
    } //end of create

    public function store(TermConditionRequest $request)
    {
        TermCondition::create($request->validated());

        Toastr()->success('تم إضافة شروط واحكام جديده جديده بنجاح');
        return redirect()->route('admin.terms.index');

    } //end of store

    public function edit(TermCondition $term)
    {
        if (! Gate::allows('terms.edit')) {
            return view('admin.errors.notAllowed');
        }
        return view('admin.terms.edit', compact('term'));
    } //end of edit

    public function update(TermConditionRequest $request, TermCondition $term)
    {
        $term->update($request->validated());

        Toastr()->success('تم التعديل على الشروط والحكام بنجاح');
        return redirect()->route('admin.terms.index');
    } //end of update

    public function destroy(TermCondition $term)
    {
        if (! Gate::allows('terms.destroy')) {
            return view('admin.errors.notAllowed');
        }

        $term->delete();

        Toastr()->success('تم الحذف بنجاح');
        return redirect()->route('admin.terms.index');
    } //end of destroy

}

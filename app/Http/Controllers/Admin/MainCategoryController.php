<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MainCategoryRequest;
use App\Models\Admin\MainCategory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class MainCategoryController extends Controller
{
    public function index()
    {
        if (! Gate::allows('mainCategories')) {
            return view('admin.errors.notAllowed');
        }
        $mainCategories = MainCategory::paginate(10);
        return view('admin.mainCategories.index', compact('mainCategories'));
    } //end of index

    public function create()
    {
        if (! Gate::allows('mainCategories.create')) {
            return view('admin.errors.notAllowed');
        }
        return view('admin.mainCategories.create');
    } //end of create

    public function store(MainCategoryRequest $request)
    {
        $data = $request->except('image');

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image         = $request->file('image');
            $data['image'] = $image->store('mainCategories', 'images');
        }

        MainCategory::create($data);

        Toastr()->success('تم إضافة قسم رئيسي بنجاح بنجاح');
        return redirect()->route('admin.mainCategories.index');

    } //end of store

    public function edit(MainCategory $mainCategory)
    {
        if (! Gate::allows('mainCategories.edit')) {
            return view('admin.errors.notAllowed');
        }
        return view('admin.mainCategories.edit', compact('mainCategory'));
    } //end of edit

    public function update(MainCategoryRequest $request, MainCategory $mainCategory)
    {

        $old_image = $mainCategory->image;
        $data      = $request->except('image');
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image         = $request->file('image');
            $data['image'] = $image->store('mainCategories', 'images');
        }

        $mainCategory->update($data);

        if ($old_image && isset($data['image'])) {
            Storage::disk('images')->delete($old_image);
        }

        Toastr()->success('تم التعديل على القسم الرئيسي بنجاح');
        return redirect()->route('admin.mainCategories.index');
    } //end of update

    public function destroy(MainCategory $mainCategory)
    {
        if (! Gate::allows('mainCategories.destroy')) {
            return view('admin.errors.notAllowed');
        }

        if ($mainCategory->image) {
            Storage::disk('images')->delete($mainCategory->image);
        }

        $mainCategory->delete();

        Toastr()->success('تم حذف قسم رئيسي بنجاح');
        return redirect()->route('admin.mainCategories.index');

    } //end of destroy

}

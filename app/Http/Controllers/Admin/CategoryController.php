<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Admin\Category;
use App\Models\Admin\MainCategory;
use App\Traits\ImageUploadTrait;
use App\Traits\ToggleStatusTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    use ImageUploadTrait;
    use ToggleStatusTrait;

    public function index()
    {
        if (! Gate::allows('categories')) {
            return view('admin.errors.notAllowed');
        }
        $categories = Category::paginate(10);
        return view('admin.categories.index', compact('categories'));
    } //end of index

    public function create()
    {
        if (! Gate::allows('categories.create')) {
            return view('admin.errors.notAllowed');
        }
        $categories     = Category::select('id', 'parent_id', 'name')->whereNull('parent_id')->get();
        $mainCategories = MainCategory::select('id', 'name')->get();

        return view('admin.categories.create', compact('categories', 'mainCategories'));
    } //end of create

    public function store(CategoryRequest $request)
    {
        $request_data = $request->except(['name', 'type', 'image']);

        if ($request->type == 1) {
            $request['parent_id'] = null;
        }

        $request_data['main_category_id'] = $request->main_category_id;

        // Handle image upload using trait
        $imagePath = $this->handleImageUpload($request, 'image', 'categories');
        if ($imagePath) {
            $request_data['image'] = $imagePath;
        }

        $request_data['name'] = $request->name;

        Category::create($request_data);

        Toastr()->success('تم إضافة قسم جديد بنجاح');
        return redirect()->route('admin.categories.index');
    } //end of store

    public function edit(Category $category)
    {
        if (! Gate::allows('categories.edit')) {
            return view('admin.errors.notAllowed');
        }
        $mainCategory   = MainCategory::select('id', 'name')->get();
        $mainCategories = MainCategory::select('id', 'name')->get();
        $categories     = Category::select('id', 'parent_id', 'name')->whereNull('parent_id')->get();
        if (! $category) {
            return redirect()->route('admin.categories.index');
        }

        return view('admin.categories.edit', compact('category', 'categories', 'mainCategory', 'mainCategories'));
    } //end of edit

    public function update(CategoryRequest $request, Category $category)
    {

        if ($request->type == 1) {
            $request['parent_id'] = null;
        }

        $request_data = $request->except(['name', 'type', 'image']);

        // Handle image update using trait
        $newImagePath = $this->handleImageUpdate($request, $category->image, 'image', 'categories');
        if ($newImagePath) {
            $request_data['image'] = $newImagePath;
        }

        $request_data['name']             = $request->name;
        $request_data['main_category_id'] = $request->main_category_id;

        $category->update($request_data);

        Toastr()->success('تم التعديل على القسم بنجاح');
        return redirect()->route('admin.categories.index');
    }

    public function destroy(Category $category)
    {
        if (! Gate::allows('categories.destroy')) {
            return view('admin.errors.notAllowed');
        }

        // Delete image using trait
        $this->deleteOldImage($category->image);

        $category->delete();
        Toastr()->success('تم حذف القسم بنجاح');
        return redirect()->route('admin.categories.index');

    } //end of destroy

    public function toggleStatus(Request $request, $id)
    {
        return $this->toggleStatusGeneric(
            $request,
            $id,
            Category::class,
            'categories.edit',
            'القسم غير موجود'
        );
    } //end of toggleStatus
}

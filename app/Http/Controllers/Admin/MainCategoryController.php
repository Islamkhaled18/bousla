<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MainCategoryRequest;
use App\Models\Admin\MainCategory;
use App\Traits\ImageUploadTrait;
use App\Traits\ToggleStatusTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MainCategoryController extends Controller
{
    use ImageUploadTrait;
    use ToggleStatusTrait;

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

        // Handle image upload using trait
        $imagePath = $this->handleImageUpload($request, 'image', 'mainCategories');
        if ($imagePath) {
            $data['image'] = $imagePath;
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

        $data = $request->except('image');

        // Handle image update using trait
        $newImagePath = $this->handleImageUpdate($request, $mainCategory->image, 'image', 'mainCategories');
        if ($newImagePath) {
            $data['image'] = $newImagePath;
        }

        $mainCategory->update($data);

        Toastr()->success('تم التعديل على القسم الرئيسي بنجاح');
        return redirect()->route('admin.mainCategories.index');
    } //end of update

    public function destroy(MainCategory $mainCategory)
    {
        if (! Gate::allows('mainCategories.destroy')) {
            return view('admin.errors.notAllowed');
        }

        // Delete image using trait
        $this->deleteOldImage($mainCategory->image);

        $mainCategory->delete();

        Toastr()->success('تم حذف قسم رئيسي بنجاح');
        return redirect()->route('admin.mainCategories.index');

    } //end of destroy

    public function toggleStatus(Request $request, $id)
    {
        // if (! Gate::allows('mainCategories.edit')) {
        //     return response()->json(['success' => false, 'message' => 'غير مسموح'], 403);
        // }

        // try {
        //     $mainCategory = MainCategory::find($id);

        //     if (! $mainCategory) {
        //         return response()->json([
        //             'success' => false,
        //             'message' => 'القسم غير موجود',
        //         ], 404);
        //     }

        //     $mainCategory->update([
        //         'is_active' => $request->is_active,
        //     ]);

        //     return response()->json([
        //         'success'   => true,
        //         'message'   => 'تم تغيير الحالة بنجاح',
        //         'is_active' => $mainCategory->is_active,
        //     ]);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'حدث خطأ أثناء تغيير الحالة: ' . $e->getMessage(),
        //     ], 500);
        // }

        return $this->toggleStatusGeneric(
            $request,
            $id,
            MainCategory::class,
            'mainCategories.edit',
            'القسم الرئيسي غير موجود'
        );
    } //end of toggleStatus

}

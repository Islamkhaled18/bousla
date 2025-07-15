<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandRequest;
use App\Models\Admin\Brand;
use App\Models\Admin\BrandImage;
use App\Traits\ImageUploadTrait;
use App\Traits\ToggleStatusTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    use ImageUploadTrait;
    use ToggleStatusTrait;

    public function index()
    {
        if (! Gate::allows('brands')) {
            return view('admin.errors.notAllowed');
        }
        $brands = Brand::paginate(10);
        return view('admin.brands.index', compact('brands'));
    } //end of index

    public function create()
    {
        if (! Gate::allows('brands.create')) {
            return view('admin.errors.notAllowed');
        }
        return view('admin.brands.create');
    } //end of create

    public function store(BrandRequest $request)
    {
        $data = $request->except('image');
        // Handle image upload using trait
        $imagePath = $this->handleImageUpload($request, 'image', 'brands');
        if ($imagePath) {
            $data['image'] = $imagePath;
        }

        $brand = Brand::create($data);

        if ($request->hasFile('photo') && is_array($request->file('photo'))) {
            foreach ($request->file('photo') as $imagefile) {
                $image           = new BrandImage();
                $path            = $imagefile->store('/images/brands', ['disk' => 'my_files']);
                $image->photo    = $path;
                $image->brand_id = $brand->id;
                $image->save();
            }
        }

        Toastr()->success('تم إضافة ماركة جديدة بنجاح');
        return redirect()->route('admin.brands.index');

    } //end of store

    public function edit(Brand $brand)
    {
        if (! Gate::allows('brands.edit')) {
            return view('admin.errors.notAllowed');
        }

        return view('admin.brands.edit', compact('brand'));
    } //end of edit

    public function update(BrandRequest $request, Brand $brand)
    {

        $data = $request->except('image');

        // Handle image update using trait
        $newImagePath = $this->handleImageUpdate($request, $brand->image, 'image', 'brands');
        if ($newImagePath) {
            $data['image'] = $newImagePath;
        }

        $brand->update($data);

        if ($brand->images && $brand->images->count() > 0) {
            foreach ($brand->images as $oldImage) {

                Storage::disk('my_files')->delete($oldImage->photo);
                $oldImage->delete();
            }
        }

        if ($request->hasFile('photo') && is_array($request->file('photo'))) {
            foreach ($request->file('photo') as $imagefile) {
                $image           = new BrandImage();
                $path            = $imagefile->store('/images/brands', ['disk' => 'my_files']);
                $image->photo    = $path;
                $image->brand_id = $brand->id;
                $image->save();
            }
        }

        Toastr()->success('تم التعديل على الماركة بنجاح');
        return redirect()->route('admin.brands.index');
    } //end of update

    public function destroy(Brand $brand)
    {
        if (! Gate::allows('brands.destroy')) {
            return view('admin.errors.notAllowed');
        }

        // Delete image using trait
        $this->deleteOldImage($brand->image);

        if ($brand->images && $brand->images->count() > 0) {
            foreach ($brand->images as $image) {

                Storage::disk('my_files')->delete($image->photo);

                $image->delete();
            }
        }

        $brand->delete();

        Toastr()->success('تم حذف الماركه بنجاح');
        return redirect()->route('admin.brands.index');

    } //end of destroy

    public function toggleStatus(Request $request, $id)
    {
        return $this->toggleStatusGeneric(
            $request,
            $id,
            Brand::class,
            'brands.edit',
            'الماركه غير موجوده'
        );
    } //end of toggleStatus

}

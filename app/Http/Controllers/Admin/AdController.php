<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdRequest;
use App\Models\Admin\Ad;
use App\Models\Admin\Brand;
use App\Traits\ImageUploadTrait;
use App\Traits\ToggleStatusTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdController extends Controller
{

    use ImageUploadTrait;
    use ToggleStatusTrait;

    public function index()
    {
        if (! Gate::allows('ads')) {
            return view('admin.errors.notAllowed');
        }
        $ads = Ad::paginate(10);
        return view('admin.ads.index', compact('ads'));
    } //end of index

    public function create()
    {
        if (! Gate::allows('ads.create')) {
            return view('admin.errors.notAllowed');
        }

        $ads    = Ad::get();
        $brands = Brand::get();
        return view('admin.ads.create', compact('ads', 'brands'));
    } //end of create

    public function store(AdRequest $request)
    {

        $request_data = $request->except(['name', 'image']);

        $request_data['brand_id'] = $request->brand_id;

        // Handle image upload using trait
        $imagePath = $this->handleImageUpload($request, 'image', 'ads');
        if ($imagePath) {
            $request_data['image'] = $imagePath;
        }

        $request_data['name'] = $request->name;

        Ad::create($request_data);

        Toastr()->success('تم إضافة صورة اعلان جديدة بنجاح');

        return redirect()->route('admin.ads.index');

    } //end of store

    public function edit(Ad $ad)
    {
        if (! Gate::allows('ads.edit')) {
            return view('admin.errors.notAllowed');
        }

        $brands = Brand::get();
        return view('admin.ads.edit', compact('ad', 'brands'));
    } //end of edit

    public function update(AdRequest $request, Ad $ad)
    {

        $request_data = $request->except(['name', 'image']);

        // Handle image update using trait
        $newImagePath = $this->handleImageUpdate($request, $ad->image, 'image', 'ads');
        if ($newImagePath) {
            $request_data['image'] = $newImagePath;
        }

        $request_data['name']     = $request->name;
        $request_data['brand_id'] = $request->brand_id;
        $ad->update($request_data);

        Toastr()->success('تم التعديل على صورة اعلان بنجاح');
        return redirect()->route('admin.ads.index');
    } //end of update

    public function destroy(Ad $ad)
    {
        if (! Gate::allows('ads.destroy')) {
            return view('admin.errors.notAllowed');
        }

        // Delete image using trait
        $this->deleteOldImage($ad->image);

        $ad->delete();
        Toastr()->success('تم حذف صورة اعلان بنجاح');
        return redirect()->route('admin.ads.index');

    } //end of destroy

    public function toggleStatus(Request $request, $id)
    {
        return $this->toggleStatusGeneric(
            $request,
            $id,
            Ad::class,
            'ads.edit',
            'صورة الاعلان غير موجوده'
        );
    } //end of toggleStatus

}

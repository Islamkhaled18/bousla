<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AreaRequest;
use App\Http\Requests\Admin\CityRequest;
use App\Models\Admin\Area;
use App\Models\Admin\City;
use App\Models\Admin\Governorate;
use App\Traits\ToggleStatusTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AreaController extends Controller
{
     use ToggleStatusTrait;

    public function index()
    {
        if (! Gate::allows('areas')) {
            return view('admin.errors.notAllowed');
        }
        $areas = Area::with('city')->get();
        return view('admin.areas.index', compact('areas'));
    }

    public function create()
    {
        if (! Gate::allows('areas.create')) {
            return view('admin.errors.notAllowed');
        }
        $cities = City::where('is_active', 1)->get();
        return view('admin.areas.create', compact('cities'));
    }

    public function store(AreaRequest $request)
    {
        Area::create($request->validated());
        Toastr()->success('تم اضافة منطقه بنجاح');
        return redirect()->route('admin.areas.index');
    }

    public function edit(Area $area)
    {
        if (! Gate::allows('areas.edit')) {
            return view('admin.errors.notAllowed');
        }
        $cities = City::where('is_active', 1)->get();
        return view('admin.areas.edit', compact('area', 'cities'));
    }

    public function update(AreaRequest $request, Area $area)
    {
        $area->update($request->validated());
        Toastr()->success('تم تعديل المنطقه بنجاح');
        return redirect()->route('admin.areas.index');
    }

    public function destroy(Area $area)
    {
        if (! Gate::allows('areas.destroy')) {
            return view('admin.errors.notAllowed');
        }
        $area->delete();
        Toastr()->success('تم حذف المنطقه بنجاح');
        return redirect()->route('admin.areas.index');
    }

    public function toggleStatus(Request $request, $id)
    {

        return $this->toggleStatusGeneric(
            $request,
            $id,
            Area::class,
            'areas.edit',
            'منطقه غير موجود'
        );
    } //end of toggleStatus
}

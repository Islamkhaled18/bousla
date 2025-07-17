<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CityRequest;
use App\Models\Admin\City;
use App\Models\Admin\Governorate;
use App\Traits\ToggleStatusTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CityController extends Controller
{
    use ToggleStatusTrait;

    public function index()
    {
        if (! Gate::allows('cities')) {
            return view('admin.errors.notAllowed');
        }
        $cities = City::with('governorate')->get();
        return view('admin.cities.index', compact('cities'));
    }

    public function create()
    {
        if (! Gate::allows('cities.create')) {
            return view('admin.errors.notAllowed');
        }
        $governorates = Governorate::where('is_active', 1)->get();
        return view('admin.cities.create', compact('governorates'));
    }

    public function store(CityRequest $request)
    {
        City::create($request->validated());
        Toastr()->success('تم اضافة المدينة بنجاح');
        return redirect()->route('admin.cities.index');
    }

    public function edit(City $city)
    {
        if (! Gate::allows('cities.edit')) {
            return view('admin.errors.notAllowed');
        }
        $governorates = Governorate::where('is_active', 1)->get();
        return view('admin.cities.edit', compact('city', 'governorates'));
    }

    public function update(CityRequest $request, City $city)
    {
        $city->update($request->validated());
        Toastr()->success('تم تعديل المدينة بنجاح');
        return redirect()->route('admin.cities.index');
    }

    public function destroy(City $city)
    {
        if (! Gate::allows('cities.destroy')) {
            return view('admin.errors.notAllowed');
        }
        $city->delete();
        Toastr()->success('تم حذف المدينة بنجاح');
        return redirect()->route('admin.cities.index');
    }

    public function toggleStatus(Request $request, $id)
    {

        return $this->toggleStatusGeneric(
            $request,
            $id,
            City::class,
            'cities.edit',
            'مدينة غير موجود'
        );
    } //end of toggleStatus

}

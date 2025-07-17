<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GovernorateRequest;
use App\Models\Admin\Governorate;
use App\Traits\ToggleStatusTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class GovernorateController extends Controller
{
    use ToggleStatusTrait;

    public function index()
    {
        if (! Gate::allows('governorates')) {
            return view('admin.errors.notAllowed');
        }
        $governorates = Governorate::paginate(10);
        return view('admin.governorates.index', compact('governorates'));
    } //end of index

    public function create()
    {
        if (! Gate::allows('governorates.create')) {
            return view('admin.errors.notAllowed');
        }
        return view('admin.governorates.create');
    } //end of create

    public function store(GovernorateRequest $request)
    {
        Governorate::create($request->validated());

        Toastr()->success('تم إضافة محافظة بنجاح بنجاح');
        return redirect()->route('admin.governorates.index');

    } //end of store

    public function edit(Governorate $governorate)
    {
        if (! Gate::allows('governorates.edit')) {
            return view('admin.errors.notAllowed');
        }
        return view('admin.governorates.edit', compact('governorate'));
    } //end of edit

    public function update(GovernorateRequest $request, Governorate $governorate)
    {
        $governorate->update($request->validated());

        Toastr()->success('تم التعديل على محافظة بنجاح');
        return redirect()->route('admin.governorates.index');
    } //end of update

    public function destroy(Governorate $governorate)
    {
        if (! Gate::allows('governorates.destroy')) {
            return view('admin.errors.notAllowed');
        }

        $governorate->delete();

        Toastr()->success('تم حذف محافظة بنجاح');
        return redirect()->route('admin.governorates.index');

    } //end of destroy

    public function toggleStatus(Request $request, $id)
    {

        return $this->toggleStatusGeneric(
            $request,
            $id,
            Governorate::class,
            'governorates.edit',
            'محافظة غير موجود'
        );
    } //end of toggleStatus
}

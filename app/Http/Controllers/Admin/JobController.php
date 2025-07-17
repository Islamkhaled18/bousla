<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GovernorateRequest;
use App\Http\Requests\Admin\JobRequest;
use App\Models\Admin\Governorate;
use App\Models\Admin\Job;
use App\Traits\ToggleStatusTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class JobController extends Controller
{
    use ToggleStatusTrait;

    public function index()
    {
        if (! Gate::allows('jobs')) {
            return view('admin.errors.notAllowed');
        }
        $jobs = Job::paginate(10);
        return view('admin.jobs.index', compact('jobs'));
    } //end of index

    public function create()
    {
        if (! Gate::allows('jobs.create')) {
            return view('admin.errors.notAllowed');
        }
        return view('admin.jobs.create');
    } //end of create

    public function store(JobRequest $request)
    {
        Job::create($request->validated());

        Toastr()->success('تم إضافة وظيفة بنجاح بنجاح');
        return redirect()->route('admin.jobs.index');

    } //end of store

    public function edit(Job $job)
    {
        if (! Gate::allows('jobs.edit')) {
            return view('admin.errors.notAllowed');
        }
        return view('admin.jobs.edit', compact('job'));
    } //end of edit

    public function update(JobRequest $request, Job $job)
    {
        $job->update($request->validated());

        Toastr()->success('تم التعديل على وظيفة بنجاح');
        return redirect()->route('admin.jobs.index');
    } //end of update

    public function destroy(Job $job)
    {
        if (! Gate::allows('jobs.destroy')) {
            return view('admin.errors.notAllowed');
        }

        $job->delete();

        Toastr()->success('تم حذف وظيفة بنجاح');
        return redirect()->route('admin.jobs.index');

    } //end of destroy

    public function toggleStatus(Request $request, $id)
    {

        return $this->toggleStatusGeneric(
            $request,
            $id,
            Job::class,
            'jobs.edit',
            'وظيفة غير موجود'
        );
    } //end of toggleStatus
}

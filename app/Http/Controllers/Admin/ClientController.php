<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JoinRequestRequest;
use App\Models\Admin\Area;
use App\Models\Admin\Job;
use App\Models\Admin\JoinRequest;
use App\Models\Admin\JoinRequestImage;
use App\Traits\ToggleStatusTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    use ToggleStatusTrait;

    public function index()
    {
        if (! Gate::allows('clients')) {
            return view('admin.errors.notAllowed');
        }
        $join_requests = JoinRequest::where('type', 'client')->paginate(10);
        return view('admin.clients.index', compact('join_requests'));
    } //end of index

    public function show(JoinRequest $client)
    {
        if (! Gate::allows('clients')) {
            return view('admin.errors.notAllowed');
        }
        $job_titles = Job::where('is_active', 1)->get();
        $areas      = Area::where('is_active', 1)->get();
        return view('admin.clients.show', compact('client', 'job_titles', 'areas'));
    } //end of edit
    public function edit(JoinRequest $client)
    {
        if (! Gate::allows('clients.edit')) {
            return view('admin.errors.notAllowed');
        }
        $job_titles = Job::where('is_active', 1)->get();
        $areas      = Area::where('is_active', 1)->get();
        return view('admin.clients.edit', compact('client', 'job_titles', 'areas'));
    } //end of edit
    public function update(JoinRequestRequest $request, $id)
    {
        $client = JoinRequest::findOrFail($id);

        $data = $request->except('image', 'logo', 'id_image_front', 'id_image_back', 'graduation_certificate', 'professional_license', 'syndicate_card');

        // Handle single file uploads with old file deletion
        $singleFileFields = [
            'image',
            'logo',
            'id_image_front',
            'id_image_back',
            'graduation_certificate',
            'professional_license',
            'syndicate_card',
        ];

        $doctorFolder = $request->name;

        foreach ($singleFileFields as $field) {
            $newFilePath = $this->handleSingleFileUploadWithDeletion($request, $field, $doctorFolder, $client->$field);
            if ($newFilePath !== null) {
                $data[$field] = $newFilePath;
            }
        }

        // Update join request
        $client->update($data);

        // Handle multiple photo uploads (if provided)
        if ($request->hasFile('photo') && is_array($request->file('photo'))) {
            $this->replaceMultiplePhotoUploads($request, $client, $doctorFolder);
        }

        Toastr()->success('تم تحديث العميل بنجاح');
        return redirect()->route('admin.clients.index');
    }

/**
 * Handle single file upload with old file deletion
 */
    private function handleSingleFileUploadWithDeletion($request, $field, $doctorFolder, $oldFilePath)
    {
        if ($request->hasFile($field) && $request->file($field)->isValid()) {
            // Delete old file if exists
            if ($oldFilePath && Storage::disk('images')->exists($oldFilePath)) {
                Storage::disk('images')->delete($oldFilePath);
            }

            // Upload new file
            return $request->file($field)->store("joins-requests/{$doctorFolder}", 'images');
        }

        return null;
    }

/**
 * Handle single file upload (for create method)
 */
    private function handleSingleFileUpload($request, $field, $doctorFolder)
    {
        if ($request->hasFile($field) && $request->file($field)->isValid()) {
            return $request->file($field)->store("joins-requests/{$doctorFolder}", 'images');
        }

        return null;
    }

/**
 * Handle multiple photo uploads
 */
    private function handleMultiplePhotoUploads($request, $joinRequest, $doctorFolder)
    {
        if (! $request->hasFile('photo') || ! is_array($request->file('photo'))) {
            return;
        }

        foreach ($request->file('photo') as $imageFile) {
            $this->saveJoinRequestImage($imageFile, $joinRequest->id, $doctorFolder);
        }
    }

/**
 * Save individual join request image
 */
    private function saveJoinRequestImage($imageFile, $joinRequestId, $doctorFolder)
    {
        $path = $imageFile->store("images/joins-requests/{$doctorFolder}", ['disk' => 'my_files']);

        JoinRequestImage::create([
            'photo'           => $path,
            'join_request_id' => $joinRequestId,
        ]);
    }

    /**
     * Replace multiple photo uploads (delete old ones and add new ones)
     */
    private function replaceMultiplePhotoUploads($request, $joinRequest, $doctorFolder)
    {
        if (! $request->hasFile('photo') || ! is_array($request->file('photo'))) {
            return;
        }

        // Delete old photos from storage and database
        foreach ($joinRequest->images as $image) {
            if ($image->photo && Storage::disk('my_files')->exists($image->photo)) {
                Storage::disk('my_files')->delete($image->photo);
            }
            $image->delete();
        }

        // Add new photos
        foreach ($request->file('photo') as $imageFile) {
            $this->saveJoinRequestImage($imageFile, $joinRequest->id, $doctorFolder);
        }
    }

    public function destroy(JoinRequest $join_request)
    {
        if (! Gate::allows('mainCategories.destroy')) {
            return view('admin.errors.notAllowed');
        }
        if ($join_request->images && $join_request->images->count() > 0) {
            foreach ($join_request->images as $image) {

                Storage::disk('my_files')->delete($image->photo);

                $image->delete();
            }
        }

        $join_request->delete();

        if ($join_request->logo) {
            Storage::disk('images')->delete($join_request->logo);
        }

        if ($join_request->image) {
            Storage::disk('images')->delete($join_request->image);
        }

        if ($join_request->id_image_front) {
            Storage::disk('images')->delete($join_request->id_image_front);
        }

        if ($join_request->id_image_back) {
            Storage::disk('images')->delete($join_request->id_image_back);
        }

        if ($join_request->graduation_certificate) {
            Storage::disk('images')->delete($join_request->graduation_certificate);
        }

        if ($join_request->professional_license) {
            Storage::disk('images')->delete($join_request->professional_license);
        }

        if ($join_request->syndicate_card) {
            Storage::disk('images')->delete($join_request->syndicate_card);
        }

        Toastr()->success('تم حذف العميل بنجاح');
        return redirect()->route('admin.clients.index');

    } //end of destroy

    public function downloadGraduationCertificate($id)
    {
        $client = JoinRequest::findOrFail($id);

        if (! $client->graduation_certificate) {
            abort(404, 'File not found');
        }

        $filePath = public_path('images/' . $client->graduation_certificate);

        if (! file_exists($filePath)) {
            abort(404, 'File not found');
        }

        $extension = pathinfo($client->graduation_certificate, PATHINFO_EXTENSION);
        $fileName  = str_replace(' ', '_', $client->name) . '_شهادة_التخرج.' . $extension;

        return response()->download($filePath, $fileName);
    }

    public function downloadProfessionalLicense($id)
    {
        $client = JoinRequest::findOrFail($id);

        if (! $client->professional_license) {
            abort(404, 'File not found');
        }

        $filePath = public_path('images/' . $client->professional_license);

        if (! file_exists($filePath)) {
            abort(404, 'File not found');
        }

        $extension = pathinfo($client->professional_license, PATHINFO_EXTENSION);
        $fileName  = str_replace(' ', '_', $client->name) . '_شهادة_مزاولة_المهنه.' . $extension;

        return response()->download($filePath, $fileName);
    }

    public function downloadSyndicateCard($id)
    {
        $client = JoinRequest::findOrFail($id);

        if (! $client->syndicate_card) {
            abort(404, 'File not found');
        }

        $filePath = public_path('images/' . $client->syndicate_card);

        if (! file_exists($filePath)) {
            abort(404, 'File not found');
        }

        $extension = pathinfo($client->syndicate_card, PATHINFO_EXTENSION);
        $fileName  = str_replace(' ', '_', $client->name) . '_كارنية_النقابه.' . $extension;

        return response()->download($filePath, $fileName);
    }

     public function toggleStatus(Request $request, $id)
    {
        return $this->toggleStatusGeneric(
            $request,
            $id,
            JoinRequest::class,
            'clients.edit',
            'العميل  غير موجود'
        );
    } //end of toggleStatus


}

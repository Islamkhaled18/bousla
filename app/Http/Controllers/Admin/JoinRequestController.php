<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JoinRequestRequest;
use App\Models\Admin\Area;
use App\Models\Admin\Job;
use App\Models\Admin\JoinRequest;
use App\Models\Admin\JoinRequestImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class JoinRequestController extends Controller
{

    public function index()
    {
        if (! Gate::allows('join_requests')) {
            return view('admin.errors.notAllowed');
        }
        $join_requests = JoinRequest::where('type', 'requester')->paginate(10);
        return view('admin.join_requests.index', compact('join_requests'));
    } //end of index

    public function create()
    {
        if (! Gate::allows('join_requests.create')) {
            return view('admin.errors.notAllowed');
        }
        $job_titles = Job::where('is_active', 1)->get();
        $areas      = Area::where('is_active', 1)->get();
        return view('admin.join_requests.create', compact('job_titles', 'areas'));
    } //end of create

    // public function store(JoinRequestRequest $request)
    // {
    //     $data = $request->except('image', 'id_image_front', 'id_image_back', 'graduation_certificate', 'professional_license', 'syndicate_card');

    //     if ($request->hasFile('image') && $request->file('image')->isValid()) {
    //         $image         = $request->file('image');
    //         $doctorFolder  = $request->name;
    //         $data['image'] = $image->store("joins-requests/{$doctorFolder}", 'images');
    //     }

    //     if ($request->hasFile('id_image_front') && $request->file('id_image_front')->isValid()) {
    //         $id_image_front         = $request->file('id_image_front');
    //         $doctorFolder           = $request->name;
    //         $data['id_image_front'] = $id_image_front->store("joins-requests/{$doctorFolder}", 'images');
    //     }

    //     if ($request->hasFile('id_image_back') && $request->file('id_image_back')->isValid()) {
    //         $id_image_back         = $request->file('id_image_back');
    //         $doctorFolder          = $request->name;
    //         $data['id_image_back'] = $id_image_back->store("joins-requests/{$doctorFolder}", 'images');
    //     }

    //     if ($request->hasFile('graduation_certificate') && $request->file('graduation_certificate')->isValid()) {
    //         $graduation_certificate         = $request->file('graduation_certificate');
    //         $doctorFolder                   = $request->name;
    //         $data['graduation_certificate'] = $graduation_certificate->store("joins-requests/{$doctorFolder}", 'images');
    //     }

    //     if ($request->hasFile('professional_license') && $request->file('professional_license')->isValid()) {
    //         $professional_license         = $request->file('professional_license');
    //         $doctorFolder                 = $request->name;
    //         $data['professional_license'] = $professional_license->store("joins-requests/{$doctorFolder}", 'images');
    //     }

    //     if ($request->hasFile('syndicate_card') && $request->file('syndicate_card')->isValid()) {
    //         $syndicate_card         = $request->file('syndicate_card');
    //         $doctorFolder           = $request->name;
    //         $data['syndicate_card'] = $syndicate_card->store("joins-requests/{$doctorFolder}", 'images');
    //     }
    //     $join_request = JoinRequest::create($data);

    //     if ($request->hasFile('photo') && is_array($request->file('photo'))) {
    //         $doctorFolder = $request->name;
    //         foreach ($request->file('photo') as $imagefile) {
    //             $image                  = new JoinRequestImage();
    //             $path                   = $imagefile->store("images/joins-requests/{$doctorFolder}", ['disk' => 'my_files']);
    //             $image->photo           = $path;
    //             $image->join_request_id = $join_request->id;
    //             $image->save();
    //         }
    //     }

    //     Toastr()->success('تم إضافة الطلب بنجاح');
    //     return redirect()->route('admin.join-requests.index');

    // } //end of store

    public function store(JoinRequestRequest $request)
    {
        $data = $request->except('image', 'id_image_front', 'id_image_back', 'graduation_certificate', 'professional_license', 'syndicate_card');

        // Handle single file uploads
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
            $data[$field] = $this->handleSingleFileUpload($request, $field, $doctorFolder);
        }

        // Create join request
        $joinRequest = JoinRequest::create($data);

        // Handle multiple photo uploads
        $this->handleMultiplePhotoUploads($request, $joinRequest, $doctorFolder);

        Toastr()->success('تم إضافة الطلب بنجاح');
        return redirect()->route('admin.join-requests.index');
    }

    public function show(JoinRequest $join_request)
    {
        if (! Gate::allows('join_requests')) {
            return view('admin.errors.notAllowed');
        }
        $job_titles = Job::where('is_active', 1)->get();
        $areas      = Area::where('is_active', 1)->get();
        return view('admin.join_requests.show', compact('join_request', 'job_titles', 'areas'));
    } //end of edit

    public function edit(JoinRequest $join_request)
    {
        if (! Gate::allows('join_requests.edit')) {
            return view('admin.errors.notAllowed');
        }
        $job_titles = Job::where('is_active', 1)->get();
        $areas      = Area::where('is_active', 1)->get();
        return view('admin.join_requests.edit', compact('join_request', 'job_titles', 'areas'));
    } //end of edit

    // public function update(JoinRequestRequest $request, JoinRequest $join_request)
    // {

    //     $old_image                  = $join_request->image;
    //     $old_id_image_front         = $join_request->id_image_front;
    //     $old_id_image_back          = $join_request->id_image_back;
    //     $old_graduation_certificate = $join_request->graduation_certificate;
    //     $old_professional_license   = $join_request->professional_license;
    //     $old_syndicate_card         = $join_request->syndicate_card;

    //     $data = $request->except('image', 'id_image_front', 'id_image_back', 'graduation_certificate', 'professional_license', 'syndicate_card');

    //     if ($request->hasFile('image') && $request->file('image')->isValid()) {
    //         $image         = $request->file('image');
    //         $doctorFolder  = $request->name;
    //         $data['image'] = $image->store("joins-requests/{$doctorFolder}", 'images');
    //     }

    //     if ($request->hasFile('id_image_front') && $request->file('id_image_front')->isValid()) {
    //         $id_image_front         = $request->file('id_image_front');
    //         $doctorFolder           = $request->name;
    //         $data['id_image_front'] = $id_image_front->store("joins-requests/{$doctorFolder}", 'images');
    //     }

    //     if ($request->hasFile('id_image_back') && $request->file('id_image_back')->isValid()) {
    //         $id_image_back         = $request->file('id_image_back');
    //         $doctorFolder          = $request->name;
    //         $data['id_image_back'] = $id_image_back->store("joins-requests/{$doctorFolder}", 'images');
    //     }

    //     if ($request->hasFile('graduation_certificate') && $request->file('graduation_certificate')->isValid()) {
    //         $graduation_certificate         = $request->file('graduation_certificate');
    //         $doctorFolder                   = $request->name;
    //         $data['graduation_certificate'] = $graduation_certificate->store("joins-requests/{$doctorFolder}", 'images');
    //     }

    //     if ($request->hasFile('professional_license') && $request->file('professional_license')->isValid()) {
    //         $professional_license         = $request->file('professional_license');
    //         $doctorFolder                 = $request->name;
    //         $data['professional_license'] = $professional_license->store("joins-requests/{$doctorFolder}", 'images');
    //     }

    //     if ($request->hasFile('syndicate_card') && $request->file('syndicate_card')->isValid()) {
    //         $syndicate_card         = $request->file('syndicate_card');
    //         $doctorFolder           = $request->name;
    //         $data['syndicate_card'] = $syndicate_card->store("joins-requests/{$doctorFolder}", 'images');
    //     }

    //     $join_request->update($data);

    //     if ($old_image && isset($data['image'])) {
    //         Storage::disk('images')->delete($old_image);
    //     }

    //     if ($old_id_image_front && isset($data['id_image_front'])) {
    //         Storage::disk('images')->delete($old_id_image_front);
    //     }

    //     if ($old_id_image_back && isset($data['id_image_back'])) {
    //         Storage::disk('images')->delete($old_id_image_back);
    //     }

    //     if ($old_graduation_certificate && isset($data['graduation_certificate'])) {
    //         Storage::disk('images')->delete($old_graduation_certificate);
    //     }

    //     if ($old_professional_license && isset($data['professional_license'])) {
    //         Storage::disk('images')->delete($old_professional_license);
    //     }

    //     if ($old_syndicate_card && isset($data['syndicate_card'])) {
    //         Storage::disk('images')->delete($old_syndicate_card);
    //     }

    //     if ($join_request->images && $join_request->images->count() > 0) {
    //         foreach ($join_request->images as $oldImage) {

    //             Storage::disk('my_files')->delete($oldImage->photo);
    //             $oldImage->delete();
    //         }
    //     }

    //     if ($request->hasFile('photo') && is_array($request->file('photo'))) {
    //         $doctorFolder = $request->name;
    //         foreach ($request->file('photo') as $imagefile) {
    //             $image                  = new JoinRequestImage();
    //             $path                   = $imagefile->store("images/joins-requests/{$doctorFolder}", ['disk' => 'my_files']);
    //             $image->photo           = $path;
    //             $image->join_request_id = $join_request->id;
    //             $image->save();
    //         }
    //     }

    //     Toastr()->success('تم التعديل على طلب الانضمام بنجاح');
    //     return redirect()->route('admin.join-requests.index');
    // } //end of update

    public function update(JoinRequestRequest $request, $id)
    {
        $joinRequest = JoinRequest::findOrFail($id);

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
            $newFilePath = $this->handleSingleFileUploadWithDeletion($request, $field, $doctorFolder, $joinRequest->$field);
            if ($newFilePath !== null) {
                $data[$field] = $newFilePath;
            }
        }

        // Update join request
        $joinRequest->update($data);

        // Handle multiple photo uploads (if provided)
        if ($request->hasFile('photo') && is_array($request->file('photo'))) {
            $this->replaceMultiplePhotoUploads($request, $joinRequest, $doctorFolder);
        }

        Toastr()->success('تم تحديث الطلب بنجاح');
        return redirect()->route('admin.join-requests.index');
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

        Toastr()->success('تم حذف طلب الانضمام بنجاح');
        return redirect()->route('admin.join-requests.index');

    } //end of destroy

    public function downloadGraduationCertificate($id)
    {
        $joinRequest = JoinRequest::findOrFail($id);

        if (! $joinRequest->graduation_certificate) {
            abort(404, 'File not found');
        }

        $filePath = public_path('images/' . $joinRequest->graduation_certificate);

        if (! file_exists($filePath)) {
            abort(404, 'File not found');
        }

        $extension = pathinfo($joinRequest->graduation_certificate, PATHINFO_EXTENSION);
        $fileName  = str_replace(' ', '_', $joinRequest->name) . '_شهادة_التخرج.' . $extension;

        return response()->download($filePath, $fileName);
    }

    public function downloadProfessionalLicense($id)
    {
        $joinRequest = JoinRequest::findOrFail($id);

        if (! $joinRequest->professional_license) {
            abort(404, 'File not found');
        }

        $filePath = public_path('images/' . $joinRequest->professional_license);

        if (! file_exists($filePath)) {
            abort(404, 'File not found');
        }

        $extension = pathinfo($joinRequest->professional_license, PATHINFO_EXTENSION);
        $fileName  = str_replace(' ', '_', $joinRequest->name) . '_شهادة_مزاولة_المهنه.' . $extension;

        return response()->download($filePath, $fileName);
    }

    public function downloadSyndicateCard($id)
    {
        $joinRequest = JoinRequest::findOrFail($id);

        if (! $joinRequest->syndicate_card) {
            abort(404, 'File not found');
        }

        $filePath = public_path('images/' . $joinRequest->syndicate_card);

        if (! file_exists($filePath)) {
            abort(404, 'File not found');
        }

        $extension = pathinfo($joinRequest->syndicate_card, PATHINFO_EXTENSION);
        $fileName  = str_replace(' ', '_', $joinRequest->name) . '_كارنية_النقابه.' . $extension;

        return response()->download($filePath, $fileName);
    }

    /**
     * Update join request status
     */
    public function updateStatus(Request $request, $id)
    {

        $joinRequest = JoinRequest::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $joinRequest->update(['status' => $request->status]);

        if ($request->status === 'approved') {
            $joinRequest->update(['type' => 'client']);
        } elseif ($request->status === 'rejected') {
            $joinRequest->update(['type' => 'requester']);
        }

        $statusText = [
            'pending'  => 'في الانتظار',
            'approved' => 'مقبول',
            'rejected' => 'مرفوض',
        ];

        return response()->json([
            'success'     => true,
            'message'     => 'تم تحديث حالة الطلب إلى ' . $statusText[$request->status],
            'status'      => $request->status,
            'status_text' => $statusText[$request->status],
        ]);
    }
}

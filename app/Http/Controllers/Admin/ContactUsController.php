<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ContactUs;
use Illuminate\Support\Facades\Gate;

class ContactUsController extends Controller
{
    public function index()
    {
        if (! Gate::allows('contact_us')) {
            return view('admin.errors.notAllowed');
        }
        $contact_us = ContactUs::paginate(10);
        return view('admin.contact_us.index', compact('contact_us'));
    } //end of index

    public function destroy(ContactUs $contact_u)
    {
        if (! Gate::allows('contact_us.destroy')) {
            return view('admin.errors.notAllowed');
        }

        $contact_u->delete();

        Toastr()->success('تم حذف التواصل بنجاح');
        return redirect()->route('admin.contact_us.index');
    } //end of destroy
}

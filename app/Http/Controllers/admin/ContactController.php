<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ContactController extends Controller
{
    use SEOTools ;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::latest()->paginate('12');
        $this->seo()->setTitle('درخواست های تماس');
        return view('admin.contacts.index', compact('contacts'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $contact->update([
            'status' => 1
        ]);


        Alert::success("وضعیت با موفقیت بروز رسانی شد.");

        return back() ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        Alert::success("درخواست با موفقیت حذف شد.");

        return back() ;

    }
}

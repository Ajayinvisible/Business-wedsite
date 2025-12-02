<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function ContactMessage()
    {
        $contacts = Contact::latest()->get();
        return view('admin.backend.contact.all_contact_message', [
            'contacts' => $contacts
        ]);
    }

    public function ShowMessage($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.backend.contact.show_contact_message', [
            'contact' => $contact
        ]);
    }

    public function DeleteMessage($id)
    {
        Contact::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Contact Message Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    /**
     * @author Brighton van Rouendal
     * Show a list of all contacts that aren't soft deleted
     */
    public function index()
    {
        $contacts = Contact::withoutTrashed()->paginate(15);
        return view('admin.contact.index', compact('contacts'));
    }

    /**
     * @author Brighton van Rouendal
     * Show the contact message in the contact form
     */
    public function show(Contact $contact)
    {
        return view('admin.contact.show', compact('contact'));
    }

    /**
     * @author Brighton van Rouendal
     * Soft delete a contact message
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contact.index')->with('success', 'Contact message has been deleted');
    }
}

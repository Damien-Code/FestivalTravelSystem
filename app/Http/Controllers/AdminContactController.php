<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    /**
     * @author Brighton van Rouendal
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::withoutTrashed()->paginate(15);
        return view('admin.contact.index', compact('contacts'));
    }

    /**
     * @author Brighton van Rouendal
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return view('admin.contact.show', compact('contact'));
    }

    /**
     * @author Brighton van Rouendal
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contact.index')->with('success', 'Contact message has been deleted');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * @author Brighton van Rouendal
     * Show contact form for guest
     */
    public function index()
    {
        return view('contact.index');
    }

    /**
     * @author Brighton van Rouendal
     * Create a new contact message
     */
    public function store(Request $request)
    {
        $validatedRequest = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email',
            'message' => 'required|string|min:12'
        ]);

        $contact = Contact::create($validatedRequest);
        if ($contact === null) {
            return redirect()->route('contact.index')->withErrors(['error' => 'Could not create new contact record']);
        }
        return redirect()->route('contact.index')->with('success', 'Successfully send message!');
    }
}

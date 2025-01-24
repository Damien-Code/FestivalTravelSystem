<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    /**
     * @author Mischa Sasse
     * @method Illuminate\Http\Request get()
     * @method request()
     * @return view + $busses
     * This method gets all users, puts them in $users and sends them to the view.
     * If the user searches in the searchbar, then the $users will change to 
     * hold the values of the users that match the username or email to the search fully or partly.
     */
    public function index()
    {
        $search = request()->get('search') ?? '';
        $users = User::where('users.name','like', "%{$search}%")
        ->withoutTrashed() //had to add this twice cause of the way Eloquent creates queries
        ->orWhere('users.email','like', "%{$search}%")
        ->withoutTrashed()
        ->orderBy('users.id')->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $validatedData = $request->validate([
            'role_id' => 'required',
        ]);
        // Update the resource
        $user->update([
            'role_id' => $validatedData['role_id'],
        ]);
        // dd($validatedData,$user);
        return redirect(route('admin.users.index'))
        ->with('success', 'User role updated successfully!');;
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('admin.users.index'));
    }
}

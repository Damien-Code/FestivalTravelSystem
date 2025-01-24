<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class AdminUserController extends Controller
{
    /**
     * @author Mischa Sasse
     * @method Illuminate\Http\Request get()
     * @method request()
     * @return view + $busses
     * This method gets all users, puts them in $users and sends them to the view.
     * If the user searches in the searchbar, then the $users will change to 
     * hold the values of the users that match the username or email 
     * to the search fully or partly.
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
     * @author Mischa Sasse
     * @param Request $request
     * @param User $users
     * @method Illuminate\Http\Request validate()
     * @method Illuminate\Database\Eloquent\Model update()
     * @method Illuminate\Http\RedirectResponse with()
     * @return RedirectResponse + message
     * This method gets the post-data, role_id. 
     * Then it validates if the role_id has actually been sent.
     * If so, it updates the users role.
     * Then it redirects the user to admin.users.index with a success message.
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
        return redirect(route('admin.users.index'))
        ->with('success', 'User role updated successfully!');;
    }
    
    /**
     * @author Mischa Sasse
     * @param User $users
     * @method Illuminate\Database\Eloquent\Model delete()
     * @return view
     * This method gets the user from the post-data.
     * Then it soft-deletes the user.
     * After which it redirects the user back to admin.users.index
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('admin.users.index'));
    }
}

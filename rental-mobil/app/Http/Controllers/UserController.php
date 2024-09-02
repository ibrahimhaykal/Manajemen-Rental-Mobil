<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Make sure to import the User model

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $search = $request->search;
        $users = User::where('name', 'like', '%' . $search .'%')
        ->orWhere('email', 'like', '%' . $search .'%')
        ->latest()
        ->paginate(10);
        return view('users.index', compact('users'));
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return the view with the form to create a new user
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'address' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'SIM_number' => 'nullable|string|max:20',
        ]);

        // Create the user with the validated data
        $user = User::create($validatedData);

        // Redirect the user back with a success message
        return redirect()->route('user.index')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Retrieve the user to edit from the database
        $user = User::findOrFail($id);

        // Return the view with the user data
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'address' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'SIM_number' => 'nullable|string|max:20',
        ]);

        // Find the user to update
        $user = User::findOrFail($id);

        // Update the user with the validated data
        $user->update($validatedData);

        // Redirect the user back with a success message
        return redirect()->route('user.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
    return redirect()->route('user.index')->with('success', 'Data pelanggan berhasil dihapus');
    }
}

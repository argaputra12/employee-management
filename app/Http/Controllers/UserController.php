<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request...
        $validator = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required',
            'phone' => 'required|max:15|min:10',
            'address' => 'required|max:255',
            'date_of_birth' => 'required',
            'role' => 'required',
            'salary' => 'required|numeric',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        // Send error message if validation fails...
        if (!$validator) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Store the record...
        User::create($request->all());

        return redirect()->route('home');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search(Request $request)
    {

        $users = User::where('name', 'like', '%' . $request->search . '%')
            ->orWhere('email', 'like', '%' . $request->search . '%')
            ->orWhere('phone', 'like', '%' . $request->search . '%')
            ->orWhere('address', 'like', '%' . $request->search . '%')
            ->orWhere('role', 'like', '%' . $request->search . '%')
            ->orWhere('salary', 'like', '%' . $request->search . '%')
            ->get();

        if ($users->isEmpty()) {
            return redirect()->back()->with('error', 'No record found!');
        }

        else {
            return response()->json($users, 200);
        }
    }
}
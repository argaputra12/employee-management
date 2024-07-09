<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::orderBy($request->sort_by ?? 'created_at', $request->sort_order ?? 'desc')->paginate(10);

        return view('welcome', compact('users'));
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

        // Upload image...
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // $image_name = $image->getClientOriginalName();
            $image_name = $image->storeAs('images', $request->name . '.' . $image->getClientOriginalExtension(), 'public');
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $image_name);

            // Store the record from validated data...
            User::create([
                'name' => $validator["name"],
                'gender' => $validator["gender"],
                'phone' => $validator["phone"],
                'address' => $validator["address"],
                'date_of_birth' => $validator["date_of_birth"],
                'role' => $validator["role"],
                'salary' => $validator["salary"],
                'email' => $validator["email"],
                'password' => bcrypt($validator["password"]),
                'image' => $image_name,
            ]);
        }
        else {
            User::create($request->all());
        }


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
        } else {
            return response()->json($users, 200);
        }
    }
}
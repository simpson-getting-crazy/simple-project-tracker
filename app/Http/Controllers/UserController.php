<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::memberOnly()->get();

        return Inertia::render('user/Index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        return Inertia::render('user/Create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|same:password',
        ]);

        User::create($data);

        return Inertia::location(route('user.index'));
    }

    public function edit(int $id)
    {
        $user = User::find($id);

        return Inertia::render('user/Edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', "unique:users,email,{$id}"],
            'old_password' => [
                'nullable',
                'string',
                'min:8',
                function ($attribute, $value, $fail) use ($id) {
                    $user = User::find($id);
                    if ($value && !Hash::check($value, $user->password)) {
                        $fail('The current password is incorrect.');
                    }
                },
            ],
            'new_password' => ['nullable', 'string', 'min:8'],
            'new_password_confirmation' => ['same:new_password'],
        ]);

        $user = User::find($id);
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['new_password'] ?? $user->password,
        ]);

        return Inertia::location(route('user.index'));
    }

    public function destroy(int $id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('user.index');
    }
}

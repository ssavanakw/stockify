<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();
        return view('pages.users.index', compact('users'));
    }

    public function create()
    {
        return view('pages.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => ['required', Rule::in(['admin', 'manager', 'staff'])],
        ]);

        $this->userService->createUser($data);
        return redirect()->route('users.index')->with('success', 'User added successfully');
    }

    public function edit($id)
    {
        $user = $this->userService->getUserById($id);
        return view('pages.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'role' => ['required', Rule::in(['admin', 'manager', 'staff'])],
        ]);

        $this->userService->updateUser($id, $data);
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'new_password' => 'required|min:6|confirmed',
        ]);

        $this->userService->updatePassword($id, $request->new_password);
        return back()->with('success', 'Password updated successfully.');
    }

    public function destroy($id)
    {
        $this->userService->deleteUser($id);
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', [
            'users' => $users,
            'initIteration' => ($users->currentPage() - 1) * $users->perPage()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('users.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed']
        ]);
        auth()->user()->name = $data['name'];
        
        if ($data['password']) {
            auth()->user()->password = Hash::make($data['password']);
        }
        auth()->user()->save();
        return redirect()->route('index')->with('success', __('Your account has been updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = auth()->user();
        if (!$user->createdTasks->isEmpty() || !$user->tasks->isEmpty()) {
            return back()->with('danger', __('Your account cannot be deleted. Remove dependencies first!'));
        }
        auth()->guard()->logout();
        $request->session()->invalidate();
        $user->delete();
        return redirect()->route('index');
    }
}

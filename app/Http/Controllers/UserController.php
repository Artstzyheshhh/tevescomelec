<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; 
use App\Models\Logs;

class UserController extends Controller
{
    //
    public function getUsers(){
        $users = User::all();
        return response()->json(['users' => $users]);
    } 

    public function addUser(Request $request){
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'usertype' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'confirm_password' => ['required', 'same:password']
           
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'usertype' => $request->usertype,
            'status' => $request->status,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $logs = Logs::create([
            'user_id' => Auth::id(),
            'action' => 'Created user (ID: ' . $user->id . ')',
        ]);
        return response()->json(['message' => 'User added successfully', 'user' => $user]);
    }

    public function editUser(Request $request, $id){
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'usertype' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'confirm_password' => ['required', 'same:password']
        ]);

        $user = User::find($id);

        if(!$user){
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'usertype' => $request->usertype,
            'status' => $request->status,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $logs = Logs::create([
            'user_id' => Auth::id(),
            'action' => 'Updated user (ID: ' . $user->id . ')',
        ]);

        return response()->json(['message' => 'User updated successfully', 'user' => $user ]);
    } 

    public function deleteUser($id){
        $user = User::find($id);

        if(!$user){
            return response()->json(['message' => 'User not found'], 404);
        }

        $userId = $user->id;
        $user->delete();
        $logs = Logs::create([
            'user_id' => Auth::id(),
            'action' => 'Deleted application (ID: ' . $userId . ')',
        ]);
        return response()->json(['message' => 'User deleted successfully']);
    }
}

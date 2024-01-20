<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use DataTables;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');

        if(Auth::attempt(['email' => $email, 'password' => $password])){
            $user = Auth::user();

            return redirect('dashboard');
        }

        return redirect()->back()->withErrors(['message' => 'The credentials are incorrect.']);
        
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password',
        ]);
  
        if ($validator->fails()){
            return response()->json([
                    "status" => false,
                    "errors" => $validator->errors()
                ]);
        }
  
        $data = $request->all();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
  
        Auth::login($user);
  
        return response()->json([
            "status" => true, 
            "redirect" => url("dashboard")
        ]);

    }

    public function users(Request $request) {
        if ($request->ajax()) {
            $data = User::get();
            $user = auth()->user();
            return Datatables::of($data)->addIndexColumn()
                ->rawColumns([])
                ->make(true);
        }
        return view('users');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }
}

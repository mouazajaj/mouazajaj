<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
class AuthenticationController extends Controller
{
    public function signinAdmin(Request $request){
     
         
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
          
        ]);
     
        $user = Admin::where('email', $request->email)->first();
     
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
     
        return $user->createToken('token-name')->plainTextToken;
    }

    
    //use this method to signin users
    public function signin(Request $request){
     
         
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
          
        ]);
     
        $user = User::where('email', $request->email)->first();
     
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
     
        return $user->createToken('token-name')->plainTextToken;
    }

  
    public function revoke(Request $request)
    {
        $user=$request->user();
        $user->tokens()->delete();
    return "revok token";
    }

    public function user(Request $request)
    {
        return $request->user();
    }
    public function RegisterAdmin(Request $request){
        $attr = $request->validate([
            'name' => ['required','max:100'],
            'email' => ['required','max:255','unique:users'],
            'password' => ['required','max:255'],
            'Card_id'=>['required','max:50','unique:users']
        ]);

        $admin = Admin::create([
            'name' => $attr['name'],
            'password' => bcrypt($attr['password']),
            'email' => $attr['email'],
            'Card_id'=>$attr['Card_id']
        ]);

        
        $token=$admin->createToken('tokens')->plainTextToken;
        $response=['admin'=>$admin
        ,'token'=>$token];
        return response()->json($response);
    }
}



<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:person',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $person = Person::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $person->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['data' => $person, 'access_token' => $token, 'token_type' => 'Bearer']);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $person = Person::where('email', $request['email'])->firstOrFail();

        $token = $person->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['data' => $person, 'access_token' => $token, 'token_type' => 'Bearer']);
    }

    // method for person logout and delete token
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged out and the token was successfully deleted',
        ];
    }
}

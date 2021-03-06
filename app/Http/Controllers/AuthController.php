<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;

class AuthController extends Controller
{
     /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
    $this->middleware('auth:api', ['except' => ['login','register']]);
    }
 
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
    $credentials = request(['email', 'password']);
    if (! $token = auth()->attempt($credentials))
    {
    return response()->json(['error' => 'Unauthorized'], 401);
    }
    return $this->respondWithToken($token);
    }

     /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
    return response()->json(auth()->user());
    }
   /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
    auth()->logout();
    return response()->json(['message' => 'Successfully logged out']);
    }

     /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
    return $this->respondWithToken(auth()->refresh());
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
    public function register(Request $request)
    {

    $validator=Validator::make($request->all(),
        ['email'=>'required|email|Unique:users',
        'password'=>'required|max:8',
        'name'=>'required']);

      
     if($validator->fails())
            return response()->json(['error'=>$validator->errors()],300);

        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
            ]);

            return response()->json(['message' => 'Successfully registered out']);

            // event(new Registered($user));//event registerd to 

            $token = auth()->login($user); //token creation
           

           
            
    
    }
}

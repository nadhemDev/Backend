<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Role;

class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(Request $request)
    {
        $request->validate([
            'userName' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);
        $user = new User([
            'userName' => $request->userName,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);


        $user->save();
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }
  
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
      $user = $request->user();

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return response()->json([
            'message' => 'Authorization Granted',
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);

        
    }

    
  
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $user = auth()->guard('api')->user();
        $user->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
        
    }
  
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function allUser(Request $request)


    { 
        $users = User::where('id', '!=', auth()->id())->get();


        return response()->json(
            $users
        , 201);
    }

  
        public function getUser() {
            $user = Auth::user()->id()->get();    
            return $user;
        }
  

   public function destroy($id)
    {
        $user=User::find($id);
        if($user) {

            $msg = "Successfully deleted user!";
            
            $user->delete();
        }
        else{

            $msg = "User not found!";

        }
    return response()->json([
        'message' => $msg
    ], 201);
    }


	public $successStatus = 200;

public function user (Request $request)
    { 
         $user = auth()->guard('api')->user();
         if(empty($user)){
            //non connecté
           return response()->json([
                'error' => 'non conncter'
           ], 404);
         }
         else {
            //connecté
                return response()->json(
                    auth()->guard('api')->user()
                );
         }
         
       
    } 

   


}
<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
class UserController extends Controller
{
  public function __construct()
   {
     //  $this->middleware('auth:api');
   }
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function authenticate(Request $request)
   {
       $this->validate($request, [
       'email' => 'required',
       'password' => 'required'
        ]);
      $user = User::where('email', $request->input('email'))->first();
     if(Hash::check($request->input('password'), $user->password)){
          $token = base64_encode(Str::random(40));
          User::where('email', $request->input('email'))->update(['token' => $token]);;
          return response()->json(['status' => 'success','token' => $token]);
      }else{
          return response()->json(['status' => 'fail'],401);
      }
   }

    //Get the input and create a user
    public function store(Request $request) {
        $this->validate($request,[
            'user_name' => 'string|required',
            'email' => "required|email|unique:users,email,",
            'password' =>"required"
        ]);
        $user = User::create([
            'user_name' => $request->get('user_name'),
            'email' => $request->get('email'),
            'password'=> Hash::make($request->get('password'))
        ]);
        return response()->json(['status' => "success", "user_id" => $user->id], 201);
    }
}    
?>
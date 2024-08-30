<?php
namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller{

    public function index(Request $request)
    {
        return view('login');
    }

    public function forgot_password(Request $request)
    {
        return view('forgot_password');
    }

    public function register(Request $request)
    {
        return view('register');
    }

   public function add_post(Request $request)
    {
        dd($request->all());
    }

    public function register_post(Request $request){
        //dd($request->all());
        $user = request()->validate([
            'name'             => 'required',
            'email'            => 'required|unique:users',
            'password'         => 'required|min:6',
            'confirm_password' => 'required_with:password|same:password|min:6'
        ]);

        $user                 = new User;
        $user->name           = trim($request->name);
        $user->email          = trim($request->email);
        $user->password       = Hash::make($request->password);
        $user->remember_token = Str::random(50);
        $user->save();

        return redirect('/')->with('success', 'Register Successfully.');
    }

   public function CheckEmail(Request $request)
    {
        $email = $request->input('email');
        $isExists = User::where('email, $email')->first();
        if($isExists){
            return response()->json(array("exist" =>true));
        }else{
            return response()->json(array("exist" =>false));

        }
    }
    public function login_post(Request $request)
    {
      if(Auth::attempt(['email' => $request->email, 'password' => $request->password], true)){

        if(Auth::User()->is_role == '1'){
            return redirect()->intended('admin/dashboard');
        }else{
            return redirect('/')->with('error', 'No HR Availables.. please check');
        }

      }else{
        return redirect()->back()->with('error', 'please enter the correct credentails');
      }
    }

public function logout(){
    Auth::logout();
    return redirect(url('/'));
}

}

?>

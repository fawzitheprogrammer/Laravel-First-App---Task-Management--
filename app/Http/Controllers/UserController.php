<?php

namespace App\Http\Controllers;
use App\Models\Post;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //
  public function register(Request $request){
  
           $incomingFields = $request->validate([
            'username'=>['required','min:3','max:20',Rule::unique('users','username')],
            'email'=>['required','email',Rule::unique('users','email')],
            'password'=>['required','min:8','confirmed',Rule::unique('users','password')]
          ]);


          $incomingFields['password'] = bcrypt($incomingFields['password']);

         $user =  User::create($incomingFields);
            auth()->login($user);
           return redirect('/')->with('Success','Thank You for creating a new account!');
    }


    public function logout(){
      auth()->logout();
      return redirect('/')->with('Success','You have successfully logged out');
    }


    public function login(Request $request){
      $incomingFields  = $request->validate([
        'loginusername'=>'required',
        'loginpassword'=>'required',
      ]);

      if(auth()->attempt(['username'=>$incomingFields['loginusername'],'password'=>$incomingFields['loginpassword']])){
      //$request->session()->regenerate();
       return redirect('/')->with('Success','You have successfully logged in');
      } else{
        return redirect('/')->with('Failure','Login failled');
      }
    }


    public function showHeader(){
         
      if(auth()->check()){
       return view('home-feed-header');
      }
      else{
       return view('home');
      }

   }


   public function profile(User $user){
 
    $postCount = Post::count();

    return view('profile-post', ['username' => $user->username, 'posts' => $user->posts()->latest()->get(), 'postCount' => $user->posts()->count()]);
}
}

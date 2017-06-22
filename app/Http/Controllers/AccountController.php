<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class AccountController extends Controller
{
    public function getPassword() {
        return view('account/change_password');
    }
    
    public function postPassword(Request $request) {
        $user = $request->user();
        
        if(!Hash::check($request->get('current_password'),$user->password))
        {
            return redirect()->back()->withErrors([
                'current_password' => 'The current password is not validate'
            ]);
        }
        
        $this->validate($request, [
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);
        
        $user->password = (bcrypt($request->get('password')));
        $user->save();
        return redirect('account')
        ->with('alert','Your Password has been changed');
    }
    
    public function editProfile(Request $request)
    {
        return view('account/edit_profile', [
            'user' => $request->user()
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $this->validate($request, [
            'name' => 'required|min:2',
            'email' => 'required'
        ]);

        $user->fill($request->only(['name','email','active','role']));
        $user->save();

        return redirect('account')
            ->with('alert', 'Your profile has been updated');
    }
    
    public function listUser()
    {
    	//$notes = \App\Note::all();
        $users = \App\User::paginate(10);
		// dd($notes);
    	return view('account/list_user', compact('users'));
    }
    
    public function edituser($user)
    {
    	
        $user = user::findOrFail($user);
        //dd($user);
        return view('account/edit_user')->with('user',$user);

    }
}

<?php

namespace App\Http\Controllers;

use App\AdminUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Hash;

class AdminUserController extends Controller
{
    public function changepassword(Request $request)
    {
        $this->validate($request, [
            'old_pass' => 'required|max:16',
            'New_Password'=>'required|max:16',
            'Confirm_Password'=>'required|max:16',
        ]);

        $old = $request->input('old_pass');
        $new = $request->input('New_Password');
        $confirm = $request->input('Confirm_Password');

        if($new==$confirm)
        {
            $admin = new AdminUser();
            $id=Auth::guard('adminuser')->user()->id;

            $result=$admin::find($id)->first();
            $hashedPassword=$result->password;
            if (Hash::check($old, $hashedPassword)) {
                $data = array(
                    'password' => bcrypt($request->input('New_Password')),
                );
                $admin::where('id',$id)-> update($data);
                Auth::guard('adminuser')->logout();
                return redirect('/admin-login')->withErrors('Password Changed Successfully!!! Login Again');
            }
            else{
                return redirect()->back()->withErrors('Old Password Does Not Match!!!');
            }
        }
        else{
            return redirect()->back()->withErrors('New Password and Confirm Password Does Not Match!!!');
        }
    }
    public function adminstore(Request $request)
    {

        $admin = new AdminUser();
        $this->validate($request, [
            'username' => 'required|max:16',
            'password'=>'required|max:16',
        ]);

        $admin->username = $request->input('username');
        $admin->password = bcrypt($request->input('password'));

        $admin->save();
        return redirect()->back()->withErrors('Admin Added Successfully Successfully');
    }
   public function alogin(Request $request){
    $obj = new AdminUser();
       $this->validate($request,[
           'username' => 'required',
           'password' => 'required'
       ]);
       if(Auth::guard('adminuser')->attempt(['username'=>$request->username,'password'=>$request->password])){
        return redirect('/admin');
       }
       else{
        return redirect('/admin-login')->withErrors('Wrong Username or Password!!!');
       }

     /*  $abc = $request->input('username');
       $selected = AdminUser::find($abc);
       if($selected)
       {
            $new_username = $selected->username;
            $new_password = $selected->password;
            if($new_username==$request->input('username'))
            {
                if($new_password==$request->input('password'))
                {
                    session(['user_auth' => $new_username]);
                    return redirect('/admin')->withErrors('Login Successful!!!');

                }
                else {
                    return redirect('/admin-login')->withErrors('Wrong Password!!!');
                }
            }
            else {
                return redirect('/admin-login')->withErrors('Wrong Usernmae or Password!!!');
            }
        }
        else {
            return redirect('/admin-login')->withErrors('Wrong Usernmae or Password!!!');
        }*/
   }
}

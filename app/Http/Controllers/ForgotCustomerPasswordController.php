<?php

namespace App\Http\Controllers;

use App\ForgotCustomerPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Customer;

class ForgotCustomerPasswordController extends Controller
{
    public function verifyforgotpasswordlink($id,$authkey){
        $verify = new ForgotCustomerPassword();

        $data = array(
            'user_id' => $id,
            'authkey' => $authkey,
        );

        $datacheck = $verify::where($data)->first();

        if($datacheck)
        {
            if($datacheck->validity>=Carbon::now())
            {
                if($datacheck->is_Used==0)
                {
                    return view('cust.page-link-validation-password-change',compact('id','authkey'));
                }
                else
                {
                    return redirect('/customer-forgotpassword')->withErrors('Link Already Used');
                }
            }
            else
            {
                return redirect('/customer-forgotpassword')->withErrors('Link Expired');
            }

        }
        else
        {
            return redirect('/customer-forgotpassword')->withErrors('Not a valid link');
        }

    }
    public function changepassword(Request $request){
        $this->validate($request, [
            'id' => 'required',
            'authkey' => 'required',
            'new_password'=>'required|max:16',
            'confirm_password'=>'required|max:16',
        ]);

        $verify = new ForgotCustomerPassword();

        $id = $request->input('id');
        $authkey = $request->input('authkey');
        $data = array(
            'user_id' => $id,
            'authkey' => $authkey,
        );

        $datacheck = $verify::where($data)->first();

        if($datacheck)
        {
            if($datacheck->validity>=Carbon::now())
            {
                if($datacheck->is_Used==0)
                {
                    $new = $request->input('new_password');
                    $confirm = $request->input('confirm_password');

                    if($new==$confirm)
                    {
                        $customer = new Customer();

                        $data1 = array(
                            'password' => bcrypt($request->input('new_password')),
                        );

                        $data2 = array(
                            'validity' => Carbon::now(),
                            'is_Used' => 1,
                        );
                        $customer::where('id',$id)-> update($data1);
                        $verify::where('id',$datacheck->id)->update($data2);
                        return redirect('/customer-login')->withErrors('Password Changed Successfully!!!');
                    }
                    else{
                        return redirect()->back()->withErrors('New Password and Confirm Password Does Not Match!!!');
                    }
                }
                else
                {
                    return redirect('/customer-forgotpassword')->withErrors('Link Already Used');
                }
            }
            else
            {
                return redirect('/customer-forgotpassword')->withErrors('Link Expired');
            }

        }
        else
        {
            return redirect('/customer-forgotpassword')->withErrors('Not a valid link');
        }
    }
}

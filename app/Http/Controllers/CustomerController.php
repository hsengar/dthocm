<?php

namespace App\Http\Controllers;

use App\Customer;
use App\ForgotCustomerPassword;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\CustomClass\SMSClass;
use App\Mail\SendMailable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Hash;


class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(10);

        return view('admin.customers_view',compact('customers'));
    }
	public function login(Request $request){
    $obj = new Customer();
       $this->validate($request,[
           'username' => 'required',
           'password' => 'required'
       ]);
       if(Auth::guard('customeruser')->attempt(['cust_email'=>$request->username,'password'=>$request->password])){
        return redirect('/customer');
       }
       else{
        return redirect('/customer-login')->withErrors('Wrong Username or Password!!!');
       }
   }
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
            $customer = new Customer();
            $id=Auth::guard('customeruser')->user()->id;

            $result=$customer::find($id)->first();
            $hashedPassword=$result->password;
            if (Hash::check($old, $hashedPassword)) {
                $data = array(
                    'password' => bcrypt($request->input('New_Password')),
                );
                $customer::where('id',$id)-> update($data);
                Auth::guard('customeruser')->logout();
                return redirect('/customer-login')->withErrors('Password Changed Successfully!!! Login Again');
            }
            else{
                return redirect()->back()->withErrors('Old Password Does Not Match!!!');
            }
        }
        else{
            return redirect()->back()->withErrors('New Password and Confirm Password Does Not Match!!!');
        }
    }
   public function forgotpassword(Request $request)
   {
    $this->validate($request, [
        'username' => 'required',
        'mode' => 'required',
    ]);

    $cust_email = $request->input('username');
    $OTP_Mode = $request->input('mode');
    $customer = new Customer();
    $result=$customer::where('cust_email',$cust_email)->first();
    if(!$result)
    {
        return redirect()->back()->withErrors('E-mail ID doesnot match our records!!!');
    }

    if($OTP_Mode=='SMS')
    {

    $mobile = $result->cust_mobile;

    $enc_mobile = substr($mobile, -3);
    $id = $result->id;
    $otp = random_int(1000,9999);
    $message = "Your OTP for CMS is ".$otp;
    $sender = "DTHOCM";

    session(['otp' => $otp]);
    session(['cust_id' => $id]);

    $sms = new SMSClass();
    $sms->sendSMS($mobile,$message);

    $errormessage = 'OTP Sent on mobile number ends with xx'.$enc_mobile;
    return redirect('/customer-otp-validation')->withErrors($errormessage);
    }
    /*elseif($OTP_Mode=='EMAIL')
    {
        $name = $result->cust_name;
        $to = $result->cust_email;
        $id = $result->cust_email;
        $subject = "DTHOCM ForgotPassword OTP";
        $otp = random_int(1000,9999);

        session(['otp' => $otp]);
        session(['cust_id' => $id]);

        $email = new SendMailable();
        $email->set($subject,$otp,$name);
        Mail::to($to)->send($email);

        $errormessage = 'OTP Sent on you email';
        return redirect('/customer-otp-validation')->withErrors($errormessage);
    }*/
    elseif($OTP_Mode=='EMAILLINK')
    {
        $name = $result->cust_name;
        $to = $result->cust_email;
        $subject = "DTHOCM Account Reset Password Link";
        $otp = random_int(1000,9999);

        $randomletter = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 255);
        $authkey = $randomletter;
        $user_id = $result->id;

        $forgottable = new ForgotCustomerPassword();

        $forgottable->user_id = $user_id;
        $forgottable->authkey = $authkey;
        $forgottable->validity = Carbon::now()->addHour(1);
        $forgottable->is_Used = 0;
        $forgottable->save();

        $link = url('/').'/customer-forgotpasswordlink/verify/'.$user_id.'/'.$authkey;
        $email = new SendMailable();
        $email->set($subject,$link,$name);
        Mail::to($to)->send($email);

        $errormessage = 'Link Sent on you email to reset password';
        return redirect('/customer-login')->withErrors($errormessage);
    }
    else
    {
        return redirect()->back()->withErrors('Please Select OTP Mode');
    }
   }
   public function changepasswordwithotp(Request $request)
    {
        $this->validate($request, [
            'otp' => 'required|min:4|max:4',
            'new_password'=>'required|max:16',
            'confirm_password'=>'required|max:16',
        ]);

        $new = $request->input('new_password');
        $confirm = $request->input('confirm_password');

        $id=session('cust_id');
        $storedotp=session('otp');

        if($storedotp==$request->input('otp'))
        {
            if($new==$confirm)
            {
                $customer = new Customer();

                $data = array(
                    'password' => bcrypt($request->input('new_password')),
                );
                $customer::where('id',$id)-> update($data);
                $request->session()->forget('cust_id');
                $request->session()->forget('otp');
                return redirect('/customer-login')->withErrors('Password Changed Successfully!!!');
            }
            else{
                return redirect()->back()->withErrors('New Password and Confirm Password Does Not Match!!!');
            }
        }
        else
        {
            return redirect()->back()->withErrors('OTP Does not Match!!! Try Again');
        }
    }
    public function store(Request $request)
    {
        $customers = new Customer();
        $this->validate($request, [
            'customer_name'=>'required|max:30',
            'customer_mobile'=>'required|digits_between:8,10',
            'customer_alternate_mobile'=>'required|digits_between:8,10',
            'customer_email'=>'required|max:50|email',
            'customer_address'=>'required|max:255',
            'customer_city'=>'required|max:20',
            'customer_state'=>'required|max:20'
        ]);

        $data1 = array(
            'cust_mobile' => $request->input('customer_mobile'),
        );
        $data2 = array(
            'cust_email' => $request->input('customer_email'),
        );

        $datacheck1 = $customers::where($data1)->first();
        $datacheck2 = $customers::where($data2)->first();

        if(!$datacheck1&&!$datacheck2)
        {
            $customers->cust_name = $request->input('customer_name');
            $customers->cust_mobile = $request->input('customer_mobile');
            $customers->cust_alt_mobile = $request->input('customer_alternate_mobile');
            $customers->cust_email = $request->input('customer_email');
            $customers->cust_address = $request->input('customer_address');
            $customers->cust_city = $request->input('customer_city');
            $customers->cust_state = $request->input('customer_state');
            //$customers->password = $request->input('customer_mobile');
            $customers->password = bcrypt($request->input('customer_mobile'));
            $customers->is_Active = 1;
            $customers->save();
            return redirect()->back()->withErrors('Customer Added Successfully');
        }
        else {
            return redirect()->back()->withErrors('Customer Already Exist with given mobile number or email id!!!');
        }
    }
    public function update($id){
        $obj = new Customer();
        $update_data = $obj::find($id);
        return view('admin.customer_edit',compact('update_data'));
    }
    public function profileupdate(){
        $id=Auth::guard('customeruser')->user()->id;
        $obj = new Customer();
        $update_data = $obj::find($id)->first();
        return view('cust.manage_profile',compact('update_data'));
    }
    public function editprofile(Request $request)
    {
        $id=Auth::guard('customeruser')->user()->id;
        return $this->edit($request,$id);
    }
    public function edit(Request $request, $id){
        $obj = new Customer();
        $this->validate($request, [
            'customer_name'=>'required|max:30',
            'customer_mobile'=>'required|digits_between:8,10',
            'customer_alternate_mobile'=>'required|digits_between:8,10',
            'customer_email'=>'required|max:50|email',
            'customer_address'=>'required|max:255',
            'customer_city'=>'required|max:20',
            'customer_state'=>'required|max:20'
        ]);

        $data = array(
            'cust_name' => $request->input('customer_name'),
            'cust_mobile' => $request->input('customer_mobile'),
            'cust_alt_mobile' => $request->input('customer_alternate_mobile'),
            'cust_email' => $request->input('customer_email'),
            'cust_address' => $request->input('customer_address'),
            'cust_city' => $request->input('customer_city'),
            'cust_state' => $request->input('customer_state'),
        );
        $obj::where('id',$id)-> update($data);
        if(Auth::guard('adminuser')->check())
        {
            return redirect('/admin/Customers')->withErrors('Customer Updated Successfully');
        }
        if(Auth::guard('customeruser')->check())
        {
            return redirect()->back()->withErrors('Your Profile Updated Successfully!!!');
        }
    }
    public function delete(Request $request){
        $customers = new Customer();
        $id=$request->input('id');
        $customers::where('id',$id) -> delete();
        return redirect()->back()->withErrors('Customer Deleted Successfully');
    }
    public function uploadpage(){
        return view('admin.customer_upload');
    }
    public function uploadFile(Request $request){

        if ($request->input('submit') != null ){

          $file = $request->file('input_file');

          // File Details
          $filename = $file->getClientOriginalName();
          $extension = $file->getClientOriginalExtension();
          $fileSize = $file->getSize();

          // Valid File Extensions
          $valid_extension = array("csv");

          // 2MB in Bytes
          $maxFileSize = 2097152;

          // Check file extension
          if(in_array(strtolower($extension),$valid_extension)){

            // Check file size
            if($fileSize <= $maxFileSize){

              // File upload location
              $location = public_path().'/CSVFiles/uploaded/customerfile/';

              // Upload file
              $file->move($location,$filename);

              // Import CSV to Database

              $filepath = public_path("/CSVFiles/uploaded/customerfile/".$filename);

              // Reading file
              $file = fopen($filepath,"r");

              $importData_arr = array();
              $i = 0;

              while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                 $num = count($filedata );

                 // Skip first row (Remove below comment if you want to skip the first row)
                 if($i == 0){
                    $i++;
                    continue;
                 }
                 for ($c=0; $c < $num; $c++) {
                    $importData_arr[$i][] = $filedata [$c];
                 }
                 $i++;
              }
              fclose($file);

              // Insert to MySQL database
              foreach($importData_arr as $importData){

                $requestinsert = array(
                   "customer_name"=>$importData[0],
                   "customer_mobile"=>$importData[1],
                   "customer_alternate_mobile"=>$importData[2],
                   "customer_email"=>$importData[3],
                   "customer_address"=>$importData[4],
                   "customer_city"=>$importData[5],
                   "customer_state"=>$importData[6]);
                   $this->storeBulk($requestinsert);
              }
              return redirect('/admin/Customers')->withErrors('Import Successful');
            }else{
                return redirect('/admin/Customers')->withErrors('File too large. File must be less than 2MB.');
            }

          }else{
            return redirect('/admin/Customers')->withErrors('Invalid File Extension');
          }

        }
        // Redirect to index
        return redirect()->action('CustomerController@index');
    }
    public function storeBulk($request)
    {
        $customers = new Customer();
        $data1 = array(
            'cust_mobile' =>$request['customer_mobile'],
        );
        $data2 = array(
            'cust_email' => $request['customer_email'],
        );

        $datacheck1 = $customers::where($data1)->first();
        $datacheck2 = $customers::where($data2)->first();

        if(!$datacheck1&&!$datacheck2)
        {
            $customers->cust_name = $request['customer_name'];
            $customers->cust_mobile = $request['customer_mobile'];
            $customers->cust_alt_mobile = $request['customer_alternate_mobile'];
            $customers->cust_email = $request['customer_email'];
            $customers->cust_address = $request['customer_address'];
            $customers->cust_city = $request['customer_city'];
            $customers->cust_state = $request['customer_state'];
            $customers->password = bcrypt($request['customer_mobile']);
            $customers->is_Active = 1;
            $customers->save();
        }
    }
    public function downloadCSV(){
        $table = Customer::all();
        $filename = "customers.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('customer_name', 'customer_mobile', 'customer_alternate_mobile', 'customer_email','customer_address','customer_city','customer_state','created_at','updated_at'));

        foreach($table as $row) {
            fputcsv($handle, array($row['cust_name'], $row['cust_mobile'], $row['cust_alt_mobile'], $row['cust_email'], $row['cust_address'], $row['cust_city'], $row['cust_state'], $row['created_at'], $row['updated_at']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return response()->download($filename, 'customers.csv', $headers);
    }
}

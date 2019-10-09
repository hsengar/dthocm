<?php

namespace App\Http\Controllers;

use App\Engineer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;

class EngineerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $engineers = Engineer::all();

        return view('admin.engineer_view',compact('engineers'));
    }
    public function login(Request $request){
        $obj = new Engineer();
           $this->validate($request,[
               'username' => 'required',
               'password' => 'required'
           ]);
           if(Auth::guard('engineeruser')->attempt(['email'=>$request->username,'password'=>$request->password])){
            return redirect('/engineer');
           }
           else{
            return redirect('/engineer-login')->withErrors('Wrong Username or Password!!!');
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
                $engineer = new Engineer();
                $id=Auth::guard('engineeruser')->user()->id;

                $result=$engineer::find($id)->first();
                $hashedPassword=$result->password;
                if (Hash::check($old, $hashedPassword)) {
                    $data = array(
                        'password' => bcrypt($request->input('New_Password')),
                    );
                    $engineer::where('id',$id)-> update($data);
                    Auth::guard('engineeruser')->logout();
                    return redirect('/engineer-login')->withErrors('Password Changed Successfully!!! Login Again');
                }
                else{
                    return redirect()->back()->withErrors('Old Password Does Not Match!!!');
                }
            }
            else{
                return redirect()->back()->withErrors('New Password and Confirm Password Does Not Match!!!');
            }
        }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.engineer_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $engineer = new Engineer();
        $this->validate($request, [
            'ename'=>'required|max:30',
            'econtact'=>'required|digits_between:8,10',
            'ecode'=>'required|max:7',
            'email'=>'required|max:50|email',
            'input_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data1 = array(
            'e_contact' => $request->input('econtact'),
        );
        $data2 = array(
            'email' => $request->input('email'),
        );

        $datacheck1 = $engineer::where($data1)->first();
        $datacheck2 = $engineer::where($data2)->first();

        if(!$datacheck1&&!$datacheck2)
        {
            $image = $request->file('input_img');
            $name = time().'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/images/uploaded/engineers');
            $image->move($destinationPath, $name);

            $engineer->e_name = $request->input('ename');
            $engineer->e_contact = $request->input('econtact');
            $engineer->e_code = $request->input('ecode');
            $engineer->email = $request->input('email');
            $engineer->e_photo = $name;
            $engineer->password = bcrypt($request->input('econtact'));
            $engineer->is_Active = 1;
            $engineer->save();
            return redirect()->back()->withErrors('Engineer Added Successfully');
        }
        else {
            return redirect()->back()->withErrors('Engineer Already Exist with given mobile number or email id!!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Engineer  $engineer
     * @return \Illuminate\Http\Response
     */
    public function show(Engineer $engineer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Engineer  $engineer
     * @return \Illuminate\Http\Response
     */
    public function edit(Engineer $engineer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Engineer  $engineer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Engineer $engineer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Engineer  $engineer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Engineer $engineer)
    {
        //
    }
}

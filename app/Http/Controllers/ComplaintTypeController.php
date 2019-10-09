<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ComplaintTy;

class ComplaintTypeController extends Controller
{

    public function index()
    {
        $cty = ComplaintTy::all();

        return view('admin.call_type',compact('cty'));
    }

    public function store(Request $request)
    {
        $ct = new ComplaintTy();
        $this->validate($request, [
            'ctname'=>'required',
            'ctcharges'=> 'required'
        ]);

        $ct->ct_name = $request->input('ctname');
        $ct->ct_charges = $request->input('ctcharges');
        $ct->save();
        return redirect()->back()->withErrors('Complaint Type Added Successfully');
    }
    public function delete(Request $request){
        $ctyp = new ComplaintTy();
        $id=$request->input('id');
        $ctyp::where('id',$id) -> delete();
        return redirect()->back()->withErrors('Complaint Type Deleted Successfully');
    }
    public function update($id){
        $ctyp = new ComplaintTy();
        $update_data = $ctyp::find($id);
        return view('admin.call_type_update',compact('update_data'));
    }
    public function edit(Request $request, $id){
        $ctyp = new ComplaintTy();
        $data = array(
            'ct_name' => $request->input('ctname'),
            'ct_charges' => $request->input('ctcharges'),
        );
        $ctyp::where('id',$id)-> update($data);
        return redirect('/admin/ComplainType')->withErrors('Complaint Type Updated Successfully');
    }
}

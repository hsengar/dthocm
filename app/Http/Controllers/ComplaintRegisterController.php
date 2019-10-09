<?php

namespace App\Http\Controllers;

use DB;
use App\ComplaintRegister;
use App\Brand;
use App\ComplaintTy;
use App\Customer;
use App\Engineer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ComplaintRegisterController extends Controller
{
    public function index($id)
    {
        $customer_data = Customer::find($id);
        $brands = Brand::all();
        $complaint_type = ComplaintTy::all();
        if(!$customer_data)
        {
            return redirect('/admin/CustomerSearch')->withErrors('No Customer Exist with given mobile number!!!');
        }

        return view('admin.Complaint_add',compact('customer_data','brands','complaint_type'));
    }
    public function customerindex($id)
    {
        $brand_data = Brand::find($id);
        if(!$brand_data)
        {
            return redirect('/customer/ComplaintPage')->withErrors('No Brand Exist!!!');
        }
        $complaint_type = ComplaintTy::all();
        return view('cust.Complaint_add',compact('brand_data','complaint_type'));
    }
    public function complaintbrandselection()
    {
        $brands = Brand::all();

        return view('cust.Complaint_Brand_Select',compact('brands'));
    }
    public function viewcomplaints()
    {
        $complaint_data = ComplaintRegister::latest()->paginate(10);
        $customer_data = Customer::all();
        $brands = Brand::all();
        $complaint_type = ComplaintTy::all();
        return view('admin.complaints_view',compact('complaint_data','brands','complaint_type','customer_data'));
    }
	public function viewComplaintsOnCustomer()
    {
		$id=Auth::guard('customeruser')->user()->id;
		$data = array(
            'cust_id' => $id
        );
		$complaint_data = ComplaintRegister::where($data)->latest()->paginate(10);
        $brands = Brand::all();
		$engineer = Engineer::all();
        $complaint_type = ComplaintTy::all();
        return view('cust.complaints_view',compact('complaint_data','brands','complaint_type','engineer'));
    }
    public function viewComplaintsOnEngineer()
    {
		$id=Auth::guard('engineeruser')->user()->id;
		$data = array(
            'eid_alloted' => $id
        );
		$complaint_data = ComplaintRegister::where($data)->latest()->paginate(10);
        $customer = Customer::all();
        $brands = Brand::all();
		$engineer = Engineer::all();
        $complaint_type = ComplaintTy::all();
        return view('engineer.complaints_view',compact('customer','complaint_data','brands','complaint_type','engineer'));
    }
    public function engineerupdate($cid)
    {
        $eng=Auth::guard('engineeruser')->user()->id;

        $complaintdata= DB::table('complaint_registers')
            ->join('customers', 'complaint_registers.cust_id', '=', 'customers.id')
            ->join('complaint_ties', 'complaint_registers.complainttype_id', '=', 'complaint_ties.id')
            ->join('brands', 'complaint_registers.brand_id', '=', 'brands.id')
            ->select('customers.cust_name as name', 'customers.cust_mobile as mobile', 'complaint_registers.status as status','complaint_registers.engineer_remarks as eng_remarks','complaint_registers.id as id','complaint_registers.eid_alloted as eid','complaint_registers.total_charges as total_charges','brands.brand_name as brand_name','complaint_ties.ct_name as complaint_type')
            ->where('complaint_registers.id', '=', $cid)
            ->first();
        if($complaintdata->eid==$eng)
        {
        return view('engineer.complaint_status_update',compact('complaintdata'));
        }
        else{
            return "Sorry Wrong Input";
        }
    }
    public function closecomplaint(Request $request)
    {
        $this->validate($request, [
            'id'=>'required',
            'othercharges'=>'required',
            'status'=>'required',
            'engineer_remarks'=>'required',
        ]);
        $id=$request->input('id');
        $obj = new ComplaintRegister();
        $current_complaint = $obj->find($id);

        $data = array(
            'other_charges' => $current_complaint->other_charges + $request->input('othercharges'),
            'total_charges' => $current_complaint->total_charges + $request->input('othercharges'),
            'engineer_remarks' => $request->input('engineer_remarks'),
            'status' => $request->input('status'),
            'closed_date' => Carbon::now(),
        );

        $obj::where('id',$id)-> update($data);
        return redirect()->back()->withErrors('Complaint Status Updated Successfully!!!');
    }
    public function viewallocation()
    {
        $cregister = new ComplaintRegister();
        $engineer = new Engineer();
        /*$data1 = array(
            'status' => 'Fresh',
        );
        $data2 = array(
            'is_Active' => '1',
        );*/
        //$complaintdata = $cregister::where($data1);
        $complaintdata = DB::select('select cr.id as id,cust.cust_name,cust.cust_address,cust.cust_mobile,br.brand_name from complaint_registers cr,customers cust,brands br, complaint_ties ct where cr.cust_id=cust.id AND cr.brand_id=br.id AND cr.complainttype_id=ct.id AND cr.status="Fresh"');
        $engineerdata = DB::select('select * from engineers where is_Active=1');
        //$engineerdata = $engineer::where($data2);
        //$engineerdata = $engineer::all();
        return view('admin.complaint_allocation',compact('complaintdata','engineerdata'));
    }
    public function allotcomplaint(Request $request)
    {
        $this->validate($request, [
            'complaints'=>'required',
            'engineer'=>'required',
        ]);
        $id=$request->input('complaints');
        $data = array(
            'eid_alloted' => $request->input('engineer'),
            'status' => "Pending",
        );
        $obj = new ComplaintRegister();
        $obj::where('id',$id)-> update($data);
        return redirect()->back()->withErrors('Complaint Allocated Successfully!!!');
    }
    public function customercomplaintstore(Request $request)
    {
        $id=Auth::guard('customeruser')->user()->id;
        $request->request->add(['customer'=>$id]);
        return $this->store($request);
    }
    public function store(Request $request)
    {
        $cregister = new ComplaintRegister();
        $this->validate($request, [
            'customer'=>'required',
            'brand'=>'required',
            'complaint_type'=>'required',
        ]);

        $cty = ComplaintTy::find($request->input('complaint_type'));
        $data = array(
            'cust_id' => $request->input('customer'),
            'brand_id' => $request->input('brand'),
            'complainttype_id' => $request->input('complaint_type'),
            'status' => 'Fresh'
        );
        $data2 = array(
            'cust_id' => $request->input('customer'),
            'brand_id' => $request->input('brand'),
            'complainttype_id' => $request->input('complaint_type'),
            'status' => 'Pending'
        );
        $complaintcheck = $cregister::where($data)->first();
        $complaintcheck2 = $cregister::where($data2)->first();
        if(!$complaintcheck&&!$complaintcheck2)
        {
            $cregister->cust_id = $request->input('customer');
            $cregister->brand_id = $request->input('brand');
            $cregister->complainttype_id = $request->input('complaint_type');
            $cregister->registered_date = Carbon::now();
            $cregister->status = 'Fresh';
            $cregister->cust_remarks = $request->input('customer_remarks');
            $cregister->other_charges = 0;
            $cregister->total_charges = $cty->ct_charges;
            $cregister->is_repeat = 0;
            $cregister->save();
            if(Auth::guard('adminuser')->check())
            {
                return redirect('/admin/CustomerSearch')->withErrors('Complaint Generated Successfully!!!');
            }
            if(Auth::guard('customeruser')->check())
            {
                return redirect()->back()->withErrors('Complaint Generated Successfully!!!');
            }
        }
        else {
            return redirect()->back()->withErrors('Complaint Already Exists!!!');
        }

    }
    public function searchview()
    {
        return view('admin.customer_search');
    }
    public function searchresponse(Request $request)
    {
        $this->validate($request, [
            'customer_mobile'=>'required',
        ]);
        $cust_mobile = $request->input('customer_mobile');
        $customer_data = Customer::where('cust_mobile', $cust_mobile)->first();
        if($customer_data)
        {
            $resultpageurl = '/admin/ComplaintRegister/'.$customer_data->id;
            return redirect($resultpageurl);
        }
        else
        {
            return redirect('/admin/CustomerSearch')->withErrors('No Customer Exist with given mobile number!!!');
        }
        return view('admin.customer_search');
    }
}

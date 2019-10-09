<?php

namespace App\Http\Controllers;

use App\Engineer;
use App\ComplaintRegister;
use Illuminate\Http\Request;
use App\Customer;
use App\Brand;
use App\ComplaintTy;
use DB;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    public function EngineerReportIndex()
    {
        $engineers = Engineer::all();
        return view('admin.engineer_report_search',compact('engineers'));
    }
    public function DisplayEngineerReport(Request $request)
    {
        $this->validate($request, [
            'engineer'=>'required',
            'fromdate'=>'required',
            'todate'=>'required',
        ]);
        $fromdate = $request->input('fromdate');
        $todate = date('Y-m-d',strtotime($request->input('todate').'+ 1 days'));
        $complaint_data = ComplaintRegister::where('eid_alloted',$request->input('engineer'))->whereBetween('registered_date',[$fromdate,$todate])->latest()->paginate(10);
        $customer_data = Customer::all();
        $brands = Brand::all();
        $complaint_type = ComplaintTy::all();
        return view('admin.complaints_view',compact('complaint_data','brands','complaint_type','customer_data'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use File;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();

        return view('admin.brand',compact('brands'));
    }
    public function store(Request $request)
    {
        $brands = new Brand();
        $this->validate($request, [
            'input_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'brand_name'=>'required|max:30',
        ]);
        $image = $request->file('input_img');
        $name = time().'.'.$image->getClientOriginalExtension();

        $brands->brand_logo = $name;
        $brands->brand_name = $request->input('brand_name');


        $destinationPath = public_path('/images/uploaded/brands');
        $image->move($destinationPath, $name);
        //$this->save();
        $brands->save();
        return redirect()->back()->withErrors('Brand Added Successfully');
    }
    public function delete(Request $request){
        $brands = new Brand();
        $id=$request->input('id');

        $brandselected= $brands::find($id);

        $filename = public_path().'/images/uploaded/brands/'.$brandselected->brand_logo;
        File::delete($filename);
        //unlink(public_path() .  '/images/uploaded/brands/' . $brandselected->brand_logo );
        $brands::where('id',$id) -> delete();
        return redirect()->back()->withErrors('Brand Deleted Successfully');
    }
    public function update($id){
        $obj = new Brand();
        $update_data = $obj::find($id);
        return view('admin.brand_update',compact('update_data'));
    }
    public function edit(Request $request, $id){
        $obj = new Brand();
        $this->validate($request, [
            'input_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'brand_name'=>'required|max:30',
        ]);

        $brandselected= $obj::find($id);
        $filename = public_path().'/images/uploaded/brands/'.$brandselected->brand_logo;
        File::delete($filename);

        $image = $request->file('input_img');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/uploaded/brands');
        $image->move($destinationPath, $name);

        $data = array(
            'brand_name' => $request->input('brand_name'),
            'brand_logo' => $name,
        );
        $obj::where('id',$id)-> update($data);
        return redirect('/admin/Brands')->withErrors('Brand Updated Successfully');
    }
}

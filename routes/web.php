<?php

use App\AdminUser;
use App\ComplaintRegister;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Middleware\CheckUser;
use App\Http\Middleware\CheckCustomer;
use App\Http\Middleware\CheckEngineer;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/admin', function () {
    if(Auth::guard('adminuser')->check())
    {
        return view('admin/dashboard_1');
    }
    else{
        return redirect('/admin-login')->withErrors('Login is required to access this page');
    }
});*/

//Home Pages
Route::get('', function () {
    return redirect('/web/home');
});

Route::get('/web/{page}','WebController@index');
//Admin
Route::get('/admin-register', function () {return view('admin/page-register');});
Route::post('/admin-registercheck','AdminUserController@adminstore');

//Login to Admin
Route::get('/admin-login', function () {return view('admin.page-login');});
Route::post('/admin-checklogin','AdminUserController@alogin');


Route::group(['middleware' => ['admin']], function() {

    //Admin Dashboard
    Route::get('/admin', function () {
        $compaint = new ComplaintRegister();
        $complaint_count_total = $compaint::all()->count();
        $complaint_count_closed = $compaint::where('status','Closed')->count();
        $complaint_count_pending = $compaint::where('status','Pending')->count();
        $complaint_count_fresh = $compaint::where('status','Fresh')->count();
        return view('admin/dashboard_1',['total_complaints' => $complaint_count_total,'closed_complaints'=>$complaint_count_closed,'pending_complaints'=>$complaint_count_pending,'fresh_complaints'=> $complaint_count_fresh]);
    });

    //Change Password
    Route::get('/admin/ChangePassword', function () {return view('admin.change_password');}); //Display Change Password Page
    Route::post('/admin-change-password','AdminUserController@changepassword'); //Request to change Password

    //Admin Logout
    Route::get('/admin-logout', function () {
        Auth::guard('adminuser')->logout();
        return redirect('/admin-login')->withErrors('Successfully Logged Out');
    });

    //To Manage the Complaint Types
    Route::post('/create-complaint','ComplaintTypeController@store'); //Add Complaint Types
    Route::get('/admin/ComplainType', 'ComplaintTypeController@index'); //Display Complaint Types
    Route::post('/delete-complaint-type','ComplaintTypeController@delete'); //Delete Complaint Types
    Route::get('/admin/update-complaint-type/{id}','ComplaintTypeController@update'); //Get Update Pages
    Route::post('/admin/edit-complaint-type/{id}','ComplaintTypeController@edit'); //Update Complaint Types

    //To Manage the brands
    Route::get('/admin/Brands', 'BrandController@index'); //Display Brands
    Route::post('/create-brand','BrandController@store'); //Add Complaint Types
    Route::post('/delete-brand','BrandController@delete'); //Delete Complaint Types
    Route::get('/admin/update-brand/{id}','BrandController@update'); //Get Update Pages
    Route::post('/admin/edit-brand/{id}','BrandController@edit'); //Update Complaint Types

    //To Manage the Customers
    Route::get('/admin/Customers', 'CustomerController@index'); //Display Customers
    Route::get('/admin/CustomersRegister', function () {return view('admin.customer_add');}); //Add Customers
    Route::post('/admin/Customers/Add','CustomerController@store'); //Add Customers
    Route::get('/admin/Customers-Edit/{id}','CustomerController@update'); //Get Update Page
    Route::post('/admin/edit-customer/{id}','CustomerController@edit'); //Update Customer
    Route::post('/admin/delete-customer','CustomerController@delete'); //Delete Customer
    Route::get('/admin/CustomerUploadPage','CustomerController@uploadpage'); //Get  Upload CSV File Page
    Route::post('/admin/customer-uploadfile','CustomerController@uploadFile'); //Upload Customer Data
    Route::get('/admin/customerDownloadCSV','CustomerController@downloadCSV'); //Download Customer Data

    //To Manage the Complaint Register
    Route::get('/admin/ComplaintRegister/{id}', 'ComplaintRegisterController@index'); // Display Complaint Register Form
    Route::post('/admin/ComplaintRegister-Add', 'ComplaintRegisterController@store'); // To Add Complaint in Complaint Register
    Route::get('/admin/CustomerSearch', 'ComplaintRegisterController@searchview'); // Display Complaint Register Form
    Route::post('/admin/Customers/Search','ComplaintRegisterController@searchresponse'); //To get search result
    Route::get('/admin/ComplaintRegister-View', 'ComplaintRegisterController@viewcomplaints'); // Display Complaints
    Route::get('/admin/ComplaintAllotEngineer', 'ComplaintRegisterController@viewallocation'); // Display Allot Engineer Form
    Route::post('/admin/ComplaintAllocation','ComplaintRegisterController@allotcomplaint'); //To Allot Complaint to Engineer using update

    //To Manage Engineers
    Route::get('/admin/EngineerAdd', 'EngineerController@create'); // Display Add Engineer Form
    Route::post('/admin/Engineer-Create', 'EngineerController@store'); // To Add Engineer in table
    Route::get('/admin/Engineers', 'EngineerController@index'); // Display Add Engineer Form

    //Report
    Route::get('/admin/ReportEngineer', 'ReportController@EngineerReportIndex'); // Display Engineer Report Index Page
    Route::post('/admin/Report-EngineerCreate', 'ReportController@DisplayEngineerReport'); // Display Engineer Wise Complaint
});

//Register Customer
Route::get('/customer-register', function () {return view('cust.page-register');});
Route::post('/customer-register-check','CustomerController@store'); //Add Customers

//Login to Customer
Route::get('/customer-login', function () {return view('cust.page-login');});
Route::post('/customer-checklogin','CustomerController@login');

//Forgot Password
Route::get('/customer-forgotpassword', function () {return view('cust.page-forgotpassword');}); //Display Forgot Password Page
Route::post('/customer-forgotpasswordotp','CustomerController@forgotpassword'); //Genrate OTP and send SMS or EMail
Route::get('/customer-otp-validation', function () {return view('cust.page-otp-validation-password-change');}); //Display OTP Validation Page
Route::post('/customer-checkotp','CustomerController@changepasswordwithotp'); //Change Password
Route::get('/customer-forgotpasswordlink/verify/{id}/{authkey}', 'ForgotCustomerPasswordController@verifyforgotpasswordlink');//Forgot Password Using Email Link
Route::post('/customer-link-changepassword','ForgotCustomerPasswordController@changepassword'); //Change Password

Route::group(['middleware' => ['customer']], function() {

    Route::get('/customer', function () {
        return view('cust/dashboard_1');
    });
    //Customer Logout
    Route::get('/customer-logout', function () {
        Auth::guard('customeruser')->logout();
        return redirect('/customer-login')->withErrors('Successfully Logged Out');
    });

    //Change Password
    Route::get('/customer/ChangePassword', function () {return view('cust.change_password');}); //Display Change Password Page
    Route::post('/customer-change-password','CustomerController@changepassword'); //Request to change Password

    //Manage Profile
    Route::get('/customer/Profile/','CustomerController@profileupdate');
    Route::post('/customer/editprofile/','CustomerController@editprofile');

    //Complaint Register
    Route::get('/customer/ComplaintRegister/{id}', 'ComplaintRegisterController@customerindex');//Complaint Register Page
    Route::get('/customer/ComplaintPage','ComplaintRegisterController@complaintbrandselection');//Brand Sleectin Page for Complaint
    Route::post('/customer/ComplaintAdd', 'ComplaintRegisterController@customercomplaintstore');//Add Complaint
    Route::get('/customer/ViewComplaint','ComplaintRegisterController@viewComplaintsOnCustomer');//View Complaint
});


//Login to Engineer
Route::get('/engineer-login', function () {return view('engineer.page-login');});
Route::post('/engineer-checklogin','EngineerController@login');

Route::group(['middleware' => ['engineer']], function() {

    Route::get('/engineer', function () {
        return view('engineer/dashboard_1');
    });
    //Customer Logout
    Route::get('/engineer-logout', function () {
        Auth::guard('engineeruser')->logout();
        return redirect('/engineer-login')->withErrors('Successfully Logged Out');
    });

    //Change Password
    Route::get('/engineer/ChangePassword', function () {return view('engineer.change_password');}); //Display Change Password Page
    Route::get('/engineer/idcard', function () {return view('engineer.mycard');});
    Route::post('/engineer-change-password','EngineerController@changepassword'); //Request to change Password

    //Complaint Register
    Route::get('/engineer/ComplaintUpdate/{cid}', 'ComplaintRegisterController@engineerupdate');//Complaint Register Page
    Route::get('/engineer/ViewComplaint','ComplaintRegisterController@viewComplaintsOnEngineer');//View Complaint
    Route::post('/engineer/ComplaintUpdateProcess','ComplaintRegisterController@closecomplaint');//Close or Update Complaint

});








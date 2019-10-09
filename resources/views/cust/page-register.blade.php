<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin Dashboard | DTHOCM</title>
        <meta name="description" content="Ela Admin - HTML5 Admin Template">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="images/logo2.png">
        <link rel="shortcut icon" href="images/logo2.png">
        <link rel="stylesheet" href="assets/css/normalize.min.css">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/themify-icons.css">
        <link rel="stylesheet" href="assets/css/pe-icon-7-stroke.min.css">
        <link rel="stylesheet" href="assets/css/flag-icon.min.css">
        <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!---<link rel="stylesheet" href="{{ URL::asset('assets/css/styles.css') }}">--->
        <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
        <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />
        <script src="jquery.min.js"></script>
        <!--Pie Chart Java Script-->
    <!--End Pie Chart Java Script-->

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
<style>
body  {
  background-image: url("images/log_main_customer.jpg");
  background-color: #cccccc;
   background-size: cover;
    background-position: center;
  background-repeat: no-repeat;
  background-attachment: fixed;
}
</style>

</head>
<body>

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">

                <div class="newlogin-form">
				<div class="login-logo">
                    <a href="/">
                        <img class="align-content" src="images/logo.png" alt="">
                    </a>
                </div>
                    <form action="{{URL('/customer-register-check')}}" method="POST">
                        @csrf
                            <div class='row'>
                                    @if(!empty($errors->first()))
                                       <div class="col-lg-12">
                                           <div class="alert alert-success">
                                               <span>{{ $errors->first() }}</span>
                                           </div>
                                       </div>
                                   @endif
                                   </div>
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" class="form-control" placeholder="Full Name" name="customer_name">
                        </div>
						<div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" placeholder="Email" name="customer_email">
                        </div>
						<div class="form-group">
                            <label>Mobile</label>
                            <input type="text" class="form-control" placeholder="Mobile" name="customer_mobile">
                        </div>
						<div class="form-group">
                            <label>Alternate Mobile Number</label>
                            <input type="text" class="form-control" placeholder="Alternate Mobile Number" name="customer_alternate_mobile">
                        </div>
						<div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" placeholder="Address" name="customer_address">
                        </div>
						<div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control" placeholder="City" name="customer_city">
                        </div>
						<div class="form-group">
                            <label>State</label>
                            <input type="text" class="form-control" placeholder="State" name="customer_state">
                        </div>
						<input type="submit" name="login" value="Register" class="btn btn-success btn-flat m-b-30 m-t-30">
                      <!---  <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30" name="login">Sign in</button>--->
                        <!---<div class="social-login-content">
                            <div class="social-button">
                                <button type="button" class="btn social facebook btn-flat btn-addon mb-3"><i class="ti-facebook"></i>Sign in with facebook</button>
                                <button type="button" class="btn social twitter btn-flat btn-addon mt-2"><i class="ti-twitter"></i>Sign in with twitter</button>
                            </div>
                        </div>--->
                        <div class="register-link m-t-15 text-center">
                            <p>Already Have Account ? <a href="customer-login"> Login</a></p>
							<p>Note : Initial your mobile number will be your password</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>
</html>

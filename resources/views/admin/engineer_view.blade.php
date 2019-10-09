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

    <link rel="apple-touch-icon" href="../images/logo2.png">
    <link rel="shortcut icon" href="../images/logo2.png">
    <link rel="stylesheet" href="../assets/css/normalize.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="../assets/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="../assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <!---<link rel="stylesheet" href="{{ URL::asset('assets/css/styles.css') }}">--->
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />
    <script src="../jquery.min.js"></script>
	<!--Pie Chart Java Script-->
<!--End Pie Chart Java Script-->
</head>

<body>
    @include('admin/left_panel')
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
            @include('admin/right_panel_header')
        <!-- Content -->
        <div class="content">
		<div class="animated fadeIn">
                <div class='row'>
                 @if(!empty($errors->first()))
                    <div class="col-lg-12">
                        <div class="alert alert-success">
                            <span>{{ $errors->first() }}</span>
                        </div>
                    </div>
                @endif
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">View Engineers</strong>
                            </div>
                            <div class="table-stats order-table ov-h">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th class="serial">ID</th>
                                            <th>Engineer Name</th>
                                            <th>Photo</th>
                                            <th>Ecode</th>
                                            <th>Contact</th>
                                            <th>Email ID</th>
                                            <th>Status</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach($engineers as $data)
                                            <tr>
                                                <td>{{$loop->index+1}}</td>
                                                <td>{{$data->e_name}}</td>
                                                <td><img src='{{ asset('images/uploaded/engineers') }}/{{$data->e_photo}}' height='64px'></td>
                                                <td>{{$data->e_code}}</td>
                                                <td>{{$data->e_contact}}</td>
                                                <td>{{$data->email}}</td>
                                                <td>
                                                    @if ($data->is_Active==1)
                                                        <a href='#'><span class='badge badge-complete'>Active</span></a>
                                                    @else
                                                        <span class='badge badge-pending'>InActive</span>
                                                    @endif
                                                </td>
                                                <td><form action = '{{URL('/delete-brand')}}' method='post'>@csrf<input type='hidden' name='id' value='{{$data->id}}'><button type='submit' name='delete_calltype' class='btn btn-sm' style='background-color:red; color:#FFFFFF;'><i class='far fa-trash-alt'></i></button></form></td>
                                                <td><a href='/admin/update-brand/{{$data->id}}'><div class='btn btn-sm' style='background-color:#00B0F0; color:#FFFFFF;' ><i class='far fa-edit'></i></div></a></td>
                                            </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div> <!-- /.table-stats -->
                        </div>
                    </div>
				</div>
			</div>
        </div>
		<div class="animated">
			<div class="modal fade" id="smallmodal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="smallmodalLabel">Close Call</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="call_add.php" method="post">

                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" id="bookId" name="bookId" placeholder="Customer ID" class="form-control" value="">
                                    </div>
                                </div>
								<div class="form-actions form-group"><input type="submit" name="registercall" value="Register Call" class="btn btn-success btn-sm"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
		</div>
        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
        @include('admin/footer')
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

	<!-- Modal Script-->
	<script></script>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="../assets/js/main.js"></script>

    <!--  Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

    <!--Chartist Chart-->
    <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
    <script src="assets/js/init/weather-init.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
    <script src="assets/js/init/fullcalendar-init.js"></script>
    <script src="https://kit.fontawesome.com/8692d5a96f.js"></script>
</body>
</html>

<!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                   <a class="navbar-brand" href="/customer"><b>HIGH LIGHT</b> SERVICES</a>
                    <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>
                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger"></span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
                            </div>
                        </div>

                        <div class="dropdown for-message">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="message" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-envelope"></i>
                                <span class="count bg-primary">0</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="message">
                                <p class="red">No Mails For You Today</p>
                            </div>
                        </div>
                    </div>

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="{{ URL::asset('images/uploaded/engineers') }}/{{Auth::guard('engineeruser')->user()->e_photo}}" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
						<a class="nav-link" href="/engineer/idcard"><i class="fa fa- user"></i>My ID Card</a>
                            <a class="nav-link" href="/engineer/ChangePassword"><i class="fa fa- user"></i>Change Password</a>
                        <a class="nav-link" href="/engineer-logout"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- /#header -->

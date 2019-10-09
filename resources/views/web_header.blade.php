
<header>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="navigation">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse.collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
            <div class="navbar-brand">
              <a href="index.html"><h1><span>HIGH LIGHT</span> SERVICES</h1></a>
			  <!-- <a href="index.html"><img src="{% static 'web_img/logo.jpg' %}" height="60px" alt="HIGH LIGHT SERVICES"></a> -->
            </div>
          </div>

          <div class="navbar-collapse collapse">
            <div class="menu">
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation"><a href="home" @if($pages=='home' || $pages=='') class="active" @endif>Home</a></li>
                <li role="presentation"><a href="about" @if($pages=='about') class="active" @endif>About Us</a></li>
                <li role="presentation"><a href="services" @if($pages=='services') class="active" @endif>Services</a></li>
                <li role="presentation"><a href="contact" @if($pages=='contact') class="active" @endif>Contact Us</a></li>
				<li class="dropdown" style="padding-top: 10px;">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Login
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="/customer-login">Customer Login</a></li>
                        <li><a href="/engineer-login">Engineer Login</a></li>
                        <li><a href="/admin-login">Admin Login</a></li>
                    </ul>
                </li>
            </ul>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>
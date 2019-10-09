<!---{% load static %}   --->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HIGH LIGHT SERVICES &#8211; Complaint Management System</title>

  <!-- Bootstrap -->
  <link href="{{ URL::asset('/css/bootstrap.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{ URL::asset('/css/font-awesome.min.css')}}" />
  <link rel="stylesheet" href="{{ URL::asset('/css/animate.css')}}">
  <link href="{{ URL::asset('/css/prettyPhoto.css')}}" rel="stylesheet">
  <link href="{{ URL::asset('/css/style.css')}}" rel="stylesheet" />
  <link rel="shortcut icon" img src="{{URL::asset('/web_img/favicon.jpg')}}" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <!-- =======================================================
    Theme Name: Company
    Theme URL: https://bootstrapmade.com/company-free-html-bootstrap-template/
    Author: BootstrapMade
    Author URL: https://bootstrapmade.com
  ======================================================= -->
</head>

<body>
    @include('web_header')
  <section id="main-slider" class="no-margin">
    <div class="carousel slide">
      <div class="carousel-inner">
        <div class="item active" style= 'background-image: url("/web_img/slider/maxresdefault.jpg");'>
          <div class="container">
            <div class="row slide-margin">
              <div class="col-sm-6">
                <div class="carousel-content">
                  <h2 class="animation animated-item-1" style="padding:10px; background-color:rgb(0,0,0,0.7);"><span>HIGH LIGHT</span>SERVICES AS YOU NEED</h2>
                  <!---<p class="animation animated-item-2">Call us now on +91 9898020032</p>--->
                  <a class="btn-slide animation animated-item-3" href="#feature-section">Read More</a>
				  <a class="btn-slide1 animation animated-item-4" href="#conatcat-info">Call +91 9998310328</a>
                </div>
              </div>

              <div class="col-sm-6 hidden-xs animation animated-item-5">
                <div class="slider-img">
                  <img src="{{URL::asset('/web_img/slider/img3.png')}}" class="img-responsive">
                </div>
              </div>

            </div>
          </div>
        </div>
        <!--/.item-->
      </div>
      <!--/.carousel-inner-->
    </div>
    <!--/.carousel-->
  </section>
  <!--/#main-slider-->

  <div class="feature" id="feature-section">
    <div class="container">
      <div class="text-center">
        <div class="col-md-3">
          <div class="hi-icon-wrap hi-icon-effect wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
            <i class="fas fa-shield-alt"></i>
            <h2>NEW DTH CONNECTION</h2>
            <p>Get a new connection of best DTH brand of India.</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="hi-icon-wrap hi-icon-effect wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
            <i class="fas fa-users"></i>
            <h2>DISH TRACKING</h2>
            <p>Get beat quality of services by experianced engineers.</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="hi-icon-wrap hi-icon-effect     wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="900ms">
            <i class="fas fa-binoculars"></i>
            <h2>DISH RELOCATION</h2>
            <p>Want to change home worried about channel connection. We are here to help you.</p>
                                                                                                                                    </div>
        </div>
        <div class="col-md-3">
          <div class="hi-icon-wrap hi-icon-effect wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="1200ms">
            <i class="fas fa-truck"></i>
            <h2>LED INSTALLATION</h2>
            <p>Purchased a new LED TV or want to change house contact us and get your TV mounted.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="about">
    <div class="container">
      <div class="col-md-12 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
        <h2>OUR MISSION</h2>
        <p>Our Mission is to be recognized as first preferred DTH AND ALL ELECTROINCS SERVICES PROVIDER in Electronics World with the motto of “Expect Good from US”</p>
      </div>
    </div>
  </div>

  <div class="our-team">
	<div class="container">
		<div class="col-md-12 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
			<h2>Meet Our Team</h2>
			<div class="team">
			 <div class="flip-card">
				<div class="flip-card-inner">
					<div class="flip-card-front">
						<img src="{{URL::asset('/web_img/team/1.jpg')}}" alt="Avatar" style="width:180;height:180px;">
					</div>
					<div class="flip-card-back">
						<h3>Mr. Hardik Sengar</h3>
						<p>Managing Director</p>
					</div>
				</div>
			</div>
			 <div class="flip-card">
				<div class="flip-card-inner">
					<div class="flip-card-front">
						<img src="{{URL::asset('/web_img/team/2.jpg')}}" alt="Avatar" style="width:180;height:180px;">
					</div>
					<div class="flip-card-back">
						<h3>Mr. Upendra Verma</h3>
						<p>IT Support Specialist</p>
					</div>
				</div>
			</div>
			 <div class="flip-card">
				<div class="flip-card-inner">
					<div class="flip-card-front">
						<img src="{{URL::asset('/web_img/team/3.jpg')}}" alt="Avatar" style="width:180;height:180px;">
					</div>
					<div class="flip-card-back">
						<h3>Mr. Vishal Prajapati</h3>
						<p>Area Manager</p>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
  </div>
  <section id="partner">
    <div class="container">
      <div class="center wow fadeInDown">
        <h2>OUR PARTNERS</h2>
      <!---  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam</p>  --->
      </div>

      <div class="partners">
        <ul>
          <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms" src="{{URL::asset('/web_img/partners/brinks.jpg')}}"></a></li>
          <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms" src="{{URL::asset('/web_img/partners/dishlogo.png')}}"></a></li>
          <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms" src="{{URL::asset('/web_img/partners/bvc.jpg')}}"></a></li>
          <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="900ms"  src="{{URL::asset('/web_img/partners/cms.jpg')}}"></a></li>
          <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="1200ms" src="{{URL::asset('/web_img/partners/Kiran.jpg')}}"></a></li>
          <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="1500ms" src="{{URL::asset('/web_img/partners/logicash.jpg')}}"></a></li>
		  <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="1800ms" src="{{URL::asset('/web_img/partners/ujaas.jpg')}}"></a></li>
          <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="2100ms" src="{{URL::asset('/web_img/partners/writer.jpg')}}"></a></li>
		  <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="2400ms" src="{{URL::asset('/web_img/partners/secure.jpg')}}"></a></li>
        </ul>
      </div>
    </div>
    <!--/.container-->
  </section>
  <!--/#partner-->

  <section id="conatcat-info">
    <div class="container">
      <div class="row">
        <div class="col-sm-8">
          <div class="media contact-info wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
            <div class="pull-left">
              <i class="fa fa-phone"></i>
            </div>
            <div class="media-body">
              <h2>GET IN TOUCH</h2>
              <p>Call Us on <a class="contact-link" href="tel:+919898020032">+91 9998310328</a> or Email us at <a class="contact-link" href="mailto:hsengar11@gmail.com">hsengar11@gmail.com</a>.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/.container-->
  </section>
  <!--/#conatcat-info-->

  @include('web_footer')

  <style>
  /* The flip card container - set the width and height to whatever you want. We have added the border property to demonstrate that the flip itself goes out of the box on hover (remove perspective if you don't want the 3D effect */
.flip-card {
  background-color: transparent;
  float: left;
  display: inline-block;
  width: 180px;
  height: 180px;
  margin: 5px;
  perspective: 1000px; /* Remove this if you don't want the 3D effect */
}
.flip-card h3 {
color: #ffffff;
}
.flip-card p {
color: #ffffff;
}

/* This container is needed to position the front and back side */
.flip-card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.8s;
  transform-style: preserve-3d;
}

/* Do an horizontal flip when you move the mouse over the flip box container */
.flip-card:hover .flip-card-inner {
  transform: rotateY(180deg);
}

/* Position the front and back side */
.flip-card-front, .flip-card-back {
  position: absolute;
  width: 100%;
  height: 100%;
  backface-visibility: hidden;
}

/* Style the front side (fallback if image is missing) */
.flip-card-front {
  background-color: #bbb;
  color: black;
}

/* Style the back side */
.flip-card-back {
  background-color: #DC2223;
  color: white;
  transform: rotateY(180deg);
}
  </style>
</body>

</html>

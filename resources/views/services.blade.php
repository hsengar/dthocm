<!DOCTYPE html>
<html lang="en">

@include('head')

<body>
  @include('web_header')

  <div id="breadcrumb">
    <div class="container">
      <div class="breadcrumb">
        <li><a href="index.html">Home</a></li>
        <li>Services</li>
      </div>
    </div>
  </div>

  <div class="services">
    <div class="container">
      <h3>Our Services</h3>
      <hr>
      <div class="col-md-6">
        <img src="../web_img/services/banner2.jpg" class="img-responsive">
      </div>

      <div class="col-md-6">
        <div class="media">
          <ul>
            <li>
              <div class="media-left">
                <i class="fas fa-user-shield"></i>
              </div>
              <div class="media-body">
                <h4 class="media-heading">NEW DTH CONNECTION</h4>
                <p>Get a new connection of best DTH brand of India.</p>
              </div>
            </li>
            <li>
              <div class="media-left">
                <i class="fas fa-binoculars"></i>
              </div>
              <div class="media-body">
                <h4 class="media-heading">DISH TRACKING</h4>
                <p>Get beat quality of services by experianced engineers.</p>
              </div>
            </li>
            <li>
              <div class="media-left">
               <i class="fas fa-people-carry"></i>
              </div>
              <div class="media-body">
                <h4 class="media-heading">DISH RELOCATION</h4>
                <p>Want to change home worried about channel connection. We are here to help you.p>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="sub-services">
    <div class="container">
      <div class="col-md-6">
        <div class="media">
          <ul>
            <li>
              <div class="media-left">
                <i class="fas fa-dolly"></i>
              </div>
              <div class="media-body">
                <h4 class="media-heading">LED INSTALLATION</h4>
                <p>LED TV installation in your new home or new LED TV in Existing home.</p>
              </div>
            </li>
            <li>
              <div class="media-left">
                <i class="fas fa-video"></i>
              </div>
              <div class="media-body">
                <h4 class="media-heading">ALL ELECTRONICS REPAIR</h4>
                <p>We do all Electronics Service and Repair Work</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-md-6">
        <img src="../web_img/services/banner1.jpg" class="img-responsive">
      </div>
    </div>
  </div>


  @include('web_footer')
</body>

</html>

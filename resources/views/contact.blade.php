<!---{% load static %}   --->
<!DOCTYPE html>
<html lang="en">

@include('head')

<body>
  @include('web_header')

  <div id="breadcrumb">
    <div class="container">
      <div class="breadcrumb">
        <li><a href="index.html">Home</a></li>
        <li>Contact</li>
      </div>
    </div>
  </div>

  <div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3672.4093866521234!2d72.63204541428215!3d23.008736122620366!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e867115555555%3A0xceb2bad9510bb032!2sHIGH%20LIGHT%20ELECTRONICS!5e0!3m2!1sen!2sin!4v1569442037810!5m2!1sen!2sin"  width="100%" height="380" frameborder="0" style="border:0" allowfullscreen></iframe>
  </div>

  <section id="contact-page">
    <div class="container">
	<div class="col-md-6">

        <h2>Drop Your Message</h2>
        <p>For any query please contact us.</p>
      <div class="row contact-wrap">
          <p style="color:#DC2223; padding: 5px; background-color:#FFFFCC;"></p>
          <form action="contact.php" method="post" role="form" class="contactForm">
            <div class="form-group">
              <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
              <div class="validation"></div>
            </div>
            <div class="form-group">
              <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
              <div class="validation"></div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone Number" data-rule="minlen:10" data-msg="Please enter a vaild 10 digit number" />
              <div class="validation"></div>
            </div>
			<div class="form-group">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
              <div class="validation"></div>
            </div>
            <div class="form-group">
              <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
              <div class="validation"></div>
            </div>
            <div class="text-center"><button type="submit" name="submit" class="btn btn-primary btn-lg" required="required">Submit Message</button></div>
          </form>
      </div>
	  </div>
	  <div class="col-md-6">
	  <h3>Head Office</h3>
	  <hr>
	  <p><b style="color:#DC2223;">Address: </b>315/5 Bhagwati Nagar,  </p>
	  <p>Satyam Nagar Road,</p>
	  <p>Amraiwadi, Ahmedabad - 380026</p>
	  <p><b style="color:#DC2223;">Contact No. :</b> +91 9898310328</p>
	  <p><b style="color:#DC2223;">Email :</b> hsengar11@gmail.com</p>
	  </div>
      <!--/.row-->
    </div>
    <!--/.container-->
  </section>
  <!--/#contact-page-->

  @include('web_footer')

</body>
</html>

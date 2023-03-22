@if (\Session::has('EmployerId'))
            
@extends('layout.employerlogged')
@section('title', 'Post Job')

@section('content') 

    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Post Job</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Employer</strong></span>
              <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Post Job</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section bg-light" id="next-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-5 mb-lg-0">
            @if (\Session::has('success'))
            <div class="alert alert-success">
              <p>{{ \Session::get('success') }}</p>
            </div><br/>
            @endif
            <form action="/employerPostjob" method="post" enctype="multipart/form-data">
              @csrf

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" >Category</label> 
                  <select name="category" class="form-control" required>
                    <option value="">--Select--</option>
                    <option>Agriculture & Food</option>
                    <option>Business & Finance</option>
                    <option>Construction</option>
                    <option>Education</option>
                    <option>Engineering</option>
                    <option>IT</option>
                    <option>Marketing</option>
                    <option>Medicine</option>
                    <option>Media</option>
                    <option>Service</option>
                    <option>Other</option>
                  </select>
                </div>
              </div>
            
               <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" >Title</label> 
                   <input type="text" name="title" class="form-control" required>
                </div>
              </div>
 
              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black">City</label> 
                  <input type="text" name="city" class="form-control" required>
                </div>
              </div>
 
              <div class="row form-group">                
                <div class="col-md-12">
                  <label class="text-black">Zipcode</label> 
                  <input type="text" name="zipcode" class="form-control" required>
                </div>
              </div>
              <div class="row form-group">                
                <div class="col-md-12">
                  <label class="text-black">Company</label> 
                  <input type="text" name="company" class="form-control" required>
                </div>
              </div>
              <div class="row form-group">                
                <div class="col-md-12">
                  <label class="text-black">Qualification</label> 
                  <input type="text" name="qualification" class="form-control" required>
                </div>
              </div>
              <div class="row form-group">                
                <div class="col-md-12">
                  <label class="text-black">Description</label> 
                  <textarea name="description" class="form-control" required></textarea>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Post Job" class="btn btn-primary btn-md text-white">
                </div>
              </div>

            </form>
          </div>
          
        </div>
      </div>
    </section>

    
      
    
    <footer class="site-footer">

      <a href="#top" class="smoothscroll scroll-top">
        <span class="icon-keyboard_arrow_up"></span>
      </a>

      <div class="container">
        <div class="row mb-5">
          <div class="col-6 col-md-3 mb-4 mb-md-0">
            <h3>Search Trending</h3>
            <ul class="list-unstyled">
              <li><a href="#">Web Design</a></li>
              <li><a href="#">Graphic Design</a></li>
              <li><a href="#">Web Developers</a></li>
              <li><a href="#">Python</a></li>
              <li><a href="#">HTML5</a></li>
              <li><a href="#">CSS3</a></li>
            </ul>
          </div>
          <div class="col-6 col-md-3 mb-4 mb-md-0">
            <h3>Company</h3>
            <ul class="list-unstyled">
              <li><a href="#">About Us</a></li>
              <li><a href="#">Career</a></li>
              <li><a href="#">Blog</a></li>
              <li><a href="#">Resources</a></li>
            </ul>
          </div>
          <div class="col-6 col-md-3 mb-4 mb-md-0">
            <h3>Support</h3>
            <ul class="list-unstyled">
              <li><a href="#">Support</a></li>
              <li><a href="#">Privacy</a></li>
              <li><a href="#">Terms of Service</a></li>
            </ul>
          </div>
          <div class="col-6 col-md-3 mb-4 mb-md-0">
            <h3>Contact Us</h3>
            <div class="footer-social">
              <a href="#"><span class="icon-facebook"></span></a>
              <a href="#"><span class="icon-twitter"></span></a>
              <a href="#"><span class="icon-instagram"></span></a>
              <a href="#"><span class="icon-linkedin"></span></a>
            </div>
          </div>
        </div>

        <div class="row text-center">
          <div class="col-12">
            <p class="copyright"><small>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></small></p>
          </div>
        </div>
      </div>
    </footer>
  
  </div>

    <!-- SCRIPTS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/stickyfill.min.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/quill.min.js"></script>
    
    
    <script src="js/bootstrap-select.min.js"></script>
    
    <script src="js/custom.js"></script>
   
   
     
  </body>
</html>
@else
 @php
        header("Location: " . URL::to('/index'), true, 302);
        exit();
  @endphp
@endif
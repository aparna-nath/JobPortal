@extends('layout.app')
@section('title', 'Login')

@section('content') 
<!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">User Login</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>User</strong></span>
              <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Login here</strong></span>
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
            <form action="/userLogin" class="" method="post" enctype="multipart/form-data">
              @csrf
              
              <div class="row form-group">
				        <div class="col-md-12">
                  <label class="text-black" for="email">Email</label> 
                  <input type="email" name="email" class="form-control" required>
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="subject">Password</label> 
                  <input type="password" name="password" class="form-control" required>
                </div>
              </div>

               

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Login" class="btn btn-primary btn-md text-white" required>
                  <a href="/userRegister" class="btn btn-primary btn-md text-white">Signup</a>
                </div>
              </div>

  
            </form>
          </div>
          
        </div>
      </div>
    </section>

@endsection
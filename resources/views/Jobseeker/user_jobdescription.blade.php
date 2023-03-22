@if (\Session::has('userId'))

@extends('layout.userloggedin')
@section('title', 'Job Description')

@section('content') 
<!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Job Description</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Jobs</strong></span>
              <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Job Description</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>
    @if (\Session::has('message'))
            <div class="alert alert-success">
              <p>{{ \Session::get('message') }}</p>
            </div><br/>
            @endif


<section class="site-section">
      <div class="container">
        <!-- <label id="labelmsg">hh</label> -->
        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2">Job Description</h2>
          </div>
        </div>
   
           

      <!--User Template starts -->
  <div class="container-xl">
  <div class="table-responsive">
    <div class="table-wrapper">
      <div class="table-title">
        <div class="row">
          
          
        </div>
      </div>
      <div class="row form-group">
                <div class="col-md-12">
                <div>
    <section class="bg-light">
    <div class="container">
        <div class="row">
        <form action="/Applyjobs" method="post">
             @csrf
            <div class="col-lg-12 mb-4 mb-sm-5">
                <div class="card card-style1 border-0">
                    <div class="card-body p-1-9 p-sm-2-3 p-md-6 p-lg-7">
                        <div class="row align-items-center">
                           
                            <div class="col-lg-6 px-xl-10">
                                <div class="bg-secondary d-lg-inline-block py-1-9 px-1-9 px-sm-6 mb-1-9 rounded">
                                    <h3 class="h2 text-white mb-0">Title: {{$job->title}}</h3>
                                    
                                </div>
                                <ul class="list-unstyled mb-1-9">
                                    
                                    <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">Company:</span> {{$job->company}}</li>
                                    <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">Location:</span> {{$job->city}}</li>
                                    <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">Qualification:</span> {{$job->qualification}}</li>
                                </ul>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mb-4 mb-sm-5">
                <div>
                    <span class="section-title text-primary mb-3 mb-sm-4">Job Description</span>
                    <p>{{$job->description}}</p>
                    
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row">
                        <div class="col-lg-12 mb-4 mb-sm-5">

                            <label>{{$job->id}} </label>
                            <input type="hidden" id="hid" name="hid" value="{{$job->id}}">
                            <input type="submit" id="btnapply" class="btn btn-primary btn-md text-white" value="Apply">
                        </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</section>
                </div>  
                
                </div>
              </div>
     

        
    </div>
  </div>        
</div> 
</div>
    
 <!-- <script>
          $(document).ready(function()
            {
              $('#btnapply').click(function()
              {
                var id=$('#hid').val();
                
                $.ajax(
                {
                  method:"post",
                    url:"{{url('/Applyjob')}}",
                     data:{ "_token":"{{csrf_token() }}",
                       id},
                    success:function(data)
                              {
                                $('lblmsg').html(data) //table id
                              }
                });
              });
            }); 
        </script> -->  
</section>
    @endsection
    
@else
 @php
        header("Location: " . URL::to('/index'), true, 302);
        exit();
  @endphp
@endif
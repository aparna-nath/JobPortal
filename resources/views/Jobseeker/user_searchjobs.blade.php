@if (\Session::has('userId'))

@extends('layout.userloggedin')
@section('title', 'Search Jobs')

@section('content') 
<!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Search Jobs</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>User</strong></span>
              <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Most Recent Jobs</strong></span>
            </div>
          </div>
        </div>
        <b>Welcome {{session('userName')}}</b>
      </div>
    </section>

    <section class="site-section">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2">Job Search</h2>
          </div>
        </div>
   
            @if (\Session::has('success'))
            <div class="alert alert-success">
              <p>{{ \Session::get('success') }}</p>
            </div><br/>
            @endif

      <!--template starts -->
  <div class="container-xl">
  <div class="table-responsive">
    <div class="table-wrapper">
      <div class="table-title">
        <div class="row">
          
          
        </div>
      </div>
      
         @csrf
              <div class="row mb-5">

                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <input type="text"id="keyword" name="keyword" class="form-control form-control-lg" placeholder="Search Keyword...">
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <select name="city" class="form-control" id="city" >
                    <option value="">--City</option>
                    <option>Lawrence</option>
                    <option>Leawood</option>
                    <option>KC Metro</option>
                    <option>Kansas</option>
                    <option>Kansas City</option>
                    <option>Olathe</option>
                    <option>Overland Park</option>
                    <option>Salina</option>
                    <option>Wichita</option>
                 </select>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <select name="category" class="form-control" id="category">
                    <option value="">-- Job Category</option>
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
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <a href="" class="btn btn-primary btn-lg btn-block text-white btn-search">Apply for job</a>
                </div>
                
              </div>
            </br>

      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>Category</th>
            <th>Title</th>
            <th>City</th>
            <th>Company</th>
            <th>Click here</th>
          </tr>
        </thead>
        <tbody>
         
        </tbody>
        </table>
       
        <div class="clearfix">
        
        <ul class="pagination">
          <li class="page-item "><a href="#">Previous</a></li>
          <li class="page-item active"><a href="#" class="page-link">1</a></li>
          <li class="page-item"><a href="#" class="page-link">2</a></li>
          <li class="page-item"><a href="#" class="page-link">3</a></li>
          <li class="page-item"><a href="#" class="page-link">4</a></li>
          <li class="page-item"><a href="#" class="page-link">5</a></li>
          <li class="page-item"><a href="#" class="page-link">Next</a></li>
        </ul>
      </div>
    </div>
  </div>        
</div> 
</div>
          
        </div>
      </div>
      <script>
       
          $('#keyword').on('keyup',function()
          {
            var keyword=$('#keyword').val();
            var city= $('#city').val();
            var category= $('#category').val();
            $.ajax({
              type : 'get',
              url : '{{URL::to('searchjobs')}}',
              data:{ "_token":"{{csrf_token() }}",
                       keyword,city,category},
              success:function(data)
              {
                $('tbody').html(data);
              }
            });
         })

          $('#city').on('change',function()
          {
            var keyword=$('#keyword').val();
            var city= $('#city').val();
            var category= $('#category').val();
            $.ajax({
              type : 'get',
              url : '{{URL::to('searchjobs')}}',
              data:{ "_token":"{{csrf_token() }}",
                       keyword,city,category},
              success:function(data)
              {
                $('tbody').html(data);
              }
            });
         })
          $('#category').on('change',function()
          {
            var keyword=$('#keyword').val();
            var city= $('#city').val();
            var category= $('#category').val();
            $.ajax({
              type : 'get',
              url : '{{URL::to('searchjobs')}}',
              data:{ "_token":"{{csrf_token() }}",
                       keyword,city,category},
              success:function(data)
              {
                $('tbody').html(data);
              }
            });
         })
           
         /* $(document).ready(function()
            {
              $('#btnsearch').click(function()
              {
                var keyword=$('#keyword').val();
                var city= $('#city').val();
                var category= $('#category').val();
                $.ajax(
                {
                  method:"get",
                    url:"{{url('/searchjobs')}}",
                     data:{ "_token":"{{csrf_token() }}",
                       keyword,city,category},
                    success:function(data)
                              {
                                $('tbody').html(data) //table id
                            }
                });
              });
            });    */ 
      </script>

    </section>

    @endsection

    @else
 @php
        header("Location: " . URL::to('/index'), true, 302);
        exit();
  @endphp
@endif
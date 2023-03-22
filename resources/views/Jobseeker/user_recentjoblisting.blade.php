@if (\Session::has('userId'))

@extends('layout.userloggedin')
@section('title', 'View Recent Jobs')

@section('content') 
<!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Recent Job Posts</h1>
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

            @if (\Session::has('success'))
            <div class="alert alert-success">
              <p>{{ \Session::get('success') }}</p>
            </div><br/>
            @endif

<section class="site-section">
  <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2">Recent Jobs</h2>
          </div>
        </div>
   
            @csrf
<!--template starts -->
    <div class="container-xl">
      <div class="table-responsive">
        <div class="table-wrapper">
          <div class="table-title">
            <div class="row">
            </div>
          </div>
              <div class="row mb-5">
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <input type="text"id="keyword" name="keyword" class="form-control form-control-lg" placeholder="Search Job title, Company...">
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
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($job as $values) 
          <tr>
            <td>{{$values->category}}</td>
            <td>{{$values->title}}</td>
            <td>{{$values->city}}</td>
            <td>{{$values->company}}</td>
            <td>
              <a href="/Jobdescription/{{$values->id}}" class="edit" title="click" >Job Description</a>
            </td>
            <td>
              <a href="/Jobapply/{{$values->id}}" class="edit" title="click" >Quick Apply</a>
              
            </td>
          </tr>
          @endforeach
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
            $value=$(this).val();
            $.ajax({
              type : 'get',
              url : '{{URL::to('searchjobs')}}',
              data:{'keyword':$value},
              success:function(data)
              {
                $('tbody').html(data);
              }
            });
         })
       </script>
</section>
    @endsection

    @else
 @php
        header("Location: " . URL::to('/index'), true, 302);
        exit();
  @endphp
@endif
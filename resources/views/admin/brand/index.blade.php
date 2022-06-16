@extends('admin.admin_master')
   @section('admin')
    <div class="py-12">
        <div class="container">
            <div class="row">

            <div class="col-md-8">
                <div class="card">
                  <!-- 
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                 <strong>{{ session('success') }}</strong>
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                 -->

                    <div class="card-header">All Brand</div>
   

    <table class="table">
  <thead>
    <tr>
      <th scope="col">SL No</th>
      <th scope="col">Brand Name</th>
      <th scope="col">Brand Image</th>
      <th scope="col">Created At</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

 <!--  @php($i = 1) --> <!-- لما استخدم هذه الحالة في ال pagination بيكون كل صفحة الترقيم ببدأ من 1  -->
        @foreach($brands as $brand)
    <tr>
      <th scope="row"> <!-- {{ $i++ }} --> {{ $brands -> firstItem()+$loop->index }}</th>
      <td>{{ $brand -> brand_name }}</td>
    <td><img src="{{ asset($brand -> brand_image) }}" style="height:40px; width:70px;" alt=""></td>

      <td>
      <!-- المشكلة هنا انو يوجد عندي null for created_at فبديني ErrOr -->
      @if($brand -> created_at == NULL)
      <span class="text-danger"> No Date Set </span>
      @else
    {{ Carbon\Carbon::parse($brand -> created_at) -> diffForHumans() }}<!-- السبب هو استخدامي ل query builder -->
     @endif
     </td>
     <td>
         <a href="{{ url('brand/edit/'.$brand->id) }}" class="btn btn-info">Edit</a>
         <a href="{{ url('brand/delete/'.$brand->id) }}" class="btn btn-danger" onclick="return confirm('Are you SURE to DELETE -> !?')" >Delete</a>

     </td>

  </tr>
    @endforeach
    
  </tbody>
</table>
{{ $brands -> links() }}


</div><!-- end card -->
          </div><!-- end col-md-8 -->


          <div class="col-md-4">
              <div class="card">
                  <div class="card-header">Add Brand</div>
                  <div class="card-body">

                  <form  action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                      @csrf <!-- الفكرة منها هي التحقق من ال isreding and istokenmach -->
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Brnad Name</label>
    <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

    @error('brand_name')
    <span class="text-danger">{{ $message }}</span>
    @enderror
  </div><!-- end mb-3 -->


  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Brnad Image</label>
    <input type="file" name="brand_image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

    @error('brand_image')
    <span class="text-danger">{{ $message }}</span>
    @enderror
  </div><!-- end mb-3 -->



  <button type="submit" class="btn btn-primary">Add Brand</button>
</form>

</div> <!-- end card-body -->
              </div><!-- end card -->
          </div><!-- end col-md-4 -->


         </div><!-- end row -->
        </div><!-- end container -->




        <!-- 
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
               <x-jet-welcome /> // هاد الي بظهر صفحة ال welcome 
            </div>
        </div>
        --> 
    </div>
@endsection
@extends('admin.admin_master')

   @section('admin')
   
   <div class="py-12">
        <div class="container">
            <div class="row">

            <div class="col-md-8">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                 <strong>{{ session('success') }}</strong>
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

        <div class="card-group">
            @foreach($images as $multi)

            <div class="col-md-4 mt-5">
                <div class="card" style="margin:10px;">
                    <img src="{{ asset($multi->image) }}" alt="">
                </div>
            </div>

            @endforeach
        </div>



          </div><!-- end col-md-8 -->


          <div class="col-md-4">
              <div class="card">
                  <div class="card-header">Multi Image</div>
                  <div class="card-body">

                  <form  action="{{ route('store.image') }}" method="POST" enctype="multipart/form-data">
                      @csrf <!-- الفكرة منها هي التحقق من ال isreding and istokenmach -->


  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Brnad Image</label>
    <input type="file" name="image[]" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" multiple="">
    <!-- image[] >> السبب هو وجووود عدد من ال image وبدهم يدخلو ب foreach loop  -->

    @error('image')
    <span class="text-danger">{{ $message }}</span>
    @enderror

  </div><!-- end mb-3 -->

  <button type="submit" class="btn btn-primary">Add Image</button>
</form>

</div> <!-- end card-body -->
              </div><!-- end card -->
          </div><!-- end col-md-4 -->


         </div><!-- end row -->
        </div><!-- end container -->




    </div>
    @endsection
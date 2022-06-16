<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          <!--  {{ __('Dashboard') }} -->
            Edit Category<b></b>
        </b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">


          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Edit Category</div>
                  <div class="card-body">

                  <form  action="{{ url('category/update/'.$categories->id) }}" method="POST">
                      @csrf <!-- الفكرة منها هي التحقق من ال isreding and istokenmach -->
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Updatre Category Name</label>
    <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $categories -> category_name }}" >

    @error('category_name')
    <span class="text-danger">{{ $message }}</span>
    @enderror
  </div><!-- end mb-3 -->



  <button type="submit" class="btn btn-primary">Update Category</button>
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
</x-app-layout>

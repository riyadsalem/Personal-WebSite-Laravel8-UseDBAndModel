<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          <!--  {{ __('Dashboard') }} -->
            All Category<b></b>
        </b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">

            <div class="col-md-8">
                <div class="card">

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                 <strong>{{ session('success') }}</strong>
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                    <div class="card-header">All Category</div>
   

    <table class="table">
  <thead>
    <tr>
      <th scope="col">SL No</th>
      <th scope="col">Category Name</th>
      <th scope="col">User</th>
      <th scope="col">Created At</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

 <!--  @php($i = 1) --> <!-- لما استخدم هذه الحالة في ال pagination بيكون كل صفحة الترقيم ببدأ من 1  -->
        @foreach($categories as $category)
    <tr>
      <th scope="row"> <!-- {{ $i++ }} --> {{ $categories -> firstItem()+$loop->index }}</th>
      <td>{{ $category -> category_name }}</td>
     <!-- <td>{{ $category -> user_id }}</td> --> 
    <td>{{ $category -> user -> name }}</td>

      <td>
      <!-- المشكلة هنا انو يوجد عندي null for created_at فبديني ErrOr -->
      @if($category -> created_at == NULL)
      <span class="text-danger"> No Date Set </span>
      @else
    {{ Carbon\Carbon::parse($category -> created_at) -> diffForHumans() }}<!-- السبب هو استخدامي ل query builder -->
     @endif
     </td>
     <td>
         <a href="{{ url('category/edit/'.$category->id) }}" class="btn btn-info">Edit</a>
         <a href="{{ url('softdelete/category/'.$category->id) }}" class="btn btn-danger">Delete</a>

     </td>

  </tr>
    @endforeach
    
  </tbody>
</table>
{{ $categories -> links() }}


</div><!-- end card -->
          </div><!-- end col-md-8 -->


          <div class="col-md-4">
              <div class="card">
                  <div class="card-header">Add Category</div>
                  <div class="card-body">

                  <form  action="{{ route('store.category') }}" method="POST">
                      @csrf <!-- الفكرة منها هي التحقق من ال isreding and istokenmach -->
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Category Name</label>
    <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

    @error('category_name')
    <span class="text-danger">{{ $message }}</span>
    @enderror
  </div><!-- end mb-3 -->



  <button type="submit" class="btn btn-primary">Add Category</button>
</form>

</div> <!-- end card-body -->
              </div><!-- end card -->
          </div><!-- end col-md-4 -->


         </div><!-- end row -->
        </div><!-- end container -->









<!-- Trash Part -->


        <div class="container">
            <div class="row">
              
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">Trash List</div>
   

    <table class="table">
  <thead>
    <tr>
      <th scope="col">SL No</th>
      <th scope="col">Category Name</th>
      <th scope="col">User</th>
      <th scope="col">Created At</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

 <!--  @php($i = 1) --> <!-- لما استخدم هذه الحالة في ال pagination بيكون كل صفحة الترقيم ببدأ من 1  -->
        @foreach($trachCat as $category)
    <tr>
      <th scope="row"> <!-- {{ $i++ }} --> {{ $categories -> firstItem()+$loop->index }}</th>
      <td>{{ $category -> category_name }}</td>
     <!-- <td>{{ $category -> user_id }}</td> --> 
    <td>{{ $category -> user -> name }}</td>

      <td>
      <!-- المشكلة هنا انو يوجد عندي null for created_at فبديني ErrOr -->
      @if($category -> created_at == NULL)
      <span class="text-danger"> No Date Set </span>
      @else
    {{ Carbon\Carbon::parse($category -> created_at) -> diffForHumans() }}<!-- السبب هو استخدامي ل query builder -->
     @endif
     </td>
     <td>
         <a href="{{ url('category/restore/'.$category->id) }}" class="btn btn-info">Restore</a>
         <a href="{{ url('pdelete/category/'.$category->id) }}" class="btn btn-danger">P Delete</a>

     </td>

  </tr>
    @endforeach
    
  </tbody>
 </table> 
 {{ $trachCat -> links() }}


 </div><!-- end card -->
          </div><!-- end col-md-8 -->


          <div class="col-md-4">
          </div><!-- end col-md-4 -->


         </div><!-- end row -->
        </div><!-- end container -->

<!-- End Trash Part -->











        <!-- 
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
               <x-jet-welcome /> // هاد الي بظهر صفحة ال welcome 
            </div>
        </div>
        --> 
    </div>
</x-app-layout>

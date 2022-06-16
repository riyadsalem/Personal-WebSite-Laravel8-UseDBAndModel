@extends('admin.admin_master')

   @section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">

            <div class="col-md-8">
            <h4> Admin Message  </h4>
            <br>
             </div>

            <div class="col-md-12">
                <div class="card">

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                 <strong>{{ session('success') }}</strong>
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                    <div class="card-header">All Message Data</div>
   

    <table class="table">
  <thead>
    <tr>
      <th scope="col" width='5%'>SL</th>
      <th scope="col" width='15%'>Name</th>
      <th scope="col" width='25%'>Email</th>
      <th scope="col" width='25%'>Subject</th>
      <th scope="col" width='25%'>Message</th>
      <th scope="col" width='15%'>Action</th>
    </tr>
  </thead>
  <tbody>

        @php($i = 1)
        @foreach($messages as $mess)
    <tr>
      <th scope="row">{{ $i++ }}</th>
      <td>{{ $mess -> name }}</td>
      <td>{{ $mess -> email }}</td>
      <td>{{ $mess -> subject }}</td>
      <td>{{ $mess -> massage }}</td>

     <td>
         <a href="{{ url('message/delete/'.$mess->id) }}" class="btn btn-danger" onclick="return confirm('Are you SURE to DELETE -> !?')" >Delete</a>

     </td>

  </tr>
    @endforeach
    
  </tbody>
</table>



              </div><!-- end card -->
          </div><!-- end col-md-12 -->


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
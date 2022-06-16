<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          <!--  {{ __('Dashboard') }} -->
            Hi.. <b>{{ Auth::user()->name }} <!-- هذه الفكرة من خلالها بجيب اي قيمة بأي مكان في ال project --></b>
            <b style="float:right;">Total Users
            <span class="badge bg-danger">{{ count($users) }}</span>
        </b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
            <table class="table">
  <thead>
    <tr>
      <th scope="col">SL No</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Created At</th>
    </tr>
  </thead>
  <tbody>

       @php($i = 1)
        @foreach($users as $user)
    <tr>
      <th scope="row">{{ $i++ }}</th>
      <td>{{ $user -> name }}</td>
      <td>{{ $user -> email }}</td>
     <td>{{ Carbon\Carbon::parse($user -> created_at) -> diffForHumans() }}</td>
    </tr>
    @endforeach
    
  </tbody>
</table>
            </div>
        </div>






        <!-- 
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
               <x-jet-welcome /> // هاد الي بظهر صفحة ال welcome 
            </div>
        </div>
        --> 
    </div>
</x-app-layout>

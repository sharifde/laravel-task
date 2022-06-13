@extends('backend.partial.layout')


@section('content')
<div class="row">
    <div class="col-lg-10 margin-tb  ml-5">
        <div class="pull-left">
            {{-- <h2>Users Management</h2> --}}
        </div>
        <div class="pull-right pl-5">
            <a class="btn btn-success mt-5 ml-5 " href="{{ route('users.create') }}"> Create New User</a>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success   col-md-4   offset-md-5">
  <p>{{ $message }}</p>
</div>
@endif


<div class="row justify-content-center">
   <div class="col-ms-10">
    <table class="table table-bordered mt-3">
      <tr>
        <th>No</th>
        <th>Name</th>
        <th>Email</th>
        <th>Roles</th>
        <th width="280px">Action</th>
      </tr>
      @foreach ($data as $key => $user)
       <tr>
         <td>{{ ++$i }}</td>
         <td>{{ $user->name }}</td>
         <td>{{ $user->email }}</td>
         <td>
           @if(!empty($user->getRoleNames()))
             @foreach($user->getRoleNames() as $v)
                <label class="badge badge-success">{{ $v }}</label>
             @endforeach
           @endif
         </td>
         <td>
            <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
             {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                 {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
             {!! Form::close() !!}
         </td>
       </tr>
      @endforeach
     </table>
   </div>

</div>


{!! $data->render() !!}


<p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
@endsection
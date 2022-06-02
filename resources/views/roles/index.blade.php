@extends('admin.layout')


@section('content')
<div class="row ">
    <div class="col-lg-12 margin-tb  ml-4">
        {{-- <div class="pull-left">
            <h2>Role Management</h2>
        </div> --}}
        <div class="pull-right  ml-5">
        @can('role-create')
            <a class="btn btn-success mt-5" href="{{ route('roles.create') }}"> Create New Role</a>
            @endcan
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif


<div class="row justify-content-center">
 <div class="col-ms-10">
    <table class="table table-bordered   mt-5">
        <tr>
           <th width="280px">No</th>
           <th width="280px">Name</th>
           <th width="280px">Action</th>
        </tr>
          @foreach ($roles as $key => $role)
          <tr>
              <td>{{ ++$i }}</td>
              <td>{{ $role->name }}</td>
              <td>
                  <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>
                  @can('role-edit')
                      <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                  @endcan
                  @can('role-delete')
                      {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                          {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                      {!! Form::close() !!}
                  @endcan
              </td>
          </tr>
          @endforeach
      </table>
 </div>

</div>


{!! $roles->render() !!}


<p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
@endsection
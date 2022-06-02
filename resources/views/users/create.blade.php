@extends('admin.layout')


@section('content')
{{-- <div class="row justify-content-center">
    <div class="col-lg-10 margin-tb ml-5 ">
        <div class="">
           
        </div>
        <div class=" ml-4   d-flex  mt-5">
            <a class="btn btn-primary  ml-5" href="{{ route('users.index') }}"> Back</a>
            <h2   class="ml-5">Create New User</h2>
        </div>
    </div>
</div> --}}


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif



{!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}

<h2   class="pt-2  text-center">Create New User</h2>
<div class="row  justify-content-center">
    <div class="col-xs-10 col-sm-8 col-md-8 ml-5">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-10 col-sm-8 col-md-8 ml-5">
        <div class="form-group">
            <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-10 col-sm-8 col-md-8 ml-5">
        <div class="form-group">
            <strong>Password:</strong>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-10 col-sm-8 col-md-8 ml-5">
        <div class="form-group">
            <strong>Confirm Password:</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-10 col-sm-8 col-md-8 ml-5">
        <div class="form-group">
            <strong>Role:</strong>
            {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-success">Submit</button>
    </div>
</div>
{!! Form::close() !!}


{{-- <p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p> --}}
@endsection
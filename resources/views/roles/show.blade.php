@extends('admin.layout')


@section('content')
<div class="row">
    <div class="col-lg-10 ml-5 margin-tb">
        <div class="pull-left">
            <h2> Show Role</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xs-10 col-sm-10 col-md-10   ml-5">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $role->name }}
        </div>
    </div>
    <div class="col-xs-10 col-sm-10 col-md-10  ml-5">
        <div class="form-group">
            <strong>Permissions:</strong>
            @if(!empty($rolePermissions))
                @foreach($rolePermissions as $v)
                    <label class="label label-success">{{ $v->name }},</label>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
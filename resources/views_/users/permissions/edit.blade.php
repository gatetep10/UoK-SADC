@extends('adminlte::page')

@section('title', 'Edit Permissions | Dashboard')

@section('content_header')
    <h1>Edit Permissions</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div id="errorBox"></div>
            <div class="col-3">
                <form action="{{route('users.permissions.update', $permission->id)}}" method="post">
                    @method('patch')
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Update Permission </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control" placeholder = "Enter permission name" value = "{{$permission->name}}">
                                @if($errors -> has('name'))
                                    <span class="text-danger">{{$errors->first('name')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('footer')
    <footer class="main-footer"></footer>
@stop

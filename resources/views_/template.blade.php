@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@stop
@section('footer')
    <footer class="main-footer" style = "background-color:#71142f; color:white">
        <div class="float-right d-none d-sm-block">
            <span >Version</span> 1.0
        </div>
        </span> Copyright © 2023 </span> <span style = "color: #007bff"><b>UoK | SADC.</b> </span> <span style = "color:white">All rights reserved. </span>
    </footer>
@stop


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
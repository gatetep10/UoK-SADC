@extends('adminlte::page')

@section('title', 'Permissions | Dashboard')

@section('content_header')
    <h1>Permissions</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div id="errorBox"></div>
            <div class="col-3">
                <form action="{{route('users.permissions.store')}}" method="post">
                    
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"> New Permission </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control" placeholder = "Enter permission name" value = "{{old('name')}}">
                                @if($errors -> has('name'))
                                    <span class="text-danger">{{$errors->first('name')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        
            <div class="col-9">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">All Available Permissions</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id = "tblData" class = "table table-bordered table-striped dataTable dtr-inline collapsed">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Guard Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
@stop

@section('footer')
    <footer class="main-footer"></footer>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

<script>
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function(){
        var table = $('#tblData').DataTable({
            responsive:true, processing:true, serverSide:true, autoWidth:false,
            ajax:"{{route('users.permissions.index')}}",
            columns:[
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'guard_name', name: 'guard_name'},
                {data: 'action', name: 'action'},
            ],
            order:[[0, "desc"]]
        });
        $('body').on('click', '#btnDel', function(){
            //Comfirmation
            var id = ($(this).data('id'));
            if(confirm('Are you sure you want to delete permission of ID: ' +id+ '?') == true){
                //Execute deletion
               var route = "{{route('users.permissions.destroy', ':id')}}";
               route = route.replace(':id', id);
                $.ajax({
                    url:route,
                    type:'delete',
                    success:function(res){
                        console.log(res);
                        $("#tblData").DataTable().ajax.reload();
                    },
                    error:function(res){
                        $('errorBox').html('<div class = "alert alert-danger">' +response.message+'</div>');
                    }
                });
                    
                
            }
            else{

                //Do nothing
            }

        });
    });
</script>
@stop
@section('plugins.Datatables', true)
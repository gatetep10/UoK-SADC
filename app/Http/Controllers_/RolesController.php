<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use DataTables;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if($request -> ajax()){
            return $this -> getRoles();
        }
        return view('users.Roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $permissions = Permission::get();
        return view('users.roles.create')->with(['Permission' => $permissions]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    private function getRoles(){
        $data = Role::withCount(['users', 'permissions']) ->get();
        return DataTables :: of($data)
        -> addColumn('users_count', function($row){
            return $row -> users_count;
        }) 
        -> addColumn('permissions_count', function($row){
            return $row -> permission_count;
        })
        -> addColumn('action', function($row){
            $action = "";
            $action .= "<a class = 'btn btn-xs btn-warning' id = 'btnEdit' href = '".route('users.roles.edit', $row->id)."'> <i class = 'fas fa-edit'></i></a>";
            $action .= "  <button class = 'btn btn-xs btn-outline-danger' id = 'btnDel' data-id = '". $row -> id ."'> <i class = 'fas fa-trash'></i></button>";
            return $action;
        })
        -> make('true');
    }  
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use DataTables;
class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if($request ->ajax()){
            return $this -> getPermissions();
        } 
        return view('users.permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        //return $request ->all();
        //validate name
        $this -> validate($request, [
            'name' => 'required | unique:permissions'
        ]);
        $permission = Permission::create(['name' => strtolower($request -> name)]);
        if($permission)
        {
            toast('Permission registered successfully', 'success');
            return view('users.permissions.index');
        }
        else{
            toat('Failed to register a new permission', 'error');
            return back() -> withInput();
        }
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
    public function edit(Permission $permission)
    {
        // Fetch data into permission form
        //return $permission;
        return view('users.permissions.edit')->with(['permission'=>$permission]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        //Validation
        $this->validate($request,[
            'name' => 'required|unique:permissions,name,'.$permission -> id
        ]);
        if($permission ->update($request -> only('name'))){
            toast('Permission updated successfullly', 'success');
            return view('users.permissions.index');
        }
        toast('Failed to update permission', 'error');
        return back()->withInput();
        //Updating permission

        return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Permission $permission)
    {
        //Execution of deletion

        //return $permission;

        if($request->ajax() && $permission -> delete()){
            
            return response(["message" => "Permission deleted successfully"], 200);
        }
        return response(["message" => "Failed to delete a permission, retry"], 201);
    }
    private function getPermissions(){

        $data = Permission::get();
        return DataTables::of($data) -> addColumn('action', function($row){
            $action = "";
            $action .= "<a class = 'btn btn-xs btn-warning' id = 'btnEdit' href = '".route('users.permissions.edit', $row->id)."'> <i class = 'fas fa-edit'></i></a>";
            $action .= "  <button class = 'btn btn-xs btn-outline-danger' id = 'btnDel' data-id = '". $row -> id ."'> <i class = 'fas fa-trash'></i></button>";
            return $action;
        }) -> make(true);
    }
}

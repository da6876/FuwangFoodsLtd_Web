<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;
use Session;

class UserTypeController extends Controller
{

    public function index()
    {
        try {
            DB::connection()->getPdo();
            return view('configpage.user_type');
        } catch (\Exception $e) {

            return view('errorpage.database_error');
        }
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $data = array();
        $data['user_type_name'] = $request['user_type_name'];
        $data['user_type_status'] = $request['user_type_status'];

        $result = DB::table('user_type')->insert($data);
        return json_encode(array(
            "statusCode" => 200,
            "statusMsg" => "User Type Added Successfully"
        ));

    }


    public function show($id)
    {
        $singleDataShow = DB::table('user_type')
            ->where('user_type_id', $id)
            ->get();
        return $singleDataShow;
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        DB::table('user_type')
            ->where('user_type_id', $id)
            ->delete();
        return json_encode(array(
            "statusCode" => 200
        ));
    }

    public function getAllUserType()
    {

        $UserType = DB::table('user_type')
            ->get();

        return DataTables::of($UserType)
            ->addColumn('action', function ($UserType) {
                $buttton = '
                <div class="button-list">
                    <a onclick="showUserTypeData(' . $UserType->user_type_id . ')" role="button" href="#" class="btn btn-success btn-sm"><i class="fa fa-external-link-square bigfonts"></i></a>
                    <a onclick="editUserTypeData(' . $UserType->user_type_id . ')" role="button" href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit bigfonts"></i></a>
                    <a onclick="deleteUserTypeData(' . $UserType->user_type_id . ')" role="button" href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash-o bigfonts"></i></a>
                </div>
                ';
                return $buttton;
            })
            ->rawColumns(['action'])
            ->toJson();

    }


}

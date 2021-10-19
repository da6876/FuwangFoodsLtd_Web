<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;
use DB;
use Session;

class UserAssignedController extends Controller
{

    public function index(){
        try {
            DB::connection()->getPdo();
            return view('configpage.user_assigned');
        } catch (\Exception $e) {
            return view('errorpage.database_error');
        }
    }

    public function store(Request $request){
        $data = array();

        $area_code= $request['zip_id'];
        $count_area_code = sizeof($area_code);

        foreach ($area_code as $area_code){

            $data['user_info_id'] = $request['user_info_id'];
            $data['user_assigned_status'] = $request['status'];
            $data['area_code'] = $area_code;
            $data['create_info'] = "Admin";

            $result = DB::table('user_assigned')->insert($data);
        }

        return json_encode(array(
            "statusCode" => 200
        ));

    }


    public function show($id)
    {
        $singleDataShow = DB::table('user_assigned')
            ->where('user_assigned_id', $id)
            ->get();
        return $singleDataShow;
    }


    public function destroy($id)
    {
        DB::table('user_assigned')
            ->where('user_assigned_id', $id)
            ->delete();
        return json_encode(array(
            "statusCode" => 200
        ));
    }

    public function getAllUserAssigned()
    {

        $categories_sub = DB::select("SELECT user_assigned_id, user_name ,area_code,ZI.zip_name ,user_assigned_status, UA.create_info, UA.update_info
                            FROM user_assigned UA, user_info UI,zip_info ZI
                            WHERE UA.user_info_id = UI.user_info_id
                            AND UA.area_code = ZI.zip_id");

        return DataTables::of($categories_sub)
            ->addColumn('action', function ($categories_sub) {
                $buttton = '
                <div class="button-list">
                    <a onclick="deletecategories_subData('.$categories_sub->user_assigned_id.')" role="button" href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash-o bigfonts"></i></a>
                </div>
                ';
                return $buttton;
            })
            ->rawColumns(['action'])
            ->toJson();

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;
use Session;

class SubCategoryInfoController extends Controller
{

    public function index()
    {
        try {
            DB::connection()->getPdo();
            return view('configpage.sub_category');
        } catch (\Exception $e) {
            return view('errorpage.database_error');
        }
    }


    public function store(Request $request)
    {
        $data = array();
        $data['sub_categories_name'] = $request['sub_categories_name'];
        $data['categories_id'] = $request['categories_id'];
        $data['sub_categories_status'] = $request['sub_categories_status'];

        $result = DB::table('categories_sub')->insert($data);
        return json_encode(array(
            "statusCode" => 200,
            "statusMsg" => "Sub Categories Added Successfully"
        ));

    }


    public function show($id)
    {
        $singleDataShow = DB::table('categories_sub')
            ->where('sub_categories_id', $id)
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
        DB::table('categories_sub')
            ->where('sub_categories_id', $id)
            ->delete();
        return json_encode(array(
            "statusCode" => 200
        ));
    }

    public function getAllcategories_sub()
    {

        $categories_sub = DB::table('categories_sub')
            ->get();

        return DataTables::of($categories_sub)
            ->addColumn('action', function ($categories_sub) {
                $buttton = '
                <div class="button-list">
                    <a onclick="showcategories_subData('.$categories_sub->sub_categories_id.')" role="button" href="#" class="btn btn-success btn-sm"><i class="fa fa-external-link-square bigfonts"></i></a>
                    <a onclick="editcategories_subData('.$categories_sub->sub_categories_id.')" role="button" href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit bigfonts"></i></a>
                    <a onclick="deletecategories_subData('.$categories_sub->sub_categories_id.')" role="button" href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash-o bigfonts"></i></a>
                </div>
                ';
                return $buttton;
            })
            ->rawColumns(['action'])
            ->toJson();

    }
}

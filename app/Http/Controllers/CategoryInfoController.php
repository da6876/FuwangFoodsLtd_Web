<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;
use Session;

class CategoryInfoController extends Controller
{

    public function index()
    {

        try {
            DB::connection()->getPdo();
            return view('configpage.category');
        } catch (\Exception $e) {
            return view('errorpage.database_error');
        }
    }


    public function store(Request $request)
    {
        $data = array();
        $data['categories_name'] = $request['categories_name'];
        $data['categories_status'] = $request['categories_status'];

        $result = DB::table('categories')->insert($data);
        return json_encode(array(
            "statusCode" => 200,
            "statusMsg" => "Categories Added Successfully"
        ));

    }


    public function show($id)
    {
        $singleDataShow = DB::table('categories')
            ->where('categories_id', $id)
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
        DB::table('categories')
            ->where('categories_id', $id)
            ->delete();
        return json_encode(array(
            "statusCode" => 200
        ));
    }

    public function getAllcategories()
    {

        $categories = DB::table('categories')
            ->get();

        return DataTables::of($categories)
            ->addColumn('action', function ($categories) {
                $buttton = '
                <div class="button-list">
                    <a onclick="showcategoriesData('.$categories->categories_id.')" role="button" href="#" class="btn btn-success btn-sm"><i class="fa fa-external-link-square bigfonts"></i></a>
                    <a onclick="editcategoriesData('.$categories->categories_id.')" role="button" href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit bigfonts"></i></a>
                    <a onclick="deletecategoriesData('.$categories->categories_id.')" role="button" href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash-o bigfonts"></i></a>
                </div>
                ';
                return $buttton;
            })
            ->rawColumns(['action'])
            ->toJson();

    }
}

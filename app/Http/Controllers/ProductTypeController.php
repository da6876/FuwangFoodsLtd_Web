<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;
use Session;
class ProductTypeController extends Controller
{

    public function index()
    {
        try {
            DB::connection()->getPdo();
            return view('configpage.product_type');
        } catch (\Exception $e) {
            return view('errorpage.database_error');
        }
    }


    public function store(Request $request)
    {
        $data = array();
        $data['product_type_name'] = $request['product_type_name'];
        $data['product_type_status'] = $request['product_type_status'];

        $result = DB::table('product_type')->insert($data);
        return json_encode(array(
            "statusCode" => 200,
            "statusMsg" => "Product Type Added Successfully"
        ));

    }


    public function show($id)
    {
        $singleDataShow = DB::table('product_type')
            ->where('product_type_id', $id)
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
        DB::table('product_type')
            ->where('product_type_id', $id)
            ->delete();
        return json_encode(array(
            "statusCode" => 200
        ));
    }

    public function getAllproduct_type()
    {

        $product_type = DB::table('product_type')
            ->get();

        return DataTables::of($product_type)
            ->addColumn('action', function ($product_type) {
                $buttton = '
                <div class="button-list">
                    <a onclick="showproduct_typeData(' . $product_type->product_type_id . ')" role="button" href="#" class="btn btn-success btn-sm"><i class="fa fa-external-link-square bigfonts"></i></a>
                    <a onclick="editproduct_typeData(' . $product_type->product_type_id . ')" role="button" href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit bigfonts"></i></a>
                    <a onclick="deleteproduct_typeData(' . $product_type->product_type_id . ')" role="button" href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash-o bigfonts"></i></a>
                </div>
                ';
                return $buttton;
            })
            ->rawColumns(['action'])
            ->toJson();

    }

}

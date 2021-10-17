<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;
use Session;


class ProductStockController extends Controller
{
    public function index()
    {
        try {
            DB::connection()->getPdo();
            return view('configpage.product_stock');
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
        $data['batch_no'] = $request['batch_no'];
        $data['product_id'] = $request['product_id'];
        $data['qnty'] = $request['qnty'];
        $data['production_date'] = $request['production_date'];
        $data['expiry_date'] = $request['expiry_date'];
        $data['other_info'] = $request['other_info'];
        $data['user_id'] = "11220001";
        $data['create_info'] = "11220001";
        $data['product_stock_status'] = $request['product_stock_status'];

        $result = DB::table('product_stock')->insert($data);
        return json_encode(array(
            "statusCode" => 200,
            "statusMsg" => "Product Stock Added Successfully"
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
        DB::table('product_stock')
            ->where('product_stock_id', $id)
            ->delete();
        return json_encode(array(
            "statusCode" => 200
        ));
    }

    public function getAllStockInfo()
    {

        $product_stock = DB::select('SELECT product_stock_id, batch_no, PI.product_name , qnty, production_date, expiry_date,
                                    user_id, PS.create_info, PS.update_info, product_stock_status 
                                    FROM product_stock PS,product_info PI
                                    WHERE PS.product_id = PI.product_id;');
        //return json_encode($product_stock);
        return DataTables::of($product_stock)
            ->addColumn('action', function ($product_stock) {
                $buttton = '
                <div class="button-list">
                    <a onclick="deleteStockData(' . $product_stock->product_stock_id . ')" role="button" href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash-o bigfonts"></i></a>
                </div>
                ';
                return $buttton;
            })
            ->rawColumns(['action'])
            ->toJson();

    }
}

/*
<a onclick="showproduct_stockData(' . $product_stock->product_stock_id . ')" role="button" href="#" class="btn btn-success btn-sm"><i class="fa fa-external-link-square bigfonts"></i></a>
                    <a onclick="editproduct_stockData(' . $product_stock->product_stock_id . ')" role="button" href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit bigfonts"></i></a>
                    */

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;
use Session;


class ProductInfoController extends Controller
{

    public function index()
    {

        try {
            DB::connection()->getPdo();
            return view('configpage.product_info');
        } catch (\Exception $e) {
            return view('errorpage.database_error');
        }
    }


    public function store(Request $request)
    {
        try {
            $data = array();
            $data['product_name'] = $request['product_name'];
            $data['product_type_id'] = $request['product_type_id'];
            $data['Categorie_id'] = $request['Categorie_id'];
            $data['sub_Categorie_id'] = $request['sub_Categorie_id'];
            $data['shot_decs'] = $request['shot_decs'];
            $data['decs'] = $request['decs'];
            $data['Gm'] = $request['Gm'];
            $data['Pcs_Per_Ctn'] = $request['Pcs_Per_Ctn'];
            $data['dp_unit'] = $request['dp_unit'];
            $data['rp_unit'] = $request['rp_unit'];
            $data['mrp_unit'] = $request['mrp_unit'];
            $data['product_sku_code'] = $request['product_sku_code'];
            $data['product_status'] = $request['product_status'];
            $data['create_by'] ="Static";

            $image_one=$request['product_image'];
            if ($image_one){
                $ran_one=str_random(10);
                $ext_one=strtolower($image_one->getClientOriginalExtension());
                $one_full_name=$ran_one.$ext_one;
                $upload_path_one="allImages/ProductImages/";
                $image_url_one=$upload_path_one.$one_full_name;
                $success_one=$image_one->move($upload_path_one,$one_full_name);

                $data['product_image']=$image_url_one;
                $result = DB::table('product_info')->insert($data);
                return json_encode(array(
                    "statusCode"=>200,
                    "statusMsg"=>"New Product Added Successfully"
                ));
            }else{

                return json_encode(array(
                    "statusCode"=>201,
                    "statusMsg"=>"Please Select Product Image !!"
                ));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return ["exception" => true, "o_status_code" => 99, "o_status_message" => $e->getMessage()];
        }

    }


    public function show($id)
    {
        $singleDataShow = DB::table('product_info')
            ->where('product_id', $id)
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
        DB::table('product_info')
            ->where('product_id', $id)
            ->delete();
        return json_encode(array(
            "statusCode" => 200
        ));
    }

    public function getAllProductInfo()
    {

        $categories = DB::table('product_info')
            ->get();

        return DataTables::of($categories)
            ->addColumn('action', function ($categories) {
                $buttton = '
                <div class="button-list">
                    <a onclick="showProductData('.$categories->product_id.')" role="button" href="#" class="btn btn-success btn-sm"><i class="fa fa-external-link-square bigfonts"></i></a>
                    <a onclick="editProductData('.$categories->product_id.')" role="button" href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit bigfonts"></i></a>
                    <a onclick="deleteProductData('.$categories->product_id.')" role="button" href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash-o bigfonts"></i></a>
                </div>
                ';
                return $buttton;
            })
            ->rawColumns(['action'])
            ->toJson();

    }


    public function showSubCat()
    {

        $ViewType= request()->input('ViewType');

        if ($ViewType=="SubCategorie"){
            $Cat_id = request()->input('Cat_id');

            try {
                $categories_sub = DB::table('categories_sub')
                    ->where('categories_id', $Cat_id)
                    ->get();
                return json_encode($categories_sub);
            } catch (\Exception $e) {
                DB::rollBack();
                return ["o_status_message" => $e->getMessage()];
            }

        }

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;
use Session;

class OutletOrderInfoController extends Controller
{
    //

    public function index(){
        return view('outletorder.outlet_order');
    }
    public function getAllOutletOrder(){
        return "ok";
    }

    public function showOrderInfo(){
        $ViewType= request()->input('ViewType');

        if ($ViewType=="OrderInfo"){
            $user_id = request()->input('user_id');

            try {
                $order_num = DB::select("SELECT order_info_id,shop_name, order_date, order_time
                                        FROM order_info_mst OIM, db_point_info  DPI
                                        WHERE OIM.db_point_id = DPI.db_point_id
                                        AND user_info_id = '$user_id'");
                return json_encode($order_num);
            } catch (\Exception $e) {
                DB::rollBack();
                return ["o_status_message" => $e->getMessage()];
            }

        }
    }

    public function showOrderDetails(){
        $ViewType= request()->input('ViewType');

        if ($ViewType=="OrderDetails"){
            $user_id = request()->input('user_id');
            $order_info_id = request()->input('order_info_id');

            try {
                $order_details = DB::select("SELECT order_info_dtl_id, order_info_id, product_id, order_qnty, order_rate,
                                        order_amount, delivery_date, delivery_time, create_info, update_info 
                                        FROM order_info_dtl
                                        WHERE order_info_id = '$order_info_id'");

                return json_encode($order_details);
            } catch (\Exception $e) {
                DB::rollBack();
                return ["o_status_message" => $e->getMessage()];
            }

        }
    }
}

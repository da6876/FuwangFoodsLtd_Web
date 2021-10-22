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
                $order_num = DB::table('order_info')
                    ->where('user_info_id', $user_id)
                    ->get();
                return json_encode($order_num);
            } catch (\Exception $e) {
                DB::rollBack();
                return ["o_status_message" => $e->getMessage()];
            }

        }
    }
}

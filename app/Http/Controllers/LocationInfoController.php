<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;
use Session;


class LocationInfoController extends Controller
{
    public function viewDivisionInfo()
    {
        return view('configpage.location.division_info');
    }

    public function viewDistrictInfo()
    {
        return view('configpage.location.district_info');
    }

    public function viewThanaInfo()
    {
        return view('configpage.location.thana_info');
    }

    public function viewAreaInfo()
    {
        return view('configpage.location.area_info');
    }

    public function viewOutletInfo()
    {
        return view('configpage.location.outlet_info');
    }

    public function store(Request $request)
    {
        try {
            $data = array();
            $data['area_name'] = $request['area_name'];
            $data['thana_id'] = $request['thana_id'];
            $data['area_status'] = $request['status'];

            $result = DB::table('area_info')->insert($data);
            return json_encode(array(
                "statusCode" => 200,
                "statusMsg" => "Area Added Successfully"
            ));
        } catch (\Exception $e) {
            DB::rollBack();
            return json_encode(array(
                "statusCode" => 230,
                "statusMsg" => $e->getMessage()
            ));
        }


    }

    public function destroy($id)
    {
        try {
            DB::table('area_info')
                ->where('area_code', $id)
                ->delete();
            return json_encode(array(
                "statusCode" => 200
            ));
        } catch (\Exception $e) {
            DB::rollBack();
            return json_encode(array(
                "statusCode" => 230,
                "statusMsg" => $e->getMessage()
            ));
        }
    }

    public function showSubOptions()
    {

        $ViewType= request()->input('ViewType');

        if ($ViewType=="GetSubDistrict"){
            $div_id = request()->input('div_id');

            try {
                $categories_sub = DB::table('soc_districts')
                    ->where('division_id', $div_id)
                    ->get();
                return json_encode($categories_sub);
            } catch (\Exception $e) {
                DB::rollBack();
                return ["o_status_message" => $e->getMessage()];
            }

        }elseif ($ViewType=="soc_thana"){
            $dis_id = request()->input('dis_id');

            try {
                $categories_sub = DB::table('upazilas')
                    ->where('district_id', $dis_id)
                    ->get();
                return json_encode($categories_sub);
            } catch (\Exception $e) {
                DB::rollBack();
                return ["o_status_message" => $e->getMessage()];
            }

        }

    }

    public function getDivisionInfo()
    {
        $categories = DB::table('soc_division')
            ->get();

        return DataTables::of($categories)
            ->addColumn('action', function ($categories) {
                $buttton = '
                <div class="button-list">
                    <a onclick="showcategoriesData(' . $categories->id . ')" role="button" href="#" class="btn btn-success btn-sm"><i class="fa fa-external-link-square bigfonts"></i></a>
                    <a onclick="editcategoriesData(' . $categories->id . ')" role="button" href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit bigfonts"></i></a>
                    <a onclick="deletecategoriesData(' . $categories->id . ')" role="button" href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash-o bigfonts"></i></a>
                </div>
                ';
                return $buttton;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function getDistrictInfo()
    {
        $categories = DB::table('soc_districts')
            ->get();

        return DataTables::of($categories)
            ->addColumn('action', function ($categories) {
                $buttton = '
                <div class="button-list">
                    <a onclick="showcategoriesData(' . $categories->id . ')" role="button" href="#" class="btn btn-success btn-sm"><i class="fa fa-external-link-square bigfonts"></i></a>
                    <a onclick="editcategoriesData(' . $categories->id . ')" role="button" href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit bigfonts"></i></a>
                    <a onclick="deletecategoriesData(' . $categories->id . ')" role="button" href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash-o bigfonts"></i></a>
                </div>
                ';
                return $buttton;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function getThanaInfo()
    {
        $categories = DB::table('soc_thana')
            ->get();

        return DataTables::of($categories)
            ->addColumn('action', function ($categories) {
                $buttton = '
                <div class="button-list">
                    <a onclick="showcategoriesData(' . $categories->id . ')" role="button" href="#" class="btn btn-success btn-sm"><i class="fa fa-external-link-square bigfonts"></i></a>
                    <a onclick="editcategoriesData(' . $categories->id . ')" role="button" href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit bigfonts"></i></a>
                    <a onclick="deletecategoriesData(' . $categories->id . ')" role="button" href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash-o bigfonts"></i></a>
                </div>
                ';
                return $buttton;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function getAreaInfo()
    {
        $categories = DB::table('area_info')
            ->get();

        return DataTables::of($categories)
            ->addColumn('action', function ($categories) {
                $buttton = '
                <div class="button-list">
                    <a onclick="deleteAreaData(' . $categories->area_code . ')" role="button" href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash-o bigfonts"></i></a>
                </div>
                ';
                return $buttton;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function getOutletInfo()
    {
        $categories = DB::table('outlet_info')
            ->get();

        return DataTables::of($categories)
            ->addColumn('action', function ($categories) {
                $buttton = '
                <div class="button-list">
                    <a onclick="showcategoriesData(' . $categories->outlet_id . ')" role="button" href="#" class="btn btn-success btn-sm"><i class="fa fa-external-link-square bigfonts"></i></a>
                    <a onclick="editcategoriesData(' . $categories->outlet_id . ')" role="button" href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit bigfonts"></i></a>
                    <a onclick="deletecategoriesData(' . $categories->outlet_id . ')" role="button" href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash-o bigfonts"></i></a>
                </div>
                ';
                return $buttton;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

}

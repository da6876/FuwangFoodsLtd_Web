<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;
use Session;


class LocationInfoController extends Controller
{
    public function viewDivisionInfo(){
        return view('configpage.location.division_info');
    }

    public function viewDistrictInfo(){
        return view('configpage.location.district_info');
    }

    public function viewThanaInfo(){
        return view('configpage.location.thana_info');
    }

    public function viewAreaInfo(){
        return view('configpage.location.area_info');
    }

    public function viewOutletInfo(){
        return view('configpage.location.outlet_info');
    }


    public function getDivisionInfo(){
        $categories = DB::table('divisions')
            ->get();

        return DataTables::of($categories)
            ->addColumn('action', function ($categories) {
                $buttton = '
                <div class="button-list">
                    <a onclick="showcategoriesData('.$categories->id.')" role="button" href="#" class="btn btn-success btn-sm"><i class="fa fa-external-link-square bigfonts"></i></a>
                    <a onclick="editcategoriesData('.$categories->id.')" role="button" href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit bigfonts"></i></a>
                    <a onclick="deletecategoriesData('.$categories->id.')" role="button" href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash-o bigfonts"></i></a>
                </div>
                ';
                return $buttton;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function getDistrictInfo(){
        $categories = DB::table('districts')
            ->get();

        return DataTables::of($categories)
            ->addColumn('action', function ($categories) {
                $buttton = '
                <div class="button-list">
                    <a onclick="showcategoriesData('.$categories->id.')" role="button" href="#" class="btn btn-success btn-sm"><i class="fa fa-external-link-square bigfonts"></i></a>
                    <a onclick="editcategoriesData('.$categories->id.')" role="button" href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit bigfonts"></i></a>
                    <a onclick="deletecategoriesData('.$categories->id.')" role="button" href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash-o bigfonts"></i></a>
                </div>
                ';
                return $buttton;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function getThanaInfo(){
        $categories = DB::table('upazilas')
            ->get();

        return DataTables::of($categories)
            ->addColumn('action', function ($categories) {
                $buttton = '
                <div class="button-list">
                    <a onclick="showcategoriesData('.$categories->id.')" role="button" href="#" class="btn btn-success btn-sm"><i class="fa fa-external-link-square bigfonts"></i></a>
                    <a onclick="editcategoriesData('.$categories->id.')" role="button" href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit bigfonts"></i></a>
                    <a onclick="deletecategoriesData('.$categories->id.')" role="button" href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash-o bigfonts"></i></a>
                </div>
                ';
                return $buttton;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function getAreaInfo(){
        $categories = DB::table('area_info')
            ->get();

        return DataTables::of($categories)
            ->addColumn('action', function ($categories) {
                $buttton = '
                <div class="button-list">
                    <a onclick="showcategoriesData('.$categories->area_code.')" role="button" href="#" class="btn btn-success btn-sm"><i class="fa fa-external-link-square bigfonts"></i></a>
                    <a onclick="editcategoriesData('.$categories->area_code.')" role="button" href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit bigfonts"></i></a>
                    <a onclick="deletecategoriesData('.$categories->area_code.')" role="button" href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash-o bigfonts"></i></a>
                </div>
                ';
                return $buttton;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function getOutletInfo(){
        $categories = DB::table('outlet_info')
            ->get();

        return DataTables::of($categories)
            ->addColumn('action', function ($categories) {
                $buttton = '
                <div class="button-list">
                    <a onclick="showcategoriesData('.$categories->outlet_id.')" role="button" href="#" class="btn btn-success btn-sm"><i class="fa fa-external-link-square bigfonts"></i></a>
                    <a onclick="editcategoriesData('.$categories->outlet_id.')" role="button" href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit bigfonts"></i></a>
                    <a onclick="deletecategoriesData('.$categories->outlet_id.')" role="button" href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash-o bigfonts"></i></a>
                </div>
                ';
                return $buttton;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

}

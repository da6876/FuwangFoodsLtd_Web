<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;
use Session;

class UserInfoController extends Controller
{

    public function index()
    {
        try {
            DB::connection()->getPdo();

            return view('configpage.user_info');
        } catch (\Exception $e) {

            return view('errorpage.database_error');
        }
    }


    public function create()
    {
        //
    }


    public function store(Request $request){
        $data = array();
        $data['user_name'] = $request['user_name'];
        $data['user_phone'] = $request['user_phone'];
        $data['user_email'] = $request['user_email'];
        $data['user_type_id'] = $request['user_type_id'];
        $data['user_address'] = $request['user_address'];
        $data['user_status'] = $request['user_status'];
        $data['update_info'] = "AAA";

        try {
            $user_password =$this->encrypData('UserPasswordEncrypt',$request['user_password']);
        } catch (\Exception $e) {
            DB::rollBack();
            return json_encode(array(
                "statusCode" => 201,
                "statusMsg" => "Password Encryp Failed !!"
            ));
        }
        if ($user_password!=""){
            $data['user_password']= $user_password;

        }else{
            return json_encode(array(
                "statusCode" => 201,
                "statusMsg" => "Password Encryp Failed !!"
            ));
        }

        $image_one = $request['user_photo'];
        if ($image_one) {
            $ran_one = str_random(5);
            $ext_one = strtolower($image_one->getClientOriginalExtension());
            $one_full_name = $ran_one . 'User_.' . $request['user_phone'] . $ext_one;
            $upload_path_one = "allImages/UserPicture/";
            $image_url_one = $upload_path_one . $one_full_name;
            $success_one = $image_one->move($upload_path_one, $one_full_name);

            $data['user_photo'] = $image_url_one;
            $result = DB::table('user_info')->insert($data);
            return json_encode(array(
                "statusCode" => 200,
                "statusMsg" => "New User Added Successfully"
            ));
        } else {
            return json_encode(array(
                "statusCode" => 201,
                "statusMsg" => "Please Select A Image !!"
            ));
        }

    }


    public function show($id)
    {
        $singleDataShow = DB::table('user_info')
            ->where('user_info_id', $id)
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
        DB::table('user_info')
            ->where('user_info_id', $id)
            ->delete();
        return json_encode(array(
            "statusCode" => 200
        ));
    }

    public function getAllUserInfo()
    {

        $UserType = DB::select("SELECT user_info_id,user_name,user_phone,user_email,user_photo,user_password,
                                UI.user_type_id, UT.user_type_name,user_address,UI.create_info,UI.update_info,
                                user_status FROM user_info UI, user_type UT
                                WHERE UI.user_type_id = UT.user_type_id;");

        return DataTables::of($UserType)
            ->addColumn('action', function ($UserType) {
                $buttton = '
                <div class="button-list">
                    <a onclick="showUserInfoData(' . $UserType->user_info_id . ')" role="button" href="#" class="btn btn-success btn-sm"><i class="fa fa-external-link-square bigfonts"></i></a>
                    <a onclick="editUserInfoData(' . $UserType->user_info_id . ')" role="button" href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit bigfonts"></i></a>
                    <a onclick="deleteUserInfoData(' . $UserType->user_info_id . ')" role="button" href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash-o bigfonts"></i></a>
                </div>
                ';
                return $buttton;
            })
            ->rawColumns(['action'])
            ->toJson();

    }

    public function userLogin(Request $request)
    {
        try {
            $userName = $request['user_id'];

            try {
                $userPassword =$this->encrypData('UserPasswordEncrypt',$request['user_password']);
            } catch (\Exception $e) {
                DB::rollBack();
                return json_encode(array(
                    "statusCode" => 201,
                    "statusMsg" => "Password Encryp Failed !!"
                ));
            }

            $userPassword = $userPassword;

            $UserType = DB::select("SELECT user_info_id,user_name,user_phone,user_email,user_photo,user_password,
                                UI.user_type_id, UT.user_type_name,user_address,UI.create_info,UI.update_info,
                                user_status FROM user_info UI, user_type UT
                                WHERE UI.user_type_id = UT.user_type_id
                                AND UI.user_phone = '$userName'
                                AND UI.user_password = '$userPassword'");

            if ($UserType){
                Session::put('user_info_id',$UserType[0]->user_info_id);
                Session::put('user_name',$UserType[0]->user_name);
                Session::put('user_phone',$UserType[0]->user_phone);
                Session::put('user_email',$UserType[0]->user_email);
                Session::put('user_photo',$UserType[0]->user_photo);
                Session::put('user_password',$UserType[0]->user_password);
                Session::put('user_type_id',$UserType[0]->user_type_id);
                Session::put('user_type_name',$UserType[0]->user_type_name);
                Session::put('user_address',$UserType[0]->user_address);
                Session::put('user_status',$UserType[0]->user_status);

                return json_encode(array(
                    "statusCode" => 200
                ));

            }else{
                return json_encode(array(
                    "statusCode" => 201,
                    "RealPass" => $request['user_password'],
                    "EncPass" => $userPassword,
                    "sss" => json_encode($UserType)
                ));
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return json_encode(array(
                "statusCode" => 201,
                "statusMsg" =>$e->getMessage()
            ));
        }
    }

    public function userPasswordCheck(){
        $ViewType= request()->input('ViewType');

        $data = request()->input('data');

        $ciphering = "AES-128-CTR";

        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        $encryption_iv = '6876199612231998';
        $encryption_key = "EncryptDhaliAbir";

        if ($ViewType=="Encrypt"){
            try {
                $encryption = openssl_encrypt($data, $ciphering,
                    $encryption_key, $options, $encryption_iv);
                return $encryption;
            } catch (\Exception $e) {
                DB::rollBack();
                ["o_status_message" => $e->getMessage()];
                return json_encode(array(
                    "statusCode" => $e->getMessage()
                ));
            }
        }

        elseif($ViewType=="DeEncrypt"){
            try {
                $decryption=openssl_decrypt ($data, $ciphering,
                    $encryption_key, $options, $encryption_iv);
                return $decryption;
            } catch (\Exception $e) {
                DB::rollBack();
                ["o_status_message" => $e->getMessage()];
                return json_encode(array(
                    "statusCode" => $e->getMessage()
                ));
            }
        }

    }


    public function encrypData($ViewType,$data){

        $ciphering = "AES-128-CTR";

        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        $encryption_iv = '6876199612231998';
        $encryption_key = "EncryptDhaliAbir";

        if ($ViewType=="UserPasswordEncrypt"){
            try {
                $encryption = openssl_encrypt($data, $ciphering,
                    $encryption_key, $options, $encryption_iv);
                return $encryption;
            } catch (\Exception $e) {
                DB::rollBack();
                ["o_status_message" => $e->getMessage()];
                return json_encode(array(
                    "statusCode" => $e->getMessage()
                ));
            }
        }

        elseif($ViewType=="UserPasswordDeEncrypt"){
            try {
                $decryption=openssl_decrypt ($data, $ciphering,
                    $encryption_key, $options, $encryption_iv);
                return $decryption;
            } catch (\Exception $e) {
                DB::rollBack();
                ["o_status_message" => $e->getMessage()];
                return json_encode(array(
                    "statusCode" => $e->getMessage()
                ));
            }
        }

    }
}

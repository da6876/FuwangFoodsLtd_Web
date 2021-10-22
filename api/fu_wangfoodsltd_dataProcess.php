<?php
error_reporting(0);

include("connection.php");

if ($conn->connect_error) {

    $post_data = array(
        'status_code' => '500',
        'msg' => 'Connection failed',
        'values' => "Connection failed: " . $conn->connect_error,
    );
}else{

    $Type = $_POST['Type'];

    if($Type=="User LogIn"){

        $user_phone = $_POST['user_phone'];
        $user_password = encrypData($_POST['user_password']);

        $checkSQL1="SELECT count(user_info_id) as User FROM user_info where
				user_phone='$user_phone' and user_password = '$user_password'
				and user_type_id = '11110013'";

        $result1 = $conn->query($checkSQL1);

        if ($result1->num_rows > 0) {
            while($row = $result1->fetch_assoc()) {
                $UserPhoneExt = $row["User"];
            }
        }

        if($UserPhoneExt==1){

            $sql = "SELECT * FROM user_info 
			where user_phone = '$user_phone' and
			user_password = '$user_password'";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    $value[]=$row;
                }

                $post_data = array(
                    'status_code' => '200',
                    'msg' => 'Success',
                    'values' => $value
                );
            } else {
                $post_data = array(
                    'status_code' => '400',
                    'msg' => 'Failed',
                    'values' => "User Login Failed !!"
                );
            }
        }else {
            $post_data = array(
                'status_code' => '400',
                'msg' => 'Failed',
                'values' => "User Login Failed !!"
            );
        }
    }

    elseif($Type=="Get Products"){
        $checkSQL1="SELECT * FROM product_info";
        $result1 = $conn->query($checkSQL1);

        if ($result1->num_rows > 0) {
            while($row = $result1->fetch_assoc()) {
                $post_data []=$row ;
            }
        }
    }

    elseif($Type=="Get Division"){
        $checkSQL1="SELECT * FROM divisions";
        $result1 = $conn->query($checkSQL1);

        if ($result1->num_rows > 0) {
            while($row = $result1->fetch_assoc()) {
                $post_data []=$row ;
            }
        }
    }

    elseif($Type=="Get District"){

        $div_id = $_POST['div_id'];

        $checkSQL1="SELECT * FROM districts where division_id = '$div_id'";

        $result1 = $conn->query($checkSQL1);

        if ($result1->num_rows > 0) {
            while($row = $result1->fetch_assoc()) {
                $post_data []=$row ;
            }
        }
    }

    elseif($Type=="Get Thana"){

        $dis_id = $_POST['dis_id'];

        $checkSQL1="SELECT * FROM upazilas where district_id = '$dis_id'";
        $result1 = $conn->query($checkSQL1);

        if ($result1->num_rows > 0) {
            while($row = $result1->fetch_assoc()) {
                $post_data []=$row ;
            }
        }
    }

    elseif($Type=="Get Zip"){

        $dis_id = $_POST['dis_id'];

        $checkSQL1="SELECT * FROM zip_info where div_id = '$dis_id'";
        $result1 = $conn->query($checkSQL1);

        if ($result1->num_rows > 0) {
            while($row = $result1->fetch_assoc()) {
                $post_data []=$row ;
            }
        }
    }

    elseif($Type=="Save DB Point"){

        $user_id = $_POST['user_id'];
        $shop_name = $_POST['shop_name'];
        $shop_own_name = $_POST['shop_own_name'];
        $mobile_no = $_POST['mobile_no'];
        $email = $_POST['email'];
        $trade_lic_no = $_POST['trade_lic_no'];
        $web_address = $_POST['web_address'];
        $address = $_POST['address'];
        $area_code = $_POST['area_code'];
        $db_point_status = $_POST['db_point_status'];
        $create_info = $_POST['create_info'];
        $update_info = "";

        $Image1=$_POST['shop_image'];
        $binary=base64_decode( $Image1);

        header('Content-Type: bitmap; charset=utf-8');
        $fileName='E:\xampp\htdocs\fu_wangfoodsltd\db_point_image/'.$mobile_no.'_DB_Point'.'.jpg';
        $file = fopen($fileName, 'wb');

        fwrite($file, $binary);
        fclose($file);

        $sql="INSERT INTO db_point_info (user_id,shop_name,shop_own_name,
		mobile_no,shop_image,email,trade_lic_no,web_address,address,
		area_code,db_point_status,create_info,update_info)
		value('$user_id','$shop_name','$shop_own_name','$mobile_no','$fileName',
		'$email','$trade_lic_no','$web_address','$address','$area_code',
		'$db_point_status','$create_info','$update_info')";


        if (mysqli_query($conn, $sql)) {
            $post_data = array(
                'status_code' => '200',
                'msg' => 'Success',
                'values' => 'New DB Point Addded Successfully'
            );
        }

        else {
            $post_data = array(
                'status_code' => '400',
                'msg' => 'Failed',
                'values' => "New DB Point Addded Failed"
            );
        }

        mysqli_close($conn);
    }

    elseif($Type=="Get Area"){

        $user_info_id = $_POST['user_info_id'];

        $checkSQL1="SELECT UA.area_code,AI.area_name
					FROM user_assigned UA,area_info AI
					WHERE UA.user_info_id = '$user_info_id'
					AND UA.area_code =AI.area_code";

        $result1 = $conn->query($checkSQL1);

        if ($result1->num_rows > 0) {
            while($row = $result1->fetch_assoc()) {
                $post_data []=$row ;
            }
        }
    }

    elseif($Type=="Get Outlet"){

        $area_code = $_POST['area_code'];

        $checkSQL1="SELECT * FROM db_point_info where area_code = '$area_code'";
        $result1 = $conn->query($checkSQL1);

        if ($result1->num_rows > 0) {
            while($row = $result1->fetch_assoc()) {
                $post_data []=$row ;
            }
        }
    }

    elseif($Type=="Save New Order"){
        $order_trck = generateRandomString();
        $db_point_id = $_POST['db_point_id'];
        $user_info_id = $_POST['user_info_id'];
        $product_id = $_POST['product_id'];
        $order_qnty = $_POST['order_qnty'];
        $order_rate = $_POST['order_rate'];
        $order_amount = $_POST['order_amount'];
        $order_date = $_POST['order_date'];
        $order_time = $_POST['order_time'];
        $delivery_date = $_POST['delivery_date'];
        $delivery_time = $_POST['delivery_time'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];


        $Image1=$_POST['db_point_image'];
        $binary=base64_decode( $Image1);

        header('Content-Type: bitmap; charset=utf-8');
        $fileName='C:\xampp\htdocs\FuwangFoodsLtd\public\allImages\db_point_order_image/'.$db_point_id.'_DB_Point'.'.jpg';
        $file = fopen($fileName, 'wb');

        fwrite($file, $binary);
        fclose($file);

        $sql1="INSERT INTO order_info_mst (db_point_id,order_trck,db_point_image,
		                    user_info_id, order_date,order_time,latitude,longitude)
		value('$db_point_id','$order_trck','$fileName','$user_info_id',
		                    '$order_date','$order_time','$latitude','$longitude')";




        if (mysqli_query($conn, $sql1)) {

            $checkSQL11="SELECT order_trck,order_info_id FROM order_info_mst where
				order_trck='$order_trck'";
            $result11 = $conn->query($checkSQL11);

            if ($result11->num_rows > 0) {
                while($row = $result11->fetch_assoc()) {
                    $order_trck = $row["order_trck"];
                    $order_info_id = $row["order_info_id"];
                }
            }

            $post_data = array(
                'status_code' => '200',
                'msg' => 'Success',
                'order_info_id' => $order_info_id,
                'order_trck' => $order_trck,
                'values' => 'New Order Placed Successfully'
            );
        }

        else {
            $post_data = array(
                'status_code' => '400',
                'msg' => 'Failed',
                'values' => "New Order Placed Failed"
            );
        }

        mysqli_close($conn);
    }

}





/* $sql="INSERT INTO order_info (db_point_id,order_trck,db_point_image,
		user_info_id,product_id,order_qnty,order_rate,order_amount, order_date,
		order_time,delivery_date,delivery_time,latitude,longitude)
		value('$db_point_id','$order_trck','$fileName','$user_info_id','$product_id',
		'$order_qnty','$order_rate','$order_amount','$order_date','$order_time',
		'$delivery_date','$delivery_time','$latitude','$longitude')";*/

print json_encode($post_data);



//===========================Other Functions===============================================

function getDates(){
    $Date="";
    date_default_timezone_set("Asia/Dhaka");
    return $Date=date("Y/m/d");
}

function getTime(){
    $Date="";
    date_default_timezone_set("Asia/Dhaka");
    return $Time=date("H:i:s");
    //$Date=$Date.','.$Time;
}

function getDateTime(){
    $Date="";
    date_default_timezone_set("Asia/Dhaka");
    $Date=date("Y/m/d");
    $Time=date("H:i:s");
    return $Date=$Date.','.$Time;
}


function encrypData($data){

    $ciphering = "AES-128-CTR";

    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    $encryption_iv = '6876199612231998';
    $encryption_key = "EncryptDhaliAbir";

    try {
        $encryption = openssl_encrypt($data, $ciphering,
            $encryption_key, $options, $encryption_iv);
        return $encryption;
    } catch (\Exception $e) {
        DB::rollBack();
        ["o_status_message" => $e->getMessage()];
        return "";
    }


}

function generateRandomString($length = 20) {
    date_default_timezone_set("Asia/Dhaka");
    $Date=date("Ymd");
    $Time=date("His");
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString.'_'.$Date.''.$Time;
}
//===========================End Other Functions===============================================

?>
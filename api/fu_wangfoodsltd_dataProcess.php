<?php
error_reporting(0);

include("connection.php");

if ($conn->connect_error) {

    $post_data = array(
        'status_code' => '500',
        'msg' => 'Connection failed',
        'values' => "Connection failed: " . $conn->connect_error,
    );
} else {

    $Type = $_POST['Type'];

    if ($Type == "User LogIn") {

        $user_phone = $_POST['user_phone'];
        $user_password = encrypData($_POST['user_password']);

        $checkSQL1 = "SELECT count(user_info_id) as User FROM user_info where
				user_phone='$user_phone' and user_password = '$user_password'
				and user_type_id = '11110013'";

        $result1 = $conn->query($checkSQL1);

        if ($result1->num_rows > 0) {
            while ($row = $result1->fetch_assoc()) {
                $UserPhoneExt = $row["User"];
            }
        }

        if ($UserPhoneExt == 1) {

            $sql = "SELECT * FROM user_info 
			where user_phone = '$user_phone' and
			user_password = '$user_password'";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $value[] = $row;
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
        } else {
            $post_data = array(
                'status_code' => '400',
                'msg' => 'Failed',
                'values' => "User Login Failed !!"
            );
        }
    }

    elseif ($Type == "Get Products") {
        $checkSQL1 = "SELECT * FROM product_info";
        $result1 = $conn->query($checkSQL1);

        if ($result1->num_rows > 0) {
            while ($row = $result1->fetch_assoc()) {
                $post_data [] = $row;
            }
        }
    }

    elseif ($Type == "Get Division") {
        $checkSQL1 = "SELECT * FROM divisions";
        $result1 = $conn->query($checkSQL1);

        if ($result1->num_rows > 0) {
            while ($row = $result1->fetch_assoc()) {
                $post_data [] = $row;
            }
        }
    }

    elseif ($Type == "Get District") {

        $div_id = $_POST['div_id'];

        $checkSQL1 = "SELECT * FROM districts where division_id = '$div_id'";

        $result1 = $conn->query($checkSQL1);

        if ($result1->num_rows > 0) {
            while ($row = $result1->fetch_assoc()) {
                $post_data [] = $row;
            }
        }
    }

    elseif ($Type == "Get Thana") {

        $dis_id = $_POST['dis_id'];

        $checkSQL1 = "SELECT * FROM upazilas where district_id = '$dis_id'";
        $result1 = $conn->query($checkSQL1);

        if ($result1->num_rows > 0) {
            while ($row = $result1->fetch_assoc()) {
                $post_data [] = $row;
            }
        }
    }

    elseif ($Type == "Get Zip") {

        $dis_id = $_POST['dis_id'];

        $checkSQL1 = "SELECT * FROM zip_info where div_id = '$dis_id'";
        $result1 = $conn->query($checkSQL1);

        if ($result1->num_rows > 0) {
            while ($row = $result1->fetch_assoc()) {
                $post_data [] = $row;
            }
        }
    }

    elseif ($Type == "Save DB Point") {

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

        $Image1 = $_POST['shop_image'];
        $binary = base64_decode($Image1);

        header('Content-Type: bitmap; charset=utf-8');
        $fileName = 'E:\xampp\htdocs\fu_wangfoodsltd\db_point_image/' . $mobile_no . '_DB_Point' . '.jpg';
        $file = fopen($fileName, 'wb');

        fwrite($file, $binary);
        fclose($file);

        $sql = "INSERT INTO db_point_info (user_id,shop_name,shop_own_name,
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
        } else {
            $post_data = array(
                'status_code' => '400',
                'msg' => 'Failed',
                'values' => "New DB Point Addded Failed"
            );
        }

        mysqli_close($conn);
    }

    elseif ($Type == "Get Area") {

        $user_info_id = $_POST['user_info_id'];

        $checkSQL1 = "SELECT UA.area_code,AI.area_name
					FROM user_assigned UA,area_info AI
					WHERE UA.user_info_id = '$user_info_id'
					AND UA.area_code =AI.area_code";

        $result1 = $conn->query($checkSQL1);

        if ($result1->num_rows > 0) {
            while ($row = $result1->fetch_assoc()) {
                $post_data [] = $row;
            }
        }
    }

    elseif ($Type == "Get Outlet") {

        $area_code = $_POST['area_code'];

        $checkSQL1 = "SELECT * FROM db_point_info where area_code = '$area_code'";
        $result1 = $conn->query($checkSQL1);

        if ($result1->num_rows > 0) {
            while ($row = $result1->fetch_assoc()) {
                $post_data [] = $row;
            }
        }
    }

    elseif ($Type == "Save New Order") {

        $order_trck = generateRandomString();
        $db_point_id = $_POST['db_point_id'];
        $user_info_id = $_POST['user_info_id'];
        $order_date = getDates();
        $order_time = getTime();
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $OrderDetails = $_POST['OrderDetails'];


        $image_one = $_POST['db_point_image'];

        if ($image_one) {
            $binary = base64_decode($image_one);
            $Date = date("Ymd");
            $Time = date("His");
            header('Content-Type: bitmap; charset=utf-8');
            $fileName = 'public/allImages/db_point_order_image/' . $db_point_id . '_DB_Point_img_'.$Date.'_'.$Time. '.jpg';
            $fileWritePath = '../'.$fileName;
            $file = fopen($fileWritePath, 'wb');

            fwrite($file, $binary);
            if (fwrite($file, $binary)){
               // echo "Success";

            }else{
              //  echo "Failed";
            }
            fclose($file);
        }


        $sql1 = "INSERT INTO order_info_mst (db_point_id,order_trck,db_point_image,
		                    user_info_id, order_date,order_time,latitude,longitude)
		value('$db_point_id','$order_trck','$fileName','$user_info_id',
		                    '$order_date','$order_time','$latitude','$longitude')";

        $arr = json_decode($OrderDetails,true);

        if (mysqli_query($conn, $sql1)) {

            $checkSQL11 = "SELECT order_trck,order_info_id FROM order_info_mst where
				order_trck='$order_trck'";
            $result11 = $conn->query($checkSQL11);

            if ($result11->num_rows > 0) {
                while ($row = $result11->fetch_assoc()) {
                    $order_trck = $row["order_trck"];
                    $order_info_id = $row["order_info_id"];
                }
            }
            $successOrder=0;
            $failedOrder=0;
            for ($x = 0; $x < count($arr); $x++) {
                $product_ids = $arr[$x]['product_id'];
                $order_qntys = $arr[$x]['order_qnty'];
                $order_rates = $arr[$x]['order_rate'];
                $order_amounts = $arr[$x]['order_amount'];
                $delivery_dates = $arr[$x]['delivery_date'];
                $delivery_times = $arr[$x]['delivery_time'];

                $sql11 = "INSERT INTO order_info_dtl (order_info_id,product_id,order_qnty,
		                    order_rate, order_amount,delivery_date,delivery_time)
                value(
                '$order_info_id',
                '$product_ids',
                '$order_qntys',
                '$order_rates',
                '$order_amounts',
                '$delivery_dates',
                '$delivery_times'
                )";

                if (mysqli_query($conn, $sql11)) {
                    $successOrder+1;
                    $successOrder++;
                } else {
                    $failedOrder+1;
                    $failedOrder++;
                }
            }
            $total=$successOrder+$failedOrder;

            if (count($arr)==$total){
                $post_data = array(
                    'status_code' => '200',
                    'msg' => 'Success',
                    'values' => $successOrder." New Order Placed Success && ".$failedOrder." Order Placed Failed"
                );
            }else{
                $post_data = array(
                    'status_code' => '200',
                    'msg' => 'Success',
                    'values' => $successOrder." New Order Placed Success && ".$failedOrder." Order Placed Failed !!"
                );
            }

        } else {
            $post_data = array(
                'status_code' => '400',
                'msg' => 'Failed',
                'values' => "New Order Placed Failed"
            );
        }

        mysqli_close($conn);
    }

    elseif($Type == "Get Order History"){
        $user_info_id = $_POST['user_info_id'];
        $order_date_from = $_POST['order_date_from'];
        $order_date_to = $_POST['order_date_to'];

        $checkSql = "SELECT OIM.order_info_id, OIM.order_trck, OIM.db_point_id, OIM.db_point_image, OIM.user_info_id,
                            OIM.order_date, OIM.order_time, OIM.latitude, OIM.longitude, OIM.create_info, OIM.update_info,
                            DPI.shop_name, DPI.shop_own_name, DPI.mobile_no
                            FROM order_info_mst OIM,db_point_info DPI
                            WHERE OIM.db_point_id = DPI.db_point_id
                            AND OIM.user_info_id = '$user_info_id'
                            AND OIM.order_date BETWEEN '$order_date_from' AND '$order_date_to';";

        $result1 = $conn->query($checkSql);

        if ($result1->num_rows > 0) {
            while ($row = $result1->fetch_assoc()) {
                $post_data [] = $row;
            }
        }

    }

}


print json_encode($post_data);


//===========================Other Functions===============================================

function getDates()
{
    $Date = "";
    date_default_timezone_set("Asia/Dhaka");
    return $Date = date("d/m/Y");
}

function getTime()
{
    $Date = "";
    date_default_timezone_set("Asia/Dhaka");
    return $Time = date("H:i:s");
    //$Date=$Date.','.$Time;
}

function getDateTime()
{
    $Date = "";
    date_default_timezone_set("Asia/Dhaka");
    $Date = date("d/m/Y");
    $Time = date("H:i:s");
    return $Date = $Date . ',' . $Time;
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

function generateRandomString($length = 20)
{
    date_default_timezone_set("Asia/Dhaka");
    $Date = date("Ymd");
    $Time = date("His");
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString . '_' . $Date . '' . $Time;
}

//===========================End Other Functions===============================================

?>

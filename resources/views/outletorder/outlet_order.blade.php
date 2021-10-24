<!DOCTYPE html>
<html lang="en">
<head>
@include('layouts.header_files')

    <link href="assets/plugins/datetimepicker/css/daterangepicker.css" rel="stylesheet" />

    <!-- BEGIN CSS for this page -->
    <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <!-- END CSS for this page -->
    <!-- BEGIN CSS for this page -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
    <style>
        td.details-control {
            background: url('{{asset('assets/plugins/datatables/img/details_open.png')}}') no-repeat center center;
            cursor: pointer;
        }

        tr.shown td.details-control {
            background: url('{{asset('assets/plugins/datatables/img/details_close.png')}}') no-repeat center center;
        }
    </style>
    <!-- END CSS for this page -->

</head>

<body class="adminbody">

<div id="main">

    <!-- top bar navigation -->
@include('layouts.header_bar')
<!-- End Navigation -->


    <!-- Left Sidebar -->
@include('layouts.left_main_sidebar')
<!-- End Sidebar -->


    <div class="content-page">

        <!-- Start content -->
        <div class="content">

            <div class="container-fluid">


                <div class="row">
                    <div class="col-xl-12">
                        <div class="breadcrumb-holder">
                            <h1 class="main-title float-left">Pending Outlet Order</h1>
                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item active">Outlet Order</li>
                            </ol>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->


                <div class="row">

                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-12 col-xl-12">
                        <div class="card mb-3">

                        <div class="card-header">
                            <h3><i class="fa fa-table"></i> Pending Outlet Order</h3>
                        </div>
                        <div class="card-body">
                            <form id="stockAdd" action="#" method="post"
                                  enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="modal-body">

                                    @php
                                        $all_Product = DB::table('user_info')
                                            ->where('user_type_id', '11110013')
                                            ->get();
                                    @endphp

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Sales Officer</label>

                                                <select id="user_info_id" name="user_info_id" class="form-control selectUser" required>
                                                    <option value="S">Select Sales Officer</option>
                                                    @foreach($all_Product as $all_Product)
                                                        <option
                                                            value="{{$all_Product->user_info_id}}">{{$all_Product->user_name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Order List</label>

                                                <select id="order_info_id" name="order_info_id" class="form-control selectProducts" required>
                                                    <option value="S">Select Order</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>


                                </div>
                                <div class="modal-footer  d-flex justify-content-center">
                                    <button type="button" onclick="addProductStock()" class="btn btn-primary btn-sm col-md-6">
                                        Search Order
                                    </button>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-12 col-xl-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                <span class="pull-right">
                                    {{--<button class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target=".ProductStockAdd">
                                    <i class="fa fa-plus-square bigfonts"></i> Add New Stock</button>--}}
                                </span>
                                <h3><i class="fa fa-table"></i> Pending Outlet Order Info</h3>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="ProductStock" width="100%"
                                           cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Stock Id</th>
                                            <th>Batch No</th>
                                            <th>Product Name</th>
                                            <th>Qnty</th>
                                            <th>Qnty</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="bodyData">

                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div><!-- end card-->
                    </div>


                </div>


            </div>
            <!-- END container-fluid -->

        </div>
        <!-- END content -->

    </div>
    <!-- END content-page -->


    <!-- Footer bar-page -->
@include('layouts.footer_bar')
<!-- END Footer bar-page -->

</div>
<!-- END main -->

<!-- END Java Script for this page -->
@include('layouts.footer_files')

<script src="assets/plugins/datetimepicker/js/daterangepicker.js"></script>
<script src="assets/plugins/select2/js/select2.min.js"></script>

<script>

    $(document).ready(function() {
        $('.selectUser').select2();
    });
    $(document).ready(function() {
        $('.selectProducts').select2();
    });
</script>


<script>


    $("#user_info_id").change(function () {
        var user_info_id = $('#user_info_id :selected').val();
        if (user_info_id != "")
            setOrderNumbers(user_info_id);
    });

    function setOrderNumbers(user_info_id){
        var csrf_tokens = document.querySelector('meta[name="csrf-token"]').content;
        url = "{{ url('ShowOrderNumberByUser') }}";
        $.ajax({
            url: url,
            type: 'POST',
            data: {'ViewType': 'OrderInfo', 'user_id': user_info_id, "_token": csrf_tokens},
            datatype: 'JSON',
            success: function (data) {
                var sub_cat = $.parseJSON(data);
                if (sub_cat != '') {
                    var markup = "<option value=''>Select Order Nuber</option>";
                    for (var x = 0; x < sub_cat.length; x++) {
                        markup += "<option value=" + sub_cat[x].order_info_id + ">"+sub_cat[x].shop_name+"- Date : "+ sub_cat[x].order_date+ " (" + sub_cat[x].order_info_id +")"+ "</option>";
                    }
                    $("#order_info_id").html(markup).show();
                } else {
                    var markup = "<option value=''>Select Order Nuber</option>";
                    $("#order_info_id").html(markup).show();
                }


            },
            error: function (data) {
                console.log(data);
                swal({
                    title: "Oops",
                    text: "Some Thing Is .... !!",
                    icon: "error",
                    timer: '1500'
                });
            }
        });
    }

    function  addProductStock() {
        var user_info_id = $('#user_info_id :selected').val();
        var order_info_id = $('#order_info_id :selected').val();
        $('#ProductStock tbody').empty();
        searchOrderDetails(user_info_id,order_info_id);
    }

    function searchOrderDetails(user_info_id,order_info_id){
        var csrf_tokens = document.querySelector('meta[name="csrf-token"]').content;
        url = "{{ url('ShowOrderDetails') }}";
        $.ajax({
            url: url,
            type: 'POST',
            data: {'ViewType': 'OrderDetails', 'user_id': user_info_id,'order_info_id': order_info_id, "_token": csrf_tokens},
            datatype: 'JSON',
            success: function (data) {
                console.log(data);
                var resultData = $.parseJSON(data);

                var bodyData = '';

                for (var x = 0; x < resultData.length; x++) {
                    bodyData += "<tr>"
                    bodyData += "<td>" + resultData[x].product_id + "</td>" +
                        "<td>" + resultData[x].product_id + "</td>" +
                        "<td>" + resultData[x].order_qnty + "</td>" +
                        "<td>" + resultData[x].order_rate + "</td>" +
                        "<td>" + resultData[x].order_amount + "</td>" +
                        "<td>" +
                        "<button class='btn btn-info btn-sm delete ' style='margin-left:20px;' onclick='deleteOrder(" + resultData[x].product_id + ")'>Edit</button>" +
                        "<button class='btn btn-danger btn-sm delete ' style='margin-left:20px;' onclick='deleteOrder(" + resultData[x].product_id + ")'>Delete</button>" +
                        "</td>";
                    bodyData += "</tr>";

                }
                $("#bodyData").append(bodyData);

            },
            error: function (data) {
                console.log(data);
                swal({
                    title: "Oops",
                    text: "Some Thing Is .... !!",
                    icon: "error",
                    timer: '1500'
                });
            }
        });
    }

    function deleteOrder(product_id){
        alert(product_id);
    }

/*    $(document).on("click", ".delete", function() {
        alert("aaaa");
    });*/

</script>

<!-- END Java Script for this page -->

</body>
</html>

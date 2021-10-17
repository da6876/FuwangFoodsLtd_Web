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
                            <h1 class="main-title float-left">Product Stock</h1>
                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item active">Product Stock</li>
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
                            <h3><i class="fa fa-table"></i>  Add New Stock</h3>
                        </div>
                        <div class="card-body">
                            <form id="stockAdd" action="#" method="post"
                                  enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="modal-body">

                                    @php
                                        $all_Product = DB::table('product_info')
                                            ->where('product_status', 'Active')
                                            ->get();
                                    @endphp

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Product</label>

                                                <select name="product_id" class="form-control selectProducts" required>
                                                    <option value="S">Select Product Type</option>
                                                    @foreach($all_Product as $all_Product)
                                                        <option
                                                            value="{{$all_Product->product_id}}">{{$all_Product->product_name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Qnty</label>
                                                <input class="form-control" name="qnty" type="number">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Batch No</label>
                                                <input class="form-control" id="batch_nos" name="batch_no" type="text" readonly>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Other Info</label>
                                                <input class="form-control" name="other_info" type="text">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Production Date</label>
                                                <input type="text" name="production_date" class="form-control" data-toggle="datepicker">

                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Expiry Date</label>
                                                <input class="form-control" name="expiry_date"  data-toggle="datepickers" type="text">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="product_stock_status" id="product_statuss"
                                                        class="form-control">
                                                    <option value="S">Select Status</option>
                                                    <option value="Active">Active</option>
                                                    <option value="InActive">InActive</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="modal-footer  d-flex justify-content-center">
                                    <button type="button" onclick="addProductStock()" class="btn btn-primary col-md-6">
                                        Add To Sock
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
                                <h3><i class="fa fa-table"></i> Product Stock Info</h3>
                            </div>

                            <div class="modal fade bd-example-modal-lg ProductStockAdd" tabindex="-1" role="dialog"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">Add Stock</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="" action="#" method="post"
                                                  enctype="multipart/form-data">
                                                {{csrf_field()}}
                                                <div class="modal-body">

                                                    @php
                                                        $all_Product = DB::table('product_info')
                                                            ->where('product_status', 'Active')
                                                            ->get();
                                                    @endphp

                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Product</label>

                                                                <select name="product_id" class="form-control">
                                                                    <option value="S">Select Product Type</option>
                                                                    @foreach($all_Product as $all_Product)
                                                                        <option
                                                                            value="{{$all_Product->product_id}}">{{$all_Product->product_name}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Qnty</label>
                                                                <input class="form-control" name="qnty" type="number">
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Batch No</label>
                                                                <input class="form-control" name="batch_no" type="text">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Other Info</label>
                                                                <input class="form-control" name="other_info" type="text">
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Production Date</label>
                                                                <input type="text" class="form-control" data-toggle="datepicker">

                                                                <input type="text" data-toggle="datepicker" class="form-control datepickers" name="singledatepicker" />

                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Expiry Date</label>
                                                                <input class="form-control" name="expiry_date" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Status</label>
                                                                <select name="product_stock_status" id="product_statuss"
                                                                        class="form-control">
                                                                    <option value="S">Select Status</option>
                                                                    <option value="Active">Active</option>
                                                                    <option value="InActive">InActive</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" onclick="addProductStock()" class="btn btn-primary">
                                                        Save
                                                    </button>
                                                    <button type="button" class="btn btn-secondary"  data-dismiss="modal">
                                                        Close
                                                    </button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="modal fade bd-example-modal-lg showCategoriesData" tabindex="-1" role="dialog"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-titles">Categories</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="addNewCategories" action="#" method="post"
                                                  enctype="multipart/form-data">
                                                {{csrf_field()}}
                                                <div class="modal-body">

                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Product Name</label>
                                                                <input class="form-control" name="product_name"
                                                                       id="product_name"
                                                                       type="text" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Product Short Desc.</label>
                                                                <input class="form-control" name="shot_decs"
                                                                       id="shot_decs"
                                                                       type="text">
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label>Product Desc.</label>
                                                                <div>
                                                                    <textarea name="decs" id="decs" required=""
                                                                              class="form-control"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @php
                                                        $all_Product_type = DB::table('product_type')
                                                            ->where('product_type_status', 'A')
                                                            ->get();
                                                        $all_categories = DB::table('categories')
                                                            ->where('categories_status', 'A')
                                                            ->get();
                                                        $all_Subcategories = DB::table('categories_sub')
                                                            ->where('sub_categories_status', 'A')
                                                            ->get();
                                                    @endphp

                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Product Type</label>

                                                                <select name="product_type_id" id="product_type_id"
                                                                        class="form-control">
                                                                    <option value="S">Select Product Type</option>
                                                                    @foreach($all_Product_type as $all_Product_type)
                                                                        <option
                                                                            value="{{$all_Product_type->product_type_id}}">{{$all_Product_type->product_type_name}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Categories</label>
                                                                <select name="Categorie_id" id="Categorie_id"
                                                                        class="form-control">
                                                                    <option value="S">Select Categories</option>
                                                                    @foreach($all_categories as $all_categories)
                                                                        <option
                                                                            value="{{$all_categories->categories_id}}">{{$all_categories->categories_name}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Sub Categories</label>
                                                                <select name="sub_Categorie_id" id="sub_Categorie_id"
                                                                        class="form-control">
                                                                    <option value="S">Select Sub Categories</option>
                                                                    @foreach($all_Subcategories as $all_Subcategories)
                                                                        <option
                                                                            value="{{$all_Subcategories->sub_categories_id}}">{{$all_Subcategories->sub_categories_name}}
                                                                        </option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Dealer price (unit) Tk.</label>
                                                                <input class="form-control" name="dp_unit" id="dp_unit"
                                                                       type="number">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Retail price (unit) Tk.</label>
                                                                <input class="form-control" name="rp_unit" id="rp_unit"
                                                                       type="number">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>MRP (unit) Tk.</label>
                                                                <input class="form-control" name="mrp_unit"
                                                                       id="mrp_unit"
                                                                       type="number">
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Gm.</label>
                                                                <input class="form-control" name="Gm" id="Gm"
                                                                       type="text">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Pcs Per Ctn</label>
                                                                <input class="form-control" name="Pcs_Per_Ctn"
                                                                       id="Pcs_Per_Ctn"
                                                                       type="text">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Product SKU.</label>
                                                                <input class="form-control" name="product_sku_code"
                                                                       id="product_sku_code"
                                                                       type="text">
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Photo</label>
                                                                <input class="form-control" name="product_image"
                                                                       id="product_image"
                                                                       type="file" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Status</label>
                                                                <select name="product_status" id="product_statuss"
                                                                        class="form-control">
                                                                    <option value="S">Select Status</option>
                                                                    <option value="Active">Active</option>
                                                                    <option value="InActive">InActive</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success" id="btnUpdate">
                                                        Save Change
                                                    </button>
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>



                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="ProductStock-dataTabel" width="100%"
                                           cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Stock Id</th>
                                            <th>Batch No</th>
                                            <th>Product Name</th>
                                            <th>Qnty</th>
                                            <th>Production Date</th>
                                            <th>Expiry Date</th>
                                            <th>User ID</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
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
        $('.select2').select2();
    });
    $(document).ready(function() {
        $('.selectProducts').select2();
    });
</script>

<script>
    function makeid() {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        for (var i = 0; i < 15; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));
        return text;
    }

    document.getElementById('batch_nos').value=makeid();
    $(function() {
        $('[data-toggle="datepicker"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'DD/MM/YYYY'
            }
    });
    });
    $(function() {
        $('[data-toggle="datepickers"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'DD/MM/YYYY'
            }
    });
    });

</script>
<script>
    //Show Data useign Yajratable
    var table1 = $('#ProductStock-dataTabel').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('all.ProductStock') !!}',
        columns: [
            {data: 'product_stock_id', name: 'product_stock_id'},
            {data: 'batch_no', name: 'batch_no'},
            {data: 'product_name', name: 'product_name'},
            {data: 'qnty', name: 'qnty'},
            {data: 'production_date', name: 'production_date'},
            {data: 'expiry_date', name: 'expiry_date'},
            {data: 'user_id', name: 'user_id'},
            {data: 'product_stock_status', name: 'product_stock_status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });


    //insert User Type Data By Ajax
    function addProductStock() {
        url = "{{ url('ProductStock') }}";
        $.ajax({
            url: url,
            type: "POST",
            data: new FormData($("#stockAdd")[0]),
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                var dataResult = JSON.parse(data);
                if (dataResult.statusCode == 200) {
                    //$('.ProductStockAdd').modal('hide');
                    $('#ProductStock-dataTabel').DataTable().ajax.reload();
                    swal("Success", dataResult.statusMsg);
                    $('#stockAdd')[0].reset();

                    document.getElementById('batch_nos').value=makeid();
                    document.getElementById('batch_nos').read = true;
                } else if (dataResult.statusCode == 201) {
                    swal({
                        title: "Oops",
                        text: dataResult.statusMsg,
                        icon: "error",
                        timer: '1500'
                    });
                }
            }, error: function (data) {
                swal({
                    title: "Oops",
                    text: "Error occured",
                    icon: "error",
                    timer: '1500'
                });
            }
        });
        return false;


    };

    //Show User Type Data By Ajax
    function showProductData(id) {

        $.ajax({
            url: "{{ url('ProductInfo') }}" + '/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('.showCategoriesData').modal('show');
                $('.modal-titles').text(data[0].product_name + ' Information');
                $('#product_name').val(data[0].product_name);
                $('#product_type_id option[value="' + data[0].product_type_id + '"]').prop('selected', true);
                $('#Categorie_id option[value="' + data[0].Categorie_id + '"]').prop('selected', true);
                $('#sub_Categorie_id option[value="' + data[0].sub_Categorie_id + '"]').prop('selected', true);
                $('#shot_decs').val(data[0].shot_decs);
                $('#decs').val(data[0].decs);
                $('#Gm').val(data[0].Gm);
                $('#Pcs_Per_Ctn').val(data[0].Pcs_Per_Ctn);
                $('#dp_unit').val(data[0].dp_unit);
                $('#rp_unit').val(data[0].rp_unit);
                $('#mrp_unit').val(data[0].mrp_unit);
                $('#product_sku_code').val(data[0].product_sku_code);
                $('#product_statuss option[value="' + data[0].product_status + '"]').prop('selected', true);
                $('#btnUpdate').hide();

                document.getElementById('product_name').disabled = true;
                document.getElementById('shot_decs').disabled = true;
                document.getElementById('decs').disabled = true;
                document.getElementById('Gm').disabled = true;
                document.getElementById('Pcs_Per_Ctn').disabled = true;
                document.getElementById('dp_unit').disabled = true;
                document.getElementById('rp_unit').disabled = true;
                document.getElementById('mrp_unit').disabled = true;
                document.getElementById('product_sku_code').disabled = true;


                $('#product_type_id').attr('disabled', 'disabled');
                $('#Categorie_id').attr('disabled', 'disabled');
                $('#sub_Categorie_id').attr('disabled', 'disabled');
                $('#product_statuss').attr('disabled', 'disabled');

            }, error: function () {
                swal({
                    title: "Oops",
                    text: "aa",
                    icon: "error",
                    timer: '1500'
                });
            }
        });
    }

    //Edit User Type Data By Ajax
    function editProductData(id) {

        $.ajax({
            url: "{{ url('ProductInfo') }}" + '/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('.showCategoriesData').modal('show');
                $('.modal-titles').text(data[0].product_name + ' Information');
                $('#product_name').val(data[0].product_name);
                $('#product_type_id option[value="' + data[0].product_type_id + '"]').prop('selected', true);
                $('#Categorie_id option[value="' + data[0].Categorie_id + '"]').prop('selected', true);
                $('#sub_Categorie_id option[value="' + data[0].sub_Categorie_id + '"]').prop('selected', true);
                $('#shot_decs').val(data[0].shot_decs);
                $('#decs').val(data[0].decs);
                $('#Gm').val(data[0].Gm);
                $('#Pcs_Per_Ctn').val(data[0].Pcs_Per_Ctn);
                $('#dp_unit').val(data[0].dp_unit);
                $('#rp_unit').val(data[0].rp_unit);
                $('#mrp_unit').val(data[0].mrp_unit);
                $('#product_sku_code').val(data[0].product_sku_code);
                $('#product_statuss option[value="' + data[0].product_status + '"]').prop('selected', true);

                document.getElementById('product_name').disabled = false;
                document.getElementById('shot_decs').disabled = false;
                document.getElementById('decs').disabled = false;
                document.getElementById('Gm').disabled = false;
                document.getElementById('Pcs_Per_Ctn').disabled = false;
                document.getElementById('dp_unit').disabled = false;
                document.getElementById('rp_unit').disabled = false;
                document.getElementById('mrp_unit').disabled = false;
                document.getElementById('product_sku_code').disabled = false;


                $('#product_type_id').attr('disabled', false);
                $('#Categorie_id').attr('disabled', false);
                $('#sub_Categorie_id').attr('disabled', false);
                $('#product_statuss').attr('disabled', false);

            }, error: function () {
                swal({
                    title: "Oops",
                    text: "aa",
                    icon: "error",
                    timer: '1500'
                });
            }
        });
    }

    //Delete User Type Data By Ajax
    function deleteStockData(id) {
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "{{ url('ProductStock') }}" + '/' + id,
                    type: "POST",
                    data: {'_method': 'DELETE', '_token': csrf_token},
                    success: function (data) {
                        console.log(data);
                        var dataResult = JSON.parse(data);
                        if (dataResult.statusCode == 200) {
                            $('#ProductStock-dataTabel').DataTable().ajax.reload();
                            swal({
                                title: "Delete Done",
                                text: "Poof! Your data file has been deleted!",
                                icon: "success",
                                button: "Done"
                            });
                        } else {
                            swal("Your imaginary file is safe!");
                        }
                    }, error: function (data) {
                        swal({
                            title: "Opps...",
                            text: "Error occured !",
                            icon: "error",
                            button: 'Ok ',
                        });
                    }
                });
            } else {
                swal("Your imaginary file is safe!");
            }
        });
    }


</script>
<!-- END Java Script for this page -->

</body>
</html>

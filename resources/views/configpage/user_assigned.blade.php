<!DOCTYPE html>
<html lang="en">
<head>
@include('layouts.header_files')

<!-- BEGIN CSS for this page -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>


    <!-- BEGIN CSS for this page -->
    <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <!-- END CSS for this page -->
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
                            <h1 class="main-title float-left">User Assigned</h1>
                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item active">User Assigned</li>
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
                                <h3><i class="fa fa-table"></i>Add User Assigned</h3>
                            </div>

                            <div class="card-body" id="addUserAssigendFrom">
                                <form id="addNewSubCategories" action="#" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="modal-body">
                                        @php
                                            $all_user_info = DB::table('user_info')
                                                ->get();
                                            $all_zip_info = DB::table('area_info')
                                                ->get();
                                            $all_db_point_info = DB::table('db_point_info')
                                                ->get();
                                        @endphp
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>User Info</label>
                                                    <select class="form-control"  name="user_info_id">
                                                        <option value="S">Select User</option>
                                                        @foreach($all_user_info as $all_user_info)
                                                            <option value="{{$all_user_info->user_info_id}}">{{$all_user_info->user_name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Area Info</label>
                                                    <select class="form-control zip_id-select-multiple" id="Area_Info" name="zip_id[]" multiple="multiple">
                                                        @foreach($all_zip_info as $all_zip_info)
                                                            <option value="{{$all_zip_info->area_code}}">{{$all_zip_info->area_name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            {{--<div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Outlet Info</label>
                                                    <select class="form-control db_point_id-select-multiple" name="db_point_id[]" multiple="multiple">
                                                        <option value="S">Select Outlet</option>
                                                        @foreach($all_db_point_info as $all_db_point_info)
                                                            <option value="{{$all_db_point_info->db_point_id}}">{{$all_db_point_info->shop_name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>--}}
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select name="status" class="form-control">
                                                        <option value="S">Select Status</option>
                                                        <option value="A">YES</option>
                                                        <option value="I">NO</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" onclick="addUserAssigned()" class="btn btn-primary">Save</button>
                                        <button type="button" class="btn btn-secondary" onclick="showAleert()"data-dismiss="modal">Close</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-12 col-xl-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3><i class="fa fa-table"></i>Sub Categories Info</h3>
                            </div>




                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="UserAssigend-dataTabel" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>User Name</th>
                                            <th>Area Name</th>
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
<script src="assets/plugins/select2/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.zip_id-select-multiple').select2({
            //maximumSelectionLength: 2,
            placeholder: 'Select Area',
            allowClear: false
        });
    });

    function  showAleert() {


        swal({
            title: "Oops",
            text: "Error occured",
            icon: "error",
            timer: '1500'
        });
    }


    //Show Data useign Yajratable
  var table1 = $('#UserAssigend-dataTabel').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('all.UserAssigned') !!}',
        columns: [
            {data: 'user_name', name: 'user_name'},
            {data: 'area_name', name: 'area_name'},
            {data: 'user_assigned_status', name: 'user_assigned_status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    //insert User Type Data By Ajax
    function addUserAssigned() {
        url = "{{ url('UserAssigned') }}";
        $.ajax({
            url: url,
            type: "POST",
            data: new FormData($("#addUserAssigendFrom form")[0]),
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                var dataResult = JSON.parse(data);
                if (dataResult.statusCode == 200) {
                    swal("Success", "User Assidend Success");
                    $('#UserAssigend-dataTabel').DataTable().ajax.reload();
                    $('#addUserAssigendFrom').trigger("reset");
                    $("#Area_Info").select2('val', 'All');
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
    function showcategories_subData(id) {

        $.ajax({
            url: "{{ url('SubCategoryInfo') }}" + '/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('.showSubCategoriesData').modal('show');
                $('.modal-titles').text(data[0].sub_categories_name + ' Information');
                $('#sub_categories_name').val(data[0].sub_categories_name);
                $('#categories_id option[value="' + data[0].categories_id + '"]').prop('selected', true);
                $('#Statuss option[value="' + data[0].sub_categories_status + '"]').prop('selected', true);
                document.getElementById('sub_categories_name').disabled = true;
                $('#Statuss').attr('disabled', 'disabled');
                $('#categories_id').attr('disabled', 'disabled');
                $('#btnUpdate').hide();

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
    function editcategories_subData(id) {

        $.ajax({
            url: "{{ url('UserAssigned') }}" + '/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('.showSubCategoriesData').modal('show');
                $('.modal-titles').text(data[0].sub_categories_name + ' Information');
                $('#sub_categories_name').val(data[0].sub_categories_name);
                $('#categories_id option[value="' + data[0].categories_id + '"]').prop('selected', true);
                $('#Statuss option[value="' + data[0].sub_categories_status + '"]').prop('selected', true);
                document.getElementById('sub_categories_name').disabled = false;
                $('#Statuss').prop('disabled', false);
                $('#categories_id').prop('disabled', false);

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
    function  deletecategories_subData(id) {
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
                    url: "{{ url('UserAssigned') }}" + '/' + id,
                    type: "POST",
                    data: {'_method': 'DELETE', '_token': csrf_token},
                    success: function (data) {
                        console.log(data);
                        var dataResult = JSON.parse(data);
                        if (dataResult.statusCode == 200) {
                            $('#UserAssigend-dataTabel').DataTable().ajax.reload();
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
            }

            else {
                swal("Your imaginary file is safe!");
            }
        });
    }





</script>
<!-- END Java Script for this page -->

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
@include('layouts.header_files')

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
                            <h1 class="main-title float-left">User Info</h1>
                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item active">User Info</li>
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
                                <span class="pull-right">
                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target=".userInfoDataAdd">
                                    <i class="fa fa-plus-square bigfonts"></i> Add New User</button>
                                </span>
                                <h3><i class="fa fa-table"></i> User Info</h3>
                            </div>

                            <div class="modal fade bd-example-modal-lg userInfoDataAdd" tabindex="-1" role="dialog"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">Add New User</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="addNewUserType" action="#" method="post"
                                                  enctype="multipart/form-data" data-parsley-validate novalidate>
                                                {{csrf_field()}}
                                                <div class="modal-body">

                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>User Name</label>
                                                                <input class="form-control" name="user_name"
                                                                       id="user_name" type="text" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Phone</label>
                                                                <input class="form-control" name="user_phone"
                                                                       type="text" required>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input class="form-control" name="user_email"
                                                                       type="text" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Photo</label>
                                                                <input class="form-control" name="user_photo"
                                                                       type="file" required>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Password</label>
                                                                <input class="form-control" name="user_password"
                                                                       type="password" required>
                                                            </div>
                                                        </div>
                                                        @php
                                                            $all_category = DB::table('user_type')
                                                                ->where('user_type_status', 'A')
                                                                ->get();
                                                        @endphp

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>User Type</label>
                                                                <select name="user_type_id" class="form-control">
                                                                    <option value="S">Select User Type</option>
                                                                    @foreach($all_category as $tv_category)
                                                                        <option
                                                                            value="{{{$tv_category->user_type_id}}}">{{$tv_category->user_type_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Address</label>
                                                                <input class="form-control" name="user_address"
                                                                       type="text">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Status</label>
                                                                <select name="Status" class="form-control">
                                                                    <option value="S">Select Status</option>
                                                                    <option value="Active">Active</option>
                                                                    <option value="InActive">InActive</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>

                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" onclick="addUserInfoData()" class="btn btn-primary">
                                                Save changes
                                            </button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade bd-example-modal-lg showUserInfoData" tabindex="-1" role="dialog"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-titles">Large title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="addNewUserType" action="#" method="post"
                                                  enctype="multipart/form-data" data-parsley-validate novalidate>
                                                {{csrf_field()}}
                                                <div class="modal-body">

                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>User Name</label>
                                                                <input class="form-control" name="user_name"
                                                                       id="user_names" type="text" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Phone</label>
                                                                <input class="form-control" name="user_phone"
                                                                       id="user_phone" type="text" required>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input class="form-control" name="user_email"
                                                                       id="user_email" type="text" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Photo</label>
                                                                <input class="form-control" name="user_photo"
                                                                       id="user_photo" type="text" required>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Password</label>
                                                                <input class="form-control" name="user_password"
                                                                       id="user_password" type="password" required>
                                                            </div>
                                                        </div>
                                                        @php
                                                            try {
                                                                $all_category = DB::table('user_type')
                                                                    ->where('user_type_status', 'A')
                                                                    ->get();
                                                         } catch (Exception $e) {
                                                                    DB::rollBack();
                                                                    return ["exception" => true, "o_status_code" => 99, "o_status_message" => $e->getMessage()];
                                                        }
                                                        @endphp

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>User Type</label>
                                                                <select name="user_type_id" id="user_type_id"
                                                                        class="form-control">
                                                                    <option value="S">Select User Type</option>
                                                                    @foreach($all_category as $tv_category)
                                                                        <option
                                                                            value="{{{$tv_category->user_type_id}}}">{{$tv_category->user_type_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Address</label>
                                                                <input class="form-control" name="user_address"
                                                                       id="user_address" type="text">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Status</label>
                                                                <select name="Status" id="Statuss" class="form-control">
                                                                    <option value="S">Select Status</option>
                                                                    <option value="Active">Active</option>
                                                                    <option value="InActive">InActive</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>

                                            </form>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" onclick="addUserInfoData()" class="btn btn-primary"
                                                    id="userUpdate">Update
                                            </button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="userInfo-dataTabel" width="100%"
                                           cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>User Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Photo</th>
                                            <th>User Type</th>
                                            <th>Address</th>
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

<script>
    //Show Data useign Yajratable
    var table1 = $('#userInfo-dataTabel').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('all.UserInfo') !!}',
        columns: [
            {data: 'user_info_id', name: 'user_info_id'},
            {data: 'user_name', name: 'user_name'},
            {data: 'user_phone', name: 'user_phone'},
            {data: 'user_email', name: 'user_email'},
            {data: 'user_photo', name: 'user_photo',
                render: function( data, type, full, meta ) {
                if (data != "No Image"){
                    return "<img src=\"/" + data + "\" height=\"80\"/>";
                }else{
                    return "No Image";
                }
                }
            },
            {data: 'user_type_name', name: 'user_type_name'},
            {data: 'user_address', name: 'user_address'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        createdRow: function ( row, data, index ) {

            if ( data['user_status'] == 'A' ) {
                $('td', row).css('background-color', '#e0f7ff');
            } else {
                $('td', row).css('background-color', '#fcddc5');
            }

        }
    });

    //Show User Type Data By Ajax
    function showUserInfoData(id) {

        $.ajax({
            url: "{{ url('UserInfo') }}" + '/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('.showUserInfoData').modal('show');
                $('.modal-titles').text(data[0].user_name + ' Info');
                $('#user_names').val(data[0].user_name).attr('readonly', 'true');
                $('#user_phone').val(data[0].user_phone).attr('readonly', 'true');
                $('#user_email').val(data[0].user_email).attr('readonly', 'true');
                $('#user_photo').val(data[0].user_photo).attr('readonly', 'true');
                $('#user_password').val(data[0].user_password).attr('readonly', 'true');
                $('#user_address').val(data[0].user_address).attr('readonly', 'true');
                $('#user_type_id').attr('disabled', 'disabled');
                $('#userUpdate').hide();
                $('#Statuss').attr('disabled', 'disabled');
                $('#user_type_id option[value="' + data[0].user_type_id + '"]').prop('selected', true);
                $('#Statuss option[value="' + data[0].user_status + '"]').prop('selected', true);

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
    function editUserInfoData(id) {

        $.ajax({
            url: "{{ url('UserInfo') }}" + '/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('.showUserInfoData').modal('show');
                $('.modal-titles').text(data[0].user_name + ' Info');
                $('#user_names').val(data[0].user_name);
                $('#user_phone').val(data[0].user_phone);
                $('#user_email').val(data[0].user_email);
                $('#user_photo').val(data[0].user_photo);
                $('#user_password').val(data[0].user_password);
                $('#user_address').val(data[0].user_address);
                $('#user_type_id option[value="' + data[0].user_type_id + '"]').prop('selected', true);
                $('#Statuss option[value="' + data[0].user_status + '"]').prop('selected', true);


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

    //insert User Type Data By Ajax
    function addUserInfoData() {
        url = "{{ url('UserInfo') }}";
        $.ajax({
            url: url,
            type: "POST",
            data: new FormData($(".userInfoDataAdd form")[0]),
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                var dataResult = JSON.parse(data);
                if (dataResult.statusCode == 200) {
                    $('.userInfoDataAdd').modal('hide');
                    $('#userInfo-dataTabel').DataTable().ajax.reload();
                    swal("Success", dataResult.statusMsg);
                    $('.userInfoDataAdd form')[0].reset();
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

    //Delete User Type Data By Ajax
    function deleteUserInfoData(id) {
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ url('UserInfo') }}" + '/' + id,
                        type: "POST",
                        data: {'_method': 'DELETE', '_token': csrf_token},
                        success: function (data) {
                            console.log(data);
                            var dataResult = JSON.parse(data);
                            if (dataResult.statusCode == 200) {
                                $('#userInfo-dataTabel').DataTable().ajax.reload();
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

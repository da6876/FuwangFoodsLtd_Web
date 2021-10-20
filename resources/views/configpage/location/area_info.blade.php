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
                            <h1 class="main-title float-left">Area Info</h1>
                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item active">Area Info</li>
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
                                            data-target=".areaInfoAdd">
                                    <i class="fa fa-plus-square bigfonts"></i> Add New Area Info</button>
                                </span>
                                <h3><i class="fa fa-table"></i> Area Info</h3>
                            </div>

                            <div class="modal fade bd-example-modal-lg areaInfoAdd" tabindex="-1" role="dialog"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">Large title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="addNewUserType" action="#" method="post"
                                                  enctype="multipart/form-data">
                                                {{csrf_field()}}
                                                <div class="modal-body">
                                                    @php
                                                        $all_divisions = DB::table('soc_division')
                                                            ->get();
                                                    @endphp
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Area Name</label>
                                                                <input class="form-control" name="area_name"
                                                                       type="text">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Division</label>
                                                                <select name="divisions_id" id="divisions_id" class="form-control">
                                                                    <option value="">Select Division</option>
                                                                    @foreach($all_divisions as $all_divisions)
                                                                        <option
                                                                            value="{{$all_divisions->id}}">{{$all_divisions->name}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Districts</label>
                                                                <select id="districts_id" class="form-control">
                                                                    <option value="">Select Districts</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Thana</label>
                                                                <select name="thana_id" id="thana_id" class="form-control">
                                                                    <option value="">Select Thana</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Status</label>
                                                                <select name="status" id="statuss"
                                                                        class="form-control">
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
                                            <button type="button" onclick="addAreaInfo()" class="btn btn-primary">
                                                Save changes
                                            </button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="areainfo-dataTabel" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Dis Id</th>
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

<script>
    //Show Data useign Yajratable
    var table1 = $('#areainfo-dataTabel').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('all.viewAreaInfo') !!}',
        columns: [
            {data: 'area_code', name: 'area_code'},
            {data: 'area_name', name: 'area_name'},
            {data: 'thana_id', name: 'thana_id'},
            {data: 'area_status', name: 'area_status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    //insert User Type Data By Ajax
    function addAreaInfo() {
        url = "{{ url('LocationInfo') }}";
        $.ajax({
            url: url,
            type: "POST",
            data: new FormData($(".areaInfoAdd form")[0]),
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                var dataResult = JSON.parse(data);
                if (dataResult.statusCode == 200) {
                    $('.areaInfoAdd').modal('hide');
                    $('#areainfo-dataTabel').DataTable().ajax.reload();
                    swal("Success", dataResult.statusMsg);
                    $('.areaInfoAdd')[0].reset();
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
    function deleteAreaData(id) {
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
                        url: "{{ url('LocationInfo') }}" + '/' + id,
                        type: "POST",
                        data: {'_method': 'DELETE', '_token': csrf_token},
                        success: function (data) {
                            console.log(data);
                            var dataResult = JSON.parse(data);
                            if (dataResult.statusCode == 200) {
                                $('#areainfo-dataTabel').DataTable().ajax.reload();
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

    $("#divisions_id").change(function () {
        var divisions_id = $('#divisions_id :selected').val();
        if (divisions_id != "")
            SetDistrict(divisions_id);
    });

    function SetDistrict(divisions_id){
        var csrf_tokens = document.querySelector('meta[name="csrf-token"]').content;
        url = "{{ url('ShowDistrict') }}";
        $.ajax({
            url: url,
            type: 'POST',
            data: {'ViewType': 'GetSubDistrict', 'div_id': divisions_id, "_token": csrf_tokens},
            datatype: 'JSON',
            success: function (data) {
                console.log(data);
                var sub_cat = $.parseJSON(data);
                if (sub_cat != '') {
                    var markup = "<option value=''>Select Districts</option>";
                    for (var x = 0; x < sub_cat.length; x++) {
                        markup += "<option value=" + sub_cat[x].id + ">" + sub_cat[x].name + "</option>";
                    }
                    $("#districts_id").html(markup).show();
                } else {
                    var markup = "<option value=''>Select Districts</option>";
                    $("#districts_id").html(markup).show();
                }


            },
            error: function (data) {
                swal({
                    title: "Oops",
                    text: "Some Thing Is .... !!",
                    icon: "error",
                    timer: '1500'
                });
            }
        });
    }



    $("#districts_id").change(function () {
        var districts_id = $('#districts_id :selected').val();
        if (districts_id != "")
            SetThana(districts_id);
    });

    function SetThana(districts_id){
        var csrf_tokens = document.querySelector('meta[name="csrf-token"]').content;
        url = "{{ url('ShowDistrict') }}";
        $.ajax({
            url: url,
            type: 'POST',
            data: {'ViewType': 'GetSubThana', 'dis_id': districts_id, "_token": csrf_tokens},
            datatype: 'JSON',
            success: function (data) {
                console.log(data);
                var sub_cat = $.parseJSON(data);
                if (sub_cat != '') {
                    var markup = "<option value=''>Select Thana</option>";
                    for (var x = 0; x < sub_cat.length; x++) {
                        markup += "<option value=" + sub_cat[x].id + ">" + sub_cat[x].name + "</option>";
                    }
                    $("#thana_id").html(markup).show();
                } else {
                    var markup = "<option value=''>Select Thana</option>";
                    $("#thana_id").html(markup).show();
                }


            },
            error: function (data) {
                swal({
                    title: "Oops",
                    text: "Some Thing Is .... !!",
                    icon: "error",
                    timer: '1500'
                });
            }
        });
    }


</script>


</body>
</html>

<!DOCTYPE html>
<html lang="en">

@include('layouts.header_files')
@section('title', 'Home')

<body class="adminbody">

<div id="main">

    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
                        <h1 class="main-title float-left">Check Password</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Check Password</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->


            <div class="row d-flex justify-content-center">


                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-4 align-items-center center">
                    <div class="card mb-6">

                        <div class="card-header">
                            <h3><i class="fa fa-hand-pointer-o"></i>Check Password</h3>
                        </div>

                        <div class="card-body UserLogin">

                            <form action="#" data-parsley-validate novalidate enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <div class="row">
                                        <input type="text" name="encript_password" id="given_password"
                                               data-parsley-trigger="change" required
                                               placeholder="Enter The Plan Password"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <input type="text" name="encript_password" id="show_password"
                                               class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <button class="btn btn-outline-success col-md-6" type="button"
                                                onclick="checkEncrypt()">
                                            Encrypt Password
                                        </button>
                                        <button class="btn btn-outline-danger  col-md-6" type="button"
                                                onclick="checkDeEncrypt()">
                                            DeEncrypt Password
                                        </button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div><!-- end card-->
                </div>

            </div>


        </div>
        <!-- END container-fluid -->

    </div>
    <!-- END content -->

</div>
<!-- END main -->


<!-- END Java Script for this page -->
@include('layouts.footer_files')

<script>
    function checkEncrypt() {
        var given_passwordEncrypt = $("#given_password").val();

        if (given_password != '') {
            encryptData('Encrypt',given_passwordEncrypt);
        } else {
            swal({
                text: "Enter Your Password !!",
                icon: "error",
                timer: '3000'
            });
        }

    }
    function checkDeEncrypt() {
        var given_passwordEncrypt = $("#given_password").val();

        if (given_password != '') {
            encryptData('DeEncrypt',given_passwordEncrypt);
        } else {
            swal({
                text: "Enter Your Password !!",
                icon: "error",
                timer: '3000'
            });
        }

    }

    function encryptData(viewType,given_password) {
        var csrf_tokens = document.querySelector('meta[name="csrf-token"]').content;
        url = "{{ url('UserPasswordCheck') }}";
        $.ajax({
            url: url,
            type: 'POST',
            data: {'ViewType': viewType, 'data': given_password, "_token": csrf_tokens},
            datatype: 'JSON',
            success: function (data) {
                console.log(data);
                $("#show_password").val(data);
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
    };
</script>
</body>
</html>

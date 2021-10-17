<?php

$route = Route::current()->getName();

?>
<div class="left main-sidebar">

    <div class="sidebar-inner leftscroll">

        <div id="sidebar-menu">

            <ul>

                <li class="submenu">
                    <a class="" href="{{url('/')}}"><i class="fa fa-fw fa-bars"></i><span> Dashboard </span> </a>
                </li>

                <li class="submenu">
                    <a href="#" class=""><i class="fa fa-map-o bigfonts"></i> <span>Location Config  </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled" >
                        <li class=""><a href="{{url('DivisionInfo')}}"><i class="fa fa-map-marker bigfonts"></i> Division Info</a></li>
                        <li class=""><a href="{{url('DistrictInfo')}}"><i class="fa fa-map-marker bigfonts"></i> District Info</a></li>
                        <li class=""><a href="{{url('ThanaInfo')}}"><i class="fa fa-map-marker bigfonts"></i> Thana Info</a></li>
                        <li class=""><a href="{{url('AreaInfo')}}"><i class="fa fa-map-marker bigfonts"></i> Area Info</a></li>
                        <li class=""><a href="{{url('OutletInfo')}}"><i class="fa fa-map-marker bigfonts"></i> Outlet Info</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#" class=""><i class="fa fa-gift bigfonts"></i> <span>Product Setup</span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled" >
                        <li class=""><a href="{{url('ProductType')}}"><i class="fa fa-asl-interpreting bigfonts"></i> Product Type</a></li>
                        <li class=""><a href="{{url('CategoriesInfo')}}"><i class="fa fa-certificate bigfonts"></i> Category</a></li>
                        <li class=""><a href="{{url('SubCategoryInfo')}}"><i class="fa fa-clone bigfonts"></i> Sub-Category</a></li>
                        <li class=""><a href="{{url('ProductInfo')}}"><i class="fa fa-cube bigfonts"></i> Product Info</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#" class=""><i class="fa fa-users bigfonts"></i> <span>User Config  </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled" >
                        <li class=""><a href="{{url('UserTypeInfo')}}"><i class="fa fa-vcard bigfonts"></i> User Type</a></li>
                        <li class=""><a href="{{url('UserInfo')}}"><i class="fa fa-user-o bigfonts"></i> User Info</a></li>
                        <li class=""><a href="{{url('UserInfo')}}"><i class="fa fa-user-secret bigfonts"></i>Distributor Info</a></li>
                        <li class=""><a href="{{url('UserAssigned')}}"><i class="fa fa-address-card-o bigfonts bigfonts"></i>User Assigned</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#" class=""><i class="fa fa-hourglass-half bigfonts"></i> <span>Stock Manage </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled" >
                        <li class=""><a href="{{url('ProductStock')}}"><i class="fa fa-hourglass-start bigfonts"></i> Product Stock</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#" class=""><i class="fa fa-tags bigfonts"></i> <span>Order Manage </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled" >
                        <li class=""><a href="#"><i class="fa fa-tag bigfonts"></i> Outlet Order</a></li>
                        <li class=""><a href="#"><i class="fa fa-tags bigfonts"></i> Distributor Order</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#" class=""><i class="fa fa-users bigfonts"></i> <span>Delivery Manage </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled" >
                        <li class=""><a href="#"><i class="fa fa-hourglass-start bigfonts"></i> Delivery to SO</a></li>
                        <li class=""><a href="#"><i class="fa fa-hourglass-start bigfonts"></i> Distributor Order</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="{{url('PasswordCheck')}}" class=""><i class="fa fa-users bigfonts"></i> <span>Delivery Manage </span> <span class="menu-arrow"></span></a>
                </li>


                <li class="submenu">
                    <a href="#" class=""><i class="fa fa-list-ol bigfonts"></i> <span>Report </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled" >
                        <li class=""><a href="#"><i class="fa fa-file-text-o bigfonts"></i> Distributor Stock</a></li>
                        <li class=""><a href="#"><i class="fa fa-file-text bigfonts"></i> Distributor List</a></li>
                        <li class=""><a href="#"><i class="fa fa-file-text-o bigfonts"></i> Total Stock</a></li>
                        <li class=""><a href="#"><i class="fa fa-file-text bigfonts"></i> Product List</a></li>
                        <li class=""><a href="#"><i class="fa fa-file-text-o bigfonts"></i> Outlet List</a></li>
                    </ul>
                </li>

            </ul>

            <div class="clearfix"></div>

        </div>

        <div class="clearfix"></div>

    </div>

</div>




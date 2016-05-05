<?php 
session_start();
// var_dump($_SESSION);
if(!isset($_SESSION['name'])){
    header("Status: 301");
    header("Location: login.html");
    var_dump($_SESSION);
}
 ?>
<div ng-controller="dashCtrl">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="#">Home</a>
            </li>
            <li class="active">Dashboard</li>
        </ul>
    </div>
    <div class="page-content">
        <div class="row">
            <div class="space-6"></div>
            <div class="col-sm-10 col-sm-offset-1">
                <div id="login-box" class="login-box visible widget-box no-border">
                    <div class="widget-body">
                        <div class="widget-main">
                            <h4 class="header blue lighter bigger">
                                <i class="icon-coffee green"></i>
                                User Authenticated
                            </h4>
                            <div class="space-16"></div>
                            UID: {{results.uid}} UID: {{uid}} {{yolo}}
                            <br/>NAME: {{rootscope.name}}
                            <br/>NAME: {{name}}
                            <br/>E-MAIL: {{email}}
                            <br/>
                            <a ng-click="logout();">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.page-content -->
<div class="breadcrumbs" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="#">Home {{yolo}}</a>
        </li>
        <li class="active">Login</li>
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
                    Login to AngularCode
                </h4>

                <div class="space-16"></div>

                <form name="loginForm" class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="email"> Email / Phone </label>
                        <div class="col-sm-7">
                           <span class="block input-icon input-icon-right">
                                <input type="text" class="form-control" placeholder="Email / Phone" name="email" ng-model="login.email" required focus/>
                                <i class="ace-icon fa fa-user"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="password"> Password </label>
                        <div class="col-sm-7">
                           <span class="block input-icon input-icon-right">
                                <input type="password" class="form-control" placeholder="Password" ng-model="login.password" required/>
                                <i class="ace-icon fa fa-lock"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="remember">Remember me</label>
                    <input type="checkbox" id="remember" ng-model="login.remember">
                    </div>
                    <div class="space"></div>
                     <div class="clearfix">
                                                        <div class="row">
                         <label class="col-sm-3 control-label no-padding-right"> </label>
                        <div class="col-sm-7">
                            <button type="submit" class="width-35 pull-right btn btn-sm btn-primary" ng-click="doLogin(login)" data-ng-disabled="loginForm.$invalid">
                                <i class="ace-icon fa fa-key"></i>
                                Login
                            </button>
                                                            </div>
                        </div>
                    </div>
                        <div class="space-4"></div>
                <span class="lbl col-sm-3"> </span><div class="col-sm-7">Don't have an account? <a href="#/signup">Signup</a></div>
                </form>

                
                
            </div><!-- /widget-main -->

            
        </div><!-- /widget-body -->
    </div><!-- /login-box -->

</div><!-- /position-relative -->
</div>
</div><!-- /.page-content -->
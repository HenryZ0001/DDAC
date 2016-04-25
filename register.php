<!DOCTYPE>
<?php

include 'BootStrap.php';
include 'DB.php';
$db = 'ddactestingone';

mysqli_select_db($conn, $db);

if (isset($_POST['RegBtn'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $email =$_POST['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gendertext'];
    $r = new register($conn, $user, $pass, $email, $fname, $lname, $gender);
    header("Location:home.php?id=".$r->getid($conn));
}

class register
{
    function register($conn, $user, $pass, $email, $fname, $lname, $gender)
    {
        $select2 = "select user_id from user where user_username='" . $user . "' or user_email='" . $email . "'";
        $uecheck = $conn->query($select2);
        if ($uecheck->num_rows < 1) {

            $select = "select user_id from user";
            $getcount = $conn->query($select);
            $newid = ($getcount->num_rows) + 1;

            $insert = "insert into user values(" . $newid . ",'" . $user . "','" . $lname . "','" . $fname . "','" . $gender . "','" . $email . "','" . $pass . "',2)";
            $conn->query($insert);
        }else
        {
            echo '<script>alert("Either username or email is not available. Please try again.")</script>';
        }
    }
    function getid($conn)
    {
        $select2 = "select user_id from user";
        $getidcount = $conn->query($select2);
        $count = $getidcount->num_rows;
        return $count;
    }
}
?>
<html>
<head>
    <title>Register for New User</title>
    <style>
        .Registerform {
            position: relative;
            top: 100px;
        }
    </style>
    <script type="text/javascript">
        var appInsights=window.appInsights||function(config){
                function r(config){t[config]=function(){var i=arguments;t.queue.push(function(){t[config].apply(t,i)})}}var t={config:config},u=document,e=window,o="script",s=u.createElement(o),i,f;for(s.src=config.url||"//az416426.vo.msecnd.net/scripts/a/ai.0.js",u.getElementsByTagName(o)[0].parentNode.appendChild(s),t.cookie=u.cookie,t.queue=[],i=["Event","Exception","Metric","PageView","Trace"];i.length;)r("track"+i.pop());return r("setAuthenticatedUserContext"),r("clearAuthenticatedUserContext"),config.disableExceptionTracking||(i="onerror",r("_"+i),f=e[i],e[i]=function(config,r,u,e,o){var s=f&&f(config,r,u,e,o);return s!==!0&&t["_"+i](config,r,u,e,o),s}),t
            }({
                instrumentationKey:"a8bf5547-83a0-450f-bcb4-cf021b003f86"
            });

        window.appInsights=appInsights;
        appInsights.trackPageView();
    </script>
</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">

        <!--Logo-->
        <div class="navbar-header">
            <a href="#" class="navbar-brand">Carnival Corp.</a>
        </div>
    </div>
</nav>

<div class="registerform col-md-9 col-md-offset-3">

    <form class="form-horizontal" method="post">
        <div class="form-group">
            <label for="Username" class="col-sm-2 control-label">User Name</label>

            <div class="col-sm-4">
                <input type="text" class="form-control" id="username" name="username" data-toggle="tooltip" data-placement="right" title="Your User Name will be used for logging in"
                       placeholder="e.g. henryjohnson0001" value="<?php if (isset($_POST['username'])) {
                    echo $_POST['username'];
                } ?>" autocomplete="off">
            </div>
        </div>
        <div class="form-group">
            <label for="Password" class="col-sm-2 control-label">Password</label>

            <div class="col-sm-4">
                <input type="password" class="form-control" id="passwordinput" name="password" placeholder="Password" value="<?php if (isset($_POST['password'])) {
                    echo $_POST['password'];
                } ?>" autocomplete="off">
            </div>
        </div>
        <div class="form-group">
            <label for="Email" class="col-sm-2 control-label">E-mail Address</label>
            <div class="col-sm-4">
                <input type="email" class="form-control" id="emailinput" name="email" placeholder="e.g henry_johnson@email.com" data-toggle="tooltip" title="E-mail will used to claim forgotten passwords" value="<?php if (isset($_POST['email'])) {
                    echo $_POST['email'];
                } ?>" autocomplete="off">
            </div>
        </div>
        <div class="form-group">
            <label for="FirstName" class="col-sm-2 control-label">First Name</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="fnameinput" name="fname" placeholder="e.g. Henry" value="<?php if (isset($_POST['fname'])) {
                    echo $_POST['fname'];
                } ?>" autocomplete="off">
            </div>
        </div>
        <div class="form-group">
            <label for="LastName" class="col-sm-2 control-label">Last Name</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="lnameinput" name="lname" placeholder="e.g. Johnson" value="<?php if (isset($_POST['lname'])) {
                    echo $_POST['lname'];
                } ?>" autocomplete="off">
            </div>
        </div>
        <div class="form-group">
            <label for="Gender" class="col-sm-2 control-label">Gender</label>
            <div class="col-sm-4">
                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Select <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><button type="submit" class="btn btn-default" name="gender" value="Male">Male</button></li>
                            <li><button type="submit" class="btn btn-default" name="gender" value="Female">Female</button></li>
                        </ul>
                    </div>
                    <input type="text" class="form-control" name="gendertext" readonly value="<?php if(isset($_POST['gender'])){echo $_POST['gender'];}?>">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default" name="RegBtn">Register</button>
            </div>
        </div>
    </form>

</div>
</body>

</html>
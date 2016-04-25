<!DOCTYPE>
<?php

include 'BootStrap.php';
include 'DB.php';
$db = 'ddactestingone';

mysqli_select_db($conn, $db);
$a = new adminfirstpage();
if (isset($_POST['LoginBtn'])) {
    $user = $_POST['LoginID'];
    $pass = $_POST['password'];
    $a->login($user,$pass,$conn,1);
}
class adminfirstpage
{
    function login($user, $pass, $conn,$utype)
    {
        $select = "select * from user where user_username='" . $user . "' and user_password='" . $pass . "' and user_type='".$utype."'";
        $result = $conn->query($select);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id = $row['user_id'];

            header("Location:adminhome.php?id=" . $id);
        } else {
            echo '<script>alert("Wrong User Name or Password, please Retry")</script>';
        }
    }
}

?>
<html>
<head>
    <title>Welcome to Carnival Corp. Cruises</title>
    <style>
        .loginform {
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

<h1 class="page-header">Admin Login</h1>

<div class="loginform col-md-9 col-md-offset-3">

    <form class="form-horizontal" method="post">
        <div class="form-group">
            <label for="Login" class="col-sm-2 control-label">User Name</label>

            <div class="col-sm-4">
                <input type="text" class="form-control" id="username" name="LoginID"
                       placeholder="Your user name, not e-mail">
            </div>
        </div>
        <div class="form-group">
            <label for="Password" class="col-sm-2 control-label">Password</label>

            <div class="col-sm-4">
                <input type="password" class="form-control" id="passwordinput" name="password" placeholder="Password">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default" name="LoginBtn">Login</button>
            </div>
        </div>
    </form>

</div>
</body>

</html>
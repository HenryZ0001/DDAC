<!DOCTYPE>
<?php
include 'BootStrap.php';
include 'DB.php';
$db = 'ddactestingone';

mysqli_select_db($conn, $db);

$id = $_GET['id'];
$gendertitle = "select user_gender, user_lname from user where user_id = " . $id;
$genderexe = $conn->query($gendertitle);
if ($genderexe->num_rows > 0) {
    while ($rows = $genderexe->fetch_assoc()) {
        $gender = $rows['user_gender'];
        $lname = $rows['user_lname'];
    }
    if ($gender = 'Male') {
        $header = "Welcome, " . $lname;
        echo "<head><title>$header</title></head>";
    } elseif ($gender = 'Female') {
        $header = "Welcome, " . $lname;
        echo "<head><title>$header</title></head>";
    }
}
?>
<html>
<head>
    <style>
        .carousel-inner > .item > img,
        .carousel-inner > .item > a > img {
            margin: auto;
            width: 750px;
            height: 200px;
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

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li class="active">
                    <a href="#">
                        Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li>
                    <?php echo "<a href='itinerary.php?id=" . $id . "'>Itineraries</a>"; ?>
                </li>
                <li>
                    <a href="index.php">Log Out</a>
                </li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header"><?php echo $header; ?></h1>

            <div id="homecarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#homecarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#homecarousel" data-slide-to="1"></li>
                    <li data-target="#homecarousel" data-slide-to="2"></li>
                </ol>

                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <a href="#">
                            <img src="images/carousel1.png" alt="...">
                        </a>
                    </div>
                    <div class="item">
                        <a href="#">
                            <img src="images/carousel2.png" alt="...">
                        </a>
                    </div>
                    <div class="item">
                        <a href="#">
                            <img src="images/carousel3.png" alt="...">
                        </a>
                    </div>
                </div>

                <a class="left carousel-control" href="#homecarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#homecarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>


</body>
</html>
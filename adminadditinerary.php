<!DOCTYPE>
<?php
include 'BootStrap.php';
include 'DB.php';
$db = 'ddactestingone';

$id = $_GET['id'];
mysqli_select_db($conn, $db);

if (isset($_POST['additinerarybtn'])) {
    $ddate= $_POST['departdate'];
    $rdate = $_POST['returndate'];
    $dto = $_POST['departto'];
    $cid = $_POST['cruiseid'];
    $bprice = $_POST['basicprice'];
    $i = new additinerary($conn, $ddate, $rdate, $dto, $cid, $bprice);
    header("Location:adminhome.php?id=" . $id);
}

class additinerary
{
    function additinerary($conn, $ddate, $rdate, $dto, $cid, $bprice)
    {
        $select2 = "select * from itinerary";
        $getcount2 = $conn->query($select2);
        $newid2 = ($getcount2->num_rows) + 1;

        $insert2 = "insert into itinerary values(" . $newid2 . ",'" . $ddate . "','" . $rdate . "','1','" . $dto . "','" . $cid . "','" . $bprice . "','20','20','20')";
        $conn->query($insert2);
        echo '<script>confirm("Itinerary '.$newid2.' added.")</script>';
    }
}

?>
<html>
<head>
    <title>Welcome, Admin</title>
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
                    <a href="adminhome.php">Home</a>
                </li>
                <li>
                    <a href="#">
                        Add Itinerary
                        <span class="sr-only">(current)</span>
                    </a>                </li>
                <li>
                    <a href="index.php">Log Out</a>
                </li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Add Itinerary</h1>
            <div class="additineraryform col-md-9 col-md-offset-3">

                <form class="form-horizontal" method="post">
                    <div class="form-group">
                        <label for="Depart Date" class="col-sm-2 control-label">Depart Date</label>

                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="departdate" name="departdate" placeholder="YYYY-MM-DD" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Return Date" class="col-sm-2 control-label">Return Date</label>

                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="returndate" name="returndate" placeholder="YYYY-MM-DD" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="DepartTo" class="col-sm-2 control-label">Depart To</label>

                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="departto" name="departto"
                                   placeholder="2 for Saint Peter Port, 3 for Spain Port" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="CruiseID" class="col-sm-2 control-label">Cruise ID</label>

                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="cruiseid" name="cruiseid"
                                   placeholder="e.g. 1/2/3/4" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="BasicPrice" class="col-sm-2 control-label">Basic Price/Normal Cabin Price</label>

                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="basicprice" name="basicprice"
                                   placeholder="The price for normal cabin" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default" name="additinerarybtn">Add Itinerary</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


</body>
</html>
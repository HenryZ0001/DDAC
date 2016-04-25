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
    $i->additinerary($conn, $ddate, $rdate, $dto, $cid, $bprice);
    header("Location:adminhome.php?id=" . $id);
}

class itineraryavailable
{
    function itineraryavailable($conn)
    {
        $select = "select i.itinerary_id,i.depart_date,i.return_date,i.cruise_id,i.basic_price, p.port_name as DepartTo from itinerary i join port p where i.to_port_id = p.port_id order by itinerary_id asc";
        $result = $conn->query($select);

        if ($result->num_rows > 0) {
            while ($rows = $result->fetch_assoc()) {
                echo "<tr><td>" . $rows['itinerary_id'] . "</a></td><td>" . $rows['depart_date'] . "</td><td>" . $rows['return_date'] . "</td><td>" . $rows['cruise_id'] . "</td><td>" . $rows['basic_price'] . "</td><td>" . $rows['DepartTo'] . "</td></tr>";
            }
        }
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
                    <a href="#">
                        Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li>
                    <a href="adminadditinerary.php">Add Itinerary</a>
                </li>
                <li>
                    <a href="index.php">Log Out</a>
                </li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Welcome, Admin</h1>

            <h2 class="sub-header">Itineraries Available Now</h2>
            <table class="table table-hover">
                <tr>
                    <th>Itinerary ID</th>
                    <th>Depart Date</th>
                    <th>Return Date</th>
                    <th>Cruise ID</th>
                    <th>Basic Price(Normal Cabin)</th>
                    <th>Destination</th>
                </tr>
                <?php $i = new itineraryavailable($conn) ?>
            </table>
        </div>
    </div>
</div>


</body>
</html>
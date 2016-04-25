<!DOCTYPE>
<?php
include 'BootStrap.php';
include 'DB.php';
$db = 'ddactestingone';

mysqli_select_db($conn, $db);

$id = $_GET['id'];
$item = $_GET['item'];
$cabin = $_GET['item2'];
$currentprice = $_GET['item3'];

class bookconfirm
{
    function current($conn, $item)
    {
        $select = "select i.itinerary_id,p.port_name as DepartTo,i.normal_left,i.vip_left,i.vvip_left,i.basic_price  from itinerary i join port p where i.to_port_id = p.port_id and i.itinerary_id =" . $item;
        $result1 = $conn->query($select);

        if ($result1->num_rows > 0) {
            echo "<tr><th>Itinerary ID</th><th>Depart To</th><th>Normal Cabin Price</th><th>Normal Cabins Left</th><th>VIP Cabins Left</th><th>VVIP Cabins Left</th></tr>";
            while ($rows = $result1->fetch_assoc()) {
                echo "<tr><td>" . $rows['itinerary_id'] . "</td><td>" . $rows['DepartTo'] . "</td><td>" . $rows['basic_price'] . "</td><td>" . $rows['normal_left'] . "</td><td>" . $rows['vip_left'] . "</td><td>" . $rows['vvip_left'] . "</td></tr>";
            }
        }
    }

    function otheritineries($conn, $item)
    {
        $select = "select i.itinerary_id,p.port_name as DepartTo,i.normal_left,i.vip_left,i.vvip_left,i.basic_price  from itinerary i join port p where i.to_port_id = p.port_id and i.itinerary_id !=" . $item;
        $result1 = $conn->query($select);

        if ($result1->num_rows > 0) {
            echo "<tr><th>Itinerary ID</th><th>Depart To</th><th>Normal Cabin Price</th><th>Normal Cabins Left</th><th>VIP Cabins Left</th><th>VVIP Cabins Left</th></tr>";
            while ($rows = $result1->fetch_assoc()) {
                echo "<tr><td>" . $rows['itinerary_id'] . "</td><td>" . $rows['DepartTo'] . "</td><td>" . $rows['basic_price'] . "</td><td>" . $rows['normal_left'] . "</td><td>" . $rows['vip_left'] . "</td><td>" . $rows['vvip_left'] . "</td></tr>";
            }
        }
    }

    function confirm($conn, $id, $item, $cabin, $currentprice)
    {
        $totalcheck = "select ticket_id from ticket";
        $totalcres = $conn->query($totalcheck);
        $total = $totalcres->num_rows + 1;

        $write = "insert into ticket values(" . $total . ", " . $item . "," . $id . "," . $cabin . "," . $currentprice . ")";
        $conn->query($write);
    }
    function normalcf($conn,$item)
    {
        $leftcheck = "select normal_left from itinerary where itinerary_id=" . $item;
        $leftres = $conn->query($leftcheck);
        $leftrow = $leftres->fetch_assoc();
        $left = $leftrow['normal_left'];
        $left = $left-1;

        $upleft = "update itinerary set normal_left=" . $left . "where itinerary_id" . $item;
        $conn->query($upleft);
    }
}

$b = new bookconfirm();

if (isset($_POST['ConfirmBtn'])) {
    $b->confirm($conn, $id, $item, $cabin, $currentprice);
    if ($cabin == 1) {
        $leftcheck = "select normal_left from itinerary where itinerary_id=" . $item;
        $leftres = $conn->query($leftcheck);
        $leftrow = $leftres->fetch_assoc();
        $left = $leftrow['normal_left'];
        $left = $left-1;

        $upleft = "update itinerary set normal_left=".$left." where itinerary_id=" . $item;
        $conn->query($upleft);
        echo '<script>confirm("The Total Price is ' . $currentprice . ' Euros. Please pay the exact amount when boarding"); window.location="home.php?id=' . $id . '";</script>';

    } elseif ($cabin == 2) {
        $leftcheck = "select vip_left from itinerary where itinerary_id=" . $item;
        $leftres = $conn->query($leftcheck);
        $leftrow = $leftres->fetch_assoc();
        $left = $leftrow['vip_left'];
        $left = $left-1;

        $upleft = "update itinerary set vip_left=".$left." where itinerary_id=" . $item;
        $conn->query($upleft);
        echo '<script>confirm("The Total Price is ' . $currentprice . ' Euros. Please pay the exact amount when boarding"); window.location="home.php?id=' . $id . '";</script>';

    } elseif ($cabin == 3) {
        $leftcheck = "select vvip_left from itinerary where itinerary_id=" . $item;
        $leftres = $conn->query($leftcheck);
        $leftrow = $leftres->fetch_assoc();
        $left = $leftrow['vvip_left'];
        $left = $left-1;

        $upleft = "update itinerary set vvip_left=".$left." where itinerary_id=" . $item;
        $conn->query($upleft);
        echo '<script>confirm("The Total Price is ' . $currentprice . ' Euros. Please pay the exact amount when boarding"); window.location="home.php?id=' . $id . '";</script>';

    }
}

if(isset($_POST['MakeOtherBookingBtn']))
{
    header("Location:itinerary.php?id=".$id);
}

if(isset($_POST['CancelBtn']))
{
    header("Location:home.php?id=".$id);
}
?>
<html>
<head>
    <title>Welcome Mr.</title>
    <style>
        .page-header {
            font-family: "impact";
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
                <li>
                    <?php echo "<a href='home.php?id=" . $id . "'>Home</a>"; ?>
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
            <h1 class="page-header"><?php echo 'Itineraries Comparison'; ?></h1>

            <h2 class="sub-header">Currently Selected Itinery</h2>
            <table class="table table-hover">
                <?php $b->current($conn, $item); ?>
            </table>
            <hr>
            <h2 class="sub-header">Other Itineries</h2>
            <table class="table table-hover">
                <?php $b->otheritineries($conn, $item); ?>
            </table>
            <hr>
            <div class="bookingform">
                <form class="horizontal-form col-md-9" method="post">
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" name="ConfirmBtn">Confirm Booking</button>
                            <button type="submit" class="btn btn-default" name="MakeOtherBookingBtn">Make Other
                                Booking
                            </button>
                            <button type="submit" class="btn btn-warning" name="CancelBtn">Cancel Booking</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<!DOCTYPE>
<?php
include 'BootStrap.php';
include 'DB.php';
$db = 'ddactestingone';

mysqli_select_db($conn, $db);

$id = $_GET['id'];
$item = $_GET['item'];

class itinerarydetails
{
    function price($conn, $item, $cabin)
    {
        $perselect = "select cabin_price_rate from cabin where cabin_type ='" . $cabin . "'";
        $perresult = $conn->query($perselect);
        if ($perresult->num_rows > 0) {
            $rows = $perresult->fetch_assoc();
            $rate = $rows['cabin_price_rate'];

            $pricesel = "select basic_price from itinerary where itinerary_id=" . $item;
            $priceres = $conn->query($pricesel);
            if ($priceres->num_rows > 0) {
                $row = $priceres->fetch_assoc();
                $basicprice = $row['basic_price'];
                $total_price = $basicprice * (($rate + 100) / 100);
                return $total_price;
            }
        }
    }

    function normalcabin($conn, $item)
    {
        $cabinsel = "select normal_left from itinerary where itinerary_id=" . $item;
        $cabinres = $conn->query($cabinsel);
        if ($cabinres->num_rows > 0) {
            $rows = $cabinres->fetch_assoc();
            if ($cabintype = 'Normal') {
                return $rows['normal_left'];
            }
        }
    }
    function vipcabin($conn, $item)
    {
        $cabinsel = "select vip_left from itinerary where itinerary_id=" . $item;
        $cabinres = $conn->query($cabinsel);
        if ($cabinres->num_rows > 0) {
            $rows = $cabinres->fetch_assoc();
            if ($cabintype = 'VIP') {
                return $rows['vip_left'];
            }
        }
    }
    function vvipcabin($conn, $item)
    {
        $cabinsel = "select vvip_left from itinerary where itinerary_id=" . $item;
        $cabinres = $conn->query($cabinsel);
        if ($cabinres->num_rows > 0) {
            $rows = $cabinres->fetch_assoc();
            if ($cabintype = 'VVIP') {
                return $rows['vvip_left'];
            }
        }
    }
}

$d = new itinerarydetails();

$select = "select i.depart_date,i.return_date,i.cruise_id,p.port_name as DepartFrom from itinerary i join port p where i.depart_from_port_id = p.port_id and i.itinerary_id =" . $item;
$result1 = $conn->query($select);

if ($result1->num_rows > 0) {
    $rows = $result1->fetch_assoc();
    $depart_date = $rows['depart_date'];
    $return_date = $rows['return_date'];
    $cruise_id = $rows['cruise_id'];
    $from = $rows['DepartFrom'];
}

$select2 = "select p.port_name as DepartTo from port p join itinerary i where i.to_port_id = p.port_id and i.itinerary_id=" . $item;
$result2 = $conn->query($select2);
if ($result2->num_rows > 0) {
    $rows2 = $result2->fetch_assoc();
    $to = $rows2['DepartTo'];
}



if(isset($_POST['BookBtn']))
{
    $cabin = $_POST['cabintext'];
    $sel = "select cabin_id from cabin where cabin_type='".$cabin."'";
    $res = $conn->query($sel);
    $r = $res->fetch_assoc();
    $cabinid=$r['cabin_id'];
    header("Location:bookingdetails.php?id=".$id."&item=".$item."&item2=".$cabinid."&item3=".$d->price($conn, $item, $cabin));
}

?>
<html>
<head>
    <title>Welcome Mr.</title>
    <style>
        .page-header {
            font-family: "impact";
        }

        .impact-font {
            font-family: "impact";
        }

        .font-hunfif {
            font-size: 150%;
        }

        .bordered {
            border-bottom: 1px solid #000;
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
            <h1 class="page-header"><?php echo 'Itinerary ' . $item; ?></h1>
            <table class="table table-bordered">
                <tr class="font-hunfif">
                    <th class="impact-font" colspan="2">Depart From:</th>
                    <td><?php echo '' . $from; ?></td>
                </tr>
                <tr class="font-hunfif bordered">
                    <th class="impact-font" colspan="2">Depart To:</th>
                    <td><?php echo '' . $to; ?></td>
                </tr>
                <tr class="font-hunfif">
                    <th class="impact-font" colspan="2">Depart Date:</th>
                    <td><?php echo '' . $depart_date; ?></td>
                </tr>
                <tr class="font-hunfif bordered">
                    <th class="impact-font" colspan="2">Return Date:</th>
                    <td><?php echo $return_date; ?></td>
                </tr>
                <tr class="font-hunfif">
                    <th class="impact-font" colspan="2">Normal Cabin Price(Euro):</th>
                    <td><?php echo $d->price($conn, $item, 'Normal'); ?></td>
                </tr>
                <tr class="font-hunfif">
                    <th class="impact-font" colspan="2">VIP Cabin Price(Euro):</th>
                    <td><?php echo $d->price($conn, $item, 'VIP'); ?></td>
                </tr>
                <tr class="font-hunfif bordered">
                    <th class="impact-font" colspan="2">VVIP Cabin Price(Euro):</th>
                    <td><?php echo $d->price($conn, $item, 'VVIP'); ?></td>
                </tr>
                <tr class="font-hunfif">
                    <th class="impact-font" colspan="3">Cabins Left:</th>
                </tr>
                <tr class="font-hunfif impact-font">
                    <th>Normal Cabin</th>
                    <th>VIP Cabin</th>
                    <th>VVIP Cabin</th>
                </tr>
                <tr class="font-hunfif">
                    <td><?php echo $d->normalcabin($conn,$item);?></td><td><?php echo $d->vipcabin($conn,$item);?></td><td><?php echo $d->vvipcabin($conn,$item);?></td>
                </tr>
            </table>
            <hr>
            <div class="bookingform">
                <form class="horizontal-form col-md-9" method="post">
                    <div class="form-group">
                        <label for="CabinType" class="col-sm-2 control-label">Cabin Type</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Select <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><button type="submit" class="btn btn-default" name="cabin" value="Normal">Normal</button></li>
                                        <li><button type="submit" class="btn btn-default" name="cabin" value="VIP">VIP</button></li>
                                        <li><button type="submit" class="btn btn-default" name="cabin" value="VVIP">VVIP</button></li>
                                    </ul>
                                </div>
                                <input type="text" class="form-control" name="cabintext" readonly value="<?php if(isset($_POST['cabin'])){echo $_POST['cabin'];}?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default" name="BookBtn">Book</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<html>
<head>
</head>
<body>
<form action='' method='POST' >
<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/erp/modules/employee/includes/BUS/library/OAuthStore.php';

    include_once $_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/erp/modules/employee/includes/BUS/library/OAuthRequester.php';

    include_once $_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/erp/modules/employee/includes/BUS/SSAPICaller.php';

 

    $storeboardingpointId=$_GET['boardingpointsList'];
    $storetripId = $_GET['chosentripid'];
    $result=getBoardingPoint($storeboardingpointId,$storetripId);
    $result2 = json_decode($result);
    echo "<table frame='box' class='wp-list-table widefat striped admins'><tbody >";
    foreach ($result2 as $key => $value) {
        echo "<tr><td style='font-weight:bold; color:green;'>".$key."</td><td>".$value."</td></tr>";
    }
    echo "</tbody></table>";
    ?>

    </form>
</body>
</html>
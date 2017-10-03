<html>
<head>
</head>
<body>
	<?php

	 include_once "library/OAuthStore.php";
    include_once "library/OAuthRequester.php";
    include_once "SSAPICaller.php";
  
$base_url = "http://api.seatseller.travel/";
echo "<form method='GET' action='' name='form5' onSubmit=''>";
session_start();
$json=$_SESSION['jsonobject'] ;
$json_2=json_encode($json); 
$key= blockTicket($json_2);
echo $key;
//$con=confirmTicket($key);
//echo $con;

      ?>
	</body>
</html>
<?php
$mobile=$_POST['mobile'];
$ch = curl_init();
$timeout = 30; // set to zero for no timeout
$myurl = "https://joloapi.com/api/findoperator.php?userid=estoor&key=174611741762437&mob=$mobile&type=json";
curl_setopt ($ch, CURLOPT_URL, $myurl);
curl_setopt ($ch, CURLOPT_HEADER, 0);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$file_contents = curl_exec($ch);
$curl_error = curl_errno($ch);
curl_close($ch);

//dump output of api if you want during test
echo $file_contents;
?>
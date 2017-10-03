<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function sendMessage($mobile,$message){
    $url = 'http://103.233.79.114/websms/sendsms.aspx?userid=estoor&password=123456&sender=ESTOOR&mobileno='.$mobile.'&msg='.$message;
     $ch = curl_init();  
         curl_setopt($ch,CURLOPT_URL,$url);
         curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
         $output=curl_exec($ch);
         curl_close($ch);
}


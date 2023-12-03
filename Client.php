<?php

$socket=socket_create(AF_INET, SOCK_STREAM 0) or die('Unable to create socket \n');

$host='192.168.0.122';
// $serverIP=$_SERVER['REMOTE_ADDR'];
$port=5041;
//Just a random port

set_time_limit(0);


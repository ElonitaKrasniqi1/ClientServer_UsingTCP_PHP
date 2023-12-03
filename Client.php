<?php

$socket=socket_create(AF_INET, SOCK_STREAM 0) or die('Unable to create socket \n');

$host='192.168.0.122';
// $serverIP=$_SERVER['REMOTE_ADDR'];
$port=5041;
//Just a random port

set_time_limit(0);
$result = socket_connect($socket, $host, $port) or die('Unable to connect to server\n');

while(true){
    $option = (string)readline("Write a command: ");

    socket_write($socket, $option, strlen($option)) or die('Unable to send data to server\n');
    if($option == "CLOSE"){
        echo "Connection terminated!";
        break;}
    else if(str_starts_with($option,"OPEN")){
        $result = socket_read($socket,2048) or die("Unable to open file for reading\n");
    }
    else if(str_starts_with($option,"WRITE")){
        $result = socket_read($socket,2048) or die("Unable to write to file\n");
    }
    else if(str_starts_with($option,"CREATE")){
        $result = socket_read($socket,2048) or die("Unable to create file\n");
    }
    else if(str_starts_with($option,"DELETE")){
        $result = socket_read($socket,2048) or die("Unable to delete file\n");
    }
    else {
        $result = socket_read($socket, 2048) or die('Unable to read server response\n');
    } 

    echo $result;
  
}
socket_close($socket);
?>


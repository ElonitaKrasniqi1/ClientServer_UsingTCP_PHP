<?php 

// $server_address = '192.168.0.122';
$server_address = '192.168.0.122';
$server_port = 5041;

# Creating a socket from where we wait for clients
$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die('Unable to create a sockett');

# connect socket to the IP address and the specified port
$result = socket_bind($socket,$server_address,$server_port) or die("Couldn't secure the socket binding\n");

# List of clients, type string, format -> "ip.addr-port.number"
$client_list = [];

# Admini
$admin = '';

echo "Ready to welcome incoming clients: ";


while (true){
    # listening for new clients
    $result = socket_listen($socket, 4) or die("Could not listen to clients\n");
    # new socket for client
    $spawn = socket_accept($socket) or die("Could not accept incoming connection\n");

    socket_getpeername($spawn, $client_address, $client_port) or die("Failed to fetch client details");
    $client = $client_address . '-'. $client_port;
    $client_list[] = $client;
    print_r($client_list);

    while(true){
    $input = socket_read($spawn, 1024) or die("Failed to read the input\n");

    if($input == "CLOSE"){
        $output = "Connection closed!";
        $index = array_search($client_address. '-' .$client_port, $client_list);
        if($admin == $client_list[$index])
            $admin = '';
        unset($client_list[$index]);
        $client_list = array_values($client_list);
        socket_close($spawn);
        break;
    }
    else if($input == "GET"){
        $output = "Commands available: \n
        1. GET - Gets data from server \n
        2. CLOSE - Close server connection \n
        3. VIEW_FILES - Explore files on the server \n
        4. OPEN <file_name> - Inspect the contents of a file \n
        5. WRITE <file_name> <content> - Record content in a file (admin authorization required) \n
        6. DELETE <file_name> - Erase a file (admin authorization required) \n
        7. CREATE <file_name> - Generate a new file (admin authorization required) \n
        8. REQ_ADMIN - Request admin permissions \n";
    }

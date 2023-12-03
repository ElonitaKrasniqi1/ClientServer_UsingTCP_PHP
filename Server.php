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

        else if($input == "VIEW_FILES"){
        $output = shell_exec("tree /f");
    }
    else if(str_starts_with($input, "OPEN")){
        $cmd = explode(' ', $input);
        $filename = ".\\dirs\\".$cmd[1];
        if(file_exists($filename)){
            $output = file_get_contents($filename)."\n";
            if('' == $output){
                $output = "File is empty \n";
            }
        }else{
            $output = "File does not exist \n";
        }
    }
    else if(str_starts_with($input, "WRITE")){
        if($client_address . '-' . $client_port != $admin){
            $output = "This action requires admin permissions! \n";
        }
        else {
            $cmd = explode(' ', $input);
            $filename = ".\\dirs\\".$cmd[1];
            if(!isset($cmd[2])){
                $output = "Provide data to be written!";
            } else {
                if(file_exists($filename)){
                    $data = "\n";
                    $f_pointer = fopen($filename,"a");
                    for($i = 2; $i < count($cmd); $i++){
                        $data .= $cmd[$i] . ' ';
                    }
                    fwrite($f_pointer, $data);
                    $output = "File successfully edited! \n";
                }
                else {
                    $output = "File does not exist! \n";
                }
            }
        }
    }
    else if (str_starts_with($input, "DELETE")) {
        if($client_address . '-' . $client_port != $admin){
            $output = "This action requires admin permissions! \n";
        }
        else {
            $cmd = explode(' ', $input);
        
            if (count($cmd) !== 2) {
                $output = "Invalid DELETE command format. Usage: DELETE <filename>\n";
            }
            else {
                echo "Current working directory: " . getcwd() . "\n";
        
                // Construct the file path using the script's directory
                $filename = __DIR__ . DIRECTORY_SEPARATOR . "dirs" . DIRECTORY_SEPARATOR . $cmd[1];
        
                echo "Attempting to delete file: " . $filename . "\n";

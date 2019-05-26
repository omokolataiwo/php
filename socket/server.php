<?php

set_time_limit(0);

$ip = '127.0.0.1';
$port = 1935;
    
if (($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) < 0) {
    echo "socket_create() fail to creat: " .socket_strerror($sock). '\n';
}

if (($ret = socket_bind($sock, $ip, $port)) < 0) {
    echo 'socket_bind() fail to bind: ' . socket_strerror($ret). '\n';
}

if (($ret = socket_listen($sock, 4)) < 0) {
    echo 'socket_listen() fail to listen: '. socket_strerror($ret) . '\n';
}

$count = 0;

do {
    if (($messageSocket = socket_accept($sock)) < 0) {
        echo 'socket_accept() failed: ' . socket_strerror($messageSocket) . '\n';
        break;
    } else {
        $message = "Success received from client! \n";
        socket_write($messageSocket, $message, strlen($message));

        echo "Success \n";
        $buffer = socket_read($messageSocket, 8192);

        echo 'Received Message: ' . $buffer . "\n";
        
        if (++$count >= 5) {
            break;
        }
    }
    socket_close($messageSocket);
} while(true);

socket_close($sock);

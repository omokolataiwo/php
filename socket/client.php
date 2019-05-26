<?php

error_reporting(E_ALL);
set_time_limit(0);

echo "<h1>TCP/IP Communication</h2>\n";

$port = 1935;
$ip = '127.0.0.1';

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

if ($socket < 0) {
    echo 'socket_create() failed: ' .socket_strerror(). '\n';
} else {
    echo "OK. \n";
}

echo "Try to connect " .$ip. ' ' . $port. "...\n";
$result = socket_connect($socket, $ip, $port);
if ($result < 0) {
    echo "socket_connect() failed. \n";
    echo "Rease: $result" . socket_strerror(). "\n";
} else {
    echo "Connected \n";
}

$in = "Testing\r\n";
$out = "";

if (!socket_write($socket, $in, strlen($in))) {
    echo "socket_write()( failed: " .socket_strerror(). "\n";
} else {
    echo "Send message to server successfully.\n";
    echo "Sent message $in\n";
}

while ($out = socket_read($socket, 8192)) {
    echo "Received server message successfully. \n";
    echo "Server message: ", $out;
}

echo "Turn off socket... \n";
socket_close($socket);
echo "Turned off\n";

<?php

/**
 * Connection to remote server using SSH Authentification
 * @author  José Franco <jose.franco@autoreno.com>
 * @license Proprietary
 * @version 1.0
 */


/*
function connect($host, $u, $pwd, $db)
{
    try {
        $conn = mysqli_connect($host, $u, $pwd, $db);
    } catch (Exception $e) {
        throw new Exception("Connection error " . $e->getMessage());
    }

    return $conn;
}




function remot_conn($ip, $u, $pwd, $db, $port)
{
    if (!function_exists('ssh2_connect')) {
        throw new Exception('SSH2 extension is not installed');
    }

    try {
        $conn = ssh2_connect($ip, $port);

        if (!$conn) {
            throw new Exception('Failed to connect to SSH server');
        }

        // Check available authentication methods
        $auth_methods = ssh2_auth_none($conn, $u);

    
        if (!in_array('password', $auth_methods)) {
        throw new Exception('Server does not support password authentication. Available methods: ' . implode(', ', $auth_methods));
    }


        // Authenticate with username and password
    if (!ssh2_auth_password($conn, $u, $pwd)) {
        throw new Exception('Failed to authenticate using provided credentials');
    }



        return $conn;
    } catch (Exception $e) {
        throw new Exception("Connection error: " . $e->getMessage());
    }
}


$conn = remot_conn('204.173.254.5', 'administrator', 'ar2024crm', 'mcrm0006', 22);


if ($conn) { 

   $usersEntity = 'User';  // entidade que contém os acessos
}*/


define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'a');
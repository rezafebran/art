<?php

require 'function.php';


session_start();

    if (isset($_POST)) {
        global $conn;
        $query =query('SELECT * FROM product WHERE name LIKE "%'.$_POST['search'].'%"');
        echo json_encode($query);
        
        
    }

?>
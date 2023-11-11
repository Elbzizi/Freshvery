<?php 
      


      
    try {
        
        //host
        if (!defined('HOST')) define("HOST", "localhost");

        //dbname
        if (!defined('DBNAME')) define("DBNAME", "freshvery");

        //user
        if (!defined('USER')) define("USER", "root");

        //pass
        if (!defined('PASS')) define("PASS", "omar2001");


        $conn = new PDO("mysql:host=".HOST.";dbname=".DBNAME.";", USER, PASS);

        // if($conn == true) {
        //     echo "connected successfully";
        // } else {
        //     echo "error";
        // }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
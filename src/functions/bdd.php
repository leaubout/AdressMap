<?php

    function connectDB(){
        $dsn = "mysql:dbname=project;host=127.0.0.1;charset=UTF8";
        $user = "project";
        $password = "0000";
        
        // 'mysql:dbname=testdb;host=127.0.0.1'
        try {
            $connection = new PDO($dsn, $user, $password);
        } catch (PDOException $e){
            echo 'Connection failed : ' . $e->getMessage(); 
        }
        return $connection;
    }
    
    
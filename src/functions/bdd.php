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
    
    // fonction qui nettoie les données (pas encore fait) et qui renvoie le tableau de données bien formaté
    // pour la création et pour la modification d'adresses
    function cleanData($data){
        $dataClean = array();
        if (isset($data['id'])){
            $dataClean['id'] = $data['id'];
        }else{
            $dataClean['id'] = NULL;
        }
        $dataClean['address'] = $data['address'];
        $dataClean['title'] = $data['title'];
        $dataClean['description'] = $data['description'];
        $dataClean['url'] = $data['url'];
        return $dataClean;
    }
    
    function cleanImportData($data){
        $dataClean = array();
        // pour une adresse à modifier
        if (isset($data['id'])){
            $dataClean['id'] = $data['id'];
        // pour une adresse à créer
        }else{
            $dataClean['id'] = NULL;
        }
        $dataClean['address'] = $data['address'];
        $dataClean['title'] = $data['title'];
        $dataClean['description'] = $data['description'];
        $dataClean['url'] = $data['url'];
        return $dataClean;
    }
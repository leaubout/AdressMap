<?php
    
    require_once '../functions/bdd.php';

    //if (!isset($pdo)){
        $pdo = connectDB();
    //}

    function create($pdo, $post){    
        $sql = "INSERT INTO `project`.`address` (`id`, `address`, `title`, `description` ,`url`) "
            . "VALUES (:id, :address, :title, :description, :url)";
        $data = array();
        $data['id'] = NULL;
        $data['address'] = $post['address'];
        $data['title'] = $post['title'];
        $data['description'] = $post['description'];
        $data['url'] = $post['url'];
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
    }

    function read($pdo){
        $sql = "SELECT `id`, `address`, `title`, `description`, `url` FROM `address";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function update($data){
    
    }
    
    function delete($data){
        
    }
    
    
<?php
    
    require_once '../functions/bdd.php';

    //if (!isset($pdo)){
        $pdo = connectDB();
    //}

    /** enregistrement d'une nouvelle adresse dans la table address
     * @param unknown $pdo : connexion PDO
     * @param array $cleanData : données nettoyées et formatées pour la requête spécifiée dans la fonction
     * @return boolean
     */
    function create($pdo, $cleanData){    
        $sql = "INSERT INTO `project`.`address` (`id`, `address`, `title`, `description` ,`url`) "
            . "VALUES (:id, :address, :title, :description, :url)";
        /*
        $data = array();
        $data['id'] = NULL;
        $data['address'] = $post['address'];
        $data['title'] = $post['title'];
        $data['description'] = $post['description'];
        $data['url'] = $post['url'];
        */
        $stmt = $pdo->prepare($sql);
        $bool = $stmt->execute($cleanData);
        return $bool;
    }

    function read($pdo){
        $sql = "SELECT `id`, `address`, `title`, `description`, `url` FROM `address`";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function readOne($pdo, $id){
        $sql = "SELECT `id`, `address`, `title`, `description`, `url` FROM `address` WHERE `id` = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array('id' => $id));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    
    
    // $data : les données ont déjà été nettoyées
    function update($pdo, $data){       
        $sql = "UPDATE `address` "
            . "SET `address` = :address, `title` = :title, `description` = :description, `url` = :url "
            . "WHERE `id` = :id";
        $stmt = $pdo->prepare($sql);
        $bool = $stmt->execute($data);
        return $bool;
    }
    
    function delete($pdo, $id){
        $sql = "DELETE FROM `address` "
                . "WHERE `id` = :id";
        $stmt = $pdo->prepare($sql);
        $bool = $stmt->execute(array('id' => $id));
        return $bool;        
    }
    
    
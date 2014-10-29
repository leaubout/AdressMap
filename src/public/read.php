<?php
    
    require_once '../bdd/address.php';
    $addressList = read($pdo);
    
    $title = "Affichage des contacts";
    $afterBootstrap = "";    
    require_once '../layout/header.php';
?>    
        <div class="container">
            <table>
                <thead>
                <tr>
                    <?php foreach($addressList[0] as $addressColumns => $value){?>
                    <th><?php echo $addressColumns?></th>
                    <?php }?>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody><?php foreach($addressList as $address) {?>
                    <tr>
                        <?php foreach($address as $key => $value){?>
                        <td><?php echo $value?></td>
                        <?php }?>
                        <td>
                            <a class="btn btn-success" href="update.php?id=<?= $address['id'] ?>">Mettre à jour</a>
                        </td>
                        <td>
                            <a class="btn btn-success" href="delete.php?id=<?= $address['id'] ?>">Supprimer</a>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>  
        </div>
        
<?php
    require_once '../layout/footer.php'; 
?>
    
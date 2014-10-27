<?php
 
    if (isset($_POST)){
        var_dump($_POST);
    }

    require_once '../bdd/address.php';
    
    $addressList = read($pdo);

/*    
    array (size=5)
    0 =>
    array (size=5)
    'id' => string '1' (length=1)
    'address' => string '6 place Charles Hernu 69100 Villeurbanne' (length=40)
    'title' => string 'Ip Formation' (length=12)
    'description' => string 'société de formation' (length=20)
    'url' => string 'www.ip-formation.com' (length=20)
*/    
    $title = "Liste des adresses";
    require_once '../layout/header.php';
    var_dump($addressList); 
    //var_dump(addressList[0]);
?>    
    
        <table>
            <thead>
            <tr><?php foreach($addressList[0] as $addressColumns => $value){?>
                <th><?php echo $addressColumns?></th>
                <?php }?>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody><?php foreach($addressList as $address) {
            var_dump($address);?>
                <tr>
                    <form action="update.php?id="<?php echo $address['id'];?>"" method="POST">
                        <?php foreach($address as $key => $value){?>
                        <td><?php echo $value?></td>
                        <?php }?>
                        <td>
                            <button id="update" name="update" value="update" class="btn btn-success">Mettre à jour</button>
                        </td>
                    </form>
                    <td>
                        <form action="update.php" method="POST">
                            <button id="submit" name="update" value="update" class="btn btn-success">Supprimer</button>
                        </form>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>  
    
<?php
    require_once '../layout/footer.php'; 
?>
    
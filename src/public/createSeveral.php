<?php

    $afterBootstrap = '<link href="css/main.css" rel="stylesheet">';
    $title = "Importation de contacts";
    require_once '../layout/header.php';

    if (isset($_POST['submit']) && $_POST['submit'] == 'import'){
     
        /* code récupéré de http://php.net/manual/fr/features.file-upload.php
        * puis légèrement adapté
        */  
        try {
     
            // Undefined | Multiple Files | $_FILES Corruption Attack
            // If this request falls under any of them, treat it invalid.
            if ( !isset($_FILES['inputFile']['error']) ||
             is_array($_FILES['inputFile']['error']) ) {
                throw new RuntimeException('Invalid parameters.');
            }
     
            // on vérifie le code d'erreur associé au téléchargement du fichier
            // on génère une exception en cas d'erreur
            switch ($_FILES['inputFile']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('Pas de fichier envoyé.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Dépassement de la limite de la taille du fichier.');
                default:
                    throw new RuntimeException('Erreurs inconnues.');
            }
     
            // on vérifie que la taille du fichier est inférieure à 1Mo  
            if ($_FILES['inputFile']['size'] > 1000000) {
                throw new RuntimeException('Dépassement de la limite de la taille du fichier.');
            }
         
            /*
            //NE FONCTIONNE PAS, mes fichiers .csv ont un type mime text/plain
            // pb : le type mime d'un fichier .csv exporté de pma est text/plain
            // on vérifie le type mime du fichier 
            // sans croire celui éventuellement fourni par le navigateur
            // récupération du type mime
            $resource = finfo_open(FILEINFO_MIME_TYPE);
            $typeMime  = finfo_file($resource, $_FILES['inputFile']['tmp_name']);
            finfo_close($resource);
            $ext = array_search($typeMime, array('csv' => 'text/csv'), true);
         
            if ( false === $ext) {
                throw new RuntimeException('Format de fichier invalide.');
            }
            */
         
            // Je me contente de vérifier l'extention sur le nom original du fichier...
            $splFileInfo = new SplFileInfo($_FILES['inputFile']['name']);
            $ext = $splFileInfo->getExtension();
            if ($ext != 'csv' ) {
                throw new RuntimeException('Format de fichier invalide.');
            }
            unset($splFileInfo);
         
            // on veut nommer le fichier téléchargé de manière unique
            // DO NOT USE $_FILES['inputFile']['name'] WITHOUT ANY VALIDATION !!
            // On this example, obtain safe unique name from its binary data.
            $fileName = $_FILES['inputFile']['tmp_name'];
            // nom et chemin de destination
            $fileNewName = sha1_file($_FILES['inputFile']['tmp_name']);
            $newPath = sprintf('./uploads/%s.%s',$fileNewName,$ext);
            if (!move_uploaded_file($fileName, $newPath)) {
                throw new RuntimeException('Impossible de déplacer le fichier téléchargé.');
            }
         
            require_once '../bdd/address.php';
         
            /* importation des données du fichier .csv */
            // maintenant, on récupère les données du fichier .csv
            // attention, le séparateur considéré ici est le point-virgule
            $fileResource = fopen($newPath,'r');
         
            $errDB = "";
            $errFile = FALSE;
            
            // on récupère la première ligne du fichier qui représente le nom de nos champs (identiques aux colonnes de table address la BD)
            $keys = fgetcsv($fileResource,0,';');
            
            if (is_array($keys)){
                // on rajoute l'id puisqu'on ne l'a pas dans le fichier importé
                array_unshift($keys, 'id');
                $keyTitle = array_search('title', $keys);
             
                
                // on récupère les enregistrements un à un
                while($data = fgetcsv($fileResource,0,';')){
                    array_unshift($data, NULL);     // on ajoute la première colonne correspondant à l'id à NULL
                 
                    // on crée un tableau ayant comme clés le nom des colonnes 
                    $data2 = array();
                    foreach($data as $key => $value){
                        $data2[$keys[$key]] = $value;
                    }
    
                    $bool = create($pdo, $data2);
                    if (!$bool){
                        $errDB .= "Il y a eu un problème lors de l'enregistrement de l'adresse de : " . $data[$keyTitle] . ".<br>"; 
                    }
                    unset($data2);
                }
                fclose($fileResource);
            // fin is_array($keys)
            } else {
                $errFile = TRUE;
            }
         
        // fin try { 
        } catch (RuntimeException $e) {
            $message = $e->getMessage();
            //echo $e->getMessage();
        }
    
        // s'il y a eu un problème avec le fichier uploadé
        if (isset($message)){
?>
        <div class="container content">
            <h3>Import de contacts</h3><br>
            <div class="alert alert-danger" role="alert">
        	   <p>Il y a eu un problème lors de l'importation de votre fichier.<br>
        	   <?= $message; ?>
        	   </p>
        	</div> 
        	<a class="btn btn-info" href="">Importer à partir d'un autre fichier 1</a>      
        </div>   
<?php      
        } else{ // s'il n'y a pas eu de problème avec le fichier uploadé,
            
        // il a cependant pu y en avoir par la suite
        
            // s'il y a eu un problème pour importer des données du fichier (fichier vide, fichier pas au format .csv)
            if ($errFile == TRUE){ ?>
        <div class="container content">
            <h3>Import de contacts</h3><br>
            <div class="alert alert-success" role="alert">
                <p>Le fichier a été téléchargé avec succès.</p>
            </div> 
            <div class="alert alert-danger" role="alert">
                <p>Mais il n'a pas été possible d'importer des données du fichier.</p>
            </div>
            <a class="btn btn-info" href="createSeveral.php">Importer à partir d'un autre fichier 2</a>
            <a class="btn btn-info" href="index.php">Revenir à l'accueil</a>
        </div>
<?php             
//          s'il n'y a pas eu d'erreur lors de l'enregistrement des adresses importées en BD
            } else if ($errDB == ""){
?>
        <div class="container content">
            <h3>Import de contacts</h3>
            <div class="alert alert-success" role="alert">
                <p>Le fichier a été téléchargé avec succès.</p>
                <p>Tous les contacts ont bien été importés</p><br>
        	</div>       
            <a class="btn btn-info" href="createSeveral.php">Importer de nouveaux contacts</a>
        	<a class="btn btn-info" href="read.php">Voir tous les contacts enregistrés</a>
        	<a class="btn btn-info" href="index.php">Revenir à l'accueil</a>
        </div>                             
<?php 
            // s'il y a eu une erreur lors de l'enregistrement des contacts dans la BD
            } else{
?>                
        <div class="container content">
            <h3>Import de contacts</h3><br>
            <div class="alert alert-success" role="alert">
                <p>Le fichier a été téléchargé avec succès.</p>
        	</div>          
            <div class="alert alert-danger" role="alert">
                <p>Cependant, il y a eu des problèmes lors de l'enregistrement des contacts dans la base de données !</p>
                <p><?= $errDB; ?></p>
            </div>
            <a class="btn btn-info" href="createSeveral.php">Importer à partir d'un autre fichier 3</a>
        	<a class="btn btn-info" href="index.php">Revenir à l'accueil</a>
        </div>            
<?php                 
            }
        }   // fin du else de if (isset($message)){
    // fin : if (isset($_POST['submit']) && $_POST['submit'] == 'import'){
    } else{           
?>                   
        <div class="container content">
        	<!-- input file Form -->
        	<form enctype="multipart/form-data" class="form-horizontal" method="POST" action="">
        		<fieldset>
        
        			<!-- Form Name -->
        			<legend>Importer des contacts à partir d'un fichier .csv</legend>
        			
        			<!-- MAX_FILE_SIZE doit précéder le champ input de type file -->
                    <div class="control-group">
        				<div class="controls">
                            <input type="hidden" name="MAX_FILE_SIZE" value="30000"/>
                        </div>
                    </div> 
       
        			<!-- Text input-->
        			<div class="control-group">
        				<label class="control-label" for="inputFile">Fichier à importer</label>
        				<div class="controls">
        					<input id="inputFile" name="inputFile" type="file" class="form-control">
        				</div>
        			</div>
        
        			<!-- Button (Double) -->
        			<div class="control-group">
        				<label class="control-label" for="submit"></label>
        				<div class="controls">
        					<button id="submit" name="submit" value="import"
        						class="btn btn-success">Importer le fichier</button>
        					<button id="reset" name="reset" value="cancel"
        						class="btn btn-danger">Réinitialiser</button>
        				</div>
        			</div>
        		</fieldset>
        	</form>
        	<br><br>
        	<a class="btn btn-info" href="index.php">Revenir à l'accueil</a>
        </div>
<?php
     }

    require_once '../layout/footer.php';
?>
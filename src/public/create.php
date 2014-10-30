        <?php
            if (isset($_POST['submit']) && $_POST['submit'] == 'create'){
                $bool = FALSE;
                require_once '../bdd/address.php';
                $dataClean = cleanData($_POST);
                $bool = create($pdo, $dataClean);
            }
            $afterBootstrap = '<link href="css/main.css" rel="stylesheet">';
            $title = "Saisie d'un nouveau contact";
            require_once '../layout/header.php';
        ?>
        <div class="container content">
        	<form class="form-horizontal" method="POST" action="">
        		<fieldset>
        
        			<!-- Form Name -->
        			<legend>Saisie d'un contact</legend>

        			<!-- Alerts Div  -->
                <?php if (isset($bool) && $bool == true){?>
        			<div class="alert alert-success" role="alert">
        			     <p>Le contact <?= $_POST['title'] . ", " . $_POST['description'] . ',' ?> a bien été créé<br>
        			     avec l'adresse : <?= $_POST['address'] ?><br>
        			     et l'url : <?= $_POST['url'] ?>.<br>
        			     </p><br>
        			     <a class="btn btn-info" href="http://www.project.dev/read.php">Voir les contacts déjà enregistrés</a>
        			</div>          			       
        		<?php } else if (isset($bool) && $bool == false){?>
                    <div class="alert alert-warning" role="alert">
            		      <p>Désolé, le contact <?= $_POST['title'] ?> n'a pas pu été créé<br></p>
            		</div>        			             
        		<?php }?>    
        			
        			<!-- Text input-->
        			<div class="control-group">
        				<label class="control-label" for="title">Titre</label>
        				<div class="controls">
        					<input id="title" name="title" type="text"
        						placeholder="Saisissez le titre" class="form-control input-xlarge">
        				</div>
        			</div><br>
        
        			<!-- Textarea -->
        			<div class="control-group">
        				<label class="control-label" for="address">Adresse</label>
        				<div class="controls">
        					<textarea id="address" name="address"
        						placeholder="Saisissez l'adresse" class="form-control"></textarea>
        				</div>
        			</div><br>
        
        			<!-- Text input-->
        			<div class="control-group">
        				<label class="control-label" for="description">Description</label>
        				<div class="controls">
        					<input id="description" name="description" type="text"
        						placeholder="Saisissez la description" class="form-control input-xlarge">
        
        				</div>
        			</div><br>
        
        			<!-- Text input-->
        			<div class="control-group">
        				<label class="control-label" for="url">URL</label>
        				<div class="controls">
        					<input id="url" name="url" type="text"
        						placeholder="Saisissez l'adresse web" class="form-control input-xlarge">
        
        				</div>
        			</div><br>
        
        			<!-- Button (Double) -->
        			<div class="control-group">
        				<label class="control-label" for="submit"></label>
        				<div class="controls">
        					<button id="submit" name="submit" value="create" class="btn btn-success">Enregistrer</button>
        					<button id="reset" name="reset" value= "reset" class="btn btn-danger">Réinitialiser</button>
        				</div>
        			</div><br>
        
        		</fieldset>
        	</form>
        	<a href="index.php" class="btn btn-info">Revenir à l'accueil</a>
        </div>
<?php
    require_once '../layout/footer.php';
?>
        

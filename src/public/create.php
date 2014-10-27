        <?php
            if (isset($_POST['submit']) && $_POST['submit'] == 'create'){
                require_once '../bdd/address.php';
                //$dataClean = clean($_POST);
                create($pdo, $_POST);
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
        
        			<!-- Text input-->
        			<div class="control-group">
        				<label class="control-label" for="title">Titre</label>
        				<div class="controls">
        					<input id="title" name="title" type="text"
        						placeholder="Saisissez le titre" class="input-xlarge">
        				</div>
        			</div><br>
        
        			<!-- Textarea -->
        			<div class="control-group">
        				<label class="control-label" for="address">Adresse</label>
        				<div class="controls">
        					<textarea id="address" name="address"
        						placeholder="Saisissez l'adresse"></textarea>
        				</div>
        			</div><br>
        
        			<!-- Text input-->
        			<div class="control-group">
        				<label class="control-label" for="description">Description</label>
        				<div class="controls">
        					<input id="description" name="description" type="text"
        						placeholder="Saisissez la description" class="input-xlarge">
        
        				</div>
        			</div><br>
        
        			<!-- Text input-->
        			<div class="control-group">
        				<label class="control-label" for="url">URL</label>
        				<div class="controls">
        					<input id="url" name="url" type="text"
        						placeholder="Saisissez l'adresse web" class="input-xlarge">
        
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
        </div>
<?php
    require_once '../layout/footer.php';
?>
        

        <?php
            var_dump($_POST);
        
            if (isset($_POST['submit']) && $_POST['submit'] == 'update'){
                require_once '../bdd/address.php';
                //$dataClean = clean($_POST);
                update($pdo, $_POST);
            }
            $afterBootstrap = '<link href="css/main.css" rel="stylesheet">';
            $title = "Modification d'un contact";
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
        					<input id="title" name="title" type="text" class="input-xlarge" 
        					   value="<?php if (isset($_POST['title'])){echo $_POST['title'];} ?>">
        				</div>
        			</div><br>
        
        			<!-- Textarea -->
        			<div class="control-group">
        				<label class="control-label" for="address">Adresse</label>
        				<div class="controls">
        					<textarea id="address" name="address"><?php if (isset($_POST['address'])){echo $_POST['address'];} ?></textarea>
        				</div>
        			</div><br>
        
        			<!-- Text input-->
        			<div class="control-group">
        				<label class="control-label" for="description">Description</label>
        				<div class="controls">
        					<input id="description" name="description" type="text" class="input-xlarge"
        					   value="<?php if (isset($_POST['description'])){echo $_POST['description'];} ?>">
        				</div>
        			</div><br>
        
        			<!-- Text input-->
        			<div class="control-group">
        				<label class="control-label" for="url">URL</label>
        				<div class="controls">
        					<input id="url" name="url" type="text" class="input-xlarge"
        					   value="<?php if (isset($_POST['url'])){echo $_POST['url'];} ?>">
        				</div>
        			</div><br>
        
        			<!-- Button (Double) -->
        			<div class="control-group">
        				<label class="control-label" for="submit"></label>
        				<div class="controls">
        					<button id="submit" name="submit" value="update" class="btn btn-success">Mettre à jour</button>
        				</div>
        			</div><br>
        
        		</fieldset>
        	</form>
        </div>
<?php
    require_once '../layout/footer.php';
?>
        

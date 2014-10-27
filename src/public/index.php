<?php
    $afterBootstrap = '<link href="css/main.css" rel="stylesheet">';
    $title = "Carnet d'adresses";
    require_once '../layout/header.php';
?>
<div class="container content">
	<form class="form-horizontal" method="POST" action="processing.php">
		<fieldset>
			<!-- Form Name -->
			<legend>Que désirez-vous faire ?</legend>
			
			<!-- Button -->
			<div class="control-group">
				<label class="control-label" for="create">Ajouter une adresse</label>
				<div class="controls">
					<button id="create" name="create" class="btn btn-info" value="create">Ajouter</button>
				</div>
			</div><br>

			<!-- Button -->
			<div class="control-group">
				<label class="control-label" for="update">Modifier une adresse</label>
				<div class="controls">
					<button id="update" name="update" class="btn btn-info" value="update">Modifier</button>
				</div>
			</div><br>

			<!-- Button -->
			<div class="control-group">
				<label class="control-label" for="delete">Supprimer une adresse</label>
				<div class="controls">
					<button id="delete" name="delete" class="btn btn-info" value="delete">Supprimer</button>
				</div>
			</div><br>

			<!-- Button -->
			<div class="control-group">
				<label class="control-label" for="read">Voir les adresses</label>
				<div class="controls">
					<button id="read" name="read" class="btn btn-info" value="read">Voir</button>
				</div>
			</div><br>

		</fieldset>
	</form>
</div>
<?php 
    require_once '../layout/footer.php';
?>

<?php
    $afterBootstrap = '<link href="css/main.css" rel="stylesheet">';
    $title = "Carnet d'adresses";
    require_once '../layout/header.php';
?>
        <div class="container content">
        	<h4>Que désirez-vous faire ?</h4>
        	<br>
        
        	<!-- Link -->
        	<div>
        		<p>
        			Ajouter un contact&nbsp;&nbsp;&nbsp;&nbsp; <a href="create.php"
        				class="btn btn-info">Ajouter</a>
        		</p>
        	</div>
        	<br>

        	<!-- Link -->
        	<div>
        		<p>
        			Importer des contacts&nbsp;&nbsp;&nbsp;&nbsp; <a href="createSeveral.php"
        				class="btn btn-info">Importer</a>
        		</p>
        	</div>
        	<br>        	
        	
        	<!-- Link -->
        	<div>
        		<p>
        			Voir les contacts&nbsp;&nbsp;&nbsp;&nbsp; <a href="read.php"
        				class="btn btn-info">Voir les contacts</a>
        		</p>
        	</div>
        	<br>
        </div>
<?php 
    require_once '../layout/footer.php';
?>

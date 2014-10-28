<?php
    $afterBootstrap = '<link href="css/main.css" rel="stylesheet">';
    $title = "Importation de contacts";
    require_once '../layout/header.php';

     if (isset($_POST['submit']) && $_POST['submit'] == 'import'){
     /****************************************/
         
         //header('Content-Type: text/plain; charset=utf-8');
         
         try {
         
             // Undefined | Multiple Files | $_FILES Corruption Attack
             // If this request falls under any of them, treat it invalid.
             if ( !isset($_FILES['addressFile']['error']) ||
                is_array($_FILES['addressFile']['error']) ) {
                    throw new RuntimeException('Invalid parameters.');
             }
         
             // Check $_FILES['addressFile']['error'] value.
             switch ($_FILES['addressFile']['error']) {
                 case UPLOAD_ERR_OK:
                     break;
                 case UPLOAD_ERR_NO_FILE:
                     throw new RuntimeException('No file sent.');
                 case UPLOAD_ERR_INI_SIZE:
                 case UPLOAD_ERR_FORM_SIZE:
                     throw new RuntimeException('Exceeded filesize limit.');
                 default:
                     throw new RuntimeException('Unknown errors.');
             }
         
             // You should also check filesize here.
             if ($_FILES['addressFile']['size'] > 1000000) {
                 throw new RuntimeException('Exceeded filesize limit.');
             }
         
             // DO NOT TRUST $_FILES['addressFile']['mime'] VALUE !!
             // Check MIME Type by yourself.
             $finfo = new finfo(FILEINFO_MIME_TYPE);
             if ( false === $ext = array_search(
                 $finfo->file($_FILES['addressFile']['tmp_name']),
                 array('csv' => 'text/plain'),
                 true) ) {
                    throw new RuntimeException('Invalid file format.');
             }
         
             // You should name it uniquely.
             // DO NOT USE $_FILES['addressFile']['name'] WITHOUT ANY VALIDATION !!
             // On this example, obtain safe unique name from its binary data.
             var_dump($_FILES['addressFile']['tmp_name']);
             var_dump(sha1_file($_FILES['addressFile']['tmp_name']));
             var_dump(basename($_FILES['addressFile']['tmp_name']));
             if (!move_uploaded_file(
                 $_FILES['addressFile']['tmp_name'],
                 sprintf('./uploads/%s.%s',
                     sha1_file($_FILES['addressFile']['tmp_name']),
                     $ext)
             )) {
                 throw new RuntimeException('Failed to move uploaded file.');
             }
         
             $html = '<p>File is uploaded successfully.</p>';
             $html .= '<div class="container content">';
         
         } catch (RuntimeException $e) {
         
             echo $e->getMessage();
         
         }
         echo $html;
     /****************************************/
     }else {

?>
        <!-- input file Form -->
        <div class="container content">
        	<form enctype="multipart/form-data" class="form-horizontal" method="POST" action="">
        		<fieldset>
        
        			<!-- Form Name -->
        			<legend>Ajouter des contacts à partir d'un fichier .csv</legend>
        			
        			<!-- MAX_FILE_SIZE doit précéder le champ input de type file -->
                    <div class="control-group">
        				<div class="controls">
                            <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                        </div>
                    </div> 
       
        			<!-- Text input-->
        			<div class="control-group">
        				<label class="control-label" for="inputFile">Fichier à importer</label>
        				<div class="controls">
        					<input id="addressFile" name="addressFile" type="file">
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
        </div>
<?php
     }

    require_once '../layout/footer.php';
?>
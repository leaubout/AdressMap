<?php
    $title = "Modification d'un contact";
    require_once '../bdd/address.php';

    $post = FALSE;
    
    // on arrive soit depuis la page read.php
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $address = array();
        /* une requête SELECT renvoie un tableau d'enregistrements stockés eux-même en tableau, 
         * ici le tableau ne contient qu'un élément
         */
        $address = readOne($pdo,$id)[0];
    // soit après rechargement de cette page sans paramètres dans l'URL suite à la soumission du formulaire        
    } else if (isset($_POST['submit']) && $_POST['submit'] == 'update'){
        $post = TRUE;
        $address = cleanData($_POST);
        $bool = FALSE;
        $bool = update($pdo, $address);
    }
    $afterBootstrap = '<link href="css/main.css" rel="stylesheet">';
    $title = "Modification d'un contact";
    require_once '../layout/header.php';
?>
        <div class="container content">
        	<form class="form-horizontal" method="POST" action="update.php">
        		<fieldset>
        
        			<!-- Form Name -->
        			<legend>Modification d'un contact</legend>
        			
        			<!-- Alert Div  -->
                <?php if (isset($bool) && $bool == TRUE){?>
        			<div class="alert alert-success" role="alert">
        			     <p>Le contact <?= $address['title'] ?> a bien été modifié<br>
        			     </p><br>
        			</div>    
                <?php } else if (isset($bool) && $bool == FALSE){?>
                    <div class="alert alert-warning" role="alert">
            		      <p>Désolé, le contact <?= $address['title'] ?> n'a pas pu être modifié<br></p>
            		</div>        			             
        		<?php }?>    
        			
        			<!-- Hidden input-->
        			<!-- pour avoir l'id dans le $_POST, bien que non modifiable par l'utilisateur -->
                    <input type="hidden" name="id" id="id" value="<?php if (isset($address)){
                                                                            echo $address['id'];
        			                                                     }?>" <?php if ($post) { echo "disabled";} ?>>
        
        			<!-- Text input-->
        			<div class="control-group">
        				<label class="control-label" for="title">Titre</label>
        				<div class="controls">
        					<input id="title" name="title" type="text" class="input-xlarge" 
        					   value="<?php if (isset($address)){
        					                   echo $address['title'];
        					                }?>" <?php if ($post) { echo "disabled";} ?> >
        				</div>
        			</div><br>
        
        			<!-- Textarea -->
        			<div class="control-group">
        				<label class="control-label" for="address">Adresse</label>
        				<div class="controls">
        					<textarea id="address" name="address" <?php if ($post) { echo "disabled";} ?> ><?php if (isset($address)){
                                                                            echo $address['address'];
        					                                            }?>
        					</textarea>
        				</div>
        			</div><br>
        
        			<!-- Text input-->
        			<div class="control-group">
        				<label class="control-label" for="description">Description</label>
        				<div class="controls">
        					<input id="description" name="description" type="text" class="input-xlarge"
        					   value="<?php if (isset($address)){
        					                   echo $address['description'];
        					                }?>" <?php if ($post) { echo "disabled";} ?>>
        				</div>
        			</div><br>
        
        			<!-- Text input-->
        			<div class="control-group">
        				<label class="control-label" for="url">URL</label>
        				<div class="controls">
        					<input id="url" name="url" type="text" class="input-xlarge"
        					   value="<?php if (isset($address)){
        					                   echo $address['url'];
        					                }?>" <?php if ($post) { echo "disabled";} ?>>
        				</div>
        			</div><br>
        
        			<!-- Button (Double) -->
        			<div class="control-group">
        				<label class="control-label" for="submit"></label>
        				<div class="controls">
        				<?php if (!$post){ ?>
        					<button id="submit" name="submit" value="update" class="btn btn-success">Modifier le contact</button>
        			    <?php } else { ?>
        			         <a href="read.php" class="btn btn-success">Retourner à la liste des contacts</a>
        			         <a href="index.php" class="btn btn-success">Retourner à l'index</a>
        			    <?php } ?>
        				</div>
        			</div><br>
        
        		</fieldset>
        	</form>
        </div>
<?php
    require_once '../layout/footer.php';
?>
        

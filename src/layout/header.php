<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php if(isset($title)){echo $title;};?></title>

        <!-- Bootstrap -->
        <link href="assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/bootflatv2/bootflat/css/bootflat.min.css" rel="stylesheet">
        <?php if(isset($afterBootstrap)) {echo $afterBootstrap;}?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="assets/html5shiv/dist/html5shiv.min.js"></script>
            <script src="assets/respond/dest/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
    <?php //require_once '../layout/menu.php';?>
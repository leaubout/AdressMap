<?php
    if (isset($_POST['create']) && $_POST['create'] == 'create'){
        header("Location: create.php");
    }else if (isset($_POST['update']) && $_POST['update'] == 'update'){
        header("Location: update.php");
    }else if (isset($_POST['delete']) && $_POST['delete'] == 'delete'){
        header("Location: delete.php");
    }else if (isset($_POST['read']) && $_POST['read'] == 'read'){
        header("Location: read.php");
    }else{
        header("Location: index.php");
    }
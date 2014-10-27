        <?php if(isset($beforejQuery)){
            echo $beforejQuery;
        }?>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="assets/jquery/dist/jquery.min.js"></script>
        <?= (isset($afterjQuery))? $afterjQuery : "";?>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="assets/bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>
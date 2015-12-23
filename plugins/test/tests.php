<!DOCTYPE html>
<html>
    <head></head>
    <body>
    <?php $test = 'Test*!'; ?>
    <script>
        var test = '<?php echo $test; ?>';
        alert(test);
    </script>
    </body>
</html>
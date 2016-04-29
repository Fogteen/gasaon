<!DOCTYPE html>
<html lang="en">
<head>

    <?php echo $this->Html->charset("utf-8"); ?>
    <title>
        <?php echo $this->fetch('title'); ?>
    </title>
    <?php
    echo $this->Html->css(array('bootstrap.min','plugins/font-awesome.min','plugins/simple-line-icons','plugins/animate.min','plugins/icheck/skins/flat/aero','plugins/datatables.bootstrap.min.css','style'));

?>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>

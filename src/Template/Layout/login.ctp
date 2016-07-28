<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>DASHGUM - Bootstrap Admin Template</title>

    <!-- Bootstrap core CSS -->
    <?php echo $this->Html->css(array('bootstrap'));?>
    <!--external css-->
    <?php echo $this->Html->css(array('font-awesome/css/font-awesome'));?>

    <!-- Custom styles for this template -->
    <?php echo $this->Html->css(array('style', 'style-responsive'));?>
    <?php echo $this->fetch('cssTop'); ?>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<!-- **********************************************************************************************************************************************************
MAIN CONTENT
*********************************************************************************************************************************************************** -->


<div id="login-page">
    <div class="container">
        <?php echo $this->fetch('content'); ?>
    </div>
</div>

<!-- js placed at the end of the document so the pages load faster -->
<?php echo $this->Html->script(array('jquery', 'bootstrap.min'));?>

<!--BACKSTRETCH-->
<!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
<?php echo $this->Html->script(array('jquery.backstretch.min'));?>
<script>
    $.backstretch("assets/img/login-bg.jpg", {speed: 500});
</script>

<?php echo $this->fetch('jsBottom'); ?>
</body>
</html>

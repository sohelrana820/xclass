<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title><?php echo $this->fetch('title');?> - <?php echo $title; ?></title>

    <!-- Bootstrap core CSS -->
    <?php echo $this->Html->css(array('bootstrap', 'font-awesome/css/font-awesome',));?>
    <!--external css-->
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <?php echo $this->Html->css(array('login'));?>
    <?php echo $this->fetch('cssTop'); ?>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div id="login-page">
    <div class="container">
        <div class="container">
            <div class="row ">
                <div class="col-md-8 col-md-offset-2 margin-top-125">
                    <?php echo $this->Flash->render() ?>
                    <div class="login-widget">
                        <div style="text-align: center; ">
                            <?php echo $this->Html->image($appsLogo, ['controller' => 'users', 'action' => 'installation'], ['class' => 'title']);;?>
                        </div>
                        <br>
                        <?php echo $this->fetch('content'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
echo $this->Html->script(array('jquery', 'bootstrap.min', 'custom'));
echo $this->fetch('jsBottom');
?>
</body>
</html>
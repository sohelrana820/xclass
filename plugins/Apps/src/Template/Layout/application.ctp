<!DOCTYPE html>
<html lang="en"  ng-app="Application">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $this->fetch('title');?> - <?php echo $title; ?></title>

    <?php
    echo $this->Html->css(array('bootstrap.min', 'sb-admin', 'plugins/morris', 'font-awesome/css/font-awesome', 'angularjs-color-picker.min.css', 'style.css'));
    echo $this->fetch('cssTop');
    echo $this->fetch('jsTop');
    ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body ng-controller="MainsCtrl">

<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">
                    <?php echo $this->Html->link($appsName, ['controller' => 'dashboard', 'action' => 'index'], ['class' => 'navbar-brand']);?>
                </span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php echo $this->Html->link($appsName, ['controller' => 'dashboard', 'action' => 'index'], ['class' => 'navbar-brand']);?>
        </div>
        <!-- Top Menu Items -->
        <?php echo $this->element('header');?>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <?php echo $this->element('sidebar');?>
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">
            <?php echo $this->Flash->render() ?>
            <?php echo $this->fetch('content'); ?>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<?php
echo $this->Html->script(array('jquery', 'bootstrap.min', 'custom'));
echo $this->Html->script(['angular.min', 'angular-resource.min', 'textAngular-rangy.min.js', 'textAngular-sanitize.min.js', 'textAngular.min.js', 'tinycolor-min.js', 'angularjs-color-picker.min.js']);
echo $this->Html->script(['src/app', 'src/factories']);
echo $this->fetch('jsBottom');
?>
</body>
</html>
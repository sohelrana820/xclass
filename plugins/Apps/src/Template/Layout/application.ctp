<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <?php echo $this->Html->meta('favicon.ico','/favicon.ico', ['type' => 'icon']);?>
    <title><?php echo $this->fetch('title');?> - <?php echo $title; ?></title>

    <?php
    echo $this->Html->css([
        'bootstrap.min',
        'font-awesome/css/font-awesome',
        'main',
        'style.css'
    ]);
    echo '<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">';

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
<body class="body-color">

<div id="wrapper">
    <!-- Sidebar -->
    <?php echo $userInfo->role == 1 ? $this->element('admin-sidebar') : $this->element('user-sidebar');?>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <button href="#menu-toggle" class="wrapper_toggle_btn" id="menu-toggle">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <div class="clearfix"></div>
        <!-- Header -->
        <?php echo $this->element('header');?>
        <!-- /#header -->

        <!-- Content area -->
        <div id="content-area">
            <?php echo $this->Flash->render() ?>
            <flash-message></flash-message>
            <div class="container-fluid">
                <?php echo $this->fetch('content'); ?>
            </div>
        </div>
        <!-- /#Content area -->
    </div>
    <!-- /#page-content-wrapper -->
</div>
<!-- /#wrapper -->

<?php
echo $this->Html->script(array('jquery', 'bootstrap.min', 'theme'));
echo $this->fetch('jsBottom');
?>
</body>
</html>

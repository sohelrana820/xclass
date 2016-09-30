<!DOCTYPE html>
<html lang="en"  ng-app="Application">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $this->fetch('title');?> - <?php echo $title; ?></title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nvd3/1.8.1/nv.d3.min.css"/>
    <?php
    echo $this->Html->css(array('bootstrap.min', 'plugins/morris', 'font-awesome/css/font-awesome', 'angularjs-color-picker.min.css', 'angular-toastr.css', 'angular-block', 'kits/kit-9' , 'kits/kit-22', 'kits/kit-19', 'main', 'style.css'));
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
<body class="body-color" ng-controller="MainsCtrl" ng-cloak>

<div id="wrapper">
    <!-- Sidebar -->
    <?php echo $this->element('sidebar');?>
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
        <div class="container-fluid">
            <div class="content-area">
                <?php echo $this->Flash->render() ?>
                <flash-message></flash-message>
                <?php echo $this->fetch('content'); ?>
            </div>
        </div>
        <!-- /#Content area -->

        <!-- Footer area -->
        <footer class="footer">
            <div class="container-fluid">
                <p class="copy-text">Copyright All Rights Reserved by Preview Technologies Limited © 2016</p>
            </div>
        </footer>
        <!-- /#Footer area -->
    </div>
    <!-- /#page-content-wrapper -->
</div>
<!-- /#wrapper -->


<?php
echo $this->Html->script(array('jquery', 'bootstrap.min', 'theme'));
echo $this->Html->script(['angular.min', 'angular-resource.min', 'textAngular-rangy.min.js', 'textAngular-sanitize.min.js', 'textAngular.min.js', 'tinycolor-min.js', 'angularjs-color-picker.min.js', 'angular-flash.min', 'angular-toastr.tpls.js', 'ng-file-upload-shim.min.js', 'ng-file-upload.min.js', 'angular-block-ui']);
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.6/d3.min.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/nvd3/1.8.1/nv.d3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-nvd3/1.0.5/angular-nvd3.min.js"></script>

<?php
echo $this->Html->script(['src/app', 'src/factories']);
echo $this->fetch('jsBottom');
?>

<script>
    localStorage.setItem("BASE_URL", '<?php echo $baseUrl;?>');
</script>
<?php ?>

</body>
</html>

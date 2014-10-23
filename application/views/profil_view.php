<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>OpenNote</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/sb-admin-2/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css"/>
    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url('assets/sb-admin-2/css/plugins/metisMenu/metisMenu.min.css');?>" rel="stylesheet" type="text/css"/>
    <!-- Timeline CSS -->
    <link href="<?php echo base_url('assets/sb-admin-2/css/plugins/timeline.css');?>" rel="stylesheet" type="text/css"/>
    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/sb-admin-2/css/sb-admin-2.css');?>" rel="stylesheet" type="text/css"/>
    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url('assets/sb-admin-2/css/plugins/morris.css');?>" rel="stylesheet" type="text/css"/>
    <!-- Custom Fonts -->
    <link href="<?php echo base_url('assets/sb-admin-2/font-awesome-4.1.0/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="accueil">OpenNote</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="profil"><i class="fa fa-user fa-fw"></i> Mon profil</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="accueil/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a class="active" href="#"><i class="fa fa-dashboard fa-fw"></i> Ma Page de profil</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Mes catégories</a>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Votre profil</h1>
                </div>
                <?php echo validation_errors(); ?>
                <?php echo form_open('profil/edit'); ?>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label>Avatar</label><br />
                        <img src="<?php echo base_url('assets/image/avatarDefault.png'); ?>" alt="Avatar par défaut" />
                        <input id="avatar" name="avatar" style="display: none" type="file">
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label>Nom :</label>
                            </div>
                            <div class="col-sm-8">
                                <div id="name"><?php echo $name; ?></div>
                                <input id ="saveName" name="name" style="display: none" class="form-control" value="<?php echo $name; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label>Prénom :</label>
                            </div>
                            <div class="col-lg-8">
                                <div id="firstname"><?php echo $firstname; ?></div>
                                <input id ="saveFirstname" name="firstname" style="display: none" class="form-control" value="<?php echo $firstname; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label>Sexe :</label>
                            </div>
                            <div id="sexe" class="col-lg-8">
                                <?php echo $sexe; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label>Groupe :</label>
                            </div>
                            <div class="col-lg-8">
                                <?php echo $groupe; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label>Adresse mail :</label>
                            </div>
                            <div class="col-lg-8">
                                <div id="email"><?php echo $username; ?></div>
                                <input id ="saveEmail" name="email" style="display: none" class="form-control" value="<?php echo $username; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label>Date d'anniversaire :</label>
                            </div>
                            <div class="col-lg-4">
                                <?php echo $birthday; ?>
                            </div>
                        </div>
                        <button id="change" type="button" class="btn btn-primary btn-lg btn-block">Envie de changer vos informations ?</button>
                        <button id="save" style="display: none" type="submit" class="btn btn-primary btn-lg btn-block">Enregistrez vos changements</button>
                    </div>
                </div>
                
                </form>
                <br />
                <br />
                <!-- /.col-lg-12 -->
            </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    <script src="<?php echo base_url('assets/sb-admin-2/js/jquery-1.11.0.js');?>" type="text/javascript"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('assets/sb-admin-2/js/bootstrap.min.js');?>" type="text/javascript"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url('assets/sb-admin-2/js/plugins/metisMenu/metisMenu.min.js');?>" type="text/javascript"></script>
    <!-- Morris Charts JavaScript
    <script src="<?php echo base_url('assets/sb-admin-2/js/plugins/morris/morris-data.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/sb-admin-2/js/plugins/morris/morris.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/sb-admin-2/js/plugins/morris/raphael.min.js');?>" type="text/javascript"></script>
    Custom Theme JavaScript -->
    <script src="<?php echo base_url('assets/sb-admin-2/js/sb-admin-2.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/custom/custom.js');?>" type="text/javascript"></script>
 <script>
       jQuery(document).ready(function(){
           edit();
       });
 </script>               
                
</body>

</html>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>OpenNote - paiement</title>

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
                        <li><a href="administration"><i class="fa fa-gear fa-fw"></i> Administration</a>
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
                            <a class="active" href="index.html"><i class="fa fa-dashboard fa-fw"></i> Comptabilité</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Cours informatique <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="flot.html">Intégration technologique</a>
                                </li>
                                <li>
                                    <a href="morris.html">Routages et commutations</a>
                                </li>
                                <li>
                                    <a href="morris.html">Sécurité réseaux</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="tables.html"><i class="fa fa-table fa-fw"></i> Marketing</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Information sur les offres payantes</h1>
                </div>
                <br />
                <ul>
                    <li>Différents aspects de la vente concernant notre projet :</li>
                    <br />
                    <ul>
                        <li>Solutions Grand Volume (installation sur parc informatique du client) :
                            <ul>
                                <li>300 utilisateurs : 5€ / mois / utilisateur</li>
                                <li>300 - 1000 utilisateurs : 4,5 € /mois /utilisateur</li>
                                <li>1000 - 10000 utilisateurs : 4 € /mois /utilisateur</li>
                                <li> +10000 : 3 € /mois /utilisateurs</li>
                                <br />
                                <li>import data utilisateurs : forfait 500 €</li>
                                <li>Offre gratuite de l'installation matérielle</li>
                            </ul>
                        </li>
                        <br />
                        <li>Solutions clés en main pour particuliers (jusqu'à 15 personnes) :
                            <ul>
                                <li>Sans fournir de serveur : Gratuit</li>
                                <li>Serveurs :
                                    <ul>
                                        <li>Basique : VPS 25 Go : 8 € /mois</li>
                                        <li>Pro : VPS 50 Go : 15 € / mois</li>
                                        <li>Premium : VPS 100 Go : 25 € / mois</li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <br />
                        <li>Solutions de support :
                            <ul>
                                <li>support en ligne : 100 € par mois</li>
                                <li>support physique : facturé à l'heure : 60 € / heure</li>
                            </ul>
                        </li>
                        <br />
                        <li>Modules :
                            <ul>
                                <li>
                                    de base :
                                    <ul>
                                        <li>Forum : 2000 €</li>
                                        <li>Editeur LaTeX : 1000 €</li>
                                        <li>Système de chat : 500 €</li>
                                        <li>Possibilité d'upload de pièces jointes aux notes : 750 €</li>
                                        <li>Recherche interne aux notes : 500 €</li>
                                        <li>Gestion d'agendas et de calendriers : 500 €</li>
                                        <li>Google Analytics (Reporting de l'activité sur le site) : 500 €</li>
                                    </ul>
                                </li>
                                <li>personnalisés : € sur devis.</li>
                            </ul>
                        </li>
                        <br />
                        <li>Design personnalisé du site internet et de l'application mobile : 4000 €</li>
                        <br />
                        <li>Moyens de paiement :
                            <div class="row">
                                <div class="col-md-3">
                                    <?php
                                        echo '<img src="';
                                        echo base_url('assets/image/VISA.gif');
                                        echo '" alt="Paiement Visa" />';
                                    ?>
                                </div>
                                <div class="col-md-3">
                                    <?php
                                        echo '<img src="';
                                        echo base_url('assets/image/mastercard.jpg');
                                        echo '" alt="Paiement Master Card" />';
                                    ?>
                                </div>
                                <div class="col-md-3">
                                    <?php
                                        echo '<img src="';
                                        echo base_url('assets/image/logo-cb.png');
                                        echo '" alt="Paiement carte bleue" />';
                                    ?>
                                </div>
                                <div class="col-md-3">
                                    <?php
                                        echo '<img src="';
                                        echo base_url('assets/image/American-Express.png');
                                        echo '" alt="Paiement American Express" />';
                                    ?>
                                </div>
                            </div>
                        </li>
                    </ul>
                </ul>
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
</body>

</html>




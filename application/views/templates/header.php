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
    <link href="<?php echo base_url('assets/custom/custom.css');?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url('assets/sb-admin-2/css/sb-admin-2.css');?>" rel="stylesheet" type="text/css"/>
    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url('assets/sb-admin-2/css/plugins/morris.css');?>" rel="stylesheet" type="text/css"/>
    <!-- Custom Fonts -->
    <link href="<?php echo base_url('assets/sb-admin-2/font-awesome-4.1.0/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css"/>
    <!-- Page-Level Plugin CSS - Tables -->
    <link href="<?php echo base_url('assets/sb-admin-2/css/plugins/dataTables.responsive.css'); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/sb-admin-2/css/plugins/dataTables.bootstrap.css'); ?>" rel="stylesheet" type="text/css">

    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- JS LOAD -->
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

    <!-- Data Tables Plugin -->
    <script href="<?php echo base_url('assets/sb-admin-2/js/plugins/dataTables/dataTables.bootstrap.js'); ?>" type="text/javascript"></script>
    <script href="<?php echo base_url('assets/sb-admin-2/js/plugins/dataTables/jquery.dataTables.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/custom/custom.js');?>" type="text/javascript"></script>
    <!--CK editor !-->
    <script src="<?php echo base_url('assets/ckeditor/ckeditor.js');?>" type="text/javascript"></script>
    <!-- DataTables JavaScript -->
    <script src=" <?php echo base_url('assets/sb-admin-2/js/plugins/dataTables/jquery.dataTables.js'); ?>"></script>
    <script src="<?php echo base_url('assets/sb-admin-2/js/plugins/dataTables/dataTables.bootstrap.js'); ?>"></script>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <span class="navbar-text"><?php echo $date; ?><span id="id39018"> </span></span>
                <script defer src="<?php echo base_url('assets/sb-admin-2/js/gettime.js');?>"></script>
                <!-- <a class="navbar-brand" href="accueil">OpenNote</a> | -->
            </div>
            
            <!-- /.navbar-header -->
            
            <ul class="nav navbar-top-links navbar-right">
                <a href="<?php echo base_url('profil'); ?>">
                    <li class="firstname-name">
                    <?php 
                        $session_data = $this->session->userdata('logged_in');
                        $data['id'] = $session_data['id'];
                        $user_page = $this->user->user_data($data['id']);
                        echo $user_page['firstname']." ".$user_page['name']; ?>
                    </li>
                </a>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <?php
                        $three_last_message = $this->conversation_model->get_three_last_message();
                        foreach($three_last_message as $message)
                        {
                            $user = $this->user->user_data($message['user_id']);
                            echo'<li>
                            <a href="'.base_url('message/voir?id=').''.$message['conversation_id'].'">
                                <div>
                                    <strong>'.$user['firstname'].' '.$user['name'].'</strong>
                                    <span class="pull-right text-muted">
                                        <em>'.$message['date_creation'].'</em>
                                    </span>
                                </div>
                                <div>'.$message['message'].'</div>
                            </a>
                        </li>
                        <li class="divider"></li>';
                        }
                        ?>
                        <li>
                            <a class="text-center" href="<?php echo base_url('message'); ?>">
                                <strong>Lire tout les messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo base_url("profil"); ?>"><i class="fa fa-user fa-fw"></i> Mon profil</a>
                        </li>
                        <li><a href="<?php echo base_url("administration");?>"><i class="fa fa-wrench fa-fw"></i> Administration</a>
                        </li>
                        <?php 
                        if($this->user->is_moderator($session_data['id'])){
                            echo '<li>';
                            echo '<a href="' . base_url('moderation') .'">';
                            echo '<i class="fa fa-cog fa-fw"></i>';
                            echo 'Modération</a>';
                            echo '</li>';
                        }                       
                        ?>
                        
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url("accueil/logout");?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>

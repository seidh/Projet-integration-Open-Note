<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>OpenNote - Récupération de votre mot de passe</title>
    
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/sb-admin-2/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css"/>
    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url('assets/sb-admin-2/css/plugins/metisMenu/metisMenu.min.css');?>" rel="stylesheet" type="text/css"/>
    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/sb-admin-2/css/sb-admin-2.css');?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url('assets/custom/custom.css');?>" rel="stylesheet" type="text/css"/>
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

    <div class="container">
        <div class="row">
            <div class="col-lg-12 center">
                <div class="logo_container"">
                    <span class="front-logo"><span class="inner_logo"></span></span>                        
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Récupération de votre mot de passe</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo validation_errors(); ?>
                        <?php echo form_open('recovery_pwd/recovery'); ?>
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Votre nouveau mot de passe" name="pwd1" id="pwd1" type="password" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Retappez votre nouveau mot de passe" name="pwd2" id="pwd2" type="password" value="">
                                    <input class="form-control"  name="cle" id="cle" type="text" style="display: none" value="
                                        <?php 
                                        if($this->input->get('cle',TRUE) != '')
                                        {
                                            echo $this->input->get('cle',TRUE); 
                                        }
                                        else
                                        {
                                            echo $cle;
                                        }
                                        ?>">
                                </div>
                                <input type="submit" value="Récupération du mot de passe" class="btn btn-lg btn-success btn-block"/>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery Version 1.11.0 -->
    <script src="<?php echo base_url('assets/sb-admin-2/js/jquery-1.11.0.js');?>" type="text/javascript"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('assets/sb-admin-2/js/bootstrap.min.js');?>" type="text/javascript"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url('assets/sb-admin-2/js/plugins/metisMenu/metisMenu.min.js');?>" type="text/javascript"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url('assets/sb-admin-2/js/sb-admin-2.js');?>" type="text/javascript"></script>

</body>

</html>




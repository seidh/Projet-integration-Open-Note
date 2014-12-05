<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <div class="input-group">
                    <span class="navbar-brand sidebarLogo"><a href="<?php echo base_url('accueil') ?>"></a></span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="<?php echo base_url('administration'); ?>"><i class="fa fa-wrench fa-fw"></i>Administration</a>
            </li>                          
            <li>
                <a class="active" href="#"><i class="fa fa-users fa-fw"></i>Utilisateurs<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo base_url('administration/userlist'); ?>">Liste d'utilisateurs</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('administration/newuserform'); ?>">Ajout d'un utilisateur</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="<?php echo base_url('administration/moderatorsList'); ?>"><i class="fa fa-life-ring fa-fw"></i>Modérateurs</a>
            </li>                        
            <li>
                <a href="#"><i class="fa fa-sitemap fa-fw"></i>Catégorie<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo base_url('administration/categoriesList'); ?>">Liste des catégories</a>
                    </li>
                    <li>
                        <a href="morris.html">Créer une nouvelle catégorie</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="<?php echo base_url('payment'); ?>"><i class="fa fa-euro fa-fw"></i>Informations de paiement</a>
            </li>   
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>
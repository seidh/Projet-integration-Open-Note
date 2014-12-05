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
                <a href="<?php echo base_url('administration'); ?>"><i class="fa fa-wrench fa-fw"></i> Administration</a>
            </li>     
                        <li>
                <a href="<?php echo base_url('administration/noteslist'); ?>"><i class="fa fa-file-text fa-fw"></i> Toutes les notes</a>
            </li>  
            <li>
                <a class="active" href="<?php echo base_url('administration/userlist'); ?>"><i class="fa fa-users fa-fw"></i> Utilisateurs</a>
                
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="<?php echo base_url('administration/moderatorsList'); ?>"><i class="fa fa-life-ring fa-fw"></i> Modérateurs</a>
            </li>                        
            <li>
                <a href="<?php echo base_url('administration/categoriesList'); ?>"><i class="fa fa-sitemap fa-fw"></i> Catégories</a>

                <!-- /.nav-second-level -->
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>
<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <span class="navbar-brand sidebarLogo"><a href="acceuil"></a></span>
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
                            <a href="../accueil"><i class="fa fa-life-ring fa-fw"></i>Modérateurs</a>
                        </li>                        
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i>Catégorie<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="flot.html">Liste des catégories</a>
                                </li>
                                <li>
                                    <a href="morris.html">Créer une nouvelle catégorie</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
            </nav>
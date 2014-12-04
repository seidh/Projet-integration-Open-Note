    <!-- Script for the active navbar -->
    <script type="text/javascript">
        activeNavbar();
    </script> 
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Administration</h1>
                </div>
                
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h3>Bienvenue sur votre page d'administration.</h3>
                    <p class="top15">Vous retrouverez ici tout le necéssaire pour gérer la plateforme.</p>
                    <p>Depuis ce panneau d'administration vous pourrez :
                    <ul>
                        <li>Lister les utilisateurs et leurs informations</li>
                        <li>Ajouter manuellement un nouvel utilisateur</li>
                        <li>Lister et gérer les modérateurs des catégories</li>
                        <li>Lister et gérer toutes les catégories présentes sur ce site</li>
                    </ul>
                    </p> 
                </div>
            </div>
            <div class="row">
                <hr />
                <div class="col-lg-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <b>Information sur cette installation</b>
                                </div>
                                <div class="panel-body">
                                    <?php 
                                        $nb_user = count($users_data);
                                        $nb_notes = count($notes_data);
                                        
                                        echo 'Nombre d\'utilisateurs enregistrés : '.$nb_user;
                                        echo '<br /><br />Nombre de notes hébergées : '.$nb_notes;
                                    ?>
                                </div>
                                <div class="panel-footer">
                                    
                                </div>
                            </div>
                        </div>
            </div>
            
        </div>
        <!-- /#page-wrapper -->

  
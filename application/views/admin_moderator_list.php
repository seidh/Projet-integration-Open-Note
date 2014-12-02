    <!-- Script for the active navbar -->
    <script type="text/javascript">
        activeNavbar();
        collapseMenu();
    </script> 
        <div id="page-wrapper">
            <div class="row">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Liste des modérateurs sur la plateforme</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-10 left">
                        <div class="table-responsive">
                            <div class="div-table-content">
                                <?php echo validation_errors();?>
                                <?php  //var_dump($category_data); ?>
                                <table id="modo_table" class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="col-md-2">Nom</th>
                                            <th class="col-md-2">Prénom</th>
                                            <th class="col-md-2">Pseudo</th>
                                            <th class="col-md-3">Email</th>
                                            <th class="col-md-3">Catégorie(s)</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            //var_dump($user_data);
                                            foreach ($moderators_data as $RawData) {
                                                //var_dump($RawData);
                                                
                                                $singleModo = $RawData;
                                                //echo $singleModo;                                        
                                                echo'<tr id='.$singleModo['id'].'>';
                                                
                                                echo'<td>'.$singleModo['name'].'</td>';
                                                echo'<td>'.$singleModo['firstname'].'</td>';
                                                echo'<td>'.$singleModo['pseudo'].'</td>';
                                                echo'<td>'.$singleModo['email'].'</td>';
                                                echo'<td>';                                                
                                                    foreach ($singleModo['moderate_cat'] as $cat){
                                                        echo '<i>'.$cat['name'].', </i>';
                                                    }
                                                echo'</td>';                                                



                                                echo'</tr>';
                                            }
                                        ?>                                        
                                    </tbody>
                                </table>
                            </div>                            
                        </div>
                    </div>
                    <div class="col-lg-12">
                        
                        <button id="addModoBtn" class="btn btn-primary" data-toggle="modal" data-target="#myModal">+</button> &nbsp;&nbsp;                                               
                        <button id="assignModoBtn" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">+</button>
                        
                    </div>
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Ajout d'un modérateur</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                Veuillez choisir un utilisateur dans la liste pour lui assigner les droits de modérateur.modérateur dans la liste de gauche et une catégorie dans la liste de droite.
                                            </div>
                                        </div>
                                        <div class="row top30">
                                            <div class="col-lg-6">
                                                <?php echo form_open("administration/addModoForm"); ?>
                                                <select class="form-control" name='user' required>
                                                <?php 
                                                    foreach ($users_data as $RawData) {
                                                        //var_dump($RawData);

                                                        $singleUser = get_object_vars($RawData);
                                                        //echo $singleModo;                                        
                                                        echo'<option value='.$singleUser['id'].'>'.$singleUser['firstname'].' '.$singleUser['name'].'</option>';
                                                    }                                            
                                                ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-6 top7"> 
                                                <input type='checkbox' name='confirm' required> Je confirme l'assignation</input>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" type='submit'>Save changes</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div> 
                    
                        <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Assignation d'une catégorie à un modérateur</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                Veuillez choisir un modérateur dans la liste de gauche et une catégorie dans la liste de droite.
                                            </div>
                                        </div>
                                        <div class="row top30">
                                            <div class="col-lg-6">
                                                <?php echo form_open("administration/addModoForm"); ?>
                                                <select class="form-control">
                                                <?php 
                                                    foreach ($moderators_data as $RawData) {
                                                        //var_dump($RawData);

                                                        $singleModo = $RawData;
                                                        //echo $singleModo;                                        
                                                        echo'<option value='.$singleModo['id'].'>'.$singleModo['firstname'].' '.$singleModo['name'].'</option>';
                                                    }                                            
                                                ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-6"> 
                                                <select class="form-control">
                                                <?php 
                                                    
                                                    foreach($category_data as $RawData) {
                                                        $singleCat = get_object_vars($RawData);
                                                        echo'<option value='.$singleCat['id'].'>'.$singleCat['name'].'</option>';
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" type='submit'>Save changes</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>     
                    
                </div>                
                <!-- /.col-lg-12 -->
            </div>

        </div>
        <!-- /#page-wrapper -->
        <!-- Data Tables Plugin -->
    <script href="<?php echo base_url('assets/sb-admin-2/js/plugins/dataTables/dataTables.bootstrap.js'); ?>" type="text/javascript"></script>
    <script href="<?php echo base_url('assets/sb-admin-2/js/plugins/dataTables/jquery.dataTables.js'); ?>" type="text/javascript"></script>
    <script>

        editUserTable();
        addUserForm();
        addModoForm();
        assignModoForm();
    </script>
   
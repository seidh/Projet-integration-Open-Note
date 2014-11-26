    <!-- Script for the active navbar -->
    <script type="text/javascript">
        activeNavbar();
        collapseMenu();
    </script> 
        <div id="page-wrapper">
            <div class="row">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Liste des utilisateurs</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-10 left">
                        <div class="table-responsive">
                            <div class="div-table-content">
                                <?php echo validation_errors();?>
                                
                                <table id="users_table" class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="col-md-2">Nom</th>
                                            <th class="col-md-2">Prénom</th>
                                            <th class="col-md-2">Pseudo</th>
                                            <th class="col-md-1">Groupe</th>
                                            <th class="col-md-3">Email</th>
                                            <th class="col-md-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            //var_dump($user_data);
                                            foreach ($user_data as $RawData) {
                                                //var_dump($RawData);
                                                $singleUser = get_object_vars($RawData);
                                                //echo $singleUser;                                        
                                                echo'<tr id='.$singleUser['id'].'>';
                                                echo form_open('administration/modify_user/'.$singleUser['id'].'');
                                                echo'<td><span id="dispname'.$singleUser['id'].'">'.$singleUser['name'].'</span><input style="display:none;" id="editName'.$singleUser['id'].'" name="name" class="form-control" value="'.$singleUser['name'].'"></input></td>';
                                                echo'<td><span id="dispfirstname'.$singleUser['id'].'">'.$singleUser['firstname'].'</span><input style="display:none;" id="editFirstname'.$singleUser['id'].'" name="firstname" class="form-control" value="'.$singleUser['firstname'].'"></input></td>';
                                                echo'<td><span id="disppseudo'.$singleUser['id'].'">'.$singleUser['pseudo'].'</span><input style="display:none;" id="editPseudo'.$singleUser['id'].'" name="pseudo" class="form-control" value="'.$singleUser['pseudo'].'"></input></td>';
                                                echo'<td><span id="dispgroup'.$singleUser['id'].'">'.$singleUser['groupe'].'</span><input style="display:none;" id="editGroup'.$singleUser['id'].'" name="group" class="form-control" value="'.$singleUser['groupe'].'"></input></td>';
                                                echo'<td><span id="dispemail'.$singleUser['id'].'">'.$singleUser['email'].'</span><input style="display:none;" id="editEmail'.$singleUser['id'].'" name="email" type="email" class="form-control" value="'.$singleUser['email'].'"></input></td>';                                                
                                                echo'<td><button id="saveModif'.$singleUser['id'].'" style="display:none" class="btn btn-primary" type="submit">Ok</button></td>';
                                                echo form_close();
                                         
                                                echo'</tr>';
                                                
                                            }
                                        ?>
                                        <?php echo form_open('administration/adduser'); ?>
                                        <tr id="trAddUser" style="display:none;">
                                            <td><input style="display:none;" id="newName" name="newName" class="form-control" value=""></input></td>
                                            <td><input style="display:none;" id="newFirstname" name="newFirstame" class="form-control" value=""></input></td>
                                            <td><input style="display:none;" id="newPseudo" name="newPseudo" class="form-control" value=""></input></td>
                                            <td><input style="display:none;" id="newGroup" name="newGroup" class="form-control" value=""></input></td>
                                            <td><input style="display:none;" id="newEmail" name="newEmail" class="form-control" type="email" value=""></input></td>
                                            <td><button id="saveNew" style="display:none;" class="btn btn-primary" type="submit">Ok</button></td>
                                        </tr>
                                        <?php echo form_close(); ?>
                                    </tbody>
                                </table>
                            </div>                            
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <button id="addUserBtn" class="btn btn-primary" onclick="addUserForm();">+</button></a>
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
    </script>
   
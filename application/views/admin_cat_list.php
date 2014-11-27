    <!-- Script for the active navbar -->
    <script type="text/javascript">
        activeNavbar();
        collapseMenu();
    </script> 
        <div id="page-wrapper">
            <div class="row">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Liste des catégories</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-10 left">
                        <div class="table-responsive">
                            <div class="div-table-content">
                                <?php echo validation_errors();?>
                               <?php // echo var_dump($cat_moderators); ?>
                                <table id="cat_table" class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="col-md-2">Catégorie</th>
                                            <th class="col-md-2">Modérateur</th>                                                                                   
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            //var_dump($user_data);
                                            foreach ($cat_datas as $RawData) {
                                                //var_dump($RawData);
                                                $singleCat = get_object_vars($RawData);
                                                //echo $singleUser;                                        
                                                echo'<tr id='.$singleCat['id'].'>';
                                                
                                                
                                                if (!is_null($singleCat['parent_id'])){
                                                    echo '<td>&nbsp;&nbsp;&nbsp;&nbsp; <span id="dispname'.$singleCat['id'].'">'.$singleCat['name'].'</span></td>';
                                                } else {
                                                    echo'<td><span id="dispname'.$singleCat['id'].'">'.$singleCat['name'].'</span></td>';
                                                }
                                                echo'<td>';
                                                foreach ($cat_moderators as $RawData2) {
                                                    //echo var_dump($RawData2);
                                                    foreach($RawData2['moderate_cat'] as $RawData3) {
                                                        if($RawData3['id'] == $singleCat['id']){
                                                            echo $RawData2["firstname"].' '.$RawData2['name'];
                                                        }
                                                    }
                                                }
                                                echo'</td>';
                                                
                                                //echo form_close();
                                         
                                                echo'</tr>';
                                                
                                            }
                                        ?>
                                        <?php echo form_open('administration/adduser'); ?>
                                        <tr id="trAddUser" style="display:none;">
                                            <td><input style="display:none;" id="newName" name="newName" class="form-control" value=""></input></td>
                                            <td><input style="display:none;" id="newFirstname" name="newFirstname" class="form-control" value=""></input></td>
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
   
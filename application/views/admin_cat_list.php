<!-- Script for the active navbar -->
<script type="text/javascript">
    activeNavbar();
    collapseMenu();
</script> 
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Liste des catégories</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-5">
            <button id="addUserBtn" class="btn btn-primary" data-toggle="modal" data-target="#myModal">+ Ajouter une catégorie</button></a>
        </div>
    </div>
    <div class="row top30">
        <!-- /.col-lg-12 -->  
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="table-responsive">
                <div class="table-scroll">
                    <?php echo validation_errors(); ?>
                    <?php // echo var_dump($cat_moderators); ?>
                    <table id="cat_table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="col-md-3">Catégorie</th>
                                <th class="col-md-3">Modérateur(s)</th>                                                                                   
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //var_dump($user_data);
                            foreach ($cat_datas as $RawData) {
                                //var_dump($RawData);
                                $singleCat = get_object_vars($RawData);
                                //echo $singleUser;                                        
                                echo'<tr id=' . $singleCat['id'] . '>';


                                if (!is_null($singleCat['parent_id'])) {
                                    echo '<td>&nbsp;&nbsp;&nbsp;&nbsp; <span id="catname' . $singleCat['id'] . '"><a href=' . base_url('administration/moderation/' . $singleCat['id']) . '>' . $singleCat['name'] . '</a></span></td>';
                                } else {
                                    echo'<td><span id="catname' . $singleCat['id'] . '"><a href=' . base_url('category?id=' . $singleCat['id']) . '>' . $singleCat['name'] . '</a></span></td>';
                                }
                                echo'<td>';


                                foreach ($cat_moderators as $RawData2) { // Pour chaque modérateur
                                    //echo var_dump($RawData2);
                                    foreach ($RawData2['moderate_cat'] as $RawData3) { // Aller voir chaque catégorie
                                        if ($RawData3['id'] == $singleCat['id']) {
                                            echo '<a href=' . base_url('profil?id=' . $RawData2["id"]) . '>' . $RawData2["firstname"] . ' ' . $RawData2['name'] . '</a>';
                                        }
                                    }
                                    if (end($cat_moderators) != $RawData2) {
                                        echo', ';
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
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Ajout d'une catégorie</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                Remplissez ce formulaire pour ajouter une catégorie. L'assignation d'un modérateur n'est pas obligatoire (Administrateur par défaut).
                            </div>
                        </div>
                        <div class="row top30">
                            <div class="col-lg-10">
                                <?php echo form_open("administration/addCat"); ?>
                                <div class="col-md-3 top5">
                                <label>Nom : </label>
                                </div>
                                <div class="col-md-9">
                                <input class="form-control" name='newCatName' required></input>
                                </div>
                            </div>
                        </div>
                        <div class="row top10">
                            <div class="col-lg-10">
                                <div class="col-md-5 top5">
                                    <label>Catégorie parente :</label>
                                </div>
                                <div class="col-md-7">
                                    <select class="form-control" name='parent_cat' required>
                                        <option value="null"><i>Aucune</i></option>
                                    <?php 
                                        foreach($cat_datas as $RawCat){
                                            $singleCat = get_object_vars($RawCat);
                                            if(is_null($singleCat["parent_id"])){
                                                echo'<option value='.$singleCat['id'].'>'.$singleCat['name'].'</option>';
                                            }
                                        }
                                    ?>
                                    </select>
                                   
                                </div>
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
<!-- /#page-wrapper -->
<!-- Data Tables Plugin -->
<script href="<?php echo base_url('assets/sb-admin-2/js/plugins/dataTables/dataTables.bootstrap.js'); ?>" type="text/javascript"></script>
<script href="<?php echo base_url('assets/sb-admin-2/js/plugins/dataTables/jquery.dataTables.js'); ?>" type="text/javascript"></script>
<script>

    
</script>

<?php
/**
 * Transforming all object into tables
 */
$category_data = get_object_vars($cat_data[0]);

$notesOfCat_data = array();
foreach ($notes_data as $element) {
    array_push($notesOfCat_data, get_object_vars($element));
}
?>
<!-- Script for the active navbar -->
<div id="page-wrapper">
    <div class="row">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Modération de la catégorie <i><?php echo $category_data['name'] ?></i></h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-8 left table-bordered">
                    <div class="top15"><b>Nom de la catégorie :</b> <i><?php echo $category_data['name'] ?></i></div>
                    <div class="top15">Modérateur(s) de la catégorie : <i>
                            <?php
                            $array_of_moderator = array();
                            foreach ($cat_moderators as $element) {
                                
                                foreach ($element['moderate_cat'] as $cat_moderated){
                                    //echo var_dump($cat_moderated);
                                    if($cat_moderated['id'] == $category_data['id']){
                                        $tmpArray = array('id'=>$element['id'], 'name'=>$element['name'], 'firstname'=>$element['firstname']);
                                        array_push($array_of_moderator, $tmpArray);
                                    }
                                }
                                //echo var_dump($array_of_moderator);
                                
                            }
                            
                            foreach($array_of_moderator as $modo){
                                echo'<a href=' . base_url('profil?id=' . $modo["id"]) . '>' . $modo['firstname'] . ' ' . $modo['name'] . '</a>';
                                if (end($array_of_moderator) != $modo) {
                                        echo', ';
                                    }
                                
                            }
                            ?></i></div>
                    <div class="top15">Nombre de notes : <i><?php echo count($notesOfCat_data) ?></i></div>
                    <div class="top15 bottom15">Utilisateur le plus actif : <i>
                            <?php
                            if(!empty($notesOfCat_data)){
                                $arrayAuthor = array();
                                foreach ($notesOfCat_data as $element) {
                                    array_push($arrayAuthor, $element['author_id']);
                                }
                                $counts = array_count_values($arrayAuthor);
                                $ActiveAuthorId = array_keys($counts, max($counts)); // Retourne l'id de l'user le plus actif
                                $ActiveUser = array();
                                foreach ($users_data as $user) {
                                    if ($user['id'] == $ActiveAuthorId[0]) {
                                        $ActiveUser = $user;
                                    }
                                }
                                echo $ActiveUser['firstname'] . ' ' . $ActiveUser['name'];
                            } else {
                                echo '<i>Pas encore d\'auteur !</i>';
                            }
                            
                            ?>
                        </i></div>

                </div>
            </div>
            <div class="row top5">
                <div class="col-lg-1"></div>
                <div class="col-lg-3">
                    <a href="<?php echo base_url('moderation')?>"><button id="return" class="btn btn-info top30" ><i class="fa fa-reply fa-fw"></i> Retour au panel</button></a>
                </div>
                <div class="col-lg-3">
                    <button id="editCat" class="btn btn-success top30" data-toggle="modal" data-target="#myModal"><i class="fa fa-cog fa-fw"></i> Modifier cette catégorie</button>                                              
                </div>
                <?php if($isAdmin){
                    echo'<div class="col-lg-3">
                    <button id="addModo" class="btn btn-warning top30" data-toggle="modal" data-target="#myModal1"><i class="fa fa-plus fa-fw"></i> Ajouter un modérateur</button>                                              
                </div>';
                } ?>
                
            </div>            
        </div>
        <div class="row top5">
                <div class="col-lg-12">
                <h2 class="page-header">Utilisateurs abonnés à la catégorie</h2>
                <div class="col-lg-1"></div>
                <div class="col-lg-8">
                    <div class="div-table-content">                    
                    <div class="col-sm-12">
                        <div class="panel panel-default">

                            <!-- /.panel-heading -->

                            <div class="panel-body">
                                <div class="table-responsive">
                                    <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid">

                                        <table id="cat_users_table" class="table table-striped table-hover dataTable no-footer">
                                            <thead>
                                                <tr>
                                                    <th class="col-md-2">Nom</th>
                                                    <th class="col-md-2">Prénom</th>
                                                    <th class="col-md-2">Pseudo</th>
                                                    <th class="col-md-1">Groupe</th>
                                                    <th class="col-md-3">Email</th>                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                //var_dump($user_data);
                                                foreach ($users_data as $user) {
                                                    //var_dump($RawData);
                                                    //$singleUser = get_object_vars($RawData);
                                                    //echo $singleUser;                                        
                                                    echo'<tr id=' . $user['id'] . '>';
                                                    echo form_open('administration/modify_user/' . $user['id'] . '');
                                                    echo'<td><span id="dispname' . $user['id'] . '">' . $user['name'] . '</span></td>';
                                                    echo'<td><span id="dispfirstname' . $user['id'] . '">' . $user['firstname'] . '</span></td>';
                                                    echo'<td><span id="disppseudo' . $user['id'] . '">' . $user['pseudo'] . '</span></td>';
                                                    echo'<td><span id="dispgroup' . $user['id'] . '">' . $user['groupe'] . '</span></td>';
                                                    echo'<td><span id="dispemail' . $user['id'] . '">' . $user['email'] . '</span></td>';
          
                                                    echo'</tr>';
                                                }
                                                ?>
                                                <?php echo form_open('administration/adduser'); ?>
                                                <tr id="trAddUser" style="display:none;">
                                                    <td><input style="display:none;" id="newName" name="newName" class="form-control" size="10" value=""></input></td>
                                                    <td><input style="display:none;" id="newFirstname" name="newFirstname" class="form-control" size="10" value=""></input></td>
                                                    <td><input style="display:none;" id="newPseudo" name="newPseudo" class="form-control" size="10" value=""></input></td>
                                                    <td><input style="display:none;" id="newGroup" name="newGroup" class="form-control" size="6" value=""></input></td>
                                                    <td><input style="display:none;" id="newEmail" name="newEmail" class="form-control" type="email" value=""></input></td>
                                                    <td><button id="saveNew" style="display:none;" class="btn btn-primary" type="submit">Ok</button></td>
                                                </tr>
                                                <?php echo form_close(); ?>
                                            </tbody>
                                        </table>
                                    </div>                            
                                </div>
                            </div>
                            
                        </div>                
                        <!-- /.col-lg-12 -->
                    </div>
                </div>
                </div>
                </div>
            </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Modifier la catégorie</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            Vous pouvez changer le nom de la catégorie.
                        </div>
                    </div>
                    <?php echo form_open("moderation/changecatname"); ?>
                    <div class="row top30">
                        <div class="col-lg-12">
                            <div class="col-lg-4 top5">
                                <label>Nom :</label>
                            </div>
                            <div class="col-lg-8">
                                <input class="form-control" name='name' required></input>

                                <input type="hidden" value='<?php echo $category_data['id']; ?>' name='id'>
                            </div>
                        </div>
                    </div>              
                    <div class="row top10">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-8">
                            <input type='checkbox' name='confirm' id='checkbox' required /> <label for='checkbox'> Je confirme le changement</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save changes</button>
                </div>
                <?php echo form_close(); ?>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div> 
    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Ajout d'un modérateur</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            Veuillez choisir un utilisateur dans la liste pour lui assigner les droits de modérateur.<br />                            
                        </div>
                    </div>
                    <?php echo form_open("moderation/addModoForm"); ?>
                    <div class="row top30">
                        <div class="col-lg-12">
                            <div class="col-lg-4">
                                <label>Utilisateur :</label>
                            </div>
                            <div class="col-lg-8">
                                <select class="form-control" name='user' required>
                                    <?php
                                    foreach ($allusers as $userRaw) {
                                        $user = get_object_vars($userRaw);
                                        //var_dump($RawData);
                                        //$singleUser = get_object_vars($RawData);
                                        //echo $singleModo;                                        
                                        echo'<option value=' . $user['id'] . '>' . $user['firstname'] . ' ' . $user['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row top5">
                        <div class="col-lg-12">
                            <div class="col-lg-4">
                                <label>Catégorie :</label>
                            </div>
                            <div class="col-lg-8">
                                <input type='hidden' value='<?php echo $category_data['id']; ?>' name="id">
                                <select class="form-control" name='noid' disabled>
                                    <option value='<?php echo $category_data['id']; ?>' selected><?php echo $category_data['name']; ?></option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 top7"> 
                            <input type='checkbox' name='confirm' id='confirmation' required /> <label for='confirmation'> Je confirme l'assignation</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type='submit'>Save changes</button>
                </div>
                <?php echo form_close(); ?>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div> 
    <!-- /#page-wrapper -->
</div>
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<!-- Data Tables Plugin -->
<script href="<?php echo base_url('assets/sb-admin-2/js/plugins/dataTables/dataTables.bootstrap.js'); ?>" type="text/javascript"></script>
<script href="<?php echo base_url('assets/sb-admin-2/js/plugins/dataTables/jquery.dataTables.js'); ?>" type="text/javascript"></script>
<script>

    editUserTable();
    addUserForm();
    $(document).ready(function () {
        $('#cat_users_table').dataTable({
            responsive: true
        });
    });
</script>

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
                            foreach ($cat_moderators as $element) {
                                echo'<a href=' . base_url('profil?id=' . $element["id"]) . '>' . $element['firstname'] . ' ' . $element['name'] . '</a>';
                                if (end($cat_moderators) != $element) {
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
                <div class="col-lg-4">
                    <button id="editCat" class="btn btn-success top30" data-toggle="modal" data-target="#myModal"><i class="fa fa-cog fa-fw"></i> Modifier cette catégorie</button>                                              
                </div>
                <?php if($isAdmin){
                    echo'<div class="col-lg-4">
                    <button id="addModo" class="btn btn-warning top30" data-toggle="modal" data-target="#myModal1"><i class="fa fa-plus fa-fw"></i> Ajouter un modérateur</button>                                              
                </div>';
                } ?>
                
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
<script>

</script>

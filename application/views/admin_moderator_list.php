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
            <?php echo validation_errors(); ?>       
            <div class="col-lg-10 left">
                <div class="panel panel-default">

                    <!-- /.panel-heading -->

                    <div class="panel-body">
                        <div class="table-responsive">
                            <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid">

                                <table id="modo_table" class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="col-md-4">Nom & Prénom</th>                                            
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
                                            echo'<tr id=' . $singleModo['id'] . '>';

                                            echo'<td><a href=' . base_url('profil?id=' . $singleModo["id"]) . '>' . $singleModo['firstname'] . ' ' . $singleModo['name'] . ' </a></td>';
                                            echo'<td><a href=' . base_url('profil?id=' . $singleModo["id"]) . '>' . $singleModo['pseudo'] . '</a></td>';
                                            echo'<td>' . $singleModo['email'] . '</td>';
                                            echo'<td>';
                                            foreach ($singleModo['moderate_cat'] as $cat) {
                                                echo '<i><a href=' . base_url('administration/moderation/' . $cat['id']) . '>' . $cat['name'] . '</a></i>';

                                                if (end($singleModo['moderate_cat']) != $cat) {
                                                    echo', ';
                                                }
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

                        <button id="addModoBtn" class="btn btn-primary top30" data-toggle="modal" data-target="#myModal">+ Ajouter un modérateur</button>                                              
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
                                            Veuillez choisir un utilisateur dans la liste pour lui assigner les droits de modérateur.<br />
                                            Choisissez également une catégorie à assigner à ce nouveau modérateur.
                                        </div>
                                    </div>
                                    <?php echo form_open("administration/addModoForm"); ?>
                                    <div class="row top30">
                                        <div class="col-lg-12">
                                            <div class="col-lg-4">
                                                <label>Utilisateur :</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <select class="form-control" name='user' required>
                                                    <?php
                                                    foreach ($users_data as $RawData) {
                                                        //var_dump($RawData);

                                                        $singleUser = get_object_vars($RawData);
                                                        //echo $singleModo;                                        
                                                        echo'<option value=' . $singleUser['id'] . '>' . $singleUser['firstname'] . ' ' . $singleUser['name'] . '</option>';
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
                                                <select class="form-control" name='category' required>
                                                    <?php
                                                    foreach ($category_data as $RawData) {
                                                        $singleCat = get_object_vars($RawData);
                                                        if (is_null($singleCat["parent_id"])) {
                                                            echo '<option value=' . $singleCat['id'] . '>' . $singleCat['name'] . '</option>';
                                                        } else {
                                                            echo'<option value=' . $singleCat['id'] . '>&#10149; ' . $singleCat['name'] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 top7"> 
                                            <input type='checkbox' name='confirm' id='checkbox' required /> <label for='checkbox'> Je confirme l'assignation</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button class="btn btn-success" type="submit">Save changes</button>
                                </div> 
                                <?php echo form_close(); ?>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                    
                        <!-- /.modal-dialog -->
                    </div> 
                </div>                
                <!-- /.col-lg-12 -->
            </div>
        </div>
    </div>
</div>
        <!-- /#page-wrapper -->
        <!-- Data Tables Plugin -->
        <script href="<?php echo base_url('assets/sb-admin-2/js/plugins/dataTables/dataTables.bootstrap.js'); ?>" type="text/javascript"></script>
        <script href="<?php echo base_url('assets/sb-admin-2/js/plugins/dataTables/jquery.dataTables.js'); ?>" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                $('#modo_table').dataTable({
                    responsive: true
                });
            });
        </script>

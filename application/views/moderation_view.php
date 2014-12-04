
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Modération</h1>
        </div>

        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>Bienvenue sur votre page de modération.</h3>
            <p class="top15">Vous retrouverez ici tout le necéssaire pour gérer les catégories qui vont sont assignées.</p>
            <p>Depuis ce panneau de modération vous pourrez :
            <ul>                
                <li>Modifier le nom de la catégorie</li>
                <li>Accepter les demandes d'abonnement aux catégories</li>
            </ul>
            </p> 
            <hr />
        </div>                                
    </div>
        <div class="row">
        <div class="col-lg-12 bottom30">
            
            <button id="abonnement" class="btn btn-lg btn-success" data-toggle="modal" data-target="#myModal">Voir les demandes d'abonnements</button>                                              
        <hr />
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3 class="top15 bottom15">Liste des catégories modérées</h3>
            <?php
            foreach ($category_data as $cat) {


                echo '
                        <div class="col-lg-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <b>' . $cat['name'] . '</b>
                                </div>
                                <div class="panel-body">
                                    Nombre de notes : ';
                if (array_key_exists($cat['id'], $notes_in_cat)) {
                    echo $notes_in_cat[$cat['id']];
                }
                echo'<br />Catégorie parente : <i>';
                foreach ($cat_level_one as $element) {
                    $elementTable = get_object_vars($element);
                    if ($cat['parent_id'] == $elementTable['id']) {
                        echo $elementTable['name'];
                    }
                }
                echo'</i>';
                echo'<br />Nombre d\'abonnés : ';
                echo $users_in_cat[$cat['id']];
                echo'
                                </div>
                                <div class="panel-footer">
                                    <a href="' . base_url('moderation/category/' . $cat['id']) . '"> &#10140; Modérer cette catégorie</a>
                                </div>
                            </div>
                        </div>
                        ';
            }
            ?>
            <?php
           // echo var_dump($category_data);
            //echo var_dump($subscription_data);
            //echo var_dump($users_subscription);
            
            ?>


        </div>

    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style='width:1000px;'>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Demandes d'abonnement</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            Vous pouvez accepter ou refuser la demande d'abonnement à une catégorie modérée.
                        </div>
                    </div>
                    <?php //echo form_open("moderation/subscription"); ?>
                    <div class="row top30">
                        <div class="col-lg-12">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                <th>Utilisateur</th>
                                <th>Catégorie</th>
                                <th>Motif</th>
                                <th>Actions</th>
                                </thead>
                                <tbody>
                                    <?php foreach($subscription_data as $demandes){ // Divise les demandes par categories
                                        if(!empty($demandes)){
                                            foreach($demandes as $demande){
                                                //echo var_dump($demande);
                                                //echo '----';
                                                echo'<input value="'.$demande['cat_id'].'" type="hidden" name="category">';
                                                echo'<input value="'.$demande['user_id'].'" type="hidden" name="user">';                                                
                                                echo'<tr><td>';
                                                echo $demande['firstname'].' '.$demande['name'];
                                                echo'</td><td>';
                                                echo $demande['catname'];
                                                echo'</td><td>';
                                                echo $demande['motivation'];
                                                echo'</td><td class="text-right">';
                                                echo'<a href="'. base_url('moderation/subscription/'.$demande['user_id'].'/'.$demande['cat_id'].'">');
                                                echo'<button id="abonnement" class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-check fa-fw"></i> Accepter</button></a><br />';
                                                echo'<a href="'. base_url('moderation/unsubscription/'.$demande['user_id'].'/'.$demande['cat_id'].'">');
                                                echo'<button id="abonnement" class="btn btn-xs btn-danger top10" data-toggle="modal" data-target="#myModal"><i class="fa fa-times fa-fw"></i> Refuser</button></a>';
                                                echo'</td></tr>';
                                            }
                                        
                                        }
                                        
                                       
                                        
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>              
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                    
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<!-- /#page-wrapper -->


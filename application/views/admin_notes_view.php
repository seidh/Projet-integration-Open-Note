<!-- Script for the active navbar -->
<script type="text/javascript">
    activeNavbar();
    collapseMenu();
</script> 
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Liste des notes de la plateforme</h1>
        </div>
    </div>
    <div class="row top30">
        <!-- /.col-lg-12 -->  
        <div class="col-md-1"></div>
        
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-body">
            <div class="table-responsive">
                                   
                    <table id="notes_table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Catégorie</th> 
                                <th>Auteur</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //echo var_dump($notes_array);
                            foreach ($notes_array as $note) {  
                                $path = base_url('note/view/'.$note['id']);
                                $path1 = base_url('profil?id='.$note['uid']);
                                $path2 = base_url('administration/moderation/'.$note['catid']);
                                echo'<tr id=' . $note['id'] . '>';
                                echo'<td><a href="'. $path .'">'. $note['name'] .'</a></td>';
                                echo'<td><a href="'. $path1 .'">'. $note['authorFirstname'] .' '. $note['authorName'].'</a></td>';
                                echo'<td><a href="'. $path2 .'">'. $note['CatName'].'</a></td>';
                                echo'<td>'. $note['creation_date'].'</td>';
                                
                                echo'</tr>';

                            }
                            ?>                            
                        </tbody>
                    </table>
                                            
            </div>
                </div>
        </div>
        </div>

    </div>                
    <!-- /.col-lg-12 -->



</div>
<!-- /#page-wrapper -->
<!-- Data Tables Plugin -->
<script href="<?php echo base_url('assets/sb-admin-2/js/plugins/dataTables/dataTables.bootstrap.js'); ?>" type="text/javascript"></script>
<script href="<?php echo base_url('assets/sb-admin-2/js/plugins/dataTables/jquery.dataTables.js'); ?>" type="text/javascript"></script>
<script>
            $(document).ready(function () {
                $('#notes_table').dataTable({
                    responsive: true
                });
            });
    
</script>

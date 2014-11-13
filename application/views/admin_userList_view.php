
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
                                <table id="users_table" class="table table-striped table-hover">
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
                                            foreach ($user_data as $RawData) {
                                                //var_dump($RawData);
                                                $singleUser = get_object_vars($RawData);
                                                //echo $singleUser;                                        
                                                echo'<tr>';
                                                echo'<td>'.$singleUser['name'].'</td>';
                                                echo'<td>'.$singleUser['firstname'].'</td>';
                                                echo'<td>'.$singleUser['pseudo'].'</td>';
                                                echo'<td>'.$singleUser['groupe'].'</td>';
                                                echo'<td>'.$singleUser['email'].'</td>';
                                                echo'</tr>';
                                            }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 top10">
                        <a href="<?php echo base_url('administration/newuserform'); ?>"><button class="btn btn-primary btn-lg btn-block" >Ajouter un utilisateur manuellement</button></a>
                    </div>
                </div>                
                <!-- /.col-lg-12 -->
            </div>


        </div>
        <!-- /#page-wrapper -->
    <script>
        $(document).ready( function () {
            $('#users_table').DataTable();
        } );
    </script>
   
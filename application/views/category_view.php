<!-- Script for the active navbar -->
<div id="page-wrapper">
    <div class="row">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Notes dans la catégorie - <?php echo $cat_name ?></h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-8 left">
                <div class="div-table-content">
                    <div class="col-sm-12">
                        <br />
                        <a href="<?php echo base_url('note/create_online' . '/' . $cat_id) ?>"><button type="button" class="btn btn-outline btn-info">Créer une note dans cette catégorie</button></a>
                        <br />
                        <br />
                        <br />
                    </div>
                    <div class="col-sm-12">
                        <div class="panel panel-default">

                            <!-- /.panel-heading -->


                            <div class="panel-body">
                                <div class="table-responsive">
                                    <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                        <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" aria-describedby="dataTables-example_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="col-md-3" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" >Titre</th>
                                                    <th class="col-md-3" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" >Auteur</th>
                                                    <th class="col-md-3" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" >Date de création</th>
                                                    <th class="col-md-2" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" >Date de modification</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($notes as $row_note) {
                                                    $user = $this->user->user_data($row_note['author_id']);
                                                    echo '
                                                <tr class=" ">
                                            <td class=" "><a href="' . base_url('note/view') . '/' . $row_note['id'] . '">' . $row_note['name'] . '</a></td>
                                            <td class=" "><a href="' . base_url('profil?id=') . $row_note['author_id'] . '">' . $user['name'] . ' ' . $user['firstname'] . '</a></td>
                                            <td class=" ">' . $row_note['creation_date'] . '</td>
                                            <td class=" ">' . $row_note['modification_date'] . '</td>
                                        </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function () {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
</script>

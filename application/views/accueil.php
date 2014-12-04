
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Bonjour <?php echo $pseudo; ?>!</h1>
        </div>
        <div class="col-lg-10 left">
            <div class="panel panel-default">

                <!-- /.panel-heading -->
                <div class="panel-heading">
                    Mes notes
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid">
                            <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" aria-describedby="dataTables-example_info">
                                <thead>
                                    <tr role="row">
                                        <th class="col-md-2" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" >Titre</th>
                                        <th class="col-md-2" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" >Auteur</th>
                                        <th class="col-md-2" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" >Date de création</th>
                                        <th class="col-md-2" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" >Date de modification</th>
                                        <th class="col-md-2" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" >Nombre de commentaires</th>
                                        <th class="col-md-1" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" >Nombre de j'aime</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($my_note as $row_note) {
                                        $user = $this->user->user_data($row_note['author_id']);
                                        $nb_comment = $this->comments_model->get_number_comments($row_note['id']);
                                        $nb_like = $this->notes_model->get_like($row_note['id']);
                                        echo '
                                                    <tr class=" ">
                                                    <td class=" "><a href="' . base_url('note/view') . '/' . $row_note['id'] . '">' . $row_note['name'] . '</a></td>
                                                    <td class=" "><a href="' . base_url('profil?id=') . $row_note['author_id'] . '">' . $user['name'] . ' ' . $user['firstname'] . '</a></td>
                                                    <td class=" ">' . $row_note['creation_date'] . '</td>
                                                    <td class=" ">' . $row_note['modification_date'] . '</td>
                                                    <td class=" ">' . $nb_comment . '</td>';
                                        if ($nb_like[0]['vote'] == null) {
                                            echo'<td class=" "> 0 </td>';
                                        } else {
                                            echo'<td class=" ">' . $nb_like[0]['vote'] . '</td>';
                                        }

                                        echo'</tr>';
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

<!-- /.col-lg-12 -->
</div>

</div>
<!-- /#page-wrapper -->





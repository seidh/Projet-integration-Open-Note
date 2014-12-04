<div id="page-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="page-header">
                Note - <?php echo $note['name'] ?>
            </h1>
        </div>

        <div class="col-sm-12 row">
            <div class="form-group row">
                <div class="col-sm-2">
                    <?php echo form_open('note/view/' . $note['id']); ?>
                    <button type="submit" class="btn btn-outline btn-primary">
                        Retour à la version actuel
                    </button>
                    <?php echo form_close(); ?>
                </div
                <div class="col-sm-2">
                    <?php
                    echo form_open('note/revert_from_history/' . $commit_hash);
                    echo '<input class="form-control"  name="note_id" id="note_id" type="text" style="display: none" value="' . $note['id'] . '" />';
                    echo '<button type="submit" class="btn btn-outline btn-primary">Retour à cette version</button>';
                    echo form_close();
                    ?>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Version actuelle de la note
                        </div>
                        <div class="panel-body" id="see_note">
                            <div class="col-sm-12 top15">
                                <?php
                                foreach ($history['current'] as $row) {
                                    if ($row != null) {
                                        if ($row[0] == '+') {
                                            echo'<div style="background-color: #eaffea">';
                                            echo $row;
                                            echo'</div>';
                                        } else {
                                            if ($row[0] == '-') {
                                                echo'<div style="background-color: #ffecec">';
                                                echo $row;
                                                echo'</div>';
                                            } else {
                                                echo $row;
                                            }
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Ancienne version de la note
                        </div>
                        <div class="panel-body" id="see_note">
                            <div class="col-sm-12 top15">
                                <?php
                                foreach ($history['previous'] as $row) {
                                    if ($row != null) {
                                        if ($row[0] == '+') {
                                            echo'<div style="background-color: #eaffea">';
                                            echo $row;
                                            echo'</div>';
                                        } else {
                                            if ($row[0] == '-') {
                                                echo'<div style="background-color: #ffecec">';
                                                echo $row;
                                                echo'</div>';
                                            } else {
                                                echo $row;
                                            }
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


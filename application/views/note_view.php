<div id="page-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="page-header">
                Note - <?php echo $note['name'] ?> - <span style="color: green; font-style: italic;"> ++ <?php echo $rating['like']; ?></span> / <span style="color:red; font-style: italic;"> -- <?php echo $rating['unlike']; ?></span>
                <div class="row top15">
                    <?php
                    if ($rating['vote_unlike'] == 1 || ($rating['vote_like'] == 0 && $rating['vote_unlike'] == 0)) {
                        echo'<div class="col-sm-1">';
                        echo form_open('note/like/' . $note['id']);
                        echo '<button type="submit" class="btn btn-outline btn-success">J\'aime</button>';
                        echo '</form>';
                        echo'</div>';
                    }
                    ?>


                    <?php
                    if ($rating['vote_like'] == 1 || ($rating['vote_like'] == 0 && $rating['vote_unlike'] == 0)) {
                        echo'<div class="col-sm-1">';
                        echo form_open('note/unlike/' . $note['id']);
                        echo '<button type="submit" class="btn btn-outline btn-danger">Je n\'aime pas</button>';
                        echo '</form>';
                        echo'</div>';
                    }
                    ?>
                </div> 
            </h1>
        </div>
        <div class="form-group row">
            <div class="col-sm-4">
                <button class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal">
                    Options
                </button>
                <button class="btn btn-outline btn-primary" id="modification">
                    Modifier la note
                </button>
                <button class="btn btn-outline btn-primary" id="cancel_modification" style="display: none;">
                    Annuler la modification
                </button>
            </div>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Options sur la notes</h4>
                        </div>
                        <div class="modal-body">
                            <div class="panel-group" id="accordion">
                                <?php
                                $i = 0;
                                foreach ($history as $commit) {
                                    echo'<div class="panel panel-default">';
                                    echo'<div class="panel-heading">';
                                    echo'<h4 class="panel-title">';
                                    echo'<a data-toggle="collapse" data-parent="#accordion" href="#collapse' . $i . '" aria-expanded="false" class="collapsed">' . $commit['commit_message'] . ' par ' . $commit['user_pseudo'] . ' | ' . $commit['date_relative'] . '</a>';
                                    echo'</h4>';
                                    echo'</div>';
                                    echo'<div id="collapse' . $i . '" class="panel-collapse collapse" aria-expanded="false">';
                                    echo'<div class="panel-body">';
                                    echo'<div class="from-group row">';
                                    echo'<div class="col-sm-4">';
                                    echo form_open('note/revert_from_history/' . $commit['commit_hash']);
                                    echo '<input class="form-control"  name="note_id" id="note_id" type="text" style="display: none" value="' . $note['id'] . '" />';
                                    echo '<button type="submit" class="btn btn-outline btn-primary btn-sm">Retour à cette version</button>';
                                    echo form_close();
                                    echo'</div>';
                                    echo'<div class="col-sm-4">';
                                    echo form_open('note/view_diff/' . $commit['commit_hash']);
                                    echo '<button type="submit" class="btn btn-outline btn-primary btn-sm">Voir la différence entre cette version et le version actuel</button>';
                                    echo '<input class="form-control"  name="note_id" id="note_id" type="text" style="display: none" value="' . $note['id'] . '" />';
                                    echo form_close();
                                    echo'</div>';
                                    echo'</div>';
                                    echo'</div>';
                                    echo'</div>';
                                    echo'</div>';
                                    $i++;
                                }
                                ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <div class="col-sm-12">
                <?php echo validation_errors(); ?>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        La note
                    </div>
                    <div class="panel-body" id="see_note">
                        <div class="col-sm-12 top15">
                            <?php
                            foreach ($note['note_content'] as $row) {
                                echo $row;
                            }
                            ?>
                        </div>
                    </div>
                    <div class="panel-body" id="modif_note" style="display: none">
                        <?php echo form_open('note/modification'); ?>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label> Raison de la modification : </label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" name="commentaire_modification" class="form-control" placeholder="Pourquoi vouloir modifier cette note ? ...">
                            </div>
                            <br />
                            <br />
                            <br />
                            <div class="col-sm-12">
                                <textarea name="modification_note" id="editor1" rows="10" cols="80">
                                    <?php
                                    foreach ($note['note_content'] as $row) {
                                        echo $row;
                                    }
                                    ?>
                                </textarea>
                            </div>
                        </div>
                        <script>
                            // Replace the <textarea id="editor1"> with a CKEditor
                            // instance, using default configuration.
                            CKEDITOR.replace('modification_note');
                        </script>
                        <input class="form-control"  name="note_id" id="note_id" type="text" style="display: none" value="<?php echo $note['id'] ?>" />
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Enregistrer vos modifications</button>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-sm-12">
                <div class="panel-group" id="commentaire">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#commentaire" href="#listeCommentaire" aria-expanded="false" class="collapsed">Voir les commentaires de cette note</a>
                            </h4>
                        </div>
                        <div id="listeCommentaire" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                            <div class="panel-body">
                                <?php
                                $comments = $this->comments_model->get_note_comments($note['id']);
                                $this->comments_model->write_comments_r($comments);
                                ?>
                                <button type="submit" id="commentMother" class="btn btn-outline btn-info">Commenter</button><br />
                                <?php
                                echo'<div id="textCommentMother" style="display: none" class="form-group row">';
                                echo form_open('note/sendComment');
                                echo'<input class="form-control"  name="note_id" id="note_id" type="text" style="display: none" value="' . $note['id'] . '" />';
                                echo'<div class="panel-footer">';
                                echo'<div class="input-group">';
                                echo'<input id="btn-input" type="text" name="comment" class="form-control input-sm" placeholder="Ecrivez votre message ici...">';
                                echo'<span class="input-group-btn">';
                                echo'<button type="submit" class="btn btn-warning btn-sm" id="btn-chat">';
                                echo'Commenter';
                                echo'</button>';
                                echo'</span>';
                                echo'</div>';
                                echo'</div>';
                                echo form_close();
                                echo'</div>';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    comment();
    commentParent();
    modification_note();

</script>


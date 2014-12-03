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
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed">Collapsible Group Item #1</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false">
                                        <div class="panel-body">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </div>
                                    </div>
                                </div>
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
                        <?php echo validation_errors(); ?>
                        <?php echo form_open(''); ?>
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
                        <button type="button" class="btn btn-primary btn-lg btn-block">Enregistrer vos modifications</button>
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


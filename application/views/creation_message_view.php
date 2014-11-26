<div id="page-wrapper">

    <div class="row">
        <div class="col-sm-12">
            <h1 class="page-header">
                Création d'un message
            </h1>
        </div>
        <div class="form-group row">
            <?php echo validation_errors(); ?>
            <?php echo form_open('message/ajout_conversation'); ?>
            <div class="col-sm-12">
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label>Choisissez un utilisateur:</label>
                    </div>
                    <div class="col-lg-2">
                        <select name="friend_id" class="form-control">
                            <?php
                            foreach($liste_user as $row)
                            {
                                echo'<option value="'.$row['id'].'">'.$row['firstname'].' '.$row['name'].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <textarea name="editor1" id="editor1" rows="10" cols="80">
               
                </textarea>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace('editor1');
                </script>
                <button id="send" type="submit" class="btn btn-success btn-lg btn-block">Créer la conversation</button>

            </div>

            </form>
        </div>
    </div>
</div>
<!-- /#page-wrapper -->
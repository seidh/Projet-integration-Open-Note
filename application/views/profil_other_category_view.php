<div id="page-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="page-header">Abonnement à la catégorie - <?php echo $cat_name ?></h1>
        </div>
        <div class="form-group row">

            <div class="col-sm-12">
                <?php echo validation_errors(); ?>
                <?php echo form_open('profil/ask_cat'); ?>
                <textarea name="editor1" id="editor1" rows="10" cols="80">
                Bonjour, <br />
                <br />
                Pourquoi voulez-vous rejoindre la catégorie - <?php echo $cat_name ?> ? <br />
                <br />
                Bien à vous,
                L'équipe de modération de Open-Note.
                </textarea>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace('editor1');
                </script>
                <input class="form-control"  name="cat_id" id="cat_id" type="text" style="display: none" value="<?php echo $cat_id ?>" />
                <button id="send" type="submit" class="btn btn-success btn-lg btn-block">Envoyer</button>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- /#page-wrapper -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="page-header">Création d'une note dans la catégorie - <?php echo $category[0]['name'];?></h1>
        </div>
        <div class="form-group row">

            <div class="col-sm-12">
                <?php echo validation_errors(); ?>
                <?php echo form_open('note/apply_create_online'); ?>
                <div class="form-group row">
                    <div class="col-lg-4">
                        <label> Titre :</label>
                    </div>
                    <div class="col-lg-4">
                        <input id="title" name="title" type="text" class="form-control">
                    </div>
                </div>

                <textarea id ="note_content" name="note_content"  rows="10" cols="80">
                </textarea>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace('note_content');
                </script>
                <input type="hidden" id="cat" name="category" value="<?php echo $cat_id ?>">
                <button type="sumbit" class="btn btn-success btn-lg btn-block">
                            Créer la note
                        </button> 
                </form>
            </div>

        </div>
    </div>
</div>
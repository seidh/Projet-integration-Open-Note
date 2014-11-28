<div id="page-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="page-header">Note - <?php echo $note['name'] ?></h1>
        </div>
        <div class="form-group row">

            <div class="col-sm-12">
                <?php echo validation_errors(); ?>
                <?php echo form_open(''); ?>
                <textarea name="editor1" id="editor1" rows="10" cols="80">
                <?php 
                foreach($note['note_content'] as $row)
                {
                    echo $row;
                }
                    ?>
                </textarea>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace('editor1');
                </script>
                <input class="form-control"  name="note_id" id="note_id" type="text" style="display: none" value="<?php echo $note['id'] ?>" />
                </form>
            </div>

        </div>
    </div>
</div>


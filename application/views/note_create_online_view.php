
<?php echo validation_errors();
 echo form_open('note/apply_create_online'); ?>

<input id="title" name="title" type="text">
<textarea id ="note_content" name="note_content" rows="10" cols="60"></textarea>
<input type="hidden" id="cat" name="category" value="<?php echo $cat_id?>">
<input type="submit">


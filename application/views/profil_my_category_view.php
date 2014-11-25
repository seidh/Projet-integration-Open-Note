<div id="page-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="page-header">Votre catégorie - <?php echo $cat_name ?></h1>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
                <?php echo validation_errors(); ?>
                <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Délier cette catégorie de votre profil ? </button>
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                            </div>
                            <div class="modal-body">
                                Etes-vous sur d'effectuer cette action ?
                            </div>
                            <div class="modal-footer">
                                <?php echo form_open('profil/delink_cat'); ?>
                                <input class="form-control"  name="cat_id" id="cat_id" type="text" style="display: none" value="<?php echo $cat_id ?>" />
                                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary">Oui</button>
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

            </div>

        </div>

    </div>
</div>
<!-- /#page-wrapper -->



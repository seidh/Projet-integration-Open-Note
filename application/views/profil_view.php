
<div id="page-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <?php
            if ($this->input->get('id') == '') {
                echo '<h1 class="page-header">Votre profil</h1>';
            } else {
                echo '<h1 class="page-header">Profil de ' . $name . ' ' . $firstname . '</h1>';
            }
            ?>
        </div>
        <div class="form-group row">
            <div class="col-sm-5">

                <?php
                if ($this->input->get('id') == '') {
                    echo $error;
                    echo $message;
                    echo form_open_multipart('profil/do_upload');
                }
                    ?>
                    

                    <label>Avatar</label><br />
                    <?php
                    if ($avatar == null) {
                        echo '<img src="';
                        echo base_url('assets/image/avatarDefault.png');
                        echo '" alt="Avatar par défaut" />';
                    } else {
                        echo '<img src="';
                        echo base_url('assets/image');
                        echo '/' . $avatar . '" alt="Mon Avatar" />';
                    }
                    ?>

                    <?php
                    if ($this->input->get('id') == '') {
                        echo'<input id="avatar" name="userfile" style="display: none" type="file">';

                        echo'<button id="choiceAvatar" type="button" class="btn btn-primary btn-lg btn-block">Envie de changer son avatar ?</button>';
                        echo'<button id="submitAvatar" style="display: none" type="submit" class="btn btn-primary btn-lg btn-block">Enregistrez votre avatar</button>';

                        echo'</form>';
                    }
                    ?>
                </div>
                <div class="col-sm-7">
                    <?php
                    if ($this->input->get('id') == '') {
                        echo validation_errors();
                        echo form_open('profil/edit');
                    }
                    ?>
                    <div class="form-group row">
                        <div class="col-sm-5">
                            <label>Nom :</label>
                        </div>
                        <div class="col-sm-7">
                            <div id="name"><?php echo $name; ?></div>
                            <input id ="saveName" name="name" style="display: none" class="form-control" value="<?php echo $name; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-5">
                            <label>Prénom :</label>
                        </div>
                        <div class="col-sm-7">
                            <div id="firstname"><?php echo $firstname; ?></div>
                            <input id ="saveFirstname" name="firstname" style="display: none" class="form-control" value="<?php echo $firstname; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-5">
                            <label>Sexe :</label>
                        </div>
                        <div id="sexe" class="col-sm-7">
                            <?php echo $sexe; ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-5">
                            <label>Groupe :</label>
                        </div>
                        <div class="col-sm-7">
                            <?php echo $groupe; ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-5">
                            <label>Adresse mail :</label>
                        </div>
                        <div class="col-sm-7">
                            <div id="email"><?php echo $username; ?></div>
                            <input id ="saveEmail" name="email" style="display: none" class="form-control" value="<?php echo $username; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-5">
                            <label>Date d'anniversaire :</label>
                        </div>
                        <div class="col-sm-7">
                            <?php echo $birthday; ?>
                        </div>
                    </div>
                    <div id="oldpwd" class="form-group row" style="display: none" >
                        <div class="col-sm-5">
                            <label>Ancien mot de passe :</label>
                        </div>
                        <div class="col-sm-7">
                            <input id ="old_pwd" name="old_pwd" class="form-control" type="password">
                        </div>
                    </div>
                    <div id="newpwd1" class="form-group row" style="display: none" >
                        <div class="col-sm-5">
                            <label>Nouveau mot de passe :</label>
                        </div>
                        <div class="col-sm-7">
                            <input id ="new_pwd_1" name="new_pwd_1" class="form-control" type="password">
                        </div>
                    </div>
                    <div id="newpwd2" class="form-group row" style="display: none" >
                        <div class="col-sm-5">
                            <label>Retappez votre nouveau mot de passe :</label>
                        </div>
                        <div class="col-sm-7">
                            <input id ="new_pwd_2" name="new_pwd_2" class="form-control" type="password">
                        </div>
                    </div>
                    <?php
                    if ($this->input->get('id') == '') {
                        echo '<button id="change" type="button" class="btn btn-primary btn-lg btn-block">Envie de changer vos informations ?</button>';
                        echo'<button id="save" style="display: none" type="submit" class="btn btn-primary btn-lg btn-block">Enregistrez vos changements</button>';
                        echo'</form>';
                    }
                    ?>
            </div>
        </div>
        <br />
        <br />
        <!-- /.col-lg-12 -->
    </div>

</div>
<!-- /#page-wrapper -->

<script>
    jQuery(document).ready(function () {
        edit();
        avatar();
    });
</script>    


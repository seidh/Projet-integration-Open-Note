<div id="page-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <?php
            echo'<h1 class="page-header">Conversation avec '.$affichage_name.'</h1>';
            ?>
        </div>
        
        <div class="form-group row">
            
            <div class="col-sm-12">
                <?php echo validation_errors();?>
                <div class="chat-panel panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-comments fa-fw"></i>
                        Chat
                        <div class="btn-group pull-right">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-chevron-down"></i>
                            </button>
                            
                        </div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <ul class="chat">
                            <?php
                            foreach ($liste_messages as $message) {
                                if ($message['user_id'] == $id) {
                                    $user_message = $this->user->user_data($message['user_id']);
                                    echo'<li class="left clearfix">';
                                    echo'<span class="chat-img pull-left">';
                                    if ($user_message['avatar'] == null) {
                                        echo '<img src="';
                                        echo base_url('assets/image/avatarDefault.png');
                                        echo '" alt="Avatar par défaut" class="img-circle" style="width:50px; height:50px;"/>';
                                    } else {
                                        echo '<img src="';
                                        echo base_url('assets/image');
                                        echo '/' . $user_message['avatar'] . '" alt="Mon Avatar" class="img-circle" style="width:50px; height:50px;"/>';
                                    }
                                    echo'</span>';
                                    echo'<div class="chat-body clearfix">';
                                    echo'<div class="header">';
                                    echo'<strong class="primary-font">' . $user_message['firstname'] . ' ' . $user_message['name'] . '</strong> ';
                                    echo'<small class="pull-right text-muted">';
                                    echo'<i class="fa fa-clock-o fa-fw"></i>' . $message['date_creation'];
                                    echo'</small>';
                                    echo'</div>';
                                    echo'<p>';
                                    echo $message['message'];
                                    echo'</p>';
                                    echo'</div>';
                                    echo'</li>';
                                } else {
                                    $user_message = $this->user->user_data($message['user_id']);
                                    echo'<li class="right clearfix">';
                                    echo'<span class="chat-img pull-right">';
                                    if ($user_message['avatar'] == null) {
                                        echo '<img src="';
                                        echo base_url('assets/image/avatarDefault.png');
                                        echo '" alt="Avatar par défaut" class="img-circle" style="width:50px; height:50px;"/>';
                                    } else {
                                        echo '<img src="';
                                        echo base_url('assets/image');
                                        echo '/' . $user_message['avatar'] . '" alt="Mon Avatar" class="img-circle" style="width:50px; height:50px;"/>';
                                    }
                                    echo'</span>';
                                    echo'<div class="chat-body clearfix">';
                                    echo'<div class="header">';
                                    echo'<strong class="pull-right primary-font">' . $user_message['firstname'] . ' ' . $user_message['name'] . '</strong> ';
                                    echo'<small class="pull-left text-muted">';
                                    echo'<i class="fa fa-clock-o fa-fw"></i>' . $message['date_creation'];
                                    echo'</small>';
                                    echo'</div>';
                                    echo'<br /><p class="pull-right">';
                                    echo $message['message'];
                                    echo'</p>';
                                    echo'</div>';
                                    echo'</li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <!-- /.panel-body -->
                    <?php
                    echo form_open('message/send');
                    ?>
                    <div class="panel-footer col-sm-12">
                        <textarea name="editor1" id="editor1" rows="5" cols="100">
                        </textarea>
                        <script>
                            // Replace the <textarea id="editor1"> with a CKEditor
                            // instance, using default configuration.
                            CKEDITOR.replace('editor1');
                        </script>
                        <input class="form-control"  name="conf_id" id="conf_id" type="text" style="display: none" value="<?php echo $conf_id ?>" />
                        <button type="sumbit" class="btn btn-success btn-lg btn-block">
                            Envoyer 
                        </button> 
                    </div>
                    </form>
                    <!-- /.panel-footer -->
                </div>
            </div>
        </div>
    </div>
</div>
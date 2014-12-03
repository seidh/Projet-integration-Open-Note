<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <div class="input-group">
                    <span class="navbar-brand sidebarLogo"><a href="<?php echo base_url('accueil') ?>"></a></span>
                </div>
                <!-- /input-group -->
            </li>
            <?php
            echo'<li><a href="'.base_url('message').'">Commencer une nouvelle conversation</a>';
            echo'</li>';
            $this->load->model('user', '', TRUE);
            $session_data = $this->session->userdata('logged_in');
            $data['id'] = $session_data['id'];
            $result = $this->user->user_data($data['id']);
            echo'<li><a href="' . base_url("message") . '">Mes conversations en cours<span class="fa arrow"></span></a>';
            echo'<ul class="nav nav-second-level">';
            $all_conversation = $this->conversation_model->get_all_conversation($result['id']);
            foreach ($all_conversation as $conf) {
                if ($conf['user_id'] == $result['id'])
                {
                    $friend = $this->user->user_data($conf['friend_id']);
                    echo'<li><a href="' . base_url("message/voir?id=" . $conf['id']) . '">Conversation avec ' . $friend['firstname'] .' '. $friend['name'] . '</a>';
                    echo'</li>';
                }
                else{
                    $friend = $this->user->user_data($conf['user_id']);
                    echo'<li><a href="' . base_url("message/voir?id=" . $conf['id']) . '">Conversation avec ' . $friend['firstname'] .' '. $friend['name'] . '</a>';
                    echo'</li>';
                }
                
            }
            echo '</ul></li>';
            ?>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>


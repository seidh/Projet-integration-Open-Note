<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <span class="navbar-brand sidebarLogo"><a href="<?php echo base_url('accueil') ?>"></a></span>
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                <!-- /input-group -->
            </li>
            <?php
            $this->load->model('user', '', TRUE);
            $session_data = $this->session->userdata('logged_in');
            $data['id'] = $session_data['id'];
            $result = $this->user->user_data($data['id']);

            $all_cat = $this->category_model->get_all_cat_mother();
            foreach ($all_cat as $cat) {
                if ($this->category_model->check_my_cat($cat['id'], $result['id'])) {
                    echo'<li><a href="">' . $cat['name'] . '<span class="fa arrow"></span></a>';
                    $all_cat_daughter = $this->category_model->get_all_cat_daughter($cat['id']);
                    echo'<ul class="nav nav-second-level">';
                    foreach ($all_cat_daughter as $cat_daughter) {
                        if ($this->category_model->check_my_cat($cat_daughter['id'], $result['id'])) {
                            echo'<li><a href="">' . $cat_daughter['name'] . '</a></li>';
                        }
                    }
                    echo'</ul>';
                    echo'</li>';
                }
            }
            ?>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>
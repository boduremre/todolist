<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="<?php echo base_url(); ?>">
        <img src="<?php echo base_url('/assets/img/logo1.png'); ?>" alt="TODO LIST"
             style="width: 128px; height: auto;">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div id="navbarNavDropdown" class="navbar-collapse collapse">
        <ul class="navbar-nav mr-auto">
            <!--<li class="nav-item">
                <a class="nav-link" href="<?php //echo base_url('/index.php/todo'); ?>">Anasayfa <span
                            class="sr-only">(current)</span></a>
            </li>
            <!--<li class="nav-item">
                <a class="nav-link" href="<?php //echo base_url('/index.php/todo/dashboard'); ?>">Yönetim Paneli</a>
            </li> -->
            <!--                <li class="nav-item">-->
            <!--                    <a class="nav-link" href="#">Pricing</a>-->
            <!--                </li>-->
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="javascript:;" id="navbarDropdownMenuLink"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Sn. <?php echo $this->session->userdata('name') . ' ' . $this->session->userdata('surname'); ?>
                    (<?php echo $this->session->userdata('username'); ?>)
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-backdrop="static"
                       data-target="#profilModal">Profil Bilgileri</a>
                    <a class="dropdown-item" href="<?php echo base_url('/index.php/todo/dashboard'); ?>">Ayarlar</a>
                    <a class="dropdown-item" href="<?php echo base_url('/index.php/login/logout'); ?>">Çıkış</a>
                </div>
            </li>
            <!--                <li class="nav-item">-->
            <!--                    <a class="nav-link" href="{{ url('/login') }}">Login</a>-->
            <!--                </li>-->
            <!--                <li class="nav-item">-->
            <!--                    <a class="nav-link" href="{{ url('/register') }}">Register</a>-->
            <!--                </li>-->
        </ul>
    </div>
</nav>

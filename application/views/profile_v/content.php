<div class="row">
    <div class="mx-auto col-sm-8">
        <!-- form user info -->
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Profil Bilgilerim</h4>
            </div>
            <div class="card-body">
                <?php echo form_open(base_url('/index.php/profile/update')); ?>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Ad</label>
                    <div class="col-lg-9">
                        <input class="form-control" name="name" type="text" value="<?php echo $user->name; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Soyad</label>
                    <div class="col-lg-9">
                        <input class="form-control" name="surname" type="text" value="<?php echo $user->surname; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Eposta</label>
                    <div class="col-lg-9">
                        <input class="form-control" name="email" type="email" value="<?php echo $user->email; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Kayıt Tarihi</label>
                    <div class="col-lg-9">
                        <input class="form-control" name="registerDate" type="text"
                               value="<?php echo $user->registerDate; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Aktif Mi?</label>
                    <div class="col-lg-9">
                        <div class="form-check">
                            <?php
                            if ($user->isActive) {
                                echo '<input type="checkbox" class="form-check-input disabled" id="isActive" checked disabled>';
                                echo '<label class="form-check-label" for="isActive">Evet</label>';
                            } else {
                                echo '<input type="checkbox" class="form-check-input disabled" id="isActive" disabled>';
                                echo '<label class="form-check-label" for="isActive">Hayır</label>';
                            } ?>

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Kullanıcı Adı</label>
                    <div class="col-lg-9">
                        <input class="form-control" type="text" name="username" value="<?php echo $user->username; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Şifre</label>
                    <div class="col-lg-9">
                        <input class="form-control" type="password" name="password" autocomplete="off">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Şifre (Tekrar)</label>
                    <div class="col-lg-9">
                        <?php echo form_error('confirm_password'); ?>
                        <input class="form-control" type="password" name="confirm_password" autocomplete="off">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label"></label>
                    <div class="col-lg-9">
                        <a href="<?php base_url(); ?>todo" class="btn btn-secondary">İptal</a>
                        <input type="submit" class="btn btn-primary" value="Güncelle">
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
        <!-- /form user info -->
    </div>
</div>

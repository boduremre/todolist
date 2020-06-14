<!DOCTYPE html>
<html lang="tr">
<head>
    <title>ToDo List - Şifremi Unuttum</title>
    <!--Bootsrap 4 CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!--Custom styles-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/'); ?>theme.css">
    <!-- iziToast -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/'); ?>iziToast.min.css">
</head>
<body>
<div class="container">
    <div class="d-flex justify-content-center h-100">
        <div class="card" style="height:250px;">
            <div class="card-header">
                <h3>Şifremi Unuttum</h3>
                <div class="d-flex justify-content-end social_icon">
                    <span><i class="fab fa-wpforms"></i></span>
                </div>
            </div>
            <div class="card-body">
                <?php echo form_open(base_url( '/index.php/password/send' ));?>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input name="email" type="email" class="form-control" placeholder="e-posta adresiniz"
                               autocomplete="off" required />
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Gönder" class="btn float-right login_btn">
                    </div>
                <?php echo form_close();?>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-center">
                    <a href="<?php echo base_url('/index.php/login'); ?>" style="color: #fff"><b>Giriş</b></a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="<?php echo base_url('assets/js/iziToast.min.js'); ?>"></script>
<?php $this->load->view("includes/alert"); ?>
</body>
</html>
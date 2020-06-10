<!-- Modal -->
<div class="modal fade" id="profilModal" tabindex="-1" role="dialog" aria-labelledby="profilModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profilModalLabel">Profil Bilgileri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="profilform" action="<?php echo base_url(); ?>index.php/login/update" method="post">
                    <div class="form-group row">
                        <label for="txtUsername" class="col-sm-4 col-form-label">Kullanıcı Adı</label>
                        <div class="col-sm-8">
                            <input type="text" readonly class="form-control-plaintext" id="txtUsername"
                                   value="<?php echo $this->session->userdata('username'); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txtUsername" class="col-sm-4 col-form-label">Yetki Düzeyi</label>
                        <div class="col-sm-8">
                            <input type="text" readonly class="form-control-plaintext" id="txtRole"
                                   value="Yönetici">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txtNameSurname" class="col-sm-4 col-form-label">Ad Soyad</label>
                        <div class="col-sm-8">
                            <input type="text"
                                   class="form-control"
                                   id="txtNameSurname"
								   name="namesurname"
                                   placeholder="Ad Soyad"
                                   value="<?php echo $this->session->userdata('name') . ' ' . $this->session->userdata('surname'); ?>">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                <button type="button" class="btn btn-success disabled" disabled>Kaydet</button>
            </div>
        </div>
    </div>
</div>
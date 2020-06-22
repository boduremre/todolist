<div class="row">
    <div class="col-md-12 col-sm-12">
        <?php echo form_open(base_url('/index.php/todo/insert')); ?>
            <div class="row">
                <div class="form-group col-md-12 col-sm-12">
                    <input type="text" name="todo_title" class="form-control"
                           placeholder="Yapılacak işi yaz entere bas..." required autocomplete="off">
                </div>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table id="myTable" class="display" data-pagelength="5">
                <thead>
                <tr>
                    <th scope="col">Açıklama</th>
                    <th scope="col">Tarih</th>
                    <th scope="col">Durum</th>                    
                </tr>
                </thead>
                <tbody>
                <?php foreach ($items as $item) { ?>
                    <tr>
                        <td style="width: 70%">
							<div><?php if ($item->isActive == 0) echo "<strike>" . $item->aciklama . "</strike>"; else echo $item->aciklama; ?>							
						</td>
                        <td style="width: 20%">
                            <?php echo ' <span class="badge badge-primary"><small>' . date("d-m-Y H:i:s", strtotime($item->createdDate)) . '</small></span>'; ?>
                            <?php
                            if ($item->completedDate != "0000-00-00 00:00:00") {
                                echo ' <span class="badge badge-success"><small>' . date("d-m-Y H:i:s", strtotime($item->completedDate)) . '</small></span>';
                            } else {
                                echo ' <span class="badge badge-danger"><small>TAMAMLANMADI</small></span>';
                            }
                            ?>
                        </td>
                        <td style="width: 10%">
                            <?php if ($item->isActive == 0) { ?>
								<a data-toggle="tooltip" title="Tamamlandı" href="<?php echo base_url("/index.php/complete/$item->id"); ?>" class="btn btn-sm btn-success disabled" disabled>
									<i class="fa fa-check-circle"></i>
								</a>
                            <?php } else { ?>
                                <a data-toggle="tooltip" title="Tamamlandı olarak işaretle" href="<?php echo base_url("/index.php/complete/$item->id"); ?>" class="btn btn-sm btn-primary">
									<i class="fa fa-check-circle"></i>
								</a>
                            <?php } ?>
							<a data-toggle="confirmation"
                               data-placement="left"
                               data-singleton="true"
                               title="Silmek istiyor musunuz?"
                               data-btn-cancel-label="Hayır"
                               data-btn-cancel-class="btn btn-sm btn-success"
                               data-btn-ok-label="Evet"
                               data-btn-ok-class="btn btn-sm btn-danger"
                               data-content="Bu işlem geri alınamaz!"
                               href="<?php echo base_url("/index.php/delete/$item->id"); ?>"
                               class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>						
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
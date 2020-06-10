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
                    <!--<th scope="col">İşlemler</th>-->
                </tr>
                </thead>
                <tbody>
                <?php foreach ($items as $item) { ?>
                    <tr data-gorev-id="<?php echo $item->id; ?>">
                        <td><?php if ($item->isActive == 0) echo "<strike>" . $item->aciklama . "</strike>"; else echo $item->aciklama; ?></td>
                        <td>
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
                            <?php if ($item->isActive == 1) { ?>
                                <input data-url="<?php echo base_url("/index.php/todo/isCompletedSetter/$item->id"); ?>"
                                       type="checkbox" class="js-switch" checked/>
                            <?php } else { ?>
                                <input data-url="<?php echo base_url("/index.php/todo/isCompletedSetter/$item->id"); ?>"
                                       type="checkbox" class="js-switch" disabled/>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div style="display:none;" id="deleteurl" data-url='<?php echo base_url("/index.php/todo/delete/$item->id"); ?>'></div>
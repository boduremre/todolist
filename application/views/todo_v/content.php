<div class="row">
    <div class="col-md-12 col-sm-12">
        <form action="<?php echo base_url('/index.php/todo/insert'); ?>" method="post">
            <div class="row">
                <div class="form-group col-md-12 col-sm-12">
                    <input type="text" name="todo_title" class="form-control"
                           placeholder="Yapılacak işi yaz entere bas..." required autocomplete="off">
                </div>

                <?php /*<div class="col-md-1 col-sm-1">
                        <button type="submit" class="btn btn-primary ">Kaydet</button>
                    </div> */ ?>
            </div>
        </form>
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
                <!--                <tfoot>-->
                <!--                <tr>-->
                <!--                    <th colspan="3" style="text-align: right;font-size: 11px;font-weight: normal">Sayfa <strong>{elapsed_time}</strong>-->
                <!--                        saniyede oluşturuldu.-->
                <!--                    </th>-->
                <!--                </tr>-->
                <!--                </tfoot>-->
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
                        <!--<td style="width: 5%">
                        <a href="<?php // echo base_url("/index.php/todo/delete/$item->id"); ?>"
                           class="btn btn-sm btn-danger"
                           data-toggle="confirmation"
                           data-singleton="true"
                           data-title="Emin misiniz?"
                           data-btn-cancel-label="Hayır"
                           data-btn-cancel-class="btn btn-sm btn-success"
                           data-btn-ok-label="Evet"
                           data-btn-ok-class="btn btn-sm btn-danger">Sil</a>
                    </td> -->
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div style="display:none;" id="deleteurl" data-url='<?php echo base_url("/index.php/todo/delete/$item->id"); ?>'></div>
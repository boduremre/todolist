<div class="row">
    <div class="col-md-12">
		<div class="card">
		  <div class="card-header">
			<h5 class="card-title">Son 10 Ziyaretiniz (<?php echo $this->session->userdata('username'); ?>)</h5>
		  </div>
		  <div class="card-body">
		  <div class="table-responsive">
			<table id="logTable" class="table table-striped table-sm" data-pagelength="10">
				<thead>
					<tr>                
						<th scope="col">Tarih</th>
						<th scope="col">IP Adresi</th>
						<th scope="col">Tarayıcı</th>
						<th scope="col">Platform</th>                
						<th scope="col">Konum</th>
					</tr>
				</thead>
				<tbody>
				<?php $i = 1;
				foreach ($items as $item) { ?>
					<tr>                    
						<td><?php echo date("d.m.Y H:i:s", strtotime($item->date)); ?></td>
						<td><?php echo $item->ip_address; ?></td>
						<td>
							<?php
                            echo $item->browser;
                            /*
							if ($this->agent->is_browser()) {
								echo $agent = $this->agent->browser(); //. ' ' . $this->agent->version();
							} elseif ($this->agent->is_robot()) {
								echo $agent = $this->agent->robot();
							} elseif ($this->agent->is_mobile()) {
								echo $agent = $this->agent->mobile();
							} else {
								echo "Tanımlanamayan Tarayıcı";
							}*/
							?>
						</td>
						<td>
							<?php echo $item->platform; // Platform info (Windows, Linux, Mac, etc.) ?>
						</td>
                        <td>
                            <?php echo $item->geo_loc; ?>
                        </td>
					</tr>
					<?php
				} ?>
				</tbody>
			</table>
		 </div>
		  </div>
		</div>       
    </div>
</div>
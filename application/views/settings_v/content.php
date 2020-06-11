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
<?php if($this->session->userdata('isAdmin')){ ?>
<div class="row mt-3">
    <div class="col-md-12">
		<div class="card">
		  <div class="card-header">
			<h5 class="card-title">Kullanıcılar</h5>
		  </div>
		  <div class="card-body">
		  <div class="table-responsive">
			<table id="logTable" class="table table-striped table-sm" data-pagelength="10">
				<thead>
					<tr>                
						<th scope="col">ID</th>
						<th scope="col">Kullanıcı Adı</th>
						<th scope="col">Ad</th>
						<th scope="col">Soyad</th>                
						<th scope="col">Eposta</th>
						<th scope="col">Kay. Tarihi</th>
						<th scope="col">Yetki</th>
						<th scope="col">İşl.</th>
					</tr>
				</thead>
				<tbody>
				<?php
					foreach ($users as $user) { ?>
						<tr>                    						
							<td><?php echo $user->id; ?></td>
							<td>
								<?php echo $user->username; ?>
								<?php 
								if($user->isActive)								  
									echo '<a href="'.base_url().'index.php/user/setactive/'.$user->id.'/0"<i class="fa fa-user" style="color:green;" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Kullanıcı Aktif"></i></a>';
								else
								  echo '<a href="'.base_url().'index.php/user/setactive/'.$user->id.'/1"<i class="fa fa-user-times" style="color:red;" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Kullanıcı Deaktif"></i></a>';
								?>
							</td>
							<td><?php echo $user->name; ?></td>
							<td><?php echo $user->surname; ?></td>
							<td>
								<?php echo $user->email; ?>&nbsp;
								<?php 
								if($user->emailConfirmed)
								  echo '<i class="fa fa-check-circle" style="color:green;" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Eposta adresi doğrulandı."></i>';
								else
								  echo '<a href="'.base_url().'index.php/email"<i class="fa fa-times" style="color:red;" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Eposta adresi doğrulanmadı. Doğrulamak için tıklayınız."></i></a>';
								?>
							</td>
							<td><?php echo date("d.m.Y H:i:s", strtotime($user->registerDate)); ?></td>
							<td><?php echo ($user->isAdmin == 1 ? 'Yönetici' : 'Kullanıcı'); ?></td>
							<td>
								<a href="#" data-user-id="<?php echo $user->id; ?>" data-username="<?php echo $user->username; ?>" class="btn btn-sm btn-primary btn-getUserLogs">
									<i class="fa fa fa-history" data-toggle="tooltip" data-placement="top" title="Kullanıcı Logları"></i>
								</a>
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
<div class="row mt-3" id="userlogs">
    <div class="col-md-12">
		<div class="card">
		  <div class="card-header">
			<h5 class="card-title">Kullanıcı Hareketleri (<span id="spanUsername"></span>)</h5>
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
				
				</tbody>
			</table>
		 </div>
		  </div>
		</div>       
    </div>
</div>
<?php } ?>
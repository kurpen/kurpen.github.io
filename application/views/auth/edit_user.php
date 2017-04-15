<section id="edit-user">
	<div class="container">
		<div class="col-lg-9 col-md-9 col-sm-12">
			<h4>Twój profil</h4>
			<hr/>

			<div id="infoMessage"><?php echo $message;?></div>

			
			<?php echo form_open_multipart(uri_string());?>
				<div class="col-lg-12 col-md-12 col-sm-12">
					<?php if($user->restaurant_id != NULL){?>
						<div class="col-lg-4 col-md-4 col-sm-12 data-container">
							<div class="lokal-image">
								<img src="<?php echo $lokal['pic']?>">
								<?php echo lang('edit_user_pic_label', 'pic');?> <br />
								<?php echo form_input($pic);?>
							</div>
						</div>
					<?php }?>
					<div class="col-lg-4 col-md-4 col-sm-12 data-container">
						  <p>
								<?php echo lang('edit_user_fname_label', 'first_name');?> <br />
								<?php echo form_input($first_name);?>
						  </p>

						  <p>
								<?php echo lang('edit_user_lname_label', 'last_name');?> <br />
								<?php echo form_input($last_name);?>
						  </p>

						  <p>
								<?php echo lang('edit_user_company_label', 'company');?> <br />
								<?php echo form_input($company);?>
						  </p>
						  
						  <p>
								<?php echo lang('edit_user_nip_label', 'nip');?> <br />
								<?php echo form_input($nip);?>
						  </p>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12 data-container">
						<p>
							<?php echo lang('edit_user_phone_label', 'phone');?> <br />
							<?php echo form_input($phone);?>
					  </p>

					  <p>
							<?php echo lang('edit_user_password_label', 'password');?> <br />
							<?php echo form_input($password);?>
					  </p>

					  <p>
							<?php echo lang('edit_user_password_confirm_label', 'password_confirm');?><br />
							<?php echo form_input($password_confirm);?>
					  </p>

					  <?php if ($this->ion_auth->is_admin()): ?>

						  <h3><?php echo lang('edit_user_groups_heading');?></h3>
						  <?php foreach ($groups as $group):?>
							  <label class="checkbox">
							  <?php
								  $gID=$group['id'];
								  $checked = null;
								  $item = null;
								  foreach($currentGroups as $grp) {
									  if ($gID == $grp->id) {
										  $checked= ' checked="checked"';
									  break;
									  }
								  }
							  ?>
							  <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
							  <?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>
							  </label>
						  <?php endforeach?>

					  <?php endif ?>

					  <?php echo form_hidden('id', $user->id);?>
					  <?php echo form_hidden($csrf); ?>
					</div>
				</div>

				<p><?php echo form_submit('submit', 'Zapisz zmiany');?></p>

			<?php echo form_close();?>
		</div>
	</div>
</section>

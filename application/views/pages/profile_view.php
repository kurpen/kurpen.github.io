<section id="profile">
	<div class="container">
			<div class="col-lg-6 col-md-6 col-sm-12">
				<h4>Twój profil <?php echo $user->id;?></h4>
				<?php echo validation_errors(); ?>
				<?php echo form_open_multipart('profile/user_profile'); ?>
				<hr/>
				<form>
					<div class="col-lg-6 col-md-6 col-sm-12 data-container">
						<input type="input" name="first_name" placeholder="Imię" value="<?php echo $user->first_name?>"/><br/>
						<input type="input" name="last_name" placeholder="Nazwisko" value="<?php echo $user->last_name?>"/><br/>
						<input type="input" name="phone" placeholder="Telefon" value="<?php echo $user->phone?>"/><br/>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 data-container">
						<input type="input" name="email" placeholder="e-mail" value="<?php echo $user->email?>"/><br/>
						<input type="input" name="password" placeholder="Zmień hasło" value=""/><br/>
						<input type="input" name="password-conf" placeholder="Powtórz hasło" value=""/><br/>
					</div>
					<input type="submit" name="submit" value="Zapisz zmiany" />
				</form>
			</div>
		</div>
</section>
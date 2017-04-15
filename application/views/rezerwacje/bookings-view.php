<section id="rezerwuj-lokal">
	<div class="container">
		<h2><?php echo $title; ?></h2>
		<?php echo validation_errors(); ?>
		
		<?php echo form_open_multipart('lokale/book'); ?>
		
		<table>
			<tr>
				<td><label for="first_name">Imię</label></td>
				<?php if ($this->session->userdata('login') || $this->ion_auth->logged_in()){ ?>
				<td><input type="input" name="first_name" value="<?php echo $user->first_name?>"/><br /></td>
				<?php } else{?>
				<td><input type="input" name="first_name"/><br /></td>
				<?php }?>
			</tr>
			<tr>
				<td><label for="last_name">Nazwisko</label></td>
				<?php if ($this->session->userdata('login') || $this->ion_auth->logged_in()){ ?>
				<td><input type="input" name="last_name" value="<?php echo $user->first_name?>"/><br /></td>
				<?php } else{?>
				<td><input type="input" name="last_name"/><br /></td>
				<?php }?>
			</tr>
			<tr>
				<td><label for="phone">Telefon</label></td>
				<?php if ($this->session->userdata('login') || $this->ion_auth->logged_in()){ ?>
				<td><input type="input" name="phone" value="<?php echo $user->first_name?>"/><br /></td>
				<?php } else{?>
				<td><input type="input" name="phone"/><br /></td>
				<?php }?>
			</tr>
			<tr>
				<td><label for="data">Data</label></td>
				<td><input id="data" type="date" name="data" value="<?php print(date("Y-m-d")); ?>" min="<?php echo date("y-m-d"); ?>"/><br /></td>
				<script>
					var today = new Date();
					var dd = today.getDate();
					var dd1 = today.getDate()+7;
					var mm = today.getMonth()+1; //January is 0!
					var yyyy = today.getFullYear();
					 if(dd<10){
							dd='0'+dd
						} 
						if(mm<10){
							mm='0'+mm
						} 

					today = yyyy+'-'+mm+'-'+dd;
					week = yyyy+'-'+mm+'-'+dd1;
					document.getElementById("data").setAttribute("min", today);
					document.getElementById("data").setAttribute("max", week);
				</script>
			</tr>
			<tr>
				<td><label for="time">Godzina</label></td>
				<td><input type="time" name="time" /><br /></td>
			</tr>
			<tr>
				<td><label for="time1">Godzina</label></td>
				<td><select name="time1">
					<option value="12:00">12:00</option>
				</select><br /></td>
			</tr>
			<tr>
				<td><label for="l_osob">Liczba osób</label></td>
				<td><select name="l_osob">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="5">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="15">15</option>
					<option value="20">20</option>
				</select><br /></td>
			<tr>
			<tr>
				<td colspan="2" style="text-align:center;"><input type="submit" name="submit" value="Rezerwuj" /></td>
			</tr>
		</form>
		</table>
	</div>
</section>
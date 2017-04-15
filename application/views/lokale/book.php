<section id="rezerwuj-lokal">
	<div class="container">
		<h2><?php echo $title; ?></h2>
		
		<?php echo validation_errors(); ?>
		<?php
		$_SESSION['rest_id'] = $id;
		$_SESSION['user_id'] = $user->id;	
			?>
		<?php echo form_open_multipart('rezerwacja/book'); ?>
		<?php $lokal_id = $lokal['id'];?>
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
				<td><input type="input" name="last_name" value="<?php echo $user->last_name?>"/><br /></td>
				<?php } else{?>
				<td><input type="input" name="last_name"/><br /></td>
				<?php }?>
			</tr>
			<tr>
				<td><label for="phone">Telefon</label></td>
				<?php if ($this->session->userdata('login') || $this->ion_auth->logged_in()){ ?>
				<td><input type="input" name="phone" value="<?php echo $user->phone?>"/><br /></td>
				<?php } else{?>
				<td><input type="input" name="phone"/><br /></td>
				<?php }?>
			</tr>
			<tr>
				<td><label for="date">Czas</label></td>
				<td><input id="date" type="text" name="date"  class="form_datetime"/><br /></td>
				<script type="text/javascript">
				var now = new Date();
				now.setMinutes(now.getMinutes() + 30);
					$(".form_datetime").datetimepicker({
						setDate: now,
						autoclose: true,
						startDate: now,
						endDate: '+7d',
						format: 'dd-mm-yyyy hh:ii'});
					//document.getElementById("date").setAttribute("value", now);
				</script>            
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
					document.getElementById("date").setAttribute("startDate", 0);
					document.getElementById("date").setAttribute("max", week);
				</script>
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
				<td colspan="2" style="text-align:center;"><input id="rezerwuj" type="submit" name="submit" value="Rezerwuj"/></td>
			</tr>
		</form>
		</table>
	</div>
</section>
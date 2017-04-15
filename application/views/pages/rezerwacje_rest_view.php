<section id="rezerwacje">
	<div class="container">
		<h2 class="text-center"><?php echo $title; ?></h2>
		<div class="col-lg-9 col-sm-12 legenda">
		<div class="col-lg-4 col-md-4"><span><i style="color: orange; font-size: 20px;" class="fa fa-times" aria-hidden="true"></i> - Brak potwierdzenia</span></div>
		<div class="col-lg-4 col-md-4"><span><i style="color: green; font-size: 20px;" class="fa fa-check" aria-hidden="true"></i> - Potwierdzenie</span></div>
		<div class="col-lg-4 col-md-4"><span><i style="color: red; font-size: 20px;" class="fa fa-ban" aria-hidden="true"></i> - Odrzucenie</span></div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12">
			<?php if($rezerwacje == null){ ?>
				<p> Nie znaleziono rezerwacji :( </p>
			<?php }?>
				<div class="rezerwacja">
					<div class="rezerwacja-container">
						<div class="rezerwacja-row">
							<div class="column column1">
								Data złożenia rezerwacji
							</div>
							<div class="column column1">
								Czas rezerwacji
							</div>
							<div class="column column2">
								Imię i nazwisko
							</div>
							<div class="column column3">
								Liczba osób
							</div>
							<div class="column column4">
								Potwierdzenie
							</div>
						</div>
						<?php foreach ($rezerwacje as $rezerwacja): ?>
						<script>
							$('#potwierdz').click(function(){
								var class_id = $("#potwierdz").prop("class");
								var class_id = class_id.replace('potwierdzenie-', '');
								console.log('Class_id: '+class_id);
								var id = $("#potwierdz").parent().prop("id");
								var id = id.replace('potwierdzenie-', '');
								if(class_id == id){
									console.log('potwierdzenie: '+id);
									$.ajax({ url: "<?php echo base_url();?>functions.php",
									 data: {action: 'potwierdz', rez_id: id},
									 type: "POST",
									 success: function(output) {
												  console.log('potwierdzono dla ID: '+id);
												  location.reload();
											  }
									});
								}
							});
							$('#odrzuc').click(function(){
								var class_id = $("#odrzuc").prop("class");
								var class_id = class_id.replace('potwierdzenie-', '');
								console.log('Class_id: '+class_id);
								var id = $("#odrzuc").parent().prop("id");
								var id = id.replace('potwierdzenie-', '');
								if(class_id == id){
									console.log('potwierdzenie: '+id);
									$.ajax({ url: "<?php echo base_url();?>functions.php",
									 data: {action: 'odrzuc', rez_id: id},
									 type: "POST",
									 success: function(output) {
												  console.log(output);
												  console.log('Odrzucono dla ID: '+id);
												  location.reload();
											  }
									});
								}
							});
						</script>
						<div class="rezerwacja-row">
							<div class="column column1">
								<?php echo date( 'd/m/Y G:i', strtotime($rezerwacja['data_rezerwacji'])) ;?>
							</div>
							<div class="column column1">
								<?php echo date( 'd/m/Y G:i', strtotime($rezerwacja['data'])) ;?>
							</div>
							<div class="column column2">
								<?php echo $rezerwacja['first_name'].' '.$rezerwacja['last_name'];?>
							</div>
							<div class="column column3">
								<?php echo $rezerwacja['l_osob'];?>
							</div>
							<div id="potwierdzenie-<?php echo $rezerwacja['id'];?>" class="column column4">
								<?php if($rezerwacja['potwierdzenie'] == 0)
								{?>
									<button class="potwierdzenie-<?php echo $rezerwacja['id'];?>" id="potwierdz">Potwierdz</button>
									<button class="potwierdzenie-<?php echo $rezerwacja['id'];?>" id="odrzuc">Odrzuć</button>
								<?php
								}else if ($rezerwacja['potwierdzenie'] == 1){
									echo '<i style="color: green; font-size: 20px;" class="fa fa-check" aria-hidden="true"></i>';
								} else{
									echo '<i style="color: red; font-size: 20px;" class="fa fa-ban" aria-hidden="true"></i>';
								}?>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php foreach ($rezerwacje as $rezerwacja): ?>
			<?php endforeach; ?>
		</div>
	</div>
</section>
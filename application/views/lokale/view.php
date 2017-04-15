<section id="lokal-view">
	<div class="container">
		<div class="col-lg-6 col-md-6 col-sm-12">
			<div class="lokal-opening-hours">
				<h2><i class="fa fa-clock-o" aria-hidden="true"></i> Godziny otwarcia</h2>
				<table>
					<tr>
						<td>Poniedziałek</td>
						<td><?php echo sprintf('%02d:%02d', (int) $godziny['pon_o'], fmod($godziny['pon_o'], 1) * 60);?> - <?php echo sprintf('%02d:%02d', (int) $godziny['pon_z'], fmod($godziny['pon_z'], 1) * 60);?></td>
					</tr>
					<tr>
						<td>Wtorek</td>
						<td><?php echo sprintf('%02d:%02d', (int) $godziny['wt_o'], fmod($godziny['wt_o'], 1) * 60);?> - <?php echo sprintf('%02d:%02d', (int) $godziny['wt_z'], fmod($godziny['wt_z'], 1) * 60);?></td>
					</tr>
					<tr>
						<td>Środa</td>
						<td><?php echo sprintf('%02d:%02d', (int) $godziny['sr_o'], fmod($godziny['sr_o'], 1) * 60);?> - <?php echo sprintf('%02d:%02d', (int) $godziny['sr_z'], fmod($godziny['sr_z'], 1) * 60);?></td>
					</tr>
					<tr>
						<td>Czwartek</td>
						<td><?php echo sprintf('%02d:%02d', (int) $godziny['czw_o'], fmod($godziny['czw_o'], 1) * 60);?> - <?php echo sprintf('%02d:%02d', (int) $godziny['czw_z'], fmod($godziny['czw_z'], 1) * 60);?></td>
					</tr>
					<tr>
						<td>Piątek</td>
						<td><?php echo sprintf('%02d:%02d', (int) $godziny['pt_o'], fmod($godziny['pt_o'], 1) * 60);?> - <?php echo sprintf('%02d:%02d', (int) $godziny['pt_z'], fmod($godziny['pt_z'], 1) * 60);?></td>
					</tr>
					<tr>
						<td>Sobota</td>
						<td><?php echo sprintf('%02d:%02d', (int) $godziny['sob_o'], fmod($godziny['sob_o'], 1) * 60);?> - <?php echo sprintf('%02d:%02d', (int) $godziny['sob_z'], fmod($godziny['sob_z'], 1) * 60);?></td>
					</tr>
					<tr>
						<td>Niedziela</td>
						<td><?php echo sprintf('%02d:%02d', (int) $godziny['nd_o'], fmod($godziny['nd_o'], 1) * 60);?> - <?php echo sprintf('%02d:%02d', (int) $godziny['nd_z'], fmod($godziny['nd_z'], 1) * 60);?></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12">
			<div class="lokal-mapa">
				<iframe width="100%" height="260" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=<?php echo $lokal['adres1'];?>+<?php echo $lokal['adres2'];?>+<?php echo $miasto['miasto'];?>,+<?php echo $lokal['kod_pocztowy'];?>&key=AIzaSyBy2DNURIwC78WQ4LxEpvb5A47uNJ5iYI8"></iframe> 
			</div>
		</div>
	</div>
</section>
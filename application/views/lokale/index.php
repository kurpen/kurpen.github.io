<section id="lokale">
	<div class="container">
		<h2 class="text-center"><?php echo $title; ?></h2>
		<div class="col-lg-4 col-md-4 col-sm-12">
			
		</div>
		<div class="col-lg-8 col-md-8 col-sm-12">
			<?php if($lokale == null){ ?>
				<p> Nie znaleziono lokali dla miasta <?php echo $city; ?></p>
			<?php }?>
			<?php foreach ($lokale as $lokale_item): ?>
				<div onclick="location.href='<?php echo site_url('lokale/'.$lokale_item['slug']); ?>';" class="lokal">
					<div class="lokal-container">
						<div class="lokal-logo">
							<div class="logo">
								<img src="<?php echo $lokale_item['pic']?>">
							</div>
						</div>
						<div class="lokal-info">
							<h3><?php echo $lokale_item['nazwa']; ?></h3>
							<div class="lokal-description">
								<p><?php echo (strlen($lokale_item['opis']) > 153) ? substr($lokale_item['opis'],0,150).'...' : $lokale_item['opis'].'.'; ?></p>
							</div>
							<div class="lokal-location">
								<?php if ($lokale_item['adres2'] != null){?>
									<p><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo ' '.$miasta[$lokale_item['miasto_id']-1]['miasto'].', '.$lokale_item['adres1'].', '.$lokale_item['adres2']; ?></p>
								<?php } else{ ?>
									<p><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo ' '.$miasta[$lokale_item['miasto_id']-1]['miasto'].', '.$lokale_item['adres1'];?></p>
								<?php }?>
							</div>
							<?php if($lokale_item['wolne_miejsca'] >= 10){ ?>
								<div class="lokal-miejsca-green">
									<p><i class="fa fa-users" aria-hidden="true"></i><?php echo ' Wolne miejsca: '.$lokale_item['wolne_miejsca'];?></p>
								</div>
							<?php } else if($lokale_item['wolne_miejsca'] >= 1){ ?>
								<div class="lokal-miejsca-orange">
									<p><i class="fa fa-users" aria-hidden="true"></i><?php echo ' Wolne miejsca: '.$lokale_item['wolne_miejsca'];?></p>
								</div>
							<?php } else{ ?>
								<div class="lokal-miejsca-red">
									<p><i class="fa fa-users" aria-hidden="true"></i><?php echo ' Wolne miejsca: '.$lokale_item['wolne_miejsca'];?></p>
								</div>
							<?php }?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
			<div><p><a href="<?php echo site_url('lokale/create');?>">Dodaj lokal</a></p></div>
			<div><p><a href="/">Home</a></p></div>
		</div>
	</div>
</section>
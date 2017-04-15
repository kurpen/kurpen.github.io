<html>
	<head>
		<!-- Chrome, Firefox OS, Opera and Vivaldi -->
        <!-- Compiled and minified CSS -->
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/css/materialize.css">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/css/materialize.css">
          <link rel="stylesheet" href="/assets/css/main.css">
          <!-- Compiled and minified JavaScript -->
          
		<meta name="theme-color" content="#222222">
		<!-- Windows Phone -->
		<meta name="msapplication-navbutton-color" content="#222222">
		<!-- iOS Safari -->
		<meta name="apple-mobile-web-app-status-bar-style" content="#222222">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title>CodeIgniter Tutorial</title>
		<!--FAVICONS-->
		<link rel="apple-touch-icon" sizes="57x57" href="/favicon/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/favicon/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/favicon/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/favicon/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/favicon/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/favicon/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/favicon/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/favicon/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="/favicon/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="/favicon/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
		<link rel="manifest" href="/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">
		<!--STYLES-->
		
		<!--SCRIPTS-->
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/js/materialize.min.js"></script>
		<script src="/assets/js/main.js"></script>
		<script src="/assets/js/modernizr.js"></script>
		<script src="/assets/js/index.js"></script>
		<script src="/assets/js/selectize.js"></script>
       


		<script type="text/javascript">
		  <?php if($this->ion_auth->logged_in()){
			  $id = $user->id;
		  }else{
			  $id = 0;
		  }
		  $_SESSION['lokal_id'] = $lokal['id'];?>
			  var id = <?php echo $id?>;
		</script>
		<!--<script src="/assets/js/notify.js"></script>-->
		<script src="https://use.fontawesome.com/f2f686dde1.js"></script>
		
		<script>
			
		setInterval(function() {
			if(!<?php echo $this->ion_auth->logged_in(); ?>){
				var rest_id = 0;
			}else{
				var rest_id = <?php echo $_SESSION['lokal_id']; ?>;
			}
			console.log("Rest id: "+rest_id);
			console.log("User id: "+id);
			//console.log("Rest id: "+rest_id);
			$.ajax({
			url:"<?php echo base_url();?>functions.php",
			data: {action: 'get_rezerwacje'},
			type:"POST",
			success:function(data){
				rezerwacje=data;
				$.each(rezerwacje, function(index, value){
					//console.log("Index #" + index+ ": " + value['shown'] + " ");
					//console.log(value);
					if((value['shown'] == 0) && (rest_id == value['restaurant_id']) ){
						NotificationsTest.ShowNotification();
						$.ajax({ url: "<?php echo base_url();?>functions.php",
						 data: {action: 'set_shown', rez_id: value['id']},
						 type: "POST",
						 success: function(output) {
									  //console.log(output);
								  }
				});
					}
				});
				//console.log("-------------------------");
			},
			dataType:"json"
			});
		}, 5000);
			var NotificationsTest = {
				VerifyBrowserSupport: function() {
					return ("Notification" in window);
				},
				ShowNotification: function(){
					var notification = new Notification("User id: " + id);
					notification.onclick = function () {
					if (window.location.pathname != "/index.php/rezerwacje"){
						window.location.replace("/index.php/rezerwacje"); 
					}
						//window.location.replace("/index.php/rezerwacje"); 
						notification.close();
					};
				},
				RequestForPermissionAndShow: function(){
					// Mamy prawo wyświetlać powiadomienia
					if ((Notification.permission === "granted") && (id == 3)) {
						//console.log("Login: " + <?php echo $this->ion_auth->logged_in();?>);
						//console.log(logged);
						console.log("User ID: " + id);
						NotificationsTest.ShowNotification();
					}
					// Brak wsparcia w Chrome dla właściwości permission
					else if (Notification.permission !== "denied") {
						Notification.requestPermission(function (permission) {
							// Dodajemy właściwość permission do obiektu Notification
							if(!("permission" in Notification)) {
								Notification.permission = permission;
							}
							if ((permission === "granted") && (id == 3)) {
								NotificationsTest.ShowNotification();
							}
						});
					}
				}
			}
			/*window.onload = function(){
				document.getElementById("shownotify").onclick = function(){
					if(!NotificationsTest.VerifyBrowserSupport()){
						alert("Brak wsparcia dla Notifications API");               
					}
					NotificationsTest.RequestForPermissionAndShow();
				};
			};*/
             
        </script>
	</head>
	<body>
	<?php setlocale(LC_ALL, 'pl_PL.UTF-8','pl.UTF-8','pol.UTF-8','plk.UTF-8','polish.UTF-8','poland.UTF-8');?>
		<header class="navbar navbar-default" style="box-shadow: black 0px 30px 100px;">
			<div class="container">
				  <div class="menu-logo">
				  <a class="navbar-brand" href="/"><img src="/assets/graphics/logo/logo_wide_1.png"></a>
				  </div>
				  <ul class="nav navbar-nav">
					<?php if ($this->ion_auth->logged_in() AND !($this->ion_auth->is_admin())){ ?>
						<li>
							<div class="menu-button">
								<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i style="font-size: 20px;" class="fa fa-user-circle-o" aria-hidden="true"></i>  <?php echo $user->first_name; ?>  <span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li><a href="<?php echo base_url(); ?>index.php/edit/<?php echo $user->id;?>"><i class="fa fa-user" aria-hidden="true"></i> Profil</a></li>
									<li><a href="<?php echo base_url(); ?>index.php/rezerwacje"><i class="fa fa-book" aria-hidden="true"></i> Rezerwacje</a></li>
									<li><a href="<?php echo base_url(); ?>index.php/auth/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Wyloguj</a></li>
								</ul>
							</div>
						</li>
					<?php } else if($this->ion_auth->is_admin()){ ?>
						<li>
							<div class="menu-button">
								<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i style="font-size: 20px;" class="fa fa-user-circle-o" aria-hidden="true"></i>  <?php echo $user->first_name; ?>  <span class="caret"></span></button>
								<script>
								$( "#btn-user" ).click(function() {
								  $( this ).toggleClass( "expanded" );
								});
								</script>
								<ul class="dropdown-menu">
									<li><a href="<?php echo base_url(); ?>index.php/lokale/create"><i class="fa fa-plus-square" aria-hidden="true"></i> Dodaj lokal</a></li>
									<li><a href="<?php echo base_url(); ?>index.php/edit/<?php echo $user->id;?>"><i class="fa fa-user" aria-hidden="true"></i> Profil</a></li>
									<li><a href="<?php echo base_url(); ?>index.php/rezerwacje"><i class="fa fa-book" aria-hidden="true"></i> Rezerwacje</a></li>
									<li><a href="<?php echo base_url(); ?>index.php/auth/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Wyloguj</a></li>
									
								</ul>
							</div>
						</li>
					<?php } else{?>
						<div class="menu-button">
							<button id="login-btn" class="btn btn-primary" type="button" onClick="document.location.href='/index.php/auth/login'">Zaloguj</button>
						</div>
					<?php }?>
				  </ul>
				
			</div>
		</header>
		<section class="home-header-lokal">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 lokal-wrapper">
				<div class="col-lg-4 col-md-4 col-sm-12 lokal-info-wrapper">
					<?php if(!$this->ion_auth->logged_in()){ ?>
						<a class="rezerwacja" href="<?php echo base_url(); ?>index.php/login"><div>Rezerwuj stolik</div></a>
					<?php }else if($this->ion_auth->get_users_groups($user->id)->row()->name == 'klient'){ ?>
						<a class="rezerwacja" href="<?php echo base_url(); ?>index.php/book/<?php echo $lokal['id'] ?>"><div>Rezerwuj stolik</div></a>
					<?php } ?>

					
				</div>
				<div class="col-lg-4 col-md-4 col-sm-12 lokal-info-wrapper">
					<?php echo '<h2>'.$lokal['nazwa'].'</h2><br>'; ?>
					<p class="lokal-address"><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo ' '.$miasto['miasto'].', '.$lokal['adres1'].', '.$lokal['adres2']; ?></p>
					<?php if($lokal['wolne_miejsca'] >= 10){ ?>
								<div class="lokal-miejsca-green">
									<p><i class="fa fa-users" aria-hidden="true"></i><?php echo ' Wolne miejsca: '.$lokal['wolne_miejsca'];?></p>
								</div>
							<?php } else if($lokal['wolne_miejsca'] >= 1){ ?>
								<div class="lokal-miejsca-orange">
									<p><i class="fa fa-users" aria-hidden="true"></i><?php echo ' Wolne miejsca: '.$lokal['wolne_miejsca'];?></p>
								</div>
							<?php } else{ ?>
								<div class="lokal-miejsca-red">
									<p><i class="fa fa-users" aria-hidden="true"></i><?php echo ' Wolne miejsca: '.$lokal['wolne_miejsca'];?></p>
								</div>
							<?php }?>
				</div>
				
				<div class="col-lg-4 col-md-4 col-sm-12 lokal-image-wrapper">
					<div class="lokal-image">
						<img src="<?php echo $lokal['pic']?>">
					</div>
				</div>

			</div>
		</section>
		<!-- PASEK -->
		<section id="bar">
			<div class="container">
				<ul>
					<li><a href="/"><i class="fa fa-home" aria-hidden="true"></i></a></li>
					<?php if(isset($view)){ ?>
						<li> > <a href="<?php echo $view_link; ?>"><?php echo $view; ?></a></li>
					<?php } ?>
					<?php if(isset($view2)){ ?>
						<li> > <a href="<?php echo $view_link2; ?>"><?php echo $view2; ?></a></li>
					<?php } ?>
				</ul>
			</div>
		</section>
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
		<title>Stoliczek.com.pl</title>
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
		  if(<?php echo $this->ion_auth->logged_in();?>){
			  var id = '<?php echo $user->id; ?>';
			  var rest_id = '<?php echo $user->restaurant_id; ?>';
		  } else{
			var id = 0;  
			var rest_id = 0;
		  }
		</script>
		<!--<script src="/assets/js/notify.js"></script>-->
		<script src="https://use.fontawesome.com/f2f686dde1.js"></script>
		 


		<script>
		  if(<?php echo $this->ion_auth->logged_in();?>){
			  setInterval(function() {
				console.log("Rest id: "+rest_id);
				console.log("User id: "+id);
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
							if(NotificationsTest.RequestForPermissionAndShow()){
								console.log('Shown1');
							}else{
								console.log('Not shown');
							}
							
							$.ajax({ url: "<?php echo base_url();?>functions.php",
							 data: {action: 'set_shown', rez_id: value['id']},
							 type: "POST",
							 success: function(output) {
										  //console.log(output);
									  }
							});
						};
						if((window.location.pathname == "/index.php/rezerwacje") && rest_id == ''){
							if(value['potwierdzenie'] == 0){
								var potwierdzenie = '<i style="color: orange; font-size: 20px;" class="fa fa-times" aria-hidden="true"></i>';
							}else if(value['potwierdzenie'] == 1){
								var potwierdzenie = '<i style="color: green; font-size: 20px;" class="fa fa-check" aria-hidden="true"></i>';
							}else {
								var potwierdzenie = '<i style="color: red; font-size: 20px;" class="fa fa-ban" aria-hidden="true"></i>';
							};
							$('#potwierdzenie-'+value['id']).html(potwierdzenie);
						}else{
							//console.log("Coś nie tak");
							//console.log(rest_id);
						};
					});
					//console.log("-------------------------");
					if((window.location.pathname == "/index.php/rezerwacje") && rest_id == ''){
							 //console.log("Widok rezerwacji + konto klient");
					}else{
						//console.log("Coś nie tak");
						//console.log(rest_id);
					}
				},
				dataType:"json"
				});
			}, 5000);
		  };
		
			var NotificationsTest = {
				VerifyBrowserSupport: function() {
					return ("Notification" in window);
				},
				ShowNotification: function(){
					console.log('Shown');
					var notification = new Notification("User id: " + id);
					notification.onclick = function () {
					if (window.location.pathname != "/index.php/rezerwacje"){
						window.location.replace("/index.php/rezerwacje"); 
					} else{
						location.refresh();
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
	<?php setlocale(LC_ALL, 'pl_PL.UTF-8','pl.UTF-8','pol.UTF-8','plk.UTF-8','polish.UTF-8','poland.UTF-8');
	date_default_timezone_set('Europe/Warsaw');?>
		<header class="navbar navbar-default" >
			
                <div class = 'row main-header'> 
				  <div class="menu-logo col s3">
				  <a class="navbar-brand" href="/"><img src="/assets/graphics/logo/logo_wide_1.png" style='width: 100%'></a>
				  </div>
				  <ul class="nav navbar-nav">
					<?php if ($this->ion_auth->logged_in() AND !($this->ion_auth->is_admin())){ ?>
						<li>
							<div class="menu-button">
								<button class='dropdown-button user-btn waves-effect waves-ligt btn' href='#' data-beloworigin="true" data-activates='dropdown-menu-login'><i style="font-size: 20px;" class="fa fa-user-circle-o" aria-hidden="true"></i>  <?php echo $user->first_name; ?>  <span class="caret"></span></button>
                                 <ul id='dropdown-menu-login' class='dropdown-content'>
								
									<li><a href="<?php echo base_url(); ?>index.php/edit/<?php echo $user->id;?>"><i class="fa fa-user" aria-hidden="true"></i> Profil</a></li>
									<li><a href="<?php echo base_url(); ?>index.php/rezerwacje"><i class="fa fa-book" aria-hidden="true"></i> Rezerwacje</a></li>
									<li><a href="<?php echo base_url(); ?>index.php/auth/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Wyloguj</a></li>
								</ul>
							</div>
						</li>
					<?php } else if($this->ion_auth->is_admin()){ ?>
						<li>
							<div class="menu-button">
                                
                                <a class="waves-effect waves-light btn" href="#modal">Modal</a>
                                
									<button class='dropdown-button user-btn waves-effect waves-ligt btn' data-beloworigin="true" href='#' data-activates='dropdown-menu-login'><i style="font-size: 20px;" class="fa fa-user-circle-o" aria-hidden="true"></i>  <?php echo $user->first_name; ?>  <span class="caret"></span></button>
								
								<ul id='dropdown-menu-login' class='dropdown-content'>
									<li><a href="<?php echo base_url(); ?>index.php/lokale/create"><i class="fa fa-plus-square" aria-hidden="true"></i> Dodaj lokal</a></li>
									<li><a href="<?php echo base_url(); ?>index.php/edit/<?php echo $user->id;?>"><i class="fa fa-user" aria-hidden="true"></i> Profil</a></li>
									<li><a href="<?php echo base_url(); ?>index.php/rezerwacje"><i class="fa fa-book" aria-hidden="true"></i> Rezerwacje</a></li>
									<li><a href="<?php echo base_url(); ?>index.php/auth/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Wyloguj</a></li>
									
								</ul>
							</div>
						</li>
					<?php } else{?>
						<div class="menu-button">
                           
							<button id="login-btn" class="btn waves-effect waves-light" type="button" onClick="document.location.href='/index.php/auth/login'"><i class="fa fa-user" aria-hidden="true"></i> Zaloguj</button>
						</div>
					<?php }?>
				  </ul>
				
			</div>
            
		</header>
		<section class="home-header">
            <div class="parallax-container">
    <div class="parallax"><img src="https://static.pexels.com/photos/6267/menu-restaurant-vintage-table.jpg"></div>
  </div>
  <div class="section white">
    <div class="row container">
      <h2 class="header">Parallax</h2>
      <p class="grey-text text-darken-3 lighten-3">Parallax is an effect where the background content or image in this case, is moved at a different speed than the foreground content while scrolling.</p>
    </div>
  </div>
  <div class="parallax-container">
    <div class="parallax"><img src="assets/graphics/banner.png"></div>
  </div>
			<div class="col s12 caption-wrapper">
				<span class="caption">Zarezerwuj stolik online</span><br>
				<span class="caption">Znajdź lokal z wolnym miejscem!</span>
				<div class="wrapper">
					<div class="demo">
						<div class="control-group">
							<?php if($miasta != null){?>
								<div class="selection-wrapper">
									<div class="col l9 city-input">
										<select id="select-city" name="miasta">
											<option selected disabled hidden>Wybierz miasto</option>
											<?php foreach ($miasta as $miasto):?>
												<option value="<?php echo $miasto['miasto'];?>"><?php echo $miasto['miasto'];?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="col m3  button-input">
										<a class="link find-link" href="<?php echo base_url().'index.php/miasto/';?>">ZNAJDŹ</a>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				<script>
					var xhr;
					var $select_state;


					$select_city = $('#select-city').selectize({
						valueField: 'name',
						labelField: 'name',
						searchField: ['name']
					});

					select_city  = $select_city[0].selectize;

					//select_city.disable();
				</script>
				<script type="text/javascript">
				$("#select-city").change(function(){
						change_link();
					});
					function change_link(){
						var val = $("select option:selected").val();
						$("a").each(function(){
							var nhref = "";
							var href = $(this).attr("href").split("/");
							for(var i=0;i<href.length-1;i++){
								nhref += href[i]+"/";
							}
							nhref += val;
							$(this).attr("href",nhref);
						});
					}
				</script>
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
<div id='modal_login' class='modal'>
        
    test test 
</div>
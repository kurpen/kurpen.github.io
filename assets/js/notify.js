		if(typeof(EventSource) !== "undefined") {
			var source = new EventSource("/demo_sse.php");
			source.onmessage = function(event) {
				//document.getElementById("result").innerHTML += event.data + "<br>";
				if(){
					
				}
			};
		} else {
			document.getElementById("result").innerHTML = "Sorry, your browser does not support server-sent events...";
		};
	

		var NotifcationsTest = {
			VerifyBrowserSupport: function() {
				return ("Notification" in window);
			},
			ShowNotification: function(){
				var notification = new Notification("User id: " + id);
			},
			RequestForPermissionAndShow: function(){
				// Mamy prawo wyœwietlaæ powiadomienia
				if ((Notification.permission === "granted") && (id == 3)) {
					//console.log("Login: " + <?php echo $this->ion_auth->logged_in();?>);
					//console.log(logged);
					console.log("User ID: " + id);
					NotifcationsTest.ShowNotification();
				}
				// Brak wsparcia w Chrome dla w³aœciwoœci permission
				else if (Notification.permission !== "denied") {
					Notification.requestPermission(function (permission) {
						// Dodajemy w³aœciwoœæ permission do obiektu Notification
						if(!("permission" in Notification)) {
							Notification.permission = permission;
						}
						if ((permission === "granted") && (id == 3)) {
							NotifcationsTest.ShowNotification();
						}
					});
				}
			}
		}
		window.onload = function(){
			document.getElementById("shownotify").onclick = function(){
				if(!NotifcationsTest.VerifyBrowserSupport()){
					alert("Brak wsparcia dla Notifications API");               
				}
				NotifcationsTest.RequestForPermissionAndShow();
			};
		};
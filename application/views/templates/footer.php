<section id="social">
	<div class="container">
		<div class="col-lg-4 col-md-4 col-sm-4 pull-left">
			<h1>Stoliczek.com.pl</h1>
		</div>
		<div class="col-lg-8 col-md-8 col-sm-8 pull-right text-right">
			<ul>
				<li class="social-icon"><a href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
			</ul>
		</div>
	</div>
</section>
<section id="footer">
	<div class="container">
		<div class="col-lg-4 col-md-4 col sm-12 text-left">
			<h3>Miasta</h3>
			<ul>
				<li><a href="<?php echo base_url().'index.php/miasto/Wrocław';?>">Wrocław</a></li>
			</ul>
			<ul>
				<li><a href="<?php echo base_url().'index.php/miasto/Poznań';?>">Poznań</a></li>
			</ul>
		</div>
	</div>
</section>

	<em>&copy; 2015</em>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script>
		function DropDown(el) {
			this.dd = el;
			this.initEvents();
		}
		DropDown.prototype = {
			initEvents : function() {
				var obj = this;

				obj.dd.on('click', function(event){
					$(this).toggleClass('active');
					event.stopPropagation();
				}); 
			}
		}
		</script>
	<script>
	</script>
			
        </body>
</html>
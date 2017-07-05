<style>
.alert{
	position: fixed;
	left: 260px;
	width: calc(100% - 290px);
	z-index: 99999999999;
	-ms-align-items: center;
	align-items: center;
	display: none;
	pointer-events: none;
}
.alert.visible{
	display: -webkit-flex;
	display: -moz-flex;
	display: -ms-flex;
	display: -o-flex;
	display: flex;
}
.alert-content{
	padding: 20px;
	padding-right: 32px; 
	display: inline-block; 
	color: #fefefe;
	margin-bottom: -60px; 
	position: relative;
	margin: auto;
	font-size: 20px;
	border-radius: 4px;
	box-shadow: 0 0 6px 2px rgba(0, 0, 0, 0.2);
}
.right .alert-content{
	margin: 0;
	margin-left: auto;
}
.alert-content a{
	pointer-events: auto;
	position: absolute; right: 10px; top: 7px; z-index: 1
}
.alert-content a svg{
	width:17px; height:17px
}
.alert.error .alert-content{
	background: red;
}
.alert.success .alert-content{
	/*#1ab561*/
	background: #0baf56; /*green*/;
}
.alert.info .alert-content{
	background-color: lightblue;
	color: #000;
}
.alert.info .alert-content svg{
	fill: #000;
}
</style>
<?php
	if (!isset($auto_dismiss))
		$auto_dismiss = true;
?>
<div style="position: relative;">
	<div class="alert <?php echo $alert_type; ?> visible">
		<div class="alert-content">
			<?php
				if (isset($dismiss_link)) {
					echo '<a href="'.$dismiss_link.'">
						<svg fill="#fff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>
					</a>';
				}
			?>
			<?php echo $alert_message; ?>
		</div>
	</div>

	<?php
		if (isset($dismiss_link) && $auto_dismiss) {
			echo '
				<script>
					setTimeout(function(){
						var alert = document.querySelector(".alert");
						alert.classList.remove("visible");
						var location = "'. $dismiss_link .'";
						window.location = location;
					}, 3000);
				</script>
			';
		};
	?>
</div>
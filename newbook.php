<?php 
	require_once 'includes/session.php';
	require_once 'includes/author.php';
	require_once 'includes/book.php';
	require_once 'includes/file_uploader.php';

	require_once 'vendor/autoload.php';
	use ColorThief\ColorThief;

	if($session->is_logged_in()){
		$user = $session->get_user();
	}else{
		header("Location: login.php");
	}

	$bookClass = new Book();
	$authorClass = new Author();

	$page = "new book";
	include 'includes/templates/header.php';
	$prevpage = "index.php";

	if(isset($_SERVER['HTTP_REFERER']))
		$prevpage = $_SERVER['HTTP_REFERER'];

	if($user->role != 'librarian'){
		header("Location:" . $prevpage);
	}

	$authors = $authorClass::all();

	if(isset($_GET['book_added'])){
		$alert_type="success";
		$dismiss_link="newbook.php";
		$alert_message = "<strong>Success!</strong> Book Added!";
		include 'includes/templates/alert.php';
	}

	if(isset($_POST['submit'])){
		$newbook = new Book();

		$fileUploader = new fileUploader("cover_path", "images/books/");
		$file_path = $fileUploader->upload();

		if(!$file_path)
			echo "Sorry, couldn't upload your file.";
		else{
			$newbook->cover_path = $file_path;
			try{
				$dominantColor = ColorThief::getColor("../../images/books/".$name);
			}
			catch (Exception $e) {
				$dominantColor = array(0,0,0);
			}

			$hsl = RGBToHSL($dominantColor);
			$newbook->color = "rgb(".implode(", ", $dominantColor).")";
			$newbook->is_light = ($hsl->lightness > 200) ? true : false;
		}

		$newbook->title = $_POST['title'];
		$newbook->description = $_POST['description'];
		$newbook->total_copies = $_POST['total_copies'];
		$newbook->author_id = $_POST['author_id'];

		if($newbook->save()){
			header("Location: newbook.php?book_added");
		}
	}
?>
<style>
	#form{
		margin: auto;
		position: relative;
		background-color: #fff;
		border: 1px solid #ccc;
		border-radius: 2px;
		width: 750px;
		min-height: 400px;

		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flex;
		display: -o-flex;
		display: flex;
	}
	#form #image, #form #details{
		padding: 40px 30px;
	}
	#form #image{
		width: 210px;
		margin-right: 50px;
		border-right: 1px solid #ccc;
	}
	#form #details{
		-webkit-flex: 1;
		-moz-flex: 1;
		-ms-flex: 1;
		-o-flex: 1;
		flex: 1;
	}
	#form .input-wrapper{
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flex;
		display: -o-flex;
		display: flex;
		-ms-align-items: center;
		align-items: center;
		margin-bottom: 30px;
	}
	#form .input-wrapper span{
		flex: 1;
		font-size: 18px;
	}
	#form .input-wrapper select, 
	#form .input-wrapper textarea, 
	#form .input-wrapper input{
		background-color: transparent;
		font-size: 16px;
		border: none;
		border-bottom: 1px solid #aaa;
		width: 220px;
		padding: 6px 0;
	}
	#form input[type="submit"], #form button{
		background-color: transparent;
		border: 1px solid #999;
		display: inline-block;
		width: calc(50% - 12px);
		text-transform: uppercase;
		padding: 12px 0;
		font-size: 16px;
		color: #444;
		margin-bottom: 22px;
	}
	#form input[type="submit"]{
		margin-left: 12px;
	}
</style>
<div style="max-width: 78%; margin: 30px auto">
	<form id="form" action="newbook.php" method="POST" enctype="multipart/form-data">
		<div id="image" style="text-align: center;">
			<h3 style="margin-top: 0; margin-bottom: 30px;">
				Book picture:
			</h3>

			<img id="book_cover" alt="" height="220px" width="90%">
			<p>
				<input require type="file" onchange="setImage(this)" name="cover_path">
			</p>
		</div>
		<div id="details">
			<h3 style="margin-top: 0; margin-bottom: 40px;">Book details:</h3>
			<div class="input-wrapper">
				<span>Title:</span>
				<input require name="title" placeholder="Book title" type="text">
			</div>
			<div class="input-wrapper">
				<span>Description:</span>
				<textarea require name="description" type="text" placeholder="Book description"></textarea>
			</div>
			<div class="input-wrapper">
				<span>Author:</span>
				<select name="author_id" require>
					<option value="">Choose an author</option>
					<?php
						foreach ($authors as $author) {
							echo "<option value='$author->id'>$author->name</option>";
						}
					?>
				</select>
			</div>
			<div class="input-wrapper">
				<span>Total Copies:</span>
				<input require name="total_copies" type="text" placeholder="Number of copies">
			</div>

			<button style="margin-top: 20px;" type="reset">Clear Form</button>
			<input type="submit" name="submit" value="ADD BOOK">&emsp;
		</div>
	</form>
</div>

<script>
	function setImage(input) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();

	        reader.onload = function (e) {
	            document.querySelector('#book_cover').src =  e.target.result;
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
</script>
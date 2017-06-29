<?php 
	
?>
<?php 	
	require_once 'includes/database.php';
	require_once 'includes/session.php';
	require_once 'includes/book.php';
	require_once 'includes/author.php';

	if($session->is_logged_in()){
		$user = $session->get_user();
	}else{
		header("Location: login.php");
	}
	
	if (isset($_GET['q'])) {
		$search_query = $_GET['q'];
		include 'includes/templates/header.php';
		$bookClass = new Book();
		$books = $bookClass->get_where("title LIKE '%$search_query%'");

		$authorClass = new Author();
		$authors = $authorClass->get_where("name LIKE '%$search_query%'");

		if(count($books) == 0 && count($authors) == 0){
			echo "No results found!";

			return;
		}

		echo "
			<div style='padding: 10px 20px; padding-bottom: 0'>
				<h2>Books</h2>
			</div>
		";

		if(count($books) == 0){
			echo "<div style='padding: 0 20px;'>No books found</div><br>";
		}else{
			foreach ($books as $key => $book) {
				$index = $key + 1;
				$is_fourth = $index %4 == 0 ? "fourth" : "";
				$book_author = $book->get_author();

				echo "<a href='book_detail.php?book_id=".$book->id."' style='text-decoration: none; color: #000'>";
				include 'includes/templates/book_item.php';
				echo "</a>";
			}
			echo "<br>";
		}

		echo "
			<div style='padding: 10px 20px;'>
				<h2>Authors</h2>
			</div>
		";

		if(count($authors) == 0){
			echo "<br><div style='padding: 0 20px;'>No authors found</div>";
			$authors = array();
		}

		foreach ($authors as $key => $author) {
			$index = $key + 1;
			$is_fourth = $index %4 == 0 ? "fourth" : "";

			echo "<a href='authors.php?author_id=".$author->id."' style='text-decoration: none; color: #000'>";
			include 'includes/templates/author_item.php';
			echo "</a>";
		}
	}
?>

<?php include 'includes/templates/footer.php'; ?>
<h2>Book Title: <?php echo $book->title; ?></h2>
<h2>Book Price: <?= $book->price ?> $</h2>
<h2>Book Author: <?= $book->author ?></h2>
<h2>Book Year: <?= $book->year ?></h2>
<h2>Book Image:
   <img src="<?= $book->cover ?>" width="300" height="300">
</h2>
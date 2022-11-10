<table border="1">
   <tr>
      <th>Book Title</th>
      <th>Book Price</th>
      <th>Book Image</th>
   </tr>
   <?php
   foreach ($books as $title => $book) {
   ?>
   <tr>
      <td>
         <a href="index.php?title=<?= $title ?>">
            <?= $book->title ?>
         </a>
      </td>
      <td><?= $book->price ?> $</td>
      <td>
         <a href="index.php?title=<?= $title ?>">
            <img src="<?= $book->cover ?>" width="100" height="100">
         </a>
      </td>
   </tr>
   <?php
   }
   ?>
</table>
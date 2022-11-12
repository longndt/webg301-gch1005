<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <!-- Bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
   <link rel="stylesheet" href="css/mystyle.css">
</head>

<body>
   <div class="container col-md-5 mt-4 text-center">
      <table class="table table-primary">
         <tr>
            <th colspan="3" id="title" class="text text-danger h1 gachchan">Book List
            </th>
         </tr>
         <tr id="header">
            <th class="innghieng">Book Title</th>
            <th>Book Price</th>
            <th>Image</th>
         </tr>
         <?php foreach ($books as $title => $book) {
         ?>
         <tr>
            <td><a class="btn btn-success" href="index.php?title=<?= $title ?>"><?= $book->title ?></a></td>
            <td><?= $book->price ?>$</td>
            <td><a href="index.php?title=<?= $title ?>"><img src="<?= $book->cover ?>" width="100" height="100"></a>
            </td>
         </tr><?php
               } ?>
      </table>
   </div>

</body>

</html>
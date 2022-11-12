<?php
require_once "model/Book.php";

class BookModel
{
   //SQL : SELECT * FROM Book
   public function viewBookList()
   {
      //tạo object của book bằng constructor
      $book1 = new Book("Java", "John", 99.99, 2020, "https://cdn.codegym.cc/images/article/bbcda54e-3cd0-4dac-a77a-447484b8b487/512.jpeg", 20);
      $book2 = new Book("Python", "John", 88.88, 2021, "https://m.media-amazon.com/images/I/41+l48O6TbL.jpg", 30);
      $book3 = new Book("NodeJS", "John", 55.55, 2022, "https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1541489138l/42643290._SY475_.jpg", 25);
      //tạo array để chứa object 
      //$books = array($book1, $book2, $book3); //index mặc định là số (0,1,2)
      //set index tùy biến theo tên của book
      $books = array(
         "Java" => $book1,
         "Python" => $book2,
         "NodeJS" => $book3
      );
      return $books; //array
   }

   //SQL : SELECT * FROM Book WHERE title = '$title'
   public function viewBookByTitle($title)
   {
      $bookList = $this->viewBookList();
      return $bookList[$title]; //object
   }
}
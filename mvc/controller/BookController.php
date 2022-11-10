<?php
require_once "model/BookModel.php";

class BookController
{
   public $model;

   public function __construct()
   {
      $this->model = new BookModel();
   }

   public function execute()
   {
      //TH1: load ra toàn bộ sách khi không có tham số trên URL
      if (!isset($_GET['title'])) {
         //lấy dữ liệu và pass qua view
         $books = $this->model->viewBookList();
         //render ra view BookList.php
         require_once "view/BookList.php";
      }

      //TH2: load ra thông tin chi tiết của sách nếu có tham số trên URL
      else {
         //lấy dữ liệu của title từ URL
         $title = $_GET['title'];
         //lấy dữ liệu và pass qua view
         $book = $this->model->viewBookByTitle($title);
         //render ra view BookDetail.php
         require_once "view/BookDetail.php";
      }
   }
}
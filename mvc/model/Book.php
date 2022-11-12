<?php
class Book
{
   //variable - attribute
   public $title;
   public $author;
   public $price;
   public $year;
   public $cover;
   public $quantity;

   //constructor - special function
   //public function Book() { }
   public function __construct($t, $a, $p, $y, $c, $quantity)
   {
      $this->title = $t;
      $this->author = $a;
      $this->price = $p;
      $this->year = $y;
      $this->cover = $c;
      $this->quantity = $quantity;
   }

   //getter
   public function getTitle()
   {
      return $this->title;
   }

   //setter
   public function setPrice($price)
   {
      $this->price = $price;
   }
}
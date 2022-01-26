<?php 


namespace App\Model;

class Menu {


        private $id;
        private $title;
        private $slug;
        private $description;
        private $image;
        private $vat;
        private $price;
        private $category;
        private $sub_category;


        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        public function getTitle()
        {
                return $this->title;
        }

        public function setTitle($title)
        {
                $this->title = $title;

                return $this;
        }

        public function getSlug()
        {
                return $this->slug;
        }

        public function setSlug($slug)
        {
                $this->slug = $slug;

                return $this;
        }

        public function getDescription()
        {
                return $this->description;
        }

        public function setDescription($description)
        {
                $this->description = $description;

                return $this;
        }

        public function getImage()
        {
                return $this->image;
        }
 
        public function setImage($image)
        {
                $this->image = $image;

                return $this;
        }

        public function getVat()
        {
                return $this->vat;
        }

        public function setVat($vat)
        {
                $this->vat = $vat;

                return $this;
        }

        public function getPrice()
        {
                return $this->price;
        }

        public function setPrice($price)
        {
                $this->price = $price;

                return $this;
        }

        public function getCategory()
        {
                return $this->category;
        }
 
        public function setCategory($category)
        {
                $this->category = $category;

                return $this;
        }

        public function getSub_category()
        {
                return $this->sub_category;
        }

        public function setSub_category($sub_category)
        {
                $this->sub_category = $sub_category;

                return $this;
        }
}



?>
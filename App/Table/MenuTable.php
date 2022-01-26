<?php 

namespace App\Table;

use PDO;
use App\Model\Menu;
use App\Table\Table;


final class MenuTable extends Table {

    protected $table = "menu";
    protected $class = Menu::class;

    /**
     * getMenuList
     *
     * @param  string $category
     * @param  string $sub_category
     * @return string
     */
    private function getMenuList(string $category, string $sub_category): string
    {   
        $query = $this->pdo->prepare("SELECT * FROM menu WHERE category = '{$category}' AND sub_category = '{$sub_category}' ORDER BY title");
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, Menu::class);
        $menu = $query->fetchAll();
        $html = '';
        
        foreach($menu as $item)
        {
            $title = strlen($item->getTitle()) > 9 ? substr($item->getTitle(), 0,9) . "..." : $item->getTitle();
            $link = "/item/{$item->getSlug()}-{$item->getId()}";
            $html .= '<li class="glide__slide">
                        <a href="'.$link.'">
                            <div class="glide__slide_container">
                                <img src="'.$item->getImage().'" alt="">
                                <div class="glide_slide_text">
                                    <h4>'.$title.'</h4>
                                    <h6>£ '.$item->getPrice().'</h6>
                                </div>
                            </div>
                        </a>
                    </li>';
        }
        return '<ul class="glide__slides">' . $html . '</ul>';
    }
    
    /**
     * getMenu
     *
     * @param  mixed $category
     * @param  mixed $sub_category
     * @return string
     */
    public function getMenu(): string
    {

        $query = $this->pdo->prepare("SELECT DISTINCT category FROM menu ORDER BY CASE WHEN category = 'cocktails' THEN 1 WHEN category = 'beers' THEN 2 WHEN category = 'soft' THEN 3 END");
        $query->execute();
        $query->setFetchMode(PDO::FETCH_OBJ);
        $categories = $query->fetchAll();
        $html = "";
        foreach($categories as $category) {
            if($category->category == "beers") {
                $cat = "WINES,<br>BEERS & CIDERS";
            }else{
                $cat = strtoupper($category->category);
            }
            $q = $this->pdo->prepare("SELECT DISTINCT sub_category FROM menu WHERE category = '{$category->category}' ORDER BY sub_category");
            $q->execute();
            $q->setFetchMode(PDO::FETCH_OBJ);
            $sub_categories = $q->fetchAll();
            $html .= "<hr class='hr-section'><div class='pin'>
                        <div class='contentContainer'>
                            <h2 class='".$category->category."_header'>".$cat."</h2>
            ";
            foreach($sub_categories as $sub_category){
                $menuList = $this->getMenuList($category->category, $sub_category->sub_category);
                $sub = strtoupper(str_replace("_", " ", $sub_category->sub_category));
                $html .= "<div class='menu-sub-header'>
                            <h6>".$sub."</h6>
                        </div>
                        <div class='glide' id='".$sub_category->sub_category."_glide'>
                            <div class='glide__track' data-glide-el='track'>
                                ".$menuList."
                            </div>
                            <div class='glide__arrows' data-glide-el='controls'>
                                <button id='glide-classic-control-left' class='glide__arrow glide__arrow--left' data-glide-dir='<'>prev</button>
                                <button class='glide__arrow glide__arrow--right' data-glide-dir='>'>next</button>
                            </div>
                        </div>";
            }
            $html .= "</div></div>";
        }
        return $html;

    }


    public function getOrderSection()
    {
        $query = $this->pdo->prepare("SELECT DISTINCT category FROM menu ORDER BY CASE WHEN category = 'cocktails' THEN 1 WHEN category = 'beers' THEN 2 WHEN category = 'soft' THEN 3 END");
        $query->execute();
        $query->setFetchMode(PDO::FETCH_OBJ);
        $categories = $query->fetchAll();
        $html = "";
        foreach($categories as $category) {
            $q = $this->pdo->prepare("SELECT DISTINCT sub_category FROM menu WHERE category = '{$category->category}' ORDER BY sub_category");
            $q->execute();
            $q->setFetchMode(PDO::FETCH_OBJ);
            $sub_categories = $q->fetchAll();
            $cat = strtoupper($category->category);
            $paramCat = $category->category;
            if($cat == "BEERS") {
                $cat = "WINES, BEERS & CIDERS";
            }else{
                $cat = $cat;
            }
            $html .= "<div class='orderCategory'>
                        <div onclick='openSection(this)' class='orderCategoryName'>
                            <h6>{$cat}</h6><i class='fas fa-chevron-down'></i>
                        </div>
                        <div class='orderSubCategories'>";
            foreach($sub_categories as $sub_category){
                $paramSub = $sub_category->sub_category;
                $sub = strtoupper(str_replace("_", " ", $sub_category->sub_category));
                $html .= "<div id='{$paramSub}' onclick='subCategoriesSelected(this); loadOrderMenu(\"$paramSub\", \"$paramCat\")' class='orderSubCategory'>
                            <h6>{$sub}</h6>
                        </div>";
            }
            $html .= "</div></div>";
        }
        return $html;
    }

}
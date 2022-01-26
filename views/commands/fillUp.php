<?php 

use App\Config;

require dirname(dirname(__DIR__)) . '/vendor/autoload.php';

$pdo = Config::getPDO();
$faker = Faker\Factory::create();

$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
$pdo->exec('TRUNCATE TABLE menu');
$pdo->exec('SET FOREIGN_KEY_CHECKS = 1');


for($i = 0; $i < 50; $i++) {
    $title = $faker->sentence(2, true);
    $description = $faker->paragraph(2, true);
    $slug = $faker->slug();
    $image = "media/menu/cocktails/classic/Tom_Collins.png";
    $categories = ["cocktails", "beers", "soft"];
    $RdmCategory = array_rand($categories, 1);
    $category = $categories[$RdmCategory];
    $subCategories = [["classic", "old_fashion", "fancy"], ["beers", "ciders", "wines"], ["juices", "soft", "hot_drinks"]];
    if($category === "cocktails") {
        $rdmSubCategory = array_rand($subCategories[0], 1);
        $sub_category = $subCategories[0][$rdmSubCategory];
    }elseif($category === "beers") {
        $rdmSubCategory = array_rand($subCategories[1], 1);
        $sub_category = $subCategories[1][$rdmSubCategory];
    }else{
        $rdmSubCategory = array_rand($subCategories[2], 1);
        $sub_category = $subCategories[2][$rdmSubCategory];
    }
    $price = $faker->randomFloat(2, $min = 6, $max = 15);
    $pdo->exec("INSERT INTO menu SET title = '{$title}', slug = '{$slug}', description = '{$description}', image = '{$image}', price = '{$price}', category = '{$category}', sub_category = '{$sub_category}', vat = 0");
}



?>
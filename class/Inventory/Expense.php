<?php

/**
 * 
 * 
 * helper class for the Inventory manager class 
 */

namespace Inventory;
use Product;





/****
 * 
 * This class handles all exipense functionality for inventory 
*/
class Expense{


    private $product;
    function __construct()
    {
        $this->product = new Product();
        
    }

    //  This class takes crop details and returns price 
    //  for buy prices the database attribute starts with buy thats why we are concantinating buy_ with class
    public function get_seed_buy_prices($class, $crop, $variety): float
    {
        $price_array =$this->product->get_prices($crop, $variety);
        return $price_array['buy_'.$class];
      
    }

    //  this function is taking crop details including the quality and multiplying the the quantity and the price to get total amount

    public function calculate_amount($seed_class, $crop, $variety, $seed_quantity): float
    {
        $amount = $this->get_seed_buy_prices($seed_class, $crop, $variety);
        return (float)$amount * (float)$seed_quantity;
    }


   



}
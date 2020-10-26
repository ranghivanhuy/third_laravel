<?php
/**
 * Namespace App\Models
 * php version 7.4.10
 * 
 * @category Product_Category
 * @package  App\Models
 * @author   ranghivanhuy <ranghivanhuy@gmail.com>
 * @license  The MIT License (MIT) Copyright © ranghivanhuy
 * @link     https://github.com/ranghivanhuy/laravel
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Product_Category
 * 
 * @category Product_Category
 * @package  App\Models
 * @author   ranghivanhuy <ranghivanhuy@gmail.com>
 * @license  The MIT License (MIT) Copyright © ranghivanhuy
 * @link     https://github.com/ranghivanhuy/laravel
 */
class ProductCategory extends Model
{
    use HasFactory;
    protected $table = 'category_product';
    protected $fillable = ['product_id', 'category_id'];

    /**
     * Relationship between products table and categories table
     * 
     * @return void
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
    /**
     * Relationship between products table and categories table
     * 
     * @return void
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }
}

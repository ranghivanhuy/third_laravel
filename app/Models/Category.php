<?php
/**
 * Namespace App\Models
 * php version 7.4.10
 * 
 * @category Category
 * @package  App\Models
 * @author   ranghivanhuy <ranghivanhuy@gmail.com>
 * @license  The MIT License (MIT) Copyright © ranghivanhuy
 * @link     https://github.com/ranghivanhuy/laravel
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Category Class
 * 
 * @category Category
 * @package  App\Models
 * @author   ranghivanhuy <ranghivanhuy@gmail.com>
 * @license  The MIT License (MIT) Copyright © ranghivanhuy
 * @link     https://github.com/ranghivanhuy/laravel
 */
class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = ['name', 'parent_id', 'description'];
    /**
     * Relationship with itself
     * 
     * @return void
     */
    public function cate()
    {
        return $this->hasMany('App\Models\Category', 'parent_id', 'id');
    }
    /**
     * Relationship with products table
     * 
     * @return void
     */
    public function product()
    {
        return $this->belongsToMany(Product::class);
    }
}

<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    // العلاقة بين Wishlist و Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

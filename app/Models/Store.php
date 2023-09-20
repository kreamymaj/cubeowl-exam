<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'storeID';
    protected $fillable = ['storeID', 'storeName', 'address', 'email', 'mobileNum', 'landline', 'storeStatus', 'productID', 'productName'];

    public function product(){
        return $this->hasMany(Product::class);
    }
}

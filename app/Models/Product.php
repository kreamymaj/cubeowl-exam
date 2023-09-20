<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory; 
    
    //SoftDelete
    use SoftDeletes;

    protected $primaryKey = 'productID';
    protected $fillable = ['productID', 'image', 'productName', 'description', 'price', 'quantity', 'productStatus'];

    public function store(){
        return $this->belongsTo(Store::class);
    }	
}

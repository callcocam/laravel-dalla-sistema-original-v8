<?php

namespace App\Models\Admin;

use App\AbstractModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Price extends AbstractModel
{
    use HasFactory;

    protected $fillable = [
        'user_id','client_id','product_id','price','status','created_at','updated_at',
    ];

    public function client(){

        return $this->belongsTo(Client::class);
    }
    public function product(){

        return $this->belongsTo(Product::class);
    }
}

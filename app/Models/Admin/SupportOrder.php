<?php

namespace App\Models\Admin;

use App\AbstractModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupportOrder extends AbstractModel
{
    use HasFactory;

    protected $table = "support_orders";

    protected $fillable = [
        'user_id','client_id','total','status', 'description','updated_at',
    ];

    public function getTotalAttribute($value){
        return form_read($value);
    }

    public function items(){

        return $this->hasMany(SupportOrderItem::class);
    }

    public function client(){

        return $this->belongsTo(Client::class);
    }
}

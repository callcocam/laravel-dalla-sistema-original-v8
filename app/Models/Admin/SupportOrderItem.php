<?php

namespace App\Models\Admin;

use App\AbstractModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupportOrderItem extends AbstractModel
{
    use HasFactory;

    protected $table = "support_order_items";

    protected $fillable = [
        'user_id','support_id','support_order_id','amount','total','status', 'description','updated_at',
    ];


    public function support(){

        return $this->belongsTo(Support::class,'support_id');
    }
}

<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Models\Admin;


use App\AbstractModel;
use Illuminate\Support\Facades\DB;

class Product extends AbstractModel
{
    protected $fillable = [
        'user_id','name','slug','price','stock','liters','und','status', 'description','updated_at',
    ];

    public function getPriceAttribute($value){
        return form_read($value);
    }
    public function items(){

        return $this->hasMany(Item::class);
    }

    public function amount($product){

        $data = $product->items()->select( DB::raw('sum( amount ) as quantity') )->first();

        if($data)
            return $data->quantity;

        return '0';
    }

    public function bonus(){

        return $this->hasMany(Bonu::class);
    }

    public function prices(){

        return $this->hasOne(Price::class);
    }
    public function bonu(){

        return $this->belongsTo(Bonu::class);
    }
    public function bonifications(){

        return $this->hasMany(Bonification::class);
    }

    public function countItems(){

        $data = $this->items()->select( DB::raw('sum( amount ) as quantity') )->first();

        if($data)
            return $data->quantity;

        return '0';
    }
}

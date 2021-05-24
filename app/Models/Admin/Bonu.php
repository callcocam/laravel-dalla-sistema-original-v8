<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Models\Admin;


use App\AbstractModel;
use Illuminate\Support\Facades\DB;

class Bonu extends AbstractModel
{
    protected $fillable = [
        'user_id','product_id','name','slug','meta','status', 'description','updated_at',
    ];

    public function product(){

        return $this->hasMany(Product::class);
    }

    public function bonifications(){

        return $this->hasMany(Bonification::class);
    }

    public function countItems(){

        $data = $this->product()->items()->select( DB::raw('sum( amount ) as quantity') )->first();

        if($data)
            return $data->quantity;

        return '0';
    }
}

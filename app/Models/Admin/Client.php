<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Models\Admin;
use App\AbstractModel;
use App\Suports\Shinobi\Concerns\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class Client extends AbstractModel
{
    use HasRolesAndPermissions;

    protected $table ='users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','slug', 'fantasy','phone','document','email','barrels','discount', 'password', 'is_admin', 'description',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','email_verified_at'
    ];

    public function saveBy($data)
    {
        if(isset($data['discount'])){
            $data['discount'] = str_replace('%','',$data['discount']);
        }
        if(isset($data['document'])){
            $data['document'] = str_replace(['.','-','/'],'',$data['document']);
        }
        if(isset($data['phone'])){
            $data['phone'] = str_replace(['.','-','/'],'',$data['phone']);
        }
        return parent::saveBy($data); // TODO: Change the autogenerated stub
    }

    public function address(){

        return $this->morphOne(Addres::class, 'addresable');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(config('shinobi.models.role'), 'role_user', 'user_id', 'role_id')->withTimestamps();
    }

    public function orders(){

        return $this->hasMany(Order::class);
    }


    public function ordersProduct(){

        $orders = $this->hasMany(Order::class)->get();

        $products = [];

        foreach ($orders as $order) {

            $items = $order->items()->get();

            foreach ($items as $item) {

                $product = $item->products()->first();

                $products[$product->id] = $product;
            }
        }

        return $products;
    }

    public function getAddressAttribute(){

        return $this->address()->first(['zip','city','state','country', 'street','district','number','complement']);
    }

    public function getBonificationAttribute(){


        $Bonifications = $this->hasMany(Bonification::class, 'client_id')->where('status','published')->get();

        if(!$Bonifications->count())
            return false;

        return $Bonifications;

    }

    public function moviment(){
        return $this->hasOne(Movimentation::class,'client_id');

    }
}

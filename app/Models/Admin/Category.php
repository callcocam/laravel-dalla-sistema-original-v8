<?php

namespace App\Models\Admin;

use App\AbstractModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends AbstractModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','slug','status', 'description','updated_at',
    ];


    public function downloads(){
        return $this->hasMany(Download::class);
    }
}

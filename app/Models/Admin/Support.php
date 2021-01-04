<?php

namespace App\Models\Admin;

use App\AbstractModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Support extends AbstractModel
{
    use HasFactory;

    protected $table = "support_materials";

    protected $fillable = [
        'user_id','name','slug','price','stock','status', 'description','updated_at',
    ];

}

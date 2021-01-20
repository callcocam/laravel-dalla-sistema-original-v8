<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Models\Admin;

use App\AbstractModel;

class ScoreMata extends AbstractModel
{

    protected $table = "score_metas";

    protected $fillable = [
        'user_id','score_meta','score_amount','score_price','status','created_at','updated_at'
    ];

}

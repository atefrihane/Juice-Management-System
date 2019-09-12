<?php

namespace App\Modules\Order\Models;

use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{

    protected $fillable = ['status', 'order_id', 'user_id'];

    public function order()
    {
        return $this->belongsTo('App\Modules\Order\Models\Order', 'order_id');

    }

}

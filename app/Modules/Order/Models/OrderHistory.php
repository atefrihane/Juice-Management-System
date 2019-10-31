<?php

namespace App\Modules\Order\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Order\Models\Order;
class OrderHistory extends Model
{

    protected $fillable = ['action', 'order_id', 'user_id'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');

    }

}

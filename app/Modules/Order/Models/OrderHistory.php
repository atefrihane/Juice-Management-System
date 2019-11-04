<?php

namespace App\Modules\Order\Models;

use App\Modules\Order\Models\Order;
use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{

    protected $fillable = ['action', 'order_id', 'user_id'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');

    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');

    }

}

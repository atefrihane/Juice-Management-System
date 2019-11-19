<?php

namespace App\Http\Middleware;

use App\Modules\Order\Models\Order;
use Closure;

class ArchiveOrder
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $orderId = $request->route()->parameters()['id'];
        $order = Order::find($orderId);
        if ($order) {

            if($order->status < 13)
            {
                return redirect()->route('showOrders');

            }

        }
        return $next($request);
    }
}

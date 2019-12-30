<?php

namespace App\Http\Middleware;
use App\Modules\Order\Models\Order;
use Auth;
use Closure;

class CheckOrderAccess
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

            if ((Auth::user()->mainDelivery() && $order->status >= 5 && $order->status <= 7)  or
            (Auth::id() == $order->delivery_man_id) or
             (Auth::user()->preparator()) or
            Auth::user()->primaryAdmin())
            
             {
                return $next($request);

            }
            return redirect()->route('showOrders');

        }
        return redirect()->route('showOrders');

    }
}

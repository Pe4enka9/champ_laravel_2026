<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebhookRequest;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class WebhookController extends Controller
{
    // Webhook для платежной системы
    public function handle(WebhookRequest $request): JsonResponse
    {
        $orderId = $request->order_id;
        $status = $request->status;

        Order::find($orderId)->update(['payment_status' => $status]);

        return response()->json(status: 204);
    }
}

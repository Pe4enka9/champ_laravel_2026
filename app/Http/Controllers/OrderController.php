<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatusEnum;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Получение всех курсов студента
    public function index(Request $request): JsonResponse
    {
        $orders = $request->user()->orders;

        return response()->json(OrderResource::collection($orders));
    }

    // Отмена записи на курс
    public function cancel(Order $order): JsonResponse
    {
        if ($order->payment_status === PaymentStatusEnum::SUCCESS) {
            return response()->json([
                'status' => 'was payed',
            ], 418);
        }

        $order->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }
}

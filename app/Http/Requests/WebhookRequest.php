<?php

namespace App\Http\Requests;

use App\Models\Order;
use Illuminate\Validation\Rule;

class WebhookRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'order_id' => ['required', 'integer', Rule::exists(Order::class, 'id')],
            'status' => ['required']
        ];
    }
}

<?php

namespace App\Models;

use App\Enums\PaymentStatusEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property int $course_id
 * @property PaymentStatusEnum $payment_status
 * @property Carbon $created_at
 *
 * @property-read User $user
 * @property-read Course $course
 */
class Order extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'date:d-m-Y',
        'payment_status' => PaymentStatusEnum::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $hours
 * @property float $price
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @property string $image
 *
 * @property-read Collection<User> $users
 * @property-read Collection<Lesson> $lessons
 * @property-read Collection<Order> $orders
 */
class Course extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'start_date' => 'date:d-m-Y',
        'end_date' => 'date:d-m-Y',
    ];

    public function getImagePathAttribute(): string
    {
        return Storage::disk('public')->url($this->image);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'orders');
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class, 'course_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'course_id');
    }
}

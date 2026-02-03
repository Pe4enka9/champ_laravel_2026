<?php

namespace App\Enums;

enum PaymentStatusEnum: string
{
    case PENDING = 'pending';
    case SUCCESS = 'success';
    case FAILED = 'failed';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Ожидает оплаты',
            self::SUCCESS => 'Оплачено',
            self::FAILED => 'Ошибка оплаты',
        };
    }
}

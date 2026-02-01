<?php

namespace App\Enums;

enum PaymentStatusEnum: string
{
    case PENDING = 'pending';
    case SUCCESS = 'success';
    case FAIL = 'fail';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Ожидает оплаты',
            self::SUCCESS => 'Оплачено',
            self::FAIL => 'Ошибка оплаты',
        };
    }
}

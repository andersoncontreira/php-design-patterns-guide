<?php

declare(strict_types=1);

namespace Application\Enums\Messages;

class MessagesEnum
{
    const OK = ['code' => 1, 'label' => 'common.success', 'message' => 'Success'];
    const NOK = ['code' => 2, 'label' => 'common.error.nok', 'message' => '%s'];
}

<?php

declare(strict_types=1);

namespace Application\Enums\Messages;

class MessagesEnum
{
    const OK = ['code' => 1, 'label' => 'common.success', 'message' => 'Success'];
    const NOK = ['code' => 2, 'label' => 'common.error.nok', 'message' => '%s'];
    const LIST_ERROR = ['code' => 3, 'label' => 'common.error.list_error', 'message' => 'Unable to return the list data, please review your request'];
}

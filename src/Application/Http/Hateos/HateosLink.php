<?php

declare(strict_types=1);


namespace Application\Http\Hateos;


class HateosLink
{
    const DELETE = ['method' => 'DELETE', 'rel' => 'delete'];
    const UPDATE = ['method' => 'UPDATE', 'rel' => 'update'];
    const PATCH = ['method' => 'PATCH', 'rel' => 'soft_upate'];
    const GET = ['method' => 'GET', 'rel' => 'get'];
}

<?php

declare(strict_types=1);

namespace Application\Http\Schemas;

use OpenApi\Annotations\Property;
use OpenApi\Annotations\Schema;

/**
 * @see https://github.com/zircote/swagger-php/blob/master/Examples/swagger-spec/petstore-simple/OpenApiSpec.php
 * @see https://github.com/zircote/swagger-php/blob/master/Examples/swagger-spec/petstore-simple/SimplePet.php
 * @OA\Schema(
 *      schema="RootSchema",
 *      required={"app"}
 * )
 */
class RootSchema {
    /**
     * @OA\Property(example="app-name:1.0.0")
     * @var string
     */
    public string $app;
}

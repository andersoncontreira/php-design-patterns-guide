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


class DeletionSchema {
//    success = fields.Bool(default=False)
//    code = fields.Int(required=True)
//    label = fields.Str()
//    message = fields.Str()
//    params = fields.List(fields.Str())
}

class ErrorSchema {
//success = fields.Bool(example=False, default=False)
//code = fields.Int(example=MessagesEnum.INTERNAL_SERVER_ERROR.code, required=True)
//label = fields.Str(example=MessagesEnum.INTERNAL_SERVER_ERROR.label)
//message = fields.Str(example=MessagesEnum.INTERNAL_SERVER_ERROR.message)
//params = fields.List(fields.Str())
//details = fields.Str()
//trace = fields.Str()
}



class RequestControlSchema {
//    offset = fields.Int(default=Pagination.OFFSET)
//    limit = fields.Int(required=True, default=Pagination.LIMIT)
//    total = fields.Int()
//    count = fields.Int()
}

class MetaSchema {
//    href = fields.URL()
//    next = fields.URL()
//    previous = fields.URL()
//    first = fields.URL()
//    last = fields.URL()
}

class LinkSchema {
//    href = fields.Str()
//    rel = fields.Str()
//    method = fields.Str()
}



class PingSchema {
    //message = fields.Str(example="PONG")
}

class AliveSchema {
    //app = fields.Str(example="I'm alive!")
}

class DefaultResponseSchema {
//    success = fields.Bool(example=True, default=True)
//    code = fields.Int(example=MessagesEnum.OK.code, required=True)
//    label = fields.Str(example=MessagesEnum.OK.label)
//    message = fields.Str(example=MessagesEnum.OK.message)
//    params = fields.List(fields.Str())
}

class HateosDefaultResponseSchema extends DefaultResponseSchema {
    //meta = fields.Nested(MetaSchema)
    //links = fields.List(fields.Nested(LinkSchema))
}

class HateosDefaultListResponseSchema extends DefaultResponseSchema {
    // meta = fields.Nested(MetaSchema)
}

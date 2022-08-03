<?php

declare(strict_types=1);

namespace Application\Http\Schemas;

use OpenApi\Annotations\Property;
use OpenApi\Annotations\Schema;

# ***************************
# Product
# ***************************
/**
 * @OA\Schema(
 *      schema="ProductSchema"
 * )
 */
class ProductSchema {
//id = fields.Int(example=1)
//sku = fields.Int(example=1)
//name = fields.Str(example="Common Pencil")
//description = fields.Str(example="Common Pencil Description")
//supplier_id = fields.Int(example=1)
//created_at = fields.DateTime()
//updated_at = fields.DateTime()
//deleted_at = fields.DateTime()
//active = fields.Int(validate=validate.OneOf([0, 1]))
//uuid = fields.UUID(example="4bcad46b-6978-488f-8153-1c49f8a45244")
}


/**
 * @OA\Schema(
 *      schema="HateosProductListResponseSchema"
 * )
 */
class HateosProductListResponseSchema extends HateosDefaultListResponseSchema {
//data = fields.List(fields.Nested(ProductSchema))
//control = fields.Nested(RequestControlSchema)
}


/**
 * @OA\Schema(
 *      schema="ProductListResponseSchema"
 * )
 */
class ProductListResponseSchema extends DefaultResponseSchema {
//data = fields.List(fields.Nested(ProductSchema))
//control = fields.Nested(RequestControlSchema)
}


/**
 * @OA\Schema(
 *      schema="ProductListErrorResponseSchema"
 * )
 */
class ProductListErrorResponseSchema extends ErrorSchema {
//code = fields.Int(example=MessagesEnum.LIST_ERROR.code, required=True)
//label = fields.Str(example=MessagesEnum.LIST_ERROR.label)
//message = fields.Str(example=MessagesEnum.LIST_ERROR.message)
}


/**
 * @OA\Schema(
 *      schema="ProductGetResponseSchema"
 * )
 */
class ProductGetResponseSchema extends DefaultResponseSchema {
//data = fields.Nested(ProductSchema)
}


/**
 * @OA\Schema(
 *      schema="HateosProductGetResponseSchema"
 * )
 */
class HateosProductGetResponseSchema extends  HateosDefaultResponseSchema {
//data = fields.Nested(ProductSchema)
}


/**
 * @OA\Schema(
 *      schema="ProductGetErrorResponseSchema"
 * )
 */
class ProductGetErrorResponseSchema extends ErrorSchema {
//code = fields.Int(example=MessagesEnum.FIND_ERROR.code, required=True)
//label = fields.Str(example=MessagesEnum.FIND_ERROR.label)
//message = fields.Str(example=MessagesEnum.FIND_ERROR.message)
}


/**
 * @OA\Schema(
 *      schema="ProductCreateRequestSchema"
 * )
 */
class ProductCreateRequestSchema {
//sku = fields.Int(example=1)
//name = fields.Str(example="Common Pencil")
//description = fields.Str(example="Common Pencil description")
//supplier_id = fields.Int(example=1)
//active = fields.Int(validate=validate.OneOf([0, 1]))
}


/**
 * @OA\Schema(
 *      schema="ProductCreateResponseSchema"
 * )
 */
class ProductCreateResponseSchema extends DefaultResponseSchema {
//data = fields.Nested(ProductSchema)
}


/**
 * @OA\Schema(
 *      schema="ProductCreateErrorResponseSchema"
 * )
 */
class ProductCreateErrorResponseSchema extends ErrorSchema {
//code = fields.Int(example=MessagesEnum.CREATE_ERROR.code, required=True)
//label = fields.Str(example=MessagesEnum.CREATE_ERROR.label)
//message = fields.Str(example=MessagesEnum.CREATE_ERROR.message)
}


/**
 * @OA\Schema(
 *      schema="ProductCompleteUpdateRequestSchema"
 * )
 */
class ProductCompleteUpdateRequestSchema extends ProductCreateRequestSchema {

}

/**
 * @OA\Schema(
 *      schema="ProductUpdateResponseSchema"
 * )
 */
class ProductUpdateResponseSchema extends ProductCreateResponseSchema {

}

/**
 * @OA\Schema(
 *      schema="ProductUpdateErrorResponseSchema"
 * )
 */
class ProductUpdateErrorResponseSchema extends ErrorSchema {
//code = fields.Int(example=MessagesEnum.UPDATE_ERROR.code, required=True)
//label = fields.Str(example=MessagesEnum.UPDATE_ERROR.label)
//message = fields.Str(example=MessagesEnum.UPDATE_ERROR.message)
}

/**
 * @OA\Schema(
 *      schema="ProductSoftUpdateRequestSchema"
 * )
 */
class ProductSoftUpdateRequestSchema {
    //field = fields.Str(example="value")
}


/**
 * @OA\Schema(
 *      schema="ProductSoftDeleteResponseSchema"
 * )
 */
class ProductSoftDeleteResponseSchema extends DefaultResponseSchema {
    //data = fields.Dict(example={"deleted": True})
}


/**
 * @OA\Schema(
 *      schema="ProductDeleteResponseSchema"
 * )
 */
class ProductDeleteResponseSchema {
    //data = fields.Dict(example={"deleted": True})
}


/**
 * @OA\Schema(
 *      schema="ProductSoftDeleteErrorResponseSchema"
 * )
 */
class ProductSoftDeleteErrorResponseSchema extends ErrorSchema {
//    code = fields.Int(example=MessagesEnum.SOFT_DELETE_ERROR.code, required=True)
//    label = fields.Str(example=MessagesEnum.SOFT_DELETE_ERROR.label)
//    message = fields.Str(example=MessagesEnum.SOFT_DELETE_ERROR.message)
}

/**
 * @OA\Schema(
 *      schema="ProductDeleteErrorResponseSchema"
 * )
 */
class ProductDeleteErrorResponseSchema extends ErrorSchema {
//code = fields.Int(example=MessagesEnum.DELETE_ERROR.code, required=True)
//label = fields.Str(example=MessagesEnum.DELETE_ERROR.label)
//message = fields.Str(example=MessagesEnum.DELETE_ERROR.message)
}


//# ***************************
//# Event
//# ***************************
//
//
//class EventSchema(Schema):
//    type = fields.Str()
//    data = fields.Dict()
//    date = fields.DateTime(example="2021-05-03T19:41:36.315842-03:00")
//    hash = fields.Str(example="406cce9743906f7b8d7dd5d5c5d8c95d820eeefd72a3a554a4a726d022d8fa19")
//
//class EventCreateRequestSchema(EventSchema):
//    pass
//
//class EventUpdateRequestSchema(EventCreateRequestSchema):
//    pass
//
//
//class EventListResponseSchema(DefaultResponseSchema):
//    data = fields.List(fields.Nested(EventSchema))
//        control = fields.Nested(RequestControlSchema)
//    meta = fields.Nested(MetaSchema)
//    links = fields.List(fields.Nested(LinkSchema))
//
//
//class EventListErrorResponseSchema(ErrorSchema):
//    pass
//
//
//class EventGetResponseSchema(Schema):
//    data = fields.Nested(EventSchema)
//    control = fields.Nested(RequestControlSchema)
//    meta = fields.Nested(MetaSchema)
//    links = fields.List(fields.Nested(LinkSchema))
//
//
//class EventCreateResponseSchema(Schema):
//    result = fields.Bool(example=True)
//    event_hash = fields.Str(example="c82bf3ee20dd2f4ae7109e52d313a3190f1a85ba3362c54d3eb6257bd0c4d69d")
//    code = fields.Int(example=MessagesEnum.EVENT_REGISTERED_WITH_SUCCESS.code)
//    label = fields.String(example=MessagesEnum.EVENT_REGISTERED_WITH_SUCCESS.label)
//    message = fields.String(example=MessagesEnum.EVENT_REGISTERED_WITH_SUCCESS.message)
//    params = fields.List(fields.Str())
//
//
//class EventCreateErrorResponseSchema(Schema):
//    result = fields.Bool(example=False)
//    event_hash = fields.Str(example=None)
//    code = fields.Int(example=MessagesEnum.EVENT_TYPE_UNKNOWN_ERROR.code)
//    label = fields.String(example=MessagesEnum.EVENT_TYPE_UNKNOWN_ERROR.label)
//    message = fields.String(example=MessagesEnum.EVENT_TYPE_UNKNOWN_ERROR.message)
//    params = fields.List(fields.Str())
//
//
//class EventUpdateResponseSchema(EventGetResponseSchema):
//    pass
//
//
//class EventDeleteResponseSchema(EventGetResponseSchema):
//    data = fields.Nested(DeletionSchema)
//
//
//def register():
//    # simple function only to force the import of the script on app.py
//    pass

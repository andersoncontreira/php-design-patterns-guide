<?php

declare(strict_types=1);


namespace Application\Http;


use Application\Enums\Messages\MessagesEnum;
use Application\Exceptions\ApiException;
use Application\Factories\LoggerFactory;
use Application\Http\Hateos\HateosLink;
use Application\Http\Hateos\HateosMeta;
use Application\Utils\HttpUtils;
use Application\Utils\PaginationUtils;
use Monolog\Logger;

class ApiResponse
{
    protected int $statusCode = 200;
    protected array $headers = [];
    protected array $data = [];
    protected ?Logger $logger = null;
    protected bool $hateos = true;
    protected ?\Exception $exception = null;
    protected ?string $exceptionDetails = null;
    protected array $links = [];
    protected array $meta = [];
    protected array $first = [];
    protected array $next = [];
    protected array $last = [];
    protected int $total = 0;
    protected int $count = 0;
    protected array $params = [];
    protected $apiRequest = null;
    protected int $limit = PaginationUtils::LIMIT;
    protected int $offset = PaginationUtils::OFFSET;

    public function __construct(Logger $logger = null, $api_request = null)
    {
//        if ($logger == null) {
//            //TODO converter para singleton
//            $logger = LoggerFactory::factory(LoggerFactory::CONSOLE, APP_NAME);
//        }
        $this->logger = $logger;

        $this->hateos = true;
        $this->statusCode = 200;
        $this->headers = HttpUtils::CUSTOM_DEFAULT_HEADERS;
        $this->exception = null;
        # used when you decide to describe the origin of the exception
        # example: unable to insert the product because another product with the same data already was found
        $this->exceptionDetails = null;

        $this->links = [];
        $this->meta = [];
        $this->data = [];

        # others
        $this->first = [];
        $this->next = [];
        $this->last = [];

        # contabilization
        $this->total = 0;
        $this->count = 0;

        if ($api_request) {
            $this->params = $api_request->fields ?: [];
            $this->limit = $api_request->limit ?: PaginationUtils::LIMIT;
            $this->offset = $api_request->offset ?: PaginationUtils::OFFSET;
            $this->apiRequest = $api_request;
        }
    }

    /**
     * @param bool $hateos
     */
    public function setHateos(bool $hateos): void
    {
        $this->hateos = $hateos;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;

        if (array_key_exists(0, $this->data)) {
            $this->count = count($this->data);
        } else {
            $this->count = 1;
            $this->total = 1;
        }
    }

    /**
     * @param int $total
     */
    public function setTotal(int $total): void
    {
        $this->total = $total;
    }

    /**
     * @param \Exception|null $exception
     */
    public function setException(?\Exception $exception): void
    {
        $this->exception = $exception;
    }

    public function getResponse(int $statusCode = null)
    {
        if ($statusCode) {
            $this->statusCode = $statusCode;
        }

        $headers = $this->headers;
        $statusCode = $this->statusCode;
        $success = ($statusCode == 200);

        $message = MessagesEnum::OK['message'];
        $code = MessagesEnum::OK['code'];
        $label = MessagesEnum::OK['label'];
        $params = [];

        if ($this->exception != null) {
            if ($this->exception instanceof ApiException) {
                $code = $this->exception->getCode();
                $label = $this->exception->getLabel();
                $message = $this->exception->getMessage();
                $params = $this->exception->getParams();
            } else {
                $message = MessagesEnum::NOK['message'];
                $code = MessagesEnum::NOK['code'];
                $label = MessagesEnum::NOK['label'];
            }

            $body = [
                "success" => $success,
                "code" => $code,
                "label" => $label,
                "message" => $message,
                "params" => $params,
                "details" => $this->exceptionDetails
            ];

            if (get_environment() == 'development') {
                $body['trace'] = $this->exception->getTrace();
            }
        } else {
            if ($this->total > 1) {
                $this->links = [];
            } else {
                if (count($this->links) == 0) {
                    $this->links = [
                        [
                            "href" => "",
                            "rel" => HateosLink::UPDATE['rel'],
                            "method" => HateosLink::UPDATE['method'],
                        ],
                        [
                            "href" => "",
                            "rel" => HateosLink::DELETE['rel'],
                            "method" => HateosLink::DELETE['method'],
                        ],
                        [
                            "href" => "",
                            "rel" => HateosLink::PATCH['rel'],
                            "method" => HateosLink::PATCH['method'],
                        ],
                        [
                            "href" => "",
                            "rel" => HateosLink::GET['rel'],
                            "method" => HateosLink::GET['method'],
                        ]
                    ];


                }
            }

            if (count($this->meta) == 0) {
                $this->meta = [
                    "href" => HateosMeta::HREF,
                    "next" => HateosMeta::NEXT,
                    "previous" => HateosMeta::PREVIOUS,
                    "first" => HateosMeta::FIRST,
                    "last" => HateosMeta::LAST
                ];
            }

            $body = [
                # success
                "success" => $success,
                "label" => $label,
                "code" => $code,
                "message" => $message,
                "params" => $this->params,
                # data
                "data" => $this->data,
                # navigation
                "control" => [
                    "offset" => $this->offset,
                    "limit" => $this->limit,
                    "total" => $this->total,
                    "count" => $this->count,
                ],
                # hypermedia info
                "meta" => $this->meta,
                # hypermedia links
                "links" => $this->links
            ];

            if (!$this->hateos) {
                unset($body["meta"]);
                unset($body["links"]);
            }

            # remove empty links (main used for list pages)
            # response.links = None
            # set_hateos_meta(request, response)
            if (count($this->links) == 0) {
                unset($body["links"]);
            }

            if (count($this->meta) == 0) {
                unset($body["meta"]);
            }

        }

        if (in_array('Content-Type', array_keys($headers)) && $headers['Content-Type'] == 'application/json') {
            return response()->json($body, $this->statusCode, $this->headers);
        } else {
            return response($body, $this->statusCode, $this->headers);
        }
    }

    public function setHateosLink(HateosLink $link, string $href)
    {
        //TODO implementar
        $this->links[] = [
            "href" => $href,
            "rel" => $link['rel'],
            "method" => $link['method']
        ];
    }

    public function setMeta(HateosMeta $meta, $value)
    {
        //TODO implementar
        $this->meta[$meta['name']] = $value;
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode(int $statusCode): void
    {
        $this->statusCode = $statusCode;
    }

}

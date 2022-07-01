<?php

use Application\Converters\EntityConverter;
use Application\Converters\ValueObjectConverter;
use Application\Entities\ProductEntity;
use Application\ValueObjects\ProductValueObject;
use Monolog\Logger;

require_once '../../tests/bootstrap.php';


// conexões
// Logger 1 instance
// Database 1 instance
// AWS (SQS,S3)
//

class AppLogger extends Logger {
    // instancia unica do singleton
    protected static ?AppLogger $instance = null;

    private function __construct(string $name, array $handlers = [], array $processors = [], ?DateTimeZone $timezone = null)
    {
        parent::__construct($name, $handlers, $processors, $timezone);
    }

    public static function getInstance(): AppLogger
    {
        if (self::$instance == null) {
            self::$instance = new self('app');
        }

        return self::$instance;
    }
}


class CustomerController {

    public AppLogger $logger;

    public function __construct()
    {
        $this->logger = AppLogger::getInstance();

    }
    public function list() {

    }

}

class CustomerListCommand {
    public AppLogger $logger;

    public function __construct()
    {
        $this->logger = AppLogger::getInstance();
    }

    public function execute() {

    }
}

class CustomerService {
    public AppLogger $logger;

    public function __construct()
    {
        $this->logger = AppLogger::getInstance();
    }

    public function list() {

    }
}


class CustomerRepository {
    public AppLogger $logger;

    public function __construct()
    {
        $this->logger = AppLogger::getInstance();
    }

    public function list() {
        $customerData = file_get_contents(APP_ROOT . '/samples/common/entities/alison.reid.customer.json');
        $converter = new EntityConverter(\Application\Entities\CustomerEntity::class);
        $customer = $converter->convertFromObjectToEntity(json_decode($customerData));

        return [
            $customer
        ];
    }
}

$controller = new CustomerController();
$controller->list();

$service = new CustomerService();
$service->list();

$repository = new CustomerRepository();
$data = $repository->list();
var_dump($controller->logger);
var_dump($service->logger);
var_dump($repository->logger);


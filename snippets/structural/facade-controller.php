<?php
//class ProductController {
//    public function create(\Psr\Http\Message\RequestInterface $request){
//        /** @var array $data */
//        $data = $request->getBody();
//        $vo = new ProductValueObject();
//        $vo->populate($data);
//
//        $container = new Application\Application(APP_ROOT);
//        $facade = new ProductManagerFacade($service);
//
//        $result = $facade->create($vo);
//
//        if (!$result) {
//
//        }
//
//        return Response(...);
//    }
//}
//
//# client existir
//# client selecionada
//# client ter saldo
//# ...
//# ...
//
//function withdraw($client, $valor, $account) {
//    $this->validateClient();
//    $this->validateSaldo();
//    $this->valiateAccountType();
//
//}
//
//$facade->withdraw($client, $valor, $account);
//
//

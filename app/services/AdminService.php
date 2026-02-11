<?php

namespace app\services;

use flight\Engine;
use app\models\ExchangeDAO;
class AdminService {

    protected Engine $app;
    protected ExchangeDAO $exchangeDAO;

    public function __construct(Engine $app) {
        $this->app = $app;
        $this->exchangeDAO = new ExchangeDAO();
    }

    public function getAllExchanges() {
            return $this->exchangeDAO->getAllExchanges();
        }
}
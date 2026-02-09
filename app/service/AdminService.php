<?php

namespace app\service;

use flight\Engine;
use app\models\ExchangeDAO;
class AdminService {

    protected Engine $app;
    protected ExchangeDAO $exchangeDAO;



    public function getAllExchanges() {
        return ExchangeDAO::getAllExchanges();
    }
}
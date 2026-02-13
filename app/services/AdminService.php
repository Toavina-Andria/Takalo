<?php

namespace app\services;

use flight\Engine;
use app\models\ExchangeDAO;
use app\repositories\ExchangeDetailRepository;

class AdminService {

    protected Engine $app;
    protected ExchangeDAO $exchangeDAO;
    protected ExchangeDetailRepository $exchangeDetailRepository;

    public function __construct(Engine $app) {
        $this->app = $app;
        $this->exchangeDAO = new ExchangeDAO();
        $this->exchangeDetailRepository = new ExchangeDetailRepository();
    }

    public function getAllExchanges() {
        return $this->exchangeDAO->getAllExchanges();
    }

    public function getAllExchangesWithDetails() {
        return $this->exchangeDetailRepository->getAllExchangesWithDetails();
    }

    public function getExchangesByUserId($userId) {
        return $this->exchangeDetailRepository->getExchangesByUserId($userId);
    }
}
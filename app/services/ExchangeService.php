<?php
namespace app\services;

use app\repositories\UserRepository;
use app\models\ExchangeDAO;

class ExchangeService
{


    public function echange($exchangeDAO, $userId, $offerId, $demandId)
    {
        if (!$exchangeDAO || !$userId || !$offerId || !$demandId) {
            return false;
        }
        return $exchangeDAO->createExchange($userId, $offerId, $demandId);
    }


    public function confirmEchange($exangeid){
    //TODO
    }

}
<?php
namespace app\services;

use App\Models\HistoryDAO;
use app\repositories\UserRepository;
use app\models\ExchangeDAO;

class ExchangeService
{


    public static function request($userId, $offerId, $propositionid, $demandId)
    {

        // verify user user is valid
        // create a pending echange

        ExchangeDAO::createExchange($demandId, $propositionid, $userId, $offerId);

    }

    public static function acceptRequest($idrequest)
    {
        // update echange to accepted
        $exchange = ExchangeDAO::getExchangeById($idrequest);
        ExchangeDAO::acceptExchange($idrequest);
        // insert history of owner ship of object
        HistoryDAO::addHistoryEntry($exchange['user1_id'], $exchange['object1_id']);
        HistoryDAO::addHistoryEntry($exchange['user2_id'], $exchange['object2_id']);

    }

    public static function refuseRquest($idrequest){
        ExchangeDAO::cancelExchange($idrequest);
    }

}
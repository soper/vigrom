<?php


namespace app\controllers;

use app\models\Wallet;
use app\services\TransactionService;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use Yii;

class WalletController extends Controller
{

    public function behaviors()
    {
        // remove rateLimiter which requires an authenticated user to work
        $behaviors = parent::behaviors();
        unset($behaviors['rateLimiter']);
        return $behaviors;
    }

    /**
     * Wallet balance action
     *
     * @param $id
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $wallet = $this->findModel($id);
        return [
            'amount' => $wallet->amount,
            'currency' => $wallet->getCurrency()
        ];
    }

    /**
     * Wallet update action
     *
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionChange()
    {
        $params = Yii::$app->request->queryParams;

        $wallet = $this->findModel($params['id']);

        unset($params['id']);

        $service = new TransactionService();

        if ($service->processTransaction($wallet, $params)) {
            return [
                'status' => 'ok',
                'message' => 'OK',
            ];
        }
        else {
            return [
                'status' => 'error',
                'message' => $service->message,
            ];
        }
    }

    protected function findModel($id)
    {
        $wallet = Wallet::findOne($id);

        if(!$wallet) {
            throw new NotFoundHttpException("Wallet not found");
        }

        return $wallet;
    }

}

<?php

namespace mobile\components;

use common\models\Staff;
use common\models\Response;
use Yii;
use yii\helpers\Url;
use yii\rest\Controller;

class RestController extends Controller
{
    public static $params = [];
    public $controller;
    public $maxDay;

    public function init()
    {
        parent::init();
        $this->maxDay = 30;
        Yii::$app->language = 'vi-VN';
    }

    public function response(Response $resp, $contentType = 'json')
    {
        Yii::$app->response->format = $contentType;
        return $resp;
    }

    public function getStaff($col = "id, email, phone, name, expiredTime")
    {
        $headers = Yii::$app->request->headers;
        self::$params["token"] = isset($headers['token']) && !empty($headers['token']) ? $headers['token'] : null;
        self::$params["cols"] = $col;

        $staff = Staff::find()->select(self::$params["cols"])
                ->andWhere(["token" => self::$params["token"]])
                ->one();

        return $staff;
    }
}

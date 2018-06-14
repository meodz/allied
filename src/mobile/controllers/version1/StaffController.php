<?php

namespace mobile\controllers\version1;

use common\models\Staff;
use common\models\Response;
use mobile\components\RestController;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\helpers\Url;

class StaffController extends RestController
{
    public $modelClass = '\common\models\Staff';

    public function init()
    {
        parent::init();
        $this->controller = 'staff';
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'login' => ['post'],
                    'detail' => ['get'],
                    'update' => ['post']
                ],
            ],
        ];
    }

    public function actionLogin()
    {
        $params = Yii::$app->getRequest()->getBodyParams();
        $email = $params['email'];
        $password = $params['password'];

        if ($email == null || $password == null) {
            return $this->response(new Response(false, "Bạn chưa nhập đầy đủ thông tin"));
        }

        $staff = Staff::find()
                ->andWhere(["email" => $email])
                ->orWhere(["phone" => $email])
                ->one();

        if (empty($staff)) {
            return $this->response(new Response(false, "Đăng nhập thất bại", [
                        "email" => ["Địa chỉ email hoặc số điện thoại không chính xác"]
            ]));
        }

        if (!Yii::$app->getSecurity()->validatePassword($password, $staff->password)) {
            return $this->response(new Response(false, "Đăng nhập thất bại", [
                        "password" => ["Sai mật khẩu"]
            ]));
        }

        $staff->token = Yii::$app->getSecurity()->generateRandomString(32);
        $staff->expiredTime = time() + Staff::TOKEN_EXPRIED_TIME;

        $staff->save(false);

        $staff->password = "*****";

        return $this->response(new Response(true, "Thông tin tài khoản", $staff));
    }

    public function actionDetail()
    {
        $staff = $this->getStaff('*');
        if (empty($staff)) {
            return $this->response(new Response(false, "Bạn cần đăng nhập để lấy thông tin hiện tại", [
                        "token" => "Bạn cần đăng nhập để lấy thông tin hiện tại"
            ]));
        }

        if ($staff->expiredTime <= time()) {
            return $this->response(new Response(true, "Token hết hạn", [
                        "token" => "Thời hạn đăng nhập đã hết"
            ]));
        }

        $staff->password = '*****';
        $staff = $staff->getAttributes();

        return $this->response(new Response(true, "Thông tin tài khoản đang đăng nhập", $staff));
    }

    public function actionUpdate()
    {
        $staff = $this->getStaff();
        if (empty($staff)) {
            return $this->response(new Response(false, "Bạn cần đăng nhập để lấy cập nhật thông tin cá nhân", [
                        "token" => "Bạn cần đăng nhập để lấy cập nhật thông tin cá nhân"
            ]));
        }

        if ($staff->expiredTime <= time()) {
            return $this->response(new Response(true, "Token hết hạn", [
                        "token" => "Thời hạn đăng nhập đã hết"
            ]));
        }

        $params = Yii::$app->getRequest()->getBodyParams();
        $staff->setAttributes($params);

        if ($staff->validate()) {
            $staff->save();
            $staff->password = "*****";
            return $this->response(new Response(true, "Cập nhật tài khoản thành công", $staff));
        }
        return $this->response(new Response(false, "Cập nhật tài khoản thất bại", $staff->errors));
    }
}

<?php

namespace institutomix\controllers;

use Yii;
use common\models\LoginForm;
use common\bases\BaseController;
use common\models\ResetPasswordForm;
use common\models\PasswordResetRequestForm;

/**
 * Site controller
 */
class SiteController extends BaseController
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->render('index');
        }
        // forçando a action para usar a condição do main.php
        Yii::$app->controller->action->id = 'login';

        return $this->actionLogin();
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Verifique o seu e-mail para obter mais instruções.');
            } else {
                Yii::$app->session->setFlash('error', 'Desculpe, somos incapazes de redefinir a senha para o e-mail fornecido.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Nova senha foi salva.');
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
    
    /**
     * Esta é a ação para lidar com exceções externas.
     */
    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;

        if ($exception->getMessage() == 'A sessão não existe.') {
            return $this->actionLogin();
        }

        if ($exception !== null) {
            return $this->render('error', ['exception' => $exception]);
        }
    }
}

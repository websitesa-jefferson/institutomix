<?php

/**
* @category Yii2
* @package  Jefferson C. Dias
* @author  Jefferson C. Dias <jeffersoncosta2@hotmail.com>
*/

namespace institutomix\modules\register\controllers;

use Yii;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\bases\BaseController;
use institutomix\modules\register\services\CityServiceInterface;
use institutomix\modules\register\services\StateServiceInterface;
use institutomix\modules\register\services\CustomerServiceInterface;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends BaseController
{
    private $cityService;
    private $stateService;
    private $customerService;

    /**
     * Contrutor para injeção de dependencia (Serviços)
     * @param int $id
     * @param Module $module
     * @param CityServiceInterface $cityService
     * @param StateServiceInterface $stateService
     * @param CustomerServiceInterface $customerService
     * @param array $config
     */
    public function __construct(
        $id,
        $module,
        CityServiceInterface $cityService,
        StateServiceInterface $stateService,
        CustomerServiceInterface $customerService,
        $config = []
    )
    {
        $this->cityService = $cityService;
        $this->stateService = $stateService;
        $this->customerService = $customerService;
        parent::__construct($id, $module, $config);
    }

    /**
     * Listar todos os Customer modelos.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = $this->customerService->customerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $render = Yii::$app->request->isAjax ? 'renderAjax' : 'render';
        return $this->$render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'cities' => ArrayHelper::map($this->cityService->buscarTodos(), 'id', 'name_code'),
        ]);
    }

    /**
     * Displays a single Customer model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->customerService->buscarPorId($id),
        ]);
    }

    /**
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = $this->customerService->customer();
        return $this->salvar($model, 'create');
    }

    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->customerService->buscarPorId($id);
        return $this->salvar($model, 'update');
    }

    /**
     * Salvar um registro Customer no banco.
     * @return boolean
     */
    private function salvar($model, $view)
    {
        if (!is_null(Yii::$app->request->post('ajax')) && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $mensagem = $view == 'create' ? 'CRIADO' : 'ALTERADO';
            if ($this->customerService->salvar($model)) {
                Yii::$app->session->setFlash('success', "REGISTRO $mensagem COM SUCESSO!");
            return true;
        } else {
                Yii::$app->session->setFlash('error', "ERRO AO $mensagem O REGISTRO.");
                return false;
            }
        } else {
            $cities = ArrayHelper::map($this->cityService->buscarTodos(), 'id', 'name_code');
            // Preenche o dropdown input via Pjax
            if (Yii::$app->request->isPjax && Yii::$app->request->post('state_id')) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                $cities = ArrayHelper::map(
                    $this->cityService->buscarPorEstado(Yii::$app->request->post('state_id')),
                    'id',
                    'name_code'
                );
            }

            return $this->renderAjax($view, [
                'view' => $view,
                'model' => $model,
                'cities' => $cities,
                'states' => ArrayHelper::map($this->stateService->buscarTodos(), 'id', 'name_code'),
            ]);
        }
    }

    /**
     * Deletes an existing Customer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if ($this->customerService->deletar(Yii::$app->request->post('ids'))) {
            Yii::$app->session->setFlash('success', 'REGISTRO DELETADO COM SUCESSO!');
            return true;
        } else {
            Yii::$app->session->setFlash('error', 'ERRO AO DELETAR O REGISTRO.');
            return false;
        }
    }
}

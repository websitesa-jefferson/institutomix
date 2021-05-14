<?php

/**
 * @Class BaseFilterActionColumn
 * @category Yii2
 * @author  Jefferson C. Dias <jeffersoncosta2@hotmail.com>
 */

namespace common\bases;

use Yii;
use yii\helpers\ArrayHelper;

class BaseFilterActionColumn extends \yii\filters\AccessControl
{
    protected $_action;

    public function init()
    {
        parent::init();
        $this->_action = Yii::$app->controller->action;
    }

    /**
     * Verifica se o usuário tem permissão para acessar determinada action, caso sim, libera os botões.
     */
    public function checkPermission($permission)
    {
        // Monta os curingas das rotas
        $joker = $this->mountJokers();
        // Caso exista algum coringa, libera o acesso
        if (in_array($joker['root'], $this->userPermissions())
            || in_array($joker['module'], $this->userPermissions())
            || in_array($joker['controller'], $this->userPermissions())) {
            return true;
        // Checa a rota literal
        } else if (in_array($permission, $this->userPermissions())) {
            return true;
        } else {
            return false;
        }
    }

    public function userPermissions()
    {
        $permissions = array_merge(
            Yii::$app->authManager->getPermissionsByUser($this->user->getId()),
            Yii::$app->authManager->getPermissionsByRole('convidado'),
        );
        // Pega as permissões do usario da sessão
        return array_values(
            ArrayHelper::map($permissions,'name','name')
        );
    }

    /**
     * Pega a rota
     * @param type $action
     * @return string
     */
    public function getRoute()
    {
        $route = '';
        foreach (Yii::$app->loadedModules as $module) {
            // Se não for projeto, pega o modulo
            if (!in_array($module->id, Yii::$app->params['projects'])) {
                $route .= '/' . $module->id . '/';
            }
        }
        $route .= '/' . $this->_action->controller->id . '/' . $this->_action->id;
        return str_replace('//', '/', $route);
    }

    /**
     * Monta os curingas
     * @param type $action
     * @return array
     */
    public function mountJokers()
    {
        $route['root'] = '/*';
        $route['module'] = $route['controller'] = null;
        foreach (Yii::$app->loadedModules as $module) {
            // Se não for projeto, pega o modulo
            if (!in_array($module->id, Yii::$app->params['projects'])) {
                $route['module'] = '/' . $module->id . '/*';
            }
        }
        $module = str_replace('/*', '/', $route['module']);
        $route['controller'] = '/' . $module . '/' . $this->_action->controller->id . '/*';
        return str_replace('//', '/', $route);
    }
}

<?php

/**
 * @Class BaseFilter
 * @category Yii2
 * @author  Jefferson C. Dias <jeffersoncosta2@hotmail.com>
 */

namespace common\bases;

class BaseFilter extends BaseFilterActionColumn
{
    public function beforeAction($action)
    {
        return $this->checkAccess();
    }

    /**
     * Verifica se o usuário tem permissão para acessar determinada action, caso sim, libera a view.
     */
    public function checkAccess()
    {
        // Monta a rota explicita do MVC
        $route = $this->getRoute();
        // Monta os curingas das rotas
        $joker = $this->mountJokers();

        // Caso exista algum coringa, libera o acesso
        if (in_array($joker['root'], $this->userPermissions())
            || in_array($joker['module'], $this->userPermissions())
            || in_array($joker['controller'], $this->userPermissions())) {
            return true;
        // Checa a rota literal
        } else if (in_array($route, $this->userPermissions())) {
            return true;
        } else if ($this->user->getIsGuest()) {
            $this->user->loginRequired();
        } else {
            $this->denyAccess($this->user);
        }
    }
}

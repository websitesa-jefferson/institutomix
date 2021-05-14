<?php

/**
 * @Class MenuAdminlte
 * @category Yii2
 * @author  Jefferson C. Dias <jeffersoncosta2@hotmail.com>
 */

namespace common\helpers;

use yii\caching\TagDependency;
use mdm\admin\components\Configs;
use mdm\admin\components\MenuHelper;

class MenuAdminlteHelper extends MenuHelper
{
    /**
     * @inheritdoc
     */
    public static function getAssignedMenu($userId, $root = null, $callback = null, $refresh = false)
    {
        $config = Configs::instance();
        $base = \Yii::$app->params['base'];
        $object = "\\$base\\modules\\admin\\models\\Menu";

        /* @var $manager \yii\rbac\BaseManager */
        $manager = Configs::authManager();
        $menus = $object::find()->asArray()->indexBy('id')->all();
        $key = [__METHOD__, $userId, $manager->defaultRoles];
        $cache = $config->cache;

        if ($refresh || $cache === null || ($assigned = $cache->get($key)) === false) {
            $routes = $filter1 = $filter2 = [];
            if ($userId !== null) {
                foreach ($manager->getPermissionsByUser($userId) as $name => $value) {
                    if ($name[0] === '/') {
                        if (substr($name, -2) === '/*') {
                            $name = substr($name, 0, -1);
                        }
                        $routes[] = $name;
                    }
                }
            }
            foreach ($manager->defaultRoles as $role) {
                foreach ($manager->getPermissionsByRole($role) as $name => $value) {
                    if ($name[0] === '/') {
                        if (substr($name, -2) === '/*') {
                            $name = substr($name, 0, -1);
                        }
                        $routes[] = $name;
                    }
                }
            }
            $routes = array_unique($routes);
            sort($routes);
            $prefix = '\\';
            foreach ($routes as $route) {
                if (strpos($route, $prefix) !== 0) {
                    if (substr($route, -1) === '/') {
                        $prefix = $route;
                        $filter1[] = $route . '%';
                    } else {
                        $filter2[] = $route;
                    }
                }
            }
            $assigned = [];
            $query = $object::find()->select(['id'])->asArray();
            if (is_countable($filter2) && count($filter2)) {
                $assigned = $query->where(['route' => $filter2])->column();
            }
            if (is_countable($filter1) && count($filter1)) {
                $query->where('route like :filter');
                foreach ($filter1 as $filter) {
                    $assigned = array_merge($assigned, $query->params([':filter' => $filter])->column());
                }
            }
            $assigned = static::requiredParent($assigned, $menus);
            if ($cache !== null) {
                $cache->set($key, $assigned, $config->cacheDuration, new TagDependency([
                    'tags' => Configs::CACHE_TAG
                ]));
            }
        }

        $key = [__METHOD__, $assigned, $root];
        if ($refresh || $callback !== null || $cache === null || (($result = $cache->get($key)) === false)) {
            $result = static::normalizeMenu($assigned, $menus, $callback, $root);
            if ($cache !== null && $callback === null) {
                $cache->set($key, $result, $config->cacheDuration, new TagDependency([
                    'tags' => Configs::CACHE_TAG
                ]));
            }
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    private static function requiredParent($assigned, &$menus)
    {
        $l = count($assigned);
        for ($i = 0; $i < $l; $i++) {
            $id = $assigned[$i];
            $parent_id = $menus[$id]['parent'];
            if ($parent_id !== null && !in_array($parent_id, $assigned)) {
                $assigned[$l++] = $parent_id;
            }
        }

        return $assigned;
    }

    /**
     * @inheritdoc
     */
    private static function normalizeMenu(&$assigned, &$menus, $callback, $parent = null)
    {
        $result = [];
        $order = [];
        foreach ($assigned as $id) {
            $menu = $menus[$id];
            if ($menu['parent'] == $parent) {
                $menu['children'] = static::normalizeMenu($assigned, $menus, $callback, $id);
                if ($callback !== null) {
                    $item = call_user_func($callback, $menu);
                } else {
                    $angle = !CheckHelper::valorExiste($menu['parent']) ? '<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>' : '';
                    $item = [
                        'label' => $menu['name'],
                        'icon' => $menu['icon'],
                        'url' => static::parseRoute($menu['route']),
                        'template' => '<a href="{url}">{icon} {label}'.$angle.self::feeedbacksMenu($menu['parent'], $menu['name']).'</a>',
                    ];
                    if ($menu['children'] != []) {
                        $item['items'] = $menu['children'];
                    }
                }
                $result[] = $item;
                $order[] = $menu['order'];
            }
        }
        if ($result != []) {
            array_multisort($order, $result);
        }

        return $result;
    }

    // Adiciona Feedbacks nos itens de menu
    private static function feeedbacksMenu($parents, $labels)
    {
        $parent = CheckHelper::valorExiste($parents) ? (int) $parents : 0;
        $label = TextHelper::removerAcentos($labels, true, false);
        $openSpan = ' <span class="pull-right-container">';
        $closeSpan = '</span>';

        // Criar o array com o parent (id) do item filho seguido da label em minúsculo e com traço no lugar do espaço
        $totalUsuarios = \Yii::createObject('common\models\User');
        $container[1]['usuarios'] = $openSpan.'<small class="label pull-right bg-green">'.$totalUsuarios->find()->count().'</small>'.$closeSpan;
        if (array_key_exists($parent, $container) && array_key_exists($label, $container[$parent])) {
            return $container[$parent][$label];
        }
        return;
    }
}
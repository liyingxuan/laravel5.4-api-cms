<?php

namespace App\Models\cms;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tree
 * 树的创建与操作
 *
 * @package App
 */
class Tree extends Model
{
    /**
     * 生成无序层级树
     *
     * @param        $models
     * @param int    $parent_id
     * @param int    $level
     * @param string $html
     *
     * @return array
     */
    public static function createLevelTree($models, $parent_id = 0, $level = 0, $html = "-")
    {
        $tree = [];
        foreach ($models as $model) {
            if ($model->parent_id == $parent_id) {

                if ($level != 0) {
                    $model->html = str_repeat("    ", $level);
                    $model->html .= '|';
                }
                $model->html .= str_repeat($html, $level);
                $tree[] = $model;
                $tree = array_merge($tree, self::createLevelTree($models, $model->id, $level + 1));
            }
        }

        return $tree;
    }

    /**
     * 生成无序节点树
     *
     * @param        $models
     * @param int    $parent_id
     * @param string $node
     *
     * @return array
     */
    public static function createNodeTree($models, $parent_id = 0, $node = 'child')
    {
        $tree = [];

        foreach ($models as $model) {
            if ($model->parent_id == $parent_id) {
                $model->$node = self::createNodeTree($models, $model->id);
                $tree[] = $model;
            }
        }

        return $tree;
    }
}

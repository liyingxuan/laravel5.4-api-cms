<?php

namespace App\Models\cms;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded = [];


    /**
     * 获取侧边栏菜单
     * @return string
     */
    public static function getSidebar()
    {
        $tree = Tree::createNodeTree(Menu::all());
        $sidebar = self::setSidebar($tree);

        return $sidebar;
    }


    /**
     * 设置侧边栏菜单
     * @param $tree
     *
     * @return string
     */
    public static function setSidebar($tree)
    {
        $html = "";
        foreach ($tree as $menu) {
            if ($menu->is_hide == 0) {
                if ($menu->child) {
                    $html .= '<li class="treeview">'
                        . '<a><i class="fa fa-bars"></i> <span>' . $menu->name . '</span><i class="fa fa-angle-left pull-right"></i></a>'
                        . '<ul class="treeview-menu">'
                        . self::setSidebar($menu->child)
                        . '</ul>'
                        . '</li>';
                } else {
                    $html .= '<li><a href="' . route($menu->url) . '"><i class="fa fa-bars"></i><span> ' . $menu->name . '</span></a></li>';
                }
            }
        }

        return $html;
    }
}

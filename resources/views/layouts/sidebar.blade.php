<?php
/**
 * Created by PhpStorm.
 * User: mvp_xuan
 * Date: 2016-4-4
 * Time: 19:22
 */
?>

<aside class="main-sidebar">
    <section class="sidebar">
        {{--<form action="#" method="get" class="sidebar-form">--}}
        {{--<div class="input-group">--}}
        {{--<input type="text" name="q" class="form-control" placeholder="Search..."/>--}}
        {{--<span class="input-group-btn">--}}
        {{--<button type='submit' name='search' id='search-btn' class="btn btn-flat">--}}
        {{--<i class="fa fa-search"></i>--}}
        {{--</button>--}}
        {{--</span>--}}
        {{--</div>--}}
        {{--</form>--}}
        <ul class="sidebar-menu">
            @inject('menu','App\Models\cms\Menu')
            {!! $menu::getSidebar() !!}
        </ul>
    </section>
</aside>

<?php
/**
 * Created by PhpStorm.
 * User: lyx
 * Date: 16/3/18
 * Time: 下午6:39
 */
?>

@if(Session::has('success'))
    <div id="success-message" class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> 成功提示!</h4>
        {{Session::get('success')}}
    </div>
@endif
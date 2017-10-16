<?php
/**
 * Created by PhpStorm.
 * User: lyx
 * Date: 16/3/18
 * Time: 下午6:39
 */
?>

@if(Session::has('errors'))
    <div id="errors-message" class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> 错误提示!</h4>
        @foreach($errors->all() as $error)
            {{$error}}
        @endforeach
    </div>
@endif
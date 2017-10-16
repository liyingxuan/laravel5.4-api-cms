<?php
/**
 * Created by PhpStorm.
 * User: lyx
 * Date: 16/3/18
 * Time: 下午6:39
 */
?>

@if($errors->has($field))
    @foreach ($errors->get($field) as $error)
        <button class="btn btn-danger col-sm-12 btn-flat" style="width: 100%;">
            <i class="fa fa-times-circle-o"></i> {{$error}}
        </button>
    @endforeach
@endif
<?php
/**
 * Created by PhpStorm.
 * User: lyx
 * Date: 16/3/30
 * Time: 下午3:41
 */
?>

<div class="modal fade" id="defalutModal" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel">
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="defaultModalLabel">{{$model_title}}</h4>
                </div>
                <div class="modal-body">
                    {{$model_content}}
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="_method" value="delete">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-primary">确认</button>
                </div>
            </div>
        </div>
    </form>
</div>


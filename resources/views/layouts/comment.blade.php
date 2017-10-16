<?php
/**
 * Created by PhpStorm.
 * User: lyx
 * Date: 2017/5/5
 * Time: 14:16
 */
?>

{{--评论区域：--}}
<div class="container" style="margin: 80px 0 150px 0;">
    <!-- why begin: 把这段插入到页面最下面就好 -->
    @if(isset($user_info))
    <div hidden class="comment-name">
        <input type="hidden" id="comment-name-val" value="{{$user_info['user_name']}}">
        <input type="hidden" id="comment-avatar-val" value="{{$user_info['user_avatar']}}">
    </div>
    @endif
    <div class="row clearfix">
        <div class="col-xs-1 column"></div>
        <div class="col-xs-10 column">
            <div id="articleComment"></div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-xs-1 column"></div>
        <div class="col-xs-10 column">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="评论" id="commentInput" aria-describedby="submitComment">
                <span class="input-group-addon btn-default" id="submitComment">提交</span>
            </div>
        </div>
    </div>
    <!-- why end: 把这段插入到页面最下面就好 -->
</div>

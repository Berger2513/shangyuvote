@extends('front.layout')

@section('content')
<div class="page panel msg_success  js_show">
    <div class="weui-msg">
        @if($stat['status'] == 1)
        <div class="weui-msg__icon-area">
            <i class="weui-icon-success weui-icon_msg"></i>
        </div>
        @else
        <div class="weui-msg__icon-area">
            <i class="weui-icon-warn weui-icon_msg"></i>
        </div>
        @endif
        <div class="weui-msg__text-area">
            <h2 class="weui-msg__title">{{$stat['message']}}</h2>
        </div>

        <div class="weui-msg__opr-area">
            <p class="weui-btn-area">
                <a href="javascript:history.back();" class="weui-btn weui-btn_primary">返回</a>
            </p>
        </div>
        <div class="weui-msg__extra-area">
            <div class="weui-footer">

                <p class="weui-footer__text">Copyright © 杭州新方向网络</p>
            </div>
        </div>
    </div>
</div>
@endsection

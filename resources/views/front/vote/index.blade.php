@extends('front.layout')

@section('content')
<div class="page panel js_show">
        <div class="page__hd">
            <div class="weui-panel weui-panel_access">
            <div class="weui-panel__hd">投票列表</div>
            <div class="weui-panel__bd">
                @foreach($votes as $vote)
                <div class="weui-media-box weui-media-box_text">
                    <h4 class="weui-media-box__title"><a href="{{ url('vote/detail/'.$vote->id)}}">{{$vote->title}}</a></h4>
                    <p class="weui-media-box__desc">由各种物质组成的巨型球状天体，叫做星球。星球有一定的形状，有自己的运行轨道。</p>
                </div>
                @endforeach
            </div>
            <!-- <div class="weui-panel__ft">
                <a href="javascript:void(0);" class="weui-cell weui-cell_access weui-cell_link">
                    <div class="weui-cell__bd">查看更多</div>
                    <span class="weui-cell__ft"></span>
                </a>
            </div> -->
        </div>
        </div>
    </div>
@endsection
@extends('front.layout')
<style>
    .detail-card {
        border: 1px solid #ccc;
        border-radius: 5px;
        background: #6E52ED;
        color: white;
    }

    .detail-card-title {
        margin-bottom: 0;
        font-size: 16px;
        padding: 0 5px;
        clear: both;
    }

    .detail-card-title-left {
        float: left;
        margin: 15px 0;
    }

    .detail-card-title-right {
        float: right;
        margin: 15px 0;
    }

</style>
@section('content')
<div class="page panel js_show">

<!-- <div class="page article js_show"> -->
    <div class="page__bd">
        <article class="weui-article">
            <h1 style="text-align: center;font-size: 28px;">{{$vote->title}}</h1>
            <section>
                <section>
                    <p>
                       {{strip_tags($vote->content)}}
                    </p>
                   <!--  <p>
                        <img src="./images/pic_article.png" alt="">
                        <img src="./images/pic_article.png" alt="">
                    </p> -->
                </section>
                <h2 style="font-size: 22px;">候选人列表</h2>
                @foreach($vote->person_list as $key=>$val)
                    <section class="detail-card">
                        <div class="detail-card-title"><span class="detail-card-title-left">编号:{{$key+1}}</span>  <span class="detail-card-title-right">{{$val->name}} --当前票数： {{$val->Sorce or 0}}</span></div>
                        <p>
                            <img src="{{ url('/uploads/'.$val->avatar)}}" alt="">
                        </p>
                        <p style="padding:0 5px;">
                            {{strip_tags($val->content)}}
                        </p>
                    </section>
                @endforeach
            </section>
            <form method="post" action="{{url('vote/store')}}">
                {{ csrf_field() }}
                <input type="hidden" name="vote_id" value="{{$vote->id}}">
            <section>
                <div class="weui-cells__title">请选择：</div>
                <div class="weui-cells weui-cells_checkbox" >
                @foreach($vote->person_list as $key=>$val)
                <label class="weui-cell weui-check__label" for="Vote_{{$key+1}}">
                    <div class="weui-cell__hd">
                        <input type="checkbox" class="weui-check" name="user_id[]" id="Vote_{{$key+1}}">
                        <i class="weui-icon-checked"></i>
                    </div>
                    <div class="weui-cell__bd">
                        <p><p>{{$val->name}}</p></p>
                    </div>
                </label>
                @endforeach
            </a>
        </div>
            </section>

            <button  type='submit' class="weui-btn weui-btn_plain-primary"> 投票 </button>
            </form>
        </article>
    </div>
    <div class="page__ft">
        <a href="javascript:home()"><img src="./images/icon_footer_link.png"></a>
    </div>
</div>
@endsection


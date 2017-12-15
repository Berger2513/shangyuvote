@extends('front.layout')

@section('content')
<div class="page panel js_show">

<!-- <div class="page article js_show"> -->
    <div class="page__bd">
        <article class="weui-article">
            <h1>{{$vote->title}}</h1>
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
                <h2>候选人列表</h2>
                @foreach($vote->person_list as $key=>$val)
                     <section>
                    <h3><b>编号:{{$key+1}}</b>  {{$val->name}} --当前票数： {{$val->Sorce or 0}}</h3>
                    <p>
                        <img src="{{ url('/uploads/'.$val->avatar)}}" alt="">
                    </p>
                    <p>
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


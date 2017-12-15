@extends('admin.layouts.admin')

@section('admin-css')
<style type="text/css">
.datepicker {
    z-index: 11111;
}
</style>
@endsection

@section('admin-content')
    <div id="content" class="content">
        <!-- begin page-header -->
        <h1 class="page-header">@if( !empty($vote->id))修改投票 @else 新增投票 @endif </h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-6 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                        </div>
                        <h4 class="panel-title">表单</h4>
                    </div>
                    @if(count($errors)>0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="panel-body panel-form">
                        <form class="form-horizontal form-vote" data-parsley-validate="true" action="{{ url('admin/vote') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{$vote->id}}">
                            <div class="form-group" style="margin-top: 15px">
                                <label class="control-label col-md-4 col-sm-4" for="display_name">标题 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="title" placeholder="名称" data-parsley-required="true" data-parsley-required-message="请输入名称" value="{{$vote->title or ''  }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="name">起始时间 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" class="form-control left-10" placeholder="月/日/年" id="datepicker1" name="create_time" value="{{$vote->create_time }}" >

                                </div>
                            </div>
                             <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="name">结束时间 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" class="form-control left-10" placeholder="月/日/年" id="datepicker2" name="end_time" value="{{$vote->end_time}}" >

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="name">最大选择数 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="number" class="form-control left-10"  name="max_num" value="{{$vote->max_num or ''}}"  min="1">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="name">内容 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <div id="editor">
                                        {!! $vote->content !!}
                                    </div>
                                </div>
                                <textarea class="hidden" name="content" id="form-content" ></textarea>
                            </div>


                             <div class="form-group">


                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4"></label>
                                <div class="col-md-6 col-sm-6">
                                    <button type="submit" class="btn btn-primary submit-button"
                                    >提交</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-6 -->
        </div>
        <!-- end row -->
    </div>
@endsection

@section('admin-js')
    <script src="{{ asset('asset_admin/js/wangEditor.min.js') }}"></script>
    <script src="{{ asset('asset_admin/js/bootstrap-datepicker.js') }}"></script>
    <!-- <script src="{{ asset('asset_admin/js/bootstrap-timepicker.min.js') }}"></script> -->
    <script>
    jQuery('#datepicker1').datepicker();
    jQuery('#datepicker2').datepicker();

    var E = window.wangEditor;
    var editor = new E('#editor');
    editor.customConfig.uploadImgShowBase64 = true ;
    editor.create();
    $(".submit-button").click(function () {
        var content = editor.txt.html();
        if( content == '<p><br></p>'){
            $('#form-content').text('');
        } else {
            $('#form-content').text(content);
        }

    });
    </script>
@endsection
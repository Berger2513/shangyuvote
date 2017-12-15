@extends('admin.layouts.admin')

@section('admin-css')
<style type="text/css">
.person-list {
    padding-top: 10px;
    padding-left: 0;
    height: 200px;
    overflow-y: scroll;
    border: 1px solid #ddd;
}
</style>

<script src="{{ asset('asset_admin/js/jquery-2.1.4.min.js') }}"></script>
@endsection

@section('admin-content')
    <div id="content" class="content">
        <!-- begin page-header -->
        <h1 class="page-header">{{$vote->title}} </h1>
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
                        <h4 class="panel-title">{{$vote->title}} 投票候选人详情</h4>
                    </div>
                    <div class="panel-body panel-form">
                    <div class="form-horizontal">
                        <div class="form-group" style="margin-top: 15px">
                            <label class="control-label col-md-4 col-sm-4" for="name">新增候选人 * :</label>
                            <div class="col-md-6 col-sm-6">
                                <button type="button" class="btn btn-primary m-r-5 m-b-5" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square-o"></i> 新增</button>
                            </div>
                        </div>

                            <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4" for="name">候选人列表 * :</label>
                            <div class="col-md-6 col-sm-6" style="overflow-x: auto; overflow-y: auto; height: 300px; ">
                                <table class="table person-list table-bordered">
                                    <tr>
                                        <th>姓名</th>
                                        <th>头像</th>
                                        <th>简介</th>
                                        <th>当前票数</th>
                                        <th>操作</th>
                                    </tr>
                                        @if(!empty($persons))
                                            @foreach($persons as $val)
                                            <tr>
                                                <td>{{$val->name}}</td>
                                                <td><img src="{{ url('/uploads/'.$val->avatar)}}" width="100"></td>
                                                <td>{{strip_tags($val->content)}}</td>
                                                <td>{{$val->sorce}}</td>
                                                <td>
                                                    <button  data-toggle="modal" data-target=".bs-example-modal-sm"  class="btn btn-danger btn-xs destroy"><i class="fa fa-trash"> 删除</i></button>

                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif

                                </table>
                            </div>
                            </div>
                           <!--  <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="name"></label>
                                <div class="col-md-6 col-sm-6">
                                    <button type="submit" class="btn btn-primary ">提交</button>
                                </div>
                            </div> -->
                    </div>
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-6 -->
        </div>
        <!-- end row -->
    </div>
    <!-- 模态框 -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">新增候选人</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal form-vote" data-parsley-validate="true" action="{{ url('admin/person') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="vote_id" value="{{$vote->id}}">
                    <div class="form-group" style="margin-top: 15px">
                        <label class="control-label col-md-4 col-sm-4" for="display_name">候选人名称 * :</label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" type="text" name="name" placeholder="名称" data-parsley-required="true" data-parsley-required-message="请输入名称" value=""/>
                        </div>
                    </div>

                    <div class="form-group" style="margin-top: 15px">
                        <label class="control-label col-md-4 col-sm-4" for="display_name">头像 * :</label>
                        <div class="col-md-6 col-sm-6">
                            <input type="file" name="image" id="uploadImage" multiple="multiple" accept="image/*">

                            <br><br>
                            <img src="" id="img0" width="220" class="hide">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4" for="name">简介 * :</label>
                        <div class="col-md-6 col-sm-6">
                            <div id="editor"></div>
                        </div>
                        <textarea class="hidden" name="content" id="form-content" ></textarea>
                    </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary submit-button">提交</button>
          </div>

          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div>


    <!-- 确认模态 -->
    <!-- Small modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" role="dialog" data-target=".bs-example-modal-sm">Small modal</button>

    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
          </div>
          @if( !empty($val))
          <form action="{{ url('admin/person/'.$val->id) }}" method="POST">
            @endif
           {{ csrf_field() }}
           <input type="hidden" name="_method" value="DELETE">

           <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">确认删除</button>
          </div>
            </form>
        </div>
      </div>
    </div>
@endsection

@section('admin-js')

    <script src="{{ asset('asset_admin/js/wangEditor.min.js') }}"></script>
    <script src="{{ asset('asset_admin/js/bootstrap-datepicker.js') }}"></script>
    <!-- <script src="{{ asset('asset_admin/js/bootstrap-timepicker.min.js') }}"></script> -->
    <script src="{{ asset('asset_admin/assets/plugins/bootstrap-sweetalert-master/dist/sweetalert.js') }}"></script>
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

    $("#uploadImage").change(function(){
        var objUrl = getObjectURL(this.files[0]) ;
        console.log("objUrl = "+objUrl) ;
        if (objUrl)
        {
            $("#img0").attr("src", objUrl);
            $("#img0").removeClass("hide");
        }
    }) ;
    //建立一個可存取到該file的url
    function getObjectURL(file)
    {
        var url = null ;
        if (window.createObjectURL!=undefined)
        { // basic
            url = window.createObjectURL(file) ;
        }
        else if (window.URL!=undefined)
        {
            // mozilla(firefox)
            url = window.URL.createObjectURL(file) ;
        }
        else if (window.webkitURL!=undefined) {
            // webkit or chrome
            url = window.webkitURL.createObjectURL(file) ;
        }
        return url ;
    }
    </script>
@endsection
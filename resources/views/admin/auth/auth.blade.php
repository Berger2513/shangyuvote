@extends('admin.layouts.auth')

@section('admin-auth-page-container')
    <div id="page-container" class="fade">
        <!-- begin login -->
        <div class="login login-with-news-feed">

            <!-- end news-feed -->
            <!-- begin right-content -->
            <div class="center-content">
                <!-- begin login-header -->
                <div class="login-header" style="margin:0 auto;">
                    <div class="brand">
                        <span class="logo"></span>上虞公安投票管理系统

                    </div>

                </div>
                <!-- end login-header -->
                <!-- begin login-content -->
                <div class="login-content" style="margin:0 auto; width: 500px">
                    @if(count($errors)>0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ url('admin/login') }}" method="POST" class="margin-bottom-0">
                        {{ csrf_field() }}
                        <div class="form-group m-b-15">
                            <input type="text" name="email" class="form-control input" placeholder="邮箱地址" value="{{ old('email') }}"/>
                        </div>
                        <div class="form-group m-b-15">
                            <input type="password" name="password" class="form-control input" placeholder="密码" />
                        </div>
                        <div class="login-buttons">
                            <button type="submit" class="btn btn-success btn-block">登　录</button>
                        </div>

                    </form>
                </div>
                <!-- end login-content -->
            </div>
            <!-- end right-container -->
        </div>
        <!-- end login -->

        <!-- begin theme-panel -->
        <!-- end theme-panel -->
    </div>
@endsection
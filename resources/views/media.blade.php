@extends('layouts.layout')

@section('content')
    <main id="js-page-content" role="main" class="page-content mt-3">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-image'></i> Загрузить аватар
            </h1>

        </div>
        @if(session('status-danger'))
            <div class="alert alert-danger">
                {{session('status-danger')}}
            </div>
        @endif
        <form action="/updateAvatar/{{$user->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Текущий аватар</h2>
                            </div>
                            <div class="panel-content">
                                <div class="form-group">
                                    <img src="@if(!empty($user->avatar)) {{asset($user->avatar)}} @else {{asset('uploads/plug/plug.jpg')}} @endif" alt="Аватар пользователя" class="img-responsive" width="200">
                                </div>

                                <div class="form-group">
                                    @error('avatar')
                                    <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                    <label class="form-label" for="example-fileinput">Выберите аватар</label>
                                    <input name="avatar" type="file" id="example-fileinput" class="form-control-file">
                                </div>


                                <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                    <button class="btn btn-warning">Загрузить</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
@endsection

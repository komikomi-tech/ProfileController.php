<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MyProfile</title>
    </head>
    <body>
        <h1>Myプロフィール見出し画面</h1>
    </body>
</html>

@extends('layouts'.'profile')

@section('title', 'プロフィールの見出し')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>ニュース見出し</h2>
            <form action="{{ action('Admin\ProfileController@update') }}" method="post"
            enctype="multipart/form-date">
                 @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="name">氏名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ $news_form->title }}">
                        </div>
                    </div>
                     <div class="form-group row">
                    <label class="col-md-2" for="hobby">趣味</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="hobby" value="{{ old('hobby') }}">
                        
                        
                    </div>
                </div>
                
                
                <div class="form-group row">
                    <label class="col-md-2" for="introduction">自己紹介欄</label>
                    <div class="col-md-10">
                        <textarea class="form-control" name="introduction" rows="20">{{ old('introduction') }}</textarea>
                    </div>
                    
                </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $news_form->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
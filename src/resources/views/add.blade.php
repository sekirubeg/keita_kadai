@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/add.css')}}">
@endsection


@section('content')
<section class="product-register">
        <h1 class="product-register__title">商品登録</h1>
        <form action="/store" method="post" enctype="multipart/form-data" class="product-register__form">
            @csrf
            <!-- 商品名 -->
            <div class="product-register__field">
                <label for="name" class="product-register__label">商品名 <span class="required">必須</span></label>
                <input type="text" id="name" name="name" class="product-register__input" placeholder="商品名を入力">
            </div>

            <!-- 値段 -->
            <div class="product-register__field">
                <label for="price" class="product-register__label">値段 <span class="required">必須</span></label>
                <input type="integer" id="price" name="price" class="product-register__input" placeholder="値段を入力">
            </div>

            <!-- 商品画像 -->
            <div class="product-register__field">
                <label class="product-register__label">商品画像 <span class="required">必須</span></label>
                <input type="file" name="image" class="product-register__image">
            </div>

            <!-- 季節 -->
            <div class="product-register__field">
                <label class="product-register__label">季節 <span class="required">必須</span> <span class="hint">複数選択可</span></label>
                <div class="product-register__season-options">
                    @foreach ($allSeasons as $season)
                        <label class="product-edit__radio">
                            <input
                                type="checkbox" 
                                name="seasons[]" 
                                value="{{ $season->id }}" 
                                class="product-edit__radio-input">
                            {{ $season->name }}
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- 商品説明 -->
            <div class="product-register__field">
                <label for="description" class="product-register__label">商品説明 <span class="required">必須</span></label>
                <textarea id="description" name="text" class="product-register__textarea" placeholder="商品の説明を入力"></textarea>
            </div>

            <!-- ボタン -->
            <div class="product-register__actions">
                <a type="button" href="/products" class="button button--back">戻る</a>
                <button type="submit" class="button button--submit">登録</button>
            </div>
        </form>
    </section>
    @endsection
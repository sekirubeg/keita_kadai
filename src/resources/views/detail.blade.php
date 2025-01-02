@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/detail.css')}}">
@endsection


@section('content')

<section class="product-edit">
    <div class="product-edit__breadcrumbs">
        <a href="/products" class="product-edit__breadcrumbs-link">商品一覧</a> &gt; <span class="product-edit__breadcrumbs-current">{{ $product['name'] }}</span>
    </div>
    <form action="/update" method="post" enctype="multipart/form-data">
        @csrf
    <input type="hidden" name="id" value="{{ $product['id'] }}">
    <div class="product-edit__form">
        <!-- 左側の画像とファイル選択 -->
        <div class="product-edit__image-section">
            <img src="{{ asset('storage/' . $product['image']) }}" alt="{{ $product['name'] }}" class="product-edit__image">
                <label class="product-edit__file-label">
                    ファイルを選択
                    <input type="file" name="image" class="product-edit__file-input">
                </label>
            <span class="product-edit__file-name">{{ $product['image'] }}</span>
        </div>

        <!-- 右側のフォーム -->
        <div class="product-edit__details">
            <div class="product-edit__field">
                <label for="name" class="product-edit__label">商品名</label>
                <input name="name" type="text" id="name" class="product-edit__input" value="{{ $product['name'] }}" placeholder="商品名を入力">
            </div>

            <div class="product-edit__field">
                <label for="price" class="product-edit__label">値段</label>
                <input name="price" type="text" id="price" class="product-edit__input" value="{{ $product['price'] }}" placeholder="値段を入力">
            </div>
            <div class="product-edit__field">
                <span class="product-edit__label">季節</span>
                <div class="product-edit__radio-group">
                    @foreach ($allSeasons as $season)
                        <label class="product-edit__radio">
                            <input
                                type="checkbox" 
                                name="seasons[]" 
                                value="{{ $season->id }}" 
                                class="product-edit__radio-input"
                                {{ $product->seasons->contains($season->id) ? 'checked' : '' }}>
                            {{ $season->name }}
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- <div class="product-edit__field">
                <span class="product-edit__label">季節</span>
                <div class="product-edit__radio-group">
                    <label class="product-edit__radio">
                        <input type="radio" name="season" value="spring" class="product-edit__radio-input"> 春
                    </label>
                    <label class="product-edit__radio">
                        <input type="radio" name="season" value="summer" class="product-edit__radio-input" checked> 夏
                    </label>
                    <label class="product-edit__radio">
                        <input type="radio" name="season" value="autumn" class="product-edit__radio-input"> 秋
                    </label>
                    <label class="product-edit__radio">
                        <input type="radio" name="season" value="winter" class="product-edit__radio-input"> 冬
                    </label>
                </div>
            </div> -->

            <div class="product-edit__field">
                <label for="description" class="product-edit__label">商品説明</label>
                <textarea name="text" id="description" class="product-edit__textarea" placeholder="商品の説明を入力">{{ $product['text'] }}</textarea>
            </div>
        </div>
    </div>

    <!-- ボタン群 -->
    <div class="product-edit__actions">
        <a href="/products" class="product-edit__button product-edit__button--back">戻る</a>
        <button type="submit" class="product-edit__button product-edit__button--save">変更を保存</button>
        </form>
        <form action="/delete?id={{$product->id}}" method="post">
            @csrf
            <button class="product-edit__button product-edit__button--delete"></button>
        </form>
    </div>
</section>

@endsection
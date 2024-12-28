@extends('layouts.app')


@section('css')
<link rel="stylesheet" href="{{asset('css/index.css')}}">
@endsection

@section('content')

<div class="product-page">

    <!-- 商品一覧のヘッダー -->
    <div class="product-page__header">
        <h1 class="product-page__title">商品一覧</h1>
        <div class="product-page__add">
            <button class="product-page__add-button">+ 商品の追加</button>
        </div>
    </div>

    <!-- 左側のフィルターエリア -->
    <div class="product-page__content">
        <aside class="product-page__filters">
            <!-- 検索フォーム -->
            <form class="product-page__search" method="post" action="/search">
                @csrf
                <input type="text" name="name"  class="product-page__search-input" placeholder="商品名で検索">
                <button class="product-page__search-button" type="submit">検索</button>
            </form>
            <!-- 並び替え -->
            <div class="product-page__sort">
                <h3 class="product-page__sort-title">価格順で表示</h3>
                <select class="product-page__sort-select">
                    <option disabled selected>価格の並び替え</option>
                    <option value="asc">安い順</option>
                    <option value="desc">高い順</option>
                </select>
            </div>
        </aside>

        <!-- 商品の一覧 -->
        <section class="product-list">
            @foreach($products as $product)
            <div class="product-card">
                <div class="product-card__image">
                    <img src="{{ asset('storage/' . $product['image']) }}" alt="{{ $product['name'] }}">
                </div>
                <div class="product-card__info">
                    <h2 class="product-card__name">{{ $product['name'] }}</h2>
                    <p class="product-card__price">¥{{ number_format($product['price']) }}</p>
                </div>
            </div>
            @endforeach
        </section>
    </div>

    <!-- ページネーション -->
    {{ $products->links('vendor.pagination.default') }}
</div>


@endsection
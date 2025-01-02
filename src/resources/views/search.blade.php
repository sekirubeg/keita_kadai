@extends('layouts.app')


@section('css')
<link rel="stylesheet" href="{{asset('css/index.css')}}">
@endsection

@section('content')

<div class="product-page">

    <!-- 商品一覧のヘッダー -->
     
    <div class="product-page__header">
    
        <h1 class="product-page__title">@foreach($items as $item)<span>
    ”{{ $item['name'] }}”
    </span>@endforeachの商品一覧</h1>
        <div class="product-page__add">
            <form action="/register" method="post">
                @csrf
                <button class="product-page__add-button">+ 商品の追加</button>
            </form>
        </div>
        
    </div>

    <!-- 左側のフィルターエリア -->
    <div class="product-page__content">
        <aside class="product-page__filters">
            <!-- 検索フォーム -->
            <form class="product-page__search" method="get" action="/search">
                @csrf
                <input name="name" type="text" class="product-page__search-input" placeholder="商品名で検索">
                <button class="product-page__search-button" type="submit">検索</button>
            </form>
            <!-- 並び替え -->
            <div class="product-page__sort">
                <h3 class="product-page__sort-title">価格順で表示</h3>
                <form method="get" action="/search">
                    <input type="hidden" name="name" value="{{ request('name') }}">
                    <select name="sort" class="product-page__sort-select" onchange="this.form.submit()">
                        <option value="" disabled selected>価格の並び替え</option>
                        <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>安い順</option>
                        <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>高い順</option>
                    </select>
                </form>
            </div>
        </aside>

        <!-- 商品の一覧 -->
            <section class="product-list">
                 @foreach ($items as $item)
                <a href="{{ route('products.detail', ['id' => $item->id]) }}" class="product-card">
                    <div class="product-card__image">
                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}">
                    </div>
                    <div class="product-card__info">
                        <h2 class="product-card__name">{{ $item['name'] }}</h2>
                        <p class="product-card__price">¥{{ number_format($item['price']) }}</p>
                    </div>
                </a>
                @endforeach
            </section>
    </div>
    {{ $items->links('vendor.pagination.default') }}
</div>


@endsection
@extends('layouts.app')

@section('content')
<div class="product-detail">
    <h1>{{ $product->name }}</h1>
    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
    <p>価格: ¥{{ number_format($product->price) }}</p>
    <p>説明: {{ $product->description }}</p>
    <a href="{{ route('home') }}">商品一覧に戻る</a>
</div>
@endsection
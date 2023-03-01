<x-app-layout>
    <x-slot name="header">
        <div class="content">
            <h2 class="title">商品情報詳細画面</h2>
            <x-secondary-button class="bg-yellow-400">
                <a href="{{ url('/product') }}">戻る</a>
            </x-secondary-button>
        </div>

    </x-slot>
    <div class="main">
        <div class="show">
            <div class="show__btn">
                <x-secondary-button class="bg-orange-400 mb-3">
                    <a href="{{ route('product.edit', $product) }}">編集</a>
                </x-secondary-button>
            </div>
            <div>
                <div>
                    <p>ID：{{ $product->id }}</p>
                </div>
                <div>
                    <p>商品名：{{ $product->product_name }}</p>
                </div>
                    <p>メーカー：{{ $product->company->company_name }}</p>
                <div>
                    <p>価格：{{ $product->price }}円</p>
                </div>
                <div>
                    <p>在庫数：{{ $product->stock }}個</p>
                </div>
                <div>
                    <p>コメント：</p>
                    {{ $product->comment }}
                </div>
                <div>
                    <p>商品画像：</p>
                    @if ($product->img_path !== null)
                        <img src="{{ asset('storage/images/'.$product->img_path)}}">
                    @else
                        <p>画像はありません</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
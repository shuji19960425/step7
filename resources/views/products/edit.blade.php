<x-app-layout>
    <x-slot name="header">
        <div class="content">
            <h2 class="title">商品情報編集画面</h2>
            <x-secondary-button class="bg-yellow-400">
                <a href="{{ route('product.show', $product) }}">戻る</a>
            </x-secondary-button>
        </div>

        <x-input-error :messages="$errors->all()" />

        @if (session('message'))
            {{session('message')}}        
        @endif
        
    </x-slot>

    <div class="main">
        <form method="POST" action="{{ route('product.update', $product)}}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
            <div class="column">
                <p>ID：{{ $product->id }}</p>
            </div>
            <div class="column">
                <label for="textProduct">商品名</label><br>
                <input type="text" id="textProduct" name="product_name" value="{{ old('product_name', $product->product_name) }}">    
            </div>
            <div class="column">
                <label for="drpMaker">メーカー</label><br>
                <select id="drpMaker" name="maker">
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" @if ($company->id == $product->company_id) selected @endif>
                            {{ $company->company_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="column">
                <label for="numPrice">価格</label><br>
                <input type="text" id="numPrice" name="price" value="{{ old('price', $product->price) }}">    
            </div>
            <div class="column">
                <label for="numLot">在庫数</label><br>
                <input type="text" id="numLot" name="stock" value="{{ old('stock', $product->stock) }}">
            </div>
            <div class="column">
                <label for="areaComment">コメント</label><br>
                <textarea name="comment" id="areaComment" cols="30" rows="10" name="comment">{{ old('comment', $product->comment) }}</textarea>
            </div>
            <div class="column">
                @if ($product->img_path)
                <div>
                    （画像ファイル：{{ $product->img_path }}）
                </div>
                <img src="{{ asset('storage/images/'.$product->img_path) }}">
                @endif
                <label for="fileImage">商品画像</label><br>
                <input type="file" id="fileImage" type="file" name="image">
            </div>
            <x-primary-button class="mt-4">
                更新
            </x-primary-button>
        </form>
    </div>
</x-app-layout>
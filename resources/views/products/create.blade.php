<x-app-layout>
    <x-slot name="header">
        <div class="content">
            <h2 class="title">商品新規登録画面</h2>
            <x-secondary-button class="bg-yellow-400">
                <a href="{{ url('/product') }}">戻る</a>
            </x-secondary-button>
        </div>

        <x-input-error :messages="$errors->all()" />

        @if (session('message'))
            {{session('message')}}        
        @endif
        
    </x-slot>
    
    <div class="main">
        <form method="post" action="{{ route('product.store')}}" enctype="multipart/form-data">
        @csrf
            <div class="column">
                <label for="textProduct">商品名</label><br>
                <input type="text" id="textProduct" name="product_name" value="{{ old('product_name') }}">    
            </div>
            <div class="column">
                <label for="drpMaker">メーカー</label><br>
                <select id="drpMaker" name="maker">
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="column">
                <label for="numPrice">価格</label><br>
                <input type="text" id="numPrice" name="price" value="{{ old('price') }}">    
            </div>
            <div class="column">
                <label for="numLot">在庫数</label><br>
                <input type="text" id="numLot" name="stock" value="{{ old('stock') }}">
            </div>
            <div class="column">
                <label for="areaComment">コメント</label><br>
                <textarea name="comment" id="areaComment" cols="30" rows="10" name="comment" value="{{ old('comment') }}"></textarea>
            </div>
            <div class="column">
                <label for="fileImage">商品画像</label>
                <input type="file" id="fileImage" name="image">
            </div>
            <x-primary-button class="mt-4">
                登録
            </x-primary-button>
        </form>
    </div>
</x-app-layout>
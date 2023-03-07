<x-app-layout>

    <x-slot name="header">

        <h2 class="title">商品の一覧</h2>
            @if (session('message'))
                <div class="delete">
                    {{session('message')}} 
                </div>       
            @endif
        

        <div class="content">
            <div>
                <x-secondary-button class="bg-green-500 button"><a href="{{ route('product.create') }}" >新規登録</a></x-secondary-button>    
            </div>    

            <form action="{{ route('product.index') }}" method="GET" class="content__form">
                <input type="text" name="search" value="{{ $search }}"  placeholder="商品名">
                <select id="drpMaker" name="makerSearch">
                    <option>メーカー名</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                    @endforeach
                </select>
                <x-primary-button>
                    検索
                </x-primary-button>
            </form>
        </div>

    </x-slot>

    {{-- 中身 --}}

    <div class="main">
        <table class="main__table">
            <tr>
                <th>id</th>
                <th>商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>メーカー名</th>
                <th></th>
                <th></th>
            </tr>

            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        @if ($product->img_path !== null)
                        <img class="main__table--img" src="{{ asset('storage/images/'.$product->img_path) }}">
                        @endif
                    </td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->price }}円</td>
                    <td>{{ $product->stock }}個</td>
                    <td>{{ $product->company->company_name }}</td>
                    <td>
                        <x-secondary-button class="bg-green-400">
                            <a href="{{ route('product.show', $product) }}">詳細表示</a>
                        </x-secondary-button>
                    </td>
                    <td>
                        <form action="{{ route('product.destroy', $product) }}" method="post">
                            @csrf
                            @method('delete')
                            <x-primary-button class="bg-red-700" onClick="return confirm('本当に削除しますか？');">
                                削除
                            </x-primary-button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</x-app-layout>


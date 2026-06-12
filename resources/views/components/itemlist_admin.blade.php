<div id="w-node-ef150e1e-10b5-3b56-2990-7c2d6ae0fe0b-26605386" class="w-layout-layout quick-stack wf-layout-layout">
    <div class="w-layout-cell">
        <div>ID</div>
    </div>
    <div class="w-layout-cell">
        <div>名前</div>
    </div>
    <div class="w-layout-cell">
        <div>税込み値段</div>
    </div>
    <div class="w-layout-cell">
        <div>説明</div>
    </div>
    <div class="w-layout-cell">
        <div>商品画像</div>
    </div>
    <div class="w-layout-cell">
        <div>ジャンル</div>
    </div>
    <div class="w-layout-cell"></div>
    <div class="w-layout-cell"></div>

    @foreach ($products as $product)
        <div class="w-layout-cell">
            <div>{{ $product->id }}</div>
        </div>
        <div class="w-layout-cell">
            <div>{{ $product->name }}</div>
        </div>
        <div class="w-layout-cell">
            <div>￥{{ number_format($product->val) }}</div>
        </div>
        <div class="w-layout-cell">
            <div>{{ $product->explanation }}</div>
        </div>
        <div class="w-layout-cell">
            <div>{{ $product->picture }}</div>
        </div>
        <div class="w-layout-cell">
            <div>{{ $product->genre }}</div>
        </div>
        <div class="w-layout-cell">
            <a href="{{ route('admin.itemedit.edit', $product->id) }}" class="button-13 w-button">編集</a>
        </div>
        <div class="w-layout-cell">
            <form action="{{ route('admin.itemedit.delete', $product->id) }}" method="post">
                @csrf
                <button type="submit" class="button-14 w-button" onclick="return confirm('本当に削除しますか？')">削除</button>
            </form>
        </div>
    @endforeach
</div>
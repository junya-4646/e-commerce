@props(['users', 'admins'])

<div id="w-node-_6dcdb1b9-8a40-1efa-4aa4-1e4fc746eb49-26605386" class="w-layout-layout quick-stack-3 wf-layout-layout">
    <div class="w-layout-cell">
        <div>ID</div>
    </div>
    <div class="w-layout-cell">
        <div>ユーザー名</div>
    </div>
    <div class="w-layout-cell cell-2">
        <div>メールアドレス</div>
    </div>
    <div class="w-layout-cell">
        <div>電話番号</div>
    </div>
    <div class="w-layout-cell">
        <div>郵便番号</div>
    </div>
    <div class="w-layout-cell cell">
        <div>住所</div>
    </div>
    <div class="w-layout-cell">
        <div>ユーザー種別</div>
    </div>
    <div class="w-layout-cell">
        <div></div>
    </div>

    @foreach ($users as $user)
        <div class="w-layout-cell">
            <div>{{ $user->id }}</div>
        </div>
        <div class="w-layout-cell">
            <div>{{ $user->name }}</div>
        </div>
        <div class="w-layout-cell">
            <div>{{ $user->email }}</div>
        </div>
        <div class="w-layout-cell">
            <div>{{ $user->tel }}</div>
        </div>
        <div class="w-layout-cell">
            <div>{{ $user->post }}</div>
        </div>
        <div class="w-layout-cell">
            <div>{{ $user->address }}</div>
        </div>
        <div class="w-layout-cell">
            <div>一般</div>
        </div>

        <div class="w-layout-cell">
            <a href="{{ route('admin.useredit.edit', ['user_type' => 'user', 'id' => $user->id]) }}" class="button-13 w-button">
                編集
            </a>
            <form action="{{ route('admin.useredit.delete', $user->id) }}" method="POST" style="display: inline;">
                @csrf
                <input type="hidden" name="user_type" value="user">
                <button type="submit" class="button-14 w-button" onclick="return confirm('本当に削除しますか？')">削除</button>
            </form>
        </div>
    @endforeach

    @foreach ($admins as $admin)
        <div class="w-layout-cell">
            <div>{{ $admin->id }}</div> 
        </div>
        <div class="w-layout-cell">
            <div>{{ $admin->name }}</div>
        </div>
        <div class="w-layout-cell">
            <div>{{ $admin->email }}</div>
        </div>
        <div class="w-layout-cell">
            <div>{{ $admin->tel }}</div>
        </div>
        <div class="w-layout-cell">
            <div>{{ $admin->post }}</div>
        </div>
        <div class="w-layout-cell">
            <div>{{ $admin->address }}</div>
        </div>
        <div class="w-layout-cell">
            <div>管理者</div>
        </div>
        <div class="w-layout-cell">
            <a href="{{ route('admin.useredit.edit', ['user_type' => 'admin', 'id' => $admin->id]) }}" class="button-13 w-button">
                編集
            </a>
            <form action="{{ route('admin.useredit.delete', $admin->id) }}" method="POST" style="display: inline;">
                @csrf
                <input type="hidden" name="user_type" value="admin">
                <button type="submit" class="button-14 w-button" onclick="return confirm('本当に削除しますか？')">削除</button>
            </form>
        </div>
    @endforeach
</div>
# Laravel Vue Todoリスト アプリケーション

## 環境構築手順

1. **ディレクトリの作成**

    ```bash
    mkdir laravel-vue-todolist
    cd laravel-vue-todolist
    ```

2. **ソースコードのクローン**

    ```bash
    git clone https://github.com/ywakikawa/laravel-vue-todolist.git
    ```

3. **PhpStormでプロジェクトを開く**

4. **ブランチの確認と切り替え**

    ```bash
    git branch
    git checkout develop
    git pull
    ```

    ※ `develop` ブランチ以外を使用する場合は、上記の `develop` を適切なブランチ名に置き換えてください。

5. **新しい機能用のブランチを作成して切り替える**

    ```bash
    git branch feature/(名前)
    git checkout feature/(名前)
    ```

6. **コンテナの起動**

    ```bash
    docker compose up -d --build  # 初回のみ --build をつける
    ```

7. **コンテナに入る**

    ```bash
    docker compose exec app bash
    ```

8. composerのインストール
    ```bash
    composer install
    ```
9. **環境ファイルの作成**

    ```bash
    cp .env.example .env
    ```

10. **フロントエンドの起動**

    ```bash
    npm install
    npm run dev
    ```

11. **アプリケーションキーの作成**.
    ```bash
    php artisan key:generate
    ```
12. **バックエンドの起動**

    ```bash
    php artisan serve --host=0.0.0.0 --port=8000
    ```

13. **アクセス先**

    ブラウザで以下のURLにアクセスする

    ```bash
    http://0.0.0.0:8000/
    ```




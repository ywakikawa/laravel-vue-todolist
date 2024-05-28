開発手順(詳細は省く)



1. **バックエンド側の開発**

    - **モデルの作成**

        ```bash
        php artisan make:model Todo
        ```

    - **コントローラーの作成**

        ```bash
        php artisan make:controller TodoController --resource
        ```

    - **マイグレーションファイルの作成**

        ```bash
        php artisan make:migration create_todos_table
        ```

    - **migrationの内容**

        ```php
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });
        ```

    - **マイグレーションの実行**

        ```bash
        php artisan migrate
        ```

    - **データベースの確認**

        1. PhpStormの左側のデータベースのアイコンをクリックします。
        2. ➕ボタンをクリックします。
        3. MySQLを選択します。
        4. ホスト名を `localhost`、ユーザー名を `root`、パスワードを `secret` に入力して、接続テストを実行し、適用します。

    - **api.phpの編集**

        ```php
        Route::apiResource('/todo', TodoController::class);
        ```

    - **TodoControllerの作成**

    - **リクエストクラスの作成**

        ```bash
        php artisan make:request TodoRequest
        ```

    - **Modelのfillableを編集**

2. **フロントエンド側の開発**

    - **TodoList.vueの作成**

        手動で作成してください。お手本の画面を見ながら、templateだけ実装します。

    - **todo作成機能の実装**
      fetchTodos methodを実装

    - **todo一覧機能の実装**
      addTodoを実装

    - **todo削除機能の実装**
      deleteTodoを実装

    - **todo更新機能の実装**
      updateTodoを実装

    - **UpdateModal.vueの作成**
      

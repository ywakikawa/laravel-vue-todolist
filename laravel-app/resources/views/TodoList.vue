<template>
    <div>
        <h1>Todo List</h1>
        <input v-model="title" placeholder="追加">
        <button @click="addTodo">追加</button>
        <ul>
            <li v-for="todo in todos" :key="todo.id"> <!-- todos(db)からとってきたデータをtodoと定義し、v-fotで回す -->
                {{ todo.title }}
                <button @click="editTodo(todo)">編集</button>
                <button @click="deleteTodo(todo.id)">削除</button>
            </li>
        </ul>
    </div>
</template>

<script>
import axios from 'axios';
export default { //export defaultないと動かない
    data() { //dataで内容を保存しtemplateでその変数を使えるようにするため。箱を作っておくようなもの
        return {
            todos: [],
            title: '',
            showModel: false,
            currentTodo: null,
        };
    },

    created() { //
        this.fetchTodos(); //画面が読み込まれた時にfetchTodosが一番最初に動く
    },
    methods: { //methodsの中は呼び出されるまで動かない
        async fetchTodos() { //＝Todosを取得する
            try {　//try,catch（例外処理）tryで処理に挑戦し、ダメだったらcatchの処理を実行。
                const response = await axios.get('/api/todo');//axiosでデータをとってくる。awaitを書いたとこでデータをとってきている間他の処理をしておこう
                this.todos = response.data; //getでとってきたtodosテーブル(db)をresponseに入れた。ここでのthisはdataやmethodの中にあるdataのことを表している
                console.log(response)
            } catch (error) {
                console.error('取得エラー:',error);//コンソールは検証ツールのコンソールのこと
            }
        },
        async addTodo() { //async（非同期処理）本来上から処理が実行されるが、その前の処理が行われている途中で処理を実行する。async＝非同期処理あるよ。await＝時間かかるから一旦ここで待って。
            if (this.title.trim() === '') return;
            try {
                const response = await axios.post('/api/todo', {title: this.title});//箱に入った内容（ここではtitle）を送信。axios vueからapiを叩く時に必要な定型分のようなもの
                console.log(response)
                this.todos.push(response.data); //Controller storeのreturnから帰ってきたデータをここで受け取ってる
                this.title = '';//にゅう
            } catch (error) {
                console.error('追加エラー:', error);
            }
        },

    }



    }
</script>

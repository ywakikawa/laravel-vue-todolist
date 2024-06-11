<template>
    <div>
        <h1>Todo List</h1>
        <input v-model="title" placeholder="追加">
        <button @click="addTodo">追加</button>
        <ul>
            <li v-for="todo in todos" :key="todo.id"> <!-- todos(db)からとってきたデータをtodoと定義し、v-fotで回す -->
                {{ todo.title }}
                <button @click="editTodo(todo)">編集</button>
                　<!-- 編集ボタンをクリックでModalを表示 -->
                <button @click="deleteTodo(todo.id)">削除</button>
            </li>
        </ul>
        <!--      ↓ scriptのimportとcomponentsでUpdateModelを指定しなきゃ使えない      -->
        <UpdateModal
            v-if="showModal"
            :todo="currentTodo"
            @close="showModal = false"
            @update="updateTodo"
            @completed="completedTodo"
        />
    </div>
</template>

<script>
import axios from 'axios';
import UpdateModal from './UpdateModal.vue';

export default { //export defaultないと動かない
    components: {UpdateModal},
    data() { //dataで内容を保存しtemplateでその変数を使えるようにするため。箱を作っておくようなもの
        return {
            todos: [],
            title: '',
            showModal: false, //showModalはオフの状態が初期状態。editTodoでshowModel: true,にすることで展開
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
                console.log("this todos", this.todos)
            } catch (error) {
                console.error('取得エラー:', error);//コンソールは検証ツールのコンソールのこと
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
        async deleteTodo(id) {　//削除をclickされた項目のidを受け取り、そのidの項目の処理が下で行われている。
            try {
                console.log(id)
                console.log(this.todos)
                await axios.delete(`/api/todo/${id}`); //コントローラのdestroyが呼び出され、裏側のデータが消える
                this.todos = this.todos.filter(todo => todo.id !== id);//表のtodoリストからも削除。
            } catch (error) {
                console.error('削除エラー:', error);

            }
        },
        editTodo(todo) {　//clickされた編集したい項目の情報を持ってきてる
            this.currentTodo = {...todo}; //今編集しようとしている項目を変数this.currentTodoに入れている。
            this.showModal = true; //modalは初期状態でオフになっているから、clickされた時trueでモーダル展開。
        },
        async updateTodo(updatedTodo) { //更新がclickされた時に開始
            try {
                const response = await axios.put(`/api/todo/${updatedTodo.id}`, updatedTodo); //idをControllerに渡して、返ってきたデータをresponseで返ってきている。updatedTodo.idは現在テーブルにある項目にふられている番号
                const index = this.todos.findIndex(todo => todo.id === updatedTodo.id); //this.todos.Index今あるtodoの一覧から、更新したidを検索。探してきたidをindexに入れる
                this.todos.splice(index, 1, response.data); //indexに入ったデータをtodos.spliceで入れ替え、配列の順番変えたり削除したり。response.dataはコントローラで更新されたデータが返ってきている。
                this.showModal = false;
            } catch (error) {
                console.error('更新エラー:', error);
            }
        },
        async completedTodo(completedTodo) {
            try{
                const response = await axios.put(`/api/todo/${completedTodo.id}/completed`);
                const index = this.todos.findIndex(todo => todo.id === completedTodo.id);
                this.todos.splice(index, 1, response.data);
            } catch (error) {
                console.error('完了エラー:', error);
            }
        }
    }


}
</script>

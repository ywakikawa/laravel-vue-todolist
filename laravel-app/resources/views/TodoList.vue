<template>
    <div>
        <h1>Todo List</h1>
        <input v-model="title" placeholder="追加" @keyup.enter="addTodo">
        <button @click="addTodo">追加</button>
        <div>
            <input type="checkbox" v-model="showCompleted">完了したTODOも表示する
        </div>
        <ul>
            <li v-for="todo in filteredTodos" :key="todo.id">
                {{ todo.title }}
                <button @click="editTodo(todo)">編集</button>
                <button @click="deleteTodo(todo.id)">削除</button>
            </li>
        </ul>
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

export default {
    components: { UpdateModal },
    data() {
        return {
            todos: [],
            title: '',
            showModal: false,
            currentTodo: null,
            //チェックボックスの状態
            showCompleted: false
        };
    },
    created() {
        this.fetchTodos();
    },
    watch: {
        //チェックボックスの値の変化を監視する
        showCompleted() {
            this.fetchTodos();
        }
    },
    computed: {
        filteredTodos() {
            //チェックボックスの値によって表示するTODOを変更する
            if (this.showCompleted) {
                //完了したTODOを含めて全てを返す
                return this.todos;
            } else {
                //完了していないTODOのみ返す
                return this.todos.filter(todo => !todo.completed);
            }
        }
    },
    methods: {
        async fetchTodos() {
            try {
                const response = await axios.get('/api/todo');
                this.todos = response.data;
                console.log('')
            } catch (error) {
                console.error('取得エラー:', error);
            }
        },
        async addTodo() {
            //前後の空白を取り除く
            if (this.title.trim() === '') return;
            try {
                const response = await axios.post('/api/todo', { title: this.title });
                this.todos.push(response.data);
                this.title = '';
            } catch (error) {
                console.error('追加エラー:', error);
            }
        },
        async deleteTodo(id) {
            try {
                await axios.delete(`/api/todo/${id}`);
                this.todos = this.todos.filter(todo => todo.id !== id);
            } catch (error) {
                console.error('削除エラー:', error);
            }
        },
        editTodo(todo) {
            this.currentTodo = { ...todo };
            this.showModal = true;
        },
        async updateTodo(updatedTodo) {
            try {
                const response = await axios.put(`/api/todo/${updatedTodo.id}`, updatedTodo);
                const index = this.todos.findIndex(todo => todo.id === updatedTodo.id);
                this.todos.splice(index, 1, response.data);
                this.showModal = false;
            } catch (error) {
                console.error('更新エラー:', error);
            }
        },
        async completedTodo(completedTodo) {
            try {
                const response = await axios.put(`/api/todo/${completedTodo.id}/completed`);
                const index = this.todos.findIndex(todo => todo.id === completedTodo.id);
                this.todos.splice(index, 1, response.data);
            } catch (error) {
                console.error('完了エラー:', error);
            }
        }
    }
};
</script>

<style scoped>

</style>



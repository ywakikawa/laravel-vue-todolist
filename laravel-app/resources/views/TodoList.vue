<template>
    <div>
        <h1>Todo List</h1>
        <input v-model="title" placeholder="追加" @keyup.enter="addTodo">
        <button @click="addTodo">追加</button>
        <ul>
            <li v-for="todo in todos" :key="todo.id">
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
        };
    },
    created() {
        this.fetchTodos();
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
        }
    }
};
</script>

<style scoped>

</style>



<template>
    <div>
        <template v-if="!loggedIn">
            <h1>Login.vue</h1>
            名前：<input type="text"><br>
            パスワード：<input type="password"><br>
            <button @click="login">ログイン</button>
        </template>
        <template v-if="loggedIn">
            <TodoList></TodoList>
        </template>
    </div>
</template>

<script>
import TodoList from "./TodoList.vue";
export default {
    name: 'Login',
    components: {
        TodoList
    },
    data() {
        return {
            loggedIn: false
        }
    },
    methods: {
        login() {
            this.loggedIn = true
        }
    },
}
</script>

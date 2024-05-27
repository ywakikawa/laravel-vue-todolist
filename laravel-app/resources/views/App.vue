<template>
    <p>App.vue</p>
    <login></login>
</template>

<script>
import TodoList from "./TodoList.vue";
import Login from "./Login.vue";
export default {
    name: 'App',
    components: {Login, TodoList}
}
</script>

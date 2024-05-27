<template>
    <h1>TodoList.vue</h1>
    <div id="input">
        <label>TODO: <input id="todo"></label><br>
        優先度:
        <select>
            <option>低</option>
            <option selected>普</option>
            <option>高</option>
        </select>
        <label>期日: <input type="date"></label><br>
        <button id="submit">登録</button>
    </div>
    <register></register>
</template>

<script>
import Register from "./Register.vue";

export default {
    name: 'TodoList',
    components: {Register}
}
</script>

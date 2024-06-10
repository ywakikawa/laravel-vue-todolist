<template>
    <div class="modal">
        <div class="modal-content">
            <span class="close" @click="$emit('close')" >&times;</span>
            <h2>Todoを更新</h2>
            <input v-model="localTodo.title" placeholder="Update todo">
            <button @click="update">更新</button>
        </div>
    </div>
</template>

<script>
export default {
    props: ['todo'], //propsでTodoList.vueから受け取っている
    data() { //propsで受け取った値をdataにいれて、templateで使えるようにdataって箱の中に入れている
        return {
            localTodo:{ ...this.todo },
        };
    },
    methods: {
        update() { //更新処理
            this.$emit('update', this.localTodo); //$emitで親要素の関数を呼び出す。親のTodoListに入っているupdateを呼び出してる
        }
    }
}
</script>

<style>
div.modal {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background-color: rgba(200,200,200,.5);
    text-align: center;
}

div.modal-content {
    display: inline-block;
    margin-top: 20%;
    padding: 20px;
    border-radius: 8%;
    background-color: white;
}

span.close {
    position: relative;
    left: 90px;
}


</style>


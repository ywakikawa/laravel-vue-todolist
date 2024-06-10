<template>
    <div class="modal">
        <div class="modal-content">
            <span class="close" @click="$emit('close')">&times;</span>
            <h2>Todoを更新</h2>
            <input v-model="localTodo.title" placeholder="Update todo">
            <button @click="update">更新</button>
            <button @click="completed">完了</button>
        </div>
    </div>
</template>

<script>
export default {
    props: ['todo'],
    data() {
        return {
            localTodo: { ...this.todo },
        };
    },
    methods: {
        update() {
            this.$emit('update', this.localTodo);
        },
        completed() {
            this.$emit('completed', this.localTodo);
        },
    }
};
</script>

<style scoped>
.modal {
    display: flex;
    justify-content: center;
    align-items: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
}

.modal-content {
    background: white;
    padding: 20px;
    border-radius: 8px;
    width: 300px;
    text-align: center;
}

.close {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
}
</style>

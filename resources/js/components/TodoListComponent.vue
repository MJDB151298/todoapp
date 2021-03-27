<template>
    <div class="row mx-1 px-5 pb-3 w-80">
        <div class="col mx-auto">
            <todo-item-component
                v-for="(todo, index) in todos"
                :key="todo.id"
                :todo="todo"
                @update="updateTodo(index, ...arguments)"
                @delete="deleteTodo(index)"
            >
            </todo-item-component>
        </div>
    </div>
</template>

<script>
    import TodoItemComponent from "./TodoItemComponent";
    export default {
        name: "TodoListComponent",
        components: {TodoItemComponent},
        props: ['todos'],
        methods: {
            updateTodo(index, task) {
                console.log(index, task);
                this.$emit('update', index, task)
            },
            deleteTodo(index) {
                this.$emit('delete', index);
            }
        }
    }
</script>

<style scoped>

</style>

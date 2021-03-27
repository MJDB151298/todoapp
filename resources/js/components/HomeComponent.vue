<template>
    <div class="container m-5 p-2 rounded mx-auto bg-light shadow">
        <!-- App title section -->
        <apptitle-component></apptitle-component>
        <!-- Create todo section -->
        <createitem-component @new="createTodo"></createitem-component>
        <div class="p-2 mx-4 border-black-25 border-bottom"></div>
        <!-- View options section -->
        <options-component @search="filterTodo" @fetch="fetchTodo" @sort="sortTodo"></options-component>
        <!-- Todo list section -->
        <todolist-component :todos="todos" @update="updateTodo" @delete="deleteTodo"></todolist-component>
    </div>
</template>

<script>
    export default {
        name: "HomeComponent",
        data() {
            return {
                todos: [],
                sorting: 'desc'
            }
        },

        mounted() {
            this.fetchTodo();
        },

        methods: {
            createTodo(task){
                if(this.sorting === 'desc')
                    this.todos.unshift(task)
                else
                    this.todos.push(task)
            },

            updateTodo(index, task){
                this.todos[index] = task;
            },

            deleteTodo(index){
                this.todos.splice(index, 1);
            },

            filterTodo(tasks){
                this.todos.splice(0,this.todos.length);
                this.todos = tasks;
                this.sortTodo();
            },

            sortTodo(sorting){
                if(sorting === 'asc'){
                    this.todos.reverse();
                }
                else if(sorting === 'desc') {
                    this.todos.sort();
                    this.todos.reverse();
                }
                this.sorting = sorting;
            },

            fetchTodo(){
                axios.get('/tasks').then((response) => {
                    this.todos = response.data;
                    console.log(this.todos);
                    this.sortTodo(this.sorting);
                });
            }
        }
    }
</script>

<style scoped>

</style>

<template>
    <div class="row px-3 align-items-center todo-item rounded">
        <div class="col-auto m-1 p-0 d-flex align-items-center">
            <Checkbox class="pb-1" v-model="form.status" :checked="todo.status" @change="checkTask">
                <p class="pt-4">Completed</p>
            </Checkbox>
        </div>
        <div class="col px-1 pb-2 m-1 d-flex align-items-center">
            <input type="text" v-if="!editable" class="form-control form-control-lg border-0 edit-todo-input bg-transparent rounded px-3" readonly v-model="form.name" :title="todo.name" />
            <input type="text" v-if="editable" class="form-control form-control-lg border-0 edit-todo-input rounded px-3"
                   v-model="form.name"
            />
        </div>
        <div class="col-auto m-1 p-0 px-3">
            <p class="m-0 pr-lg-5 pt-0"><strong>{{category}}</strong></p>
        </div>
        <div class="col-auto m-1 p-0">
            <div class="row d-flex align-items-center justify-content-end">
                <!--Two buttons, one to edit, another one to save the edition-->
                <button
                    class="btn btn-secondary m-0 p-0 px-2"
                    v-if="!editable"
                    v-on:click="editable = !editable">
                    Edit
                </button>
                <button
                    class="btn btn-secondary m-0 p-0 px-2"
                    v-if="editable"
                    v-on:click="updateTodo">
                    Save
                </button>

                <a data-toggle="modal"><button class="btn btn-danger m-1 p-0 px-2" v-on:click="deleteTodo">Delete</button></a>
            </div>
        </div>
    </div>
</template>

<script>
    import Checkbox from 'vue-material-checkbox';
    export default {
        name: "TodoItemComponent",
        props: ['todo'],
        components: {Checkbox},

        data() {
            return {
                editable: false,
                form: {
                    name: this.todo.name,
                    status: this.todo.status
                },
                category: 'Loading...'
            }
        },

        mounted() {
            axios.get('/categories/'+this.todo.category_id).then((response) => {
                this.category = response.data.name;
            });
        },

        methods: {
            updateTodo() {
                this.editable = !this.editable;
                console.log(this.todo.id);
                const params = {name: this.form.name, status: this.form.status};
                axios.put('/tasks/'+this.todo.id, params).then((response) =>{
                    this.$emit('update', response.data);
                    this.form.name = response.data.name;
                })

            },

            deleteTodo(){
                axios.delete('/tasks/'+this.todo.id).then(() => {
                    this.$emit('delete');
                })
            },

            checkTask() {
                const params = {name: this.form.name, status: this.form.status};
                axios.put('/tasks/'+this.todo.id, params).then((response) =>{
                    this.$emit('update', response.data);
                })
            }
        }
    }
</script>

<style scoped>

</style>

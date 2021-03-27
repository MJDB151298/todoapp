<template>
    <form action="" v-on:submit.prevent="newTodo">
        <div class="row m-1 p-3">
            <div class="col col-11 mx-auto">
                <div class="row bg-white rounded shadow-sm p-2 add-todo-wrapper align-items-center justify-content-center">
                    <div class="col">
                        <input
                            required
                            class="form-control form-control-lg border-0 add-todo-input bg-transparent rounded"
                            type="text"
                            placeholder="Add new .."
                            v-model="form.name"
                        >
                    </div>
                    <div class="col-auto mr-1 px-2 d-flex align-items-center">
                        <label class="text-secondary my-2 pr-2 view-opt-label">Category: </label>
                        <select class="custom-select custom-select-sm btn my-2" v-model="form.category">
                            <option v-for="category in categories" :value="category.name" :id="category.id">{{category.name}}</option>
                        </select>
                    </div>
                    <div class="col-auto px-0 mx-0 mr-2">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
        </div>
    </div>
    </form>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    export default {
        name: "CreateItemComponent",
        components: {
            Datepicker
        },
        data() {
            return {
                form: {
                    name: '',
                    category: 'Personal'
                },
                categories: []
            }
        },

        mounted() {
          axios.get('/categories').then((response) => {
              this.categories = response.data;
          });
        },

        methods: {
            newTodo() {
                axios.get('/categories/name/'+this.form.category).then((response) => {
                    console.log(response.data[0]);
                    axios.post('/tasks', {name: this.form.name, category_id: response.data[0].id}).then((secondResponse) =>{
                        this.$emit('new', secondResponse.data);
                        this.form.name = '';
                    })
                });



            }
        }
    }
</script>

<style scoped>

</style>

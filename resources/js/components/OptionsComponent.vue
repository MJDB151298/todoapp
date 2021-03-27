<template>
    <div class="row m-1 p-3 px-5 justify-content-end">
        <div class="col-auto d-flex align-items-center">
            <label class="text-secondary my-2 pr-2 view-opt-label">Filter by category</label>
            <select class="custom-select custom-select-sm btn my-2" v-model="filters.category" @change="onChange">
                <option value="All" selected>All</option>
                <option value=Personal>Personal</option>
                <option value="Work">Work</option>
                <option value="Education">Education</option>
            </select>
        </div>
        <!--
        <div class="col-auto d-flex align-items-center">
            <label class="text-secondary my-2 pr-2 view-opt-label">Filter by status</label>
            <select class="custom-select custom-select-sm btn my-2" v-model="filters.status" @change="onChange">
                <option value="all" selected>All</option>
                <option value="completed">Completed</option>
                <option value="active">Active</option>
            </select>
        </div>
        -->
        <div class="col-auto d-flex align-items-center px-1 pr-3">
            <label class="text-secondary my-2 pr-2 view-opt-label">Sort</label>
            <select class="custom-select custom-select-sm btn my-2" v-model="filters.sort" @change="onChangeSort">
                <option value="added-date-desc" selected>Added date - desc</option>
                <option value="due-date-asc">Added date - asc</option>


            </select>
            <i class="fa fa fa-sort-amount-asc text-info btn mx-0 px-0 pl-1" data-toggle="tooltip" data-placement="bottom" title="Ascending"></i>
            <i class="fa fa fa-sort-amount-desc text-info btn mx-0 px-0 pl-1 d-none" data-toggle="tooltip" data-placement="bottom" title="Descending"></i>
        </div>
    </div>
</template>

<script>
    export default {
        name: "OptionsComponent",
        data() {
            return {
                filters: {
                    category: "All",
                    status: "all",
                    sort: 'added-date-desc'
                }
            }
        },

        methods: {
            onChange(event){
                if(this.filters.category === "All"){
                        this.$emit('fetch');
                }
                else{
                    axios.get('/categories/name/'+this.filters.category).then((response) => {
                        let request = '/tasks/filter/'+response.data[0].id;
                        axios.get(request).then((response) => {
                            this.$emit('search', response.data);
                        })
                    })
                }
            },
            onChangeSort(){
                let sorting = this.filters.sort === 'added-date-desc' ? 'desc' : 'asc';
                this.$emit("sort", sorting);
            }
        }
    }
</script>

<style scoped>

</style>

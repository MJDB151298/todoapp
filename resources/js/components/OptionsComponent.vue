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
            <select class="custom-select custom-select-sm btn my-2" v-model="filters.sort" @change="onChange">
                <option value="added-date-asc" selected>Added date - desc</option>
                <option value="due-date-desc">Added date - asc</option>
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
                    sort: 'added-date-asc'
                }
            }
        },

        methods: {
            onChange(event){
                let sorting = this.filters.sort === 'added-date-asc' ? 'asc' : 'desc';
                if(this.filters.category === "All"){
                    axios.get('/tasks/indexSorted/'+sorting).then((response) => {
                        console.log("hola");
                        console.log(response.data);
                        this.$emit('search', response.data);
                    });
                }
                else{
                    //let status = this.filters.status === "completed" ? 1 : 0;
                    //if(this.filters.status === "all")
                      //  status = "all";



                    axios.get('/categories/name/'+this.filters.category).then((response) => {
                        let request = '/tasks/filter/'+0+"/"+sorting;
                        if(response.data.length > 0)
                            request = '/tasks/filter/'+response.data[0].id+"/"+sorting;
                        axios.get(request).then((response) => {
                            this.$emit('search', response.data);
                        })
                    })
                }
            }
        }
    }
</script>

<style scoped>

</style>

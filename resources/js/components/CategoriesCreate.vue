<template>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" v-model="name" name="name" class="form-control" id="name" placeholder="Category Name" autocomplete="off">
                        <input type="button" class="btn btn-primary mt-3" value="Add Category" @click="createCategory()">
                    </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'CategoriesCreate',
    data: function (){
        return {
            name: ''
        }
    },
    methods: {
        createCategory: function (){
            console.log('Creating Category...');
            axios.post('/api/categories', {
                name: this.name
                }).then( function(response) {
                    console.log('New Category ID', response.data.data.id);
                }).catch(function(err) {
                    console.log('Category Route error Promise has been rejected!', err);
            });
        }
    }
}
</script>

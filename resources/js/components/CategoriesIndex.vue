<template>
    <div class="container py-5">
        <div class="row">
            <div class="col-12">

                <div v-if="loading" class="text-center">Loading....</div>
                <div v-if="Array.isArray(categories) && categories.length > 0" class="table-responsive">
                 <a href="/categories/create" class="btn btn-primary my-4">Add new Category</a>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr v-for="(category, index) in categories" :key="category.id">
                        <th scope="row">{{ index + 1 }}</th>
                        <td>{{ _.capitalize(category.name) }}</td>
                        <!-- Photo -->
                        <td v-if="category.hasOwnProperty('photo') && category.photo">
                            <img :src="category.photo" style="width: 80px;height: 80px" alt="Photo"/>
                        </td>
                        <td v-else><em>Null</em></td>
                        <!-- End - Photo -->
                        <td>
                          <a :href="`/categories/${category.id}/edit`" class="btn btn-primary mr-2">Edit</a>
                           <a :href="`/categories/${category.id}`" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: 'CategoriesIndex',
    data: function () {
        return {
            categories: [],
            loading: true
        }
    },
    mounted() {
        this.loadCategories();
    },
    methods: {
        loadCategories: function () {
            // Note: Please only destructure those properties which are read only
            // e.g. Props are read only and state should not be destructure.
            const self = this;
            axios.get('/api/categories').then(function (response) {
                setTimeout(function () {
                    self.categories = response.data.data;
                    self.loading = false;
                }, 2000);
            }).catch(function (err) {
                self.loading = false;
                console.log('Error from the GET Request', err);
            });
        }
    }

}
</script>

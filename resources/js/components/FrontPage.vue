<!-- In Vue.js Every component has 2 parts HTML Part & JavaScript Part. -->

<!-- Template Part -->
<template>
    <div class="container" :class="{'loading': loading}">

        <!-- Spinner will only appear if the private property inside the function object `loading` is true. -->
        <div class="loading-wrapper" v-if="loading">
            <div class="spinner-border text-secondary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <!-- If there is an Error please show -->
        <div class="loading-wrapper" v-if="error">
            <div class="text-center text-secondary">
                <p>Sorry, No records found! Maybe database connection error.</p>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-3">
                <h1 class="my-4">Shop Catalog</h1>
                <div class="list-group" v-if="Array.isArray(categories) && categories.length > 0">
                    <a :href="`/?category=${category.id}`" class="list-group-item" v-for="category in categories">
                        {{ category.name }}
                    </a>
                </div>
            </div>
            <!-- /.col-lg-3 -->

            <div class="col-lg-9">

                <div class="row my-5" v-if="Array.isArray(products.data) && products.data.length > 0">
                    <div class="col-lg-4 col-md-6 mb-4" v-for="product in products.data">
                        <div class="card h-100">
                            <a :href="`/product/${product.name}`">
                                <img class="card-img-top" src="http://placehold.it/700x400" alt="">
                            </a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a :href="`/product/${product.name}`">
                                        {{ _.capitalize (product.name) }}
                                    </a>
                                </h4>
                                <h5>${{ product.price }}</h5>
                                <p class="card-text">
                                    {{ product.description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.col-lg-9 -->

        </div>
        <!-- /.row -->

        <!--  Vue pagination component we are binding data private property :data="products"
     and method named "loadProducts" -->
        <div class="d-flex align-items-center justify-content-center">
            <pagination :data="products" @pagination-change-page="loadProducts"></pagination>
        </div>

    </div>

</template>


<!-- JavaScript Part -->
<script>
export default {
    name: 'FrontPage',
    // Public properties
    data: function(){
      return {
          categories: [],
          products: {}, // Products has object literal because we are depend upon third party Vue.js component
          loading: true,
          error: false
      }
    },
    // Private method runs before the component is mount on the screen
    mounted() {
        //console.log('Component is mounted!');
        this.loadCategories();
        this.loadProducts();
    },
    // Methods
    methods: {
        loadCategories: function (){
            // load API
            // assign this.categories
            // catch errors
            axios.get('/api/categories').then(response => {
                this.categories = response.data.data;
            }).catch(err => {
                    console.log('API Promise rejected error categories :', err);
                }
            );
        },
        loadProducts: function (page = 1){
            axios.get(`/api/products?page=${page}`).then(response => {
                console.log(response.data);
                this.products = response.data;
                this.loading = false;
            }).catch(err => {
                this.error = true;
                this.loading = false;
                console.log('API Promise rejected error products:', err);
            });
        }
    }
}
</script>




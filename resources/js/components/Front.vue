<!-- In Vue.js Every component has 2 parts HTML Part & JavaScript Part. -->

<!-- Template Part -->
<template>
    <div class="container">

        <div class="row">

            <div class="col-lg-3">

                <h1 class="my-4">Shop Catalog</h1>
                @if(count($categories) > 0)
                <div class="list-group">
                    @foreach($categories as $category)
                    <a href="/?category={{ $category->id }}" class="list-group-item">{{ $category->name }}</a>
                    @endforeach
                </div>
                @endif

            </div>
            <!-- /.col-lg-3 -->

            <div class="col-lg-9">

                <div class="row my-5">

                    @if(count($categories) > 0)
                    @foreach($products as $product)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <a href="/product/{{ $product->name }}">
                                <img class="card-img-top" src="http://placehold.it/700x400" alt="">
                            </a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="/product/{{ $product->name }}">{{ ucfirst($product->name) }}</a>
                                </h4>
                                <h5>${{ $product->price }}</h5>
                                <p class="card-text">
                                    {{ $product->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif


                </div>
                <!-- /.row -->

            </div>
            <!-- /.col-lg-9 -->

        </div>
        <!-- /.row -->

    </div>
</template>




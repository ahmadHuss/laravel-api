<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name') }}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

</head>

<body style="padding-top: 56px">

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
        </div>
    </div>
</nav>

<!-- Page Content -->
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
<!-- /.container -->

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; {{ config('app.name') }} {{ date('Y') }}</p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>


</body>

</html>


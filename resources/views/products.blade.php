@extends('master')

@section('seo_title')
    @if(!$page->seo_title)
        {{title_case($page->name)}}
    @else
        {{title_case($page->seo_title)}}
    @endif
@endsection
@section('meta_description')
    @if(!$page->meta_description)
        {{$page->excerpt}}
    @else
        {{$page->meta_description}}
    @endif
@endsection
@section('meta_keywords',$page->meta_keywords)

@section('content')
    <div class="area content bg-white fullwidth">
        <div class="content grid-100">
            <div class="csc-default">
                <div class="banner">
                    <div class="slideshow" data-speed="1600" data-interval="8000">
                        <div class="item"><img src="{{Voyager::image($page->image)}}"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid-container grid-parent">
            <nav class="breadcrumbs grid-75 push-25 tablet-grid-75 tablet-push-25 mobile-grid-100">
                <ul>
                    <li><a href="/">{{title_case(__('main.home'))}}</a></li>
                    <li><a href="/products">{{title_case(__('main.products'))}}</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="area content bg-white">
        <div class="grid-container">
            <div class="content-column grid-75 push-25 tablet-grid-75 tablet-push-25 mobile-grid-100 grid-parent">
                @component('component.search_form')@endcomponent
                <h1>All Products</h1>
                <div class="csc-default">
                    <ul class="product_group">
                        @foreach($products as $product)
                            <li>
                                <h2>
                                    <a href="/products/{{$product_categories->where('id',$product->product_category_id)->first()->slug}}/{{$product->slug}}">{{title_case($product->name)}}</a>
                                </h2>
                                <div>
                                    <a href="/products/{{$product_categories->where('id',$product->product_category_id)->first()->slug}}/{{$product->slug}}">
                                        <img src="{{Voyager::image($product->image)}}"
                                             alt="{{title_case($product->name)}}"></a>
                                    <ul>
                                        {!! $product->excerpt !!}
                                    </ul>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    {{$products->links('vendor.pagination.default')}}
                </div>
            </div>

            <div class="sidebar-column grid-25 pull-75 tablet-grid-25 tablet-pull-75 grid-parent">
                <nav class="nav">
                    @component('component.product_sidebar')
                    @endcomponent
                </nav>
                <div class="tagcloud-container content"></div>
            </div>
        </div>
    </div>
@endsection
@extends('master')

@section('seo_title')
    @if(!$product_category->seo_title)
        {{title_case($product_category->name)}}
    @else
        {{title_case($product_category->seo_title)}}
    @endif
@endsection
@section('meta_description')
    @if(!$product_category->meta_description)
        {{$product_category->excerpt}}
    @else
        {{$product_category->meta_description}}
    @endif
@endsection
@section('meta_keywords',$product_category->meta_keywords)

@section('content')
    <div class="area content bg-white fullwidth">
        <div class="grid-container grid-parent">
            <nav class="breadcrumbs grid-75 push-25 tablet-grid-75 tablet-push-25 mobile-grid-100">
                <ul>
                    <li><a href="/">{{__('main.home')}}</a></li>
                    <li><a href="/products">{{__('main.products')}}</a></li>
                    <li><a href="/products/{{$product_category->slug}}">{{title_case($product_category->name)}}</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="area content bg-white">
        <div class="grid-container">
            <div class="content-column grid-75 push-25 tablet-grid-75 tablet-push-25 mobile-grid-100 grid-parent">
                <h1>{{title_case($product_category->name)}}</h1>
                <div class="csc-default csc-space-after-20">
                    <div>
                        {!! $product_category->excerpt !!}
                    </div>
                </div>
                <div class="csc-default">
                    <ul class="product_group">
                        @foreach($products as $product)
                            <li>
                                <h2><a href="/products/{{$product_category->slug}}/{{$product->slug}}">{{title_case($product->name)}}</a></h2>
                                <div>
                                    <a href="/products/{{$product_category->slug}}/{{$product->slug}}">
                                        <img src="{{Voyager::image($product->image)}}" alt="{{title_case($product->name)}}"></a>
                                    <ul>
                                        {!! $product->excerpt !!}
                                    </ul>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="sidebar-column grid-25 pull-75 tablet-grid-25 tablet-pull-75 grid-parent">
                <nav class="nav">
                    <ul>
                        <li><a href="/products">Products</a>
                        @foreach($product_categories as $product_category)
                            <li @if(str_contains(url()->current(),$product_category->slug)) class="active" @endif><a href="/products/{{$product_category->slug}}">{{title_case($product_category->name)}}</a>
                                @if(str_contains(url()->current(),$product_category->slug))
                                <ul>
                                @foreach($products as $product)
                                    <li><a href="/products/{{$product_category->slug}}/{{$product->slug}}">{{title_case($product->name)}}</a></li>
                                @endforeach
                                </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </nav>
                <div class="tagcloud-container content"></div>
            </div>
        </div>
    </div>
@endsection
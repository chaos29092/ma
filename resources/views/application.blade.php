@extends('master')

@section('seo_title')
    @if(!$gallery->seo_title)
        {{title_case($gallery->name)}}
    @else
        {{title_case($gallery->seo_title)}}
    @endif
@endsection
@section('meta_description')
    @if(!$gallery->meta_description)
        {{$gallery->excerpt}}
    @else
        {{$gallery->meta_description}}
    @endif
@endsection
@section('meta_keywords',$gallery->meta_keywords)

@section('content')
    <div class="area content bg-white fullwidth">
        <div class="grid-container grid-parent">
            <nav class="breadcrumbs grid-75 push-25 tablet-grid-75 tablet-push-25 mobile-grid-100">
                <ul>
                    <li><a href="/">{{__('main.home')}}</a></li>
                    <li><a href="/projects">{{__('main.projects')}}</a></li>
                    <li><a href="/projects/{{$gallery_category->slug}}">{{title_case($gallery_category->name)}}</a></li>
                    <li><a href="/projects/{{$gallery_category->slug}}/{{$gallery->slug}}">{{title_case($gallery->name)}}</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="area content bg-white">
        <div class="grid-container">
            <div class="content-column grid-75 push-25 tablet-grid-75 tablet-push-25 mobile-grid-100 grid-parent">
                <h1>{{title_case($gallery->name)}}</h1>
                <div class="csc-default">
                    {!! $gallery->body !!}
                </div>
            </div>

            <div class="sidebar-column grid-25 pull-75 tablet-grid-25 tablet-pull-75 grid-parent">
                <nav class="nav">
                    <ul>
                        <li><a href="/projects">{{title_case(__('main.projects'))}}</a></li>
                        @foreach($gallery_categories as $gallery_category)
                        <li @if(str_contains(url()->current(),$gallery_category->slug)) class="active" @endif><a href="/projects/{{$gallery_category->slug}}">{{title_case($gallery_category->name)}}</a>
                            @if(str_contains(url()->current(),$gallery_category->slug))
                            <ul>
                                @foreach($galleries as $gallery)
                                <li @if(ends_with(url()->current(),$gallery->slug)) class="active" @endif><a href="/projects/{{$gallery_category->slug}}/{{$gallery->slug}}">{{title_case($gallery->name)}}</a></li>
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
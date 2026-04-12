@extends('front.layouts.app')

@section('meta_title', $page->meta_title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)

@section('content')
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>{{ $page->title }}</h1>
        </div>
    </section>

    <!-- Content -->
    <section class="section" style="padding-top: 2rem;">
        <div class="container" style="max-width: 850px;">
            <div class="form-glass" style="border-radius: 24px;">
                <div style="color: var(--text-muted); font-size: 1.1rem; line-height: 1.9;">
                    {!! $page->content !!}
                </div>
                <div style="margin-top: 3rem; text-align: center;">
                    <a href="{{ url('/services') }}" class="btn btn-primary">
                        Explore Our Services <i class="fa fa-arrow-right" style="margin-left: 0.5rem;"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
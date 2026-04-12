@extends('front.layouts.app')

@section('meta_title', $page->meta_title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)

@section('content')
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>{{ $page->title }}</h1>
            @if($page->content)
                <div class="page-desc">
                    {!! $page->content !!}
                </div>
            @endif
        </div>
    </section>

    <!-- Contact Form -->
    <section class="section" style="padding-top: 2rem;">
        <div class="container" style="max-width: 750px;">
            @if(!empty($status))
                <div class="form-success">
                    {{ $status }}
                </div>
            @endif

            <div class="form-glass">
                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                               class="form-input" placeholder="Your full name" required>
                        @error('name')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                               class="form-input" placeholder="you@example.com" required>
                        @error('email')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" name="subject" id="subject" value="{{ old('subject') }}"
                               class="form-input" placeholder="What's this about?" required>
                        @error('subject')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" rows="5"
                                  class="form-textarea" placeholder="Tell us about your project..." required>{{ old('message') }}</textarea>
                        @error('message')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary" style="width: 100%;">
                            Send Message <i class="fa fa-arrow-right" style="margin-left: 0.5rem;"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Contact Details -->
            <div class="contact-details">
                <div class="contact-detail-item">
                    <strong>Address</strong>
                    <span>{{ $settings['address'] ?? '—' }}</span>
                </div>
                <div class="contact-detail-item">
                    <strong>Email</strong>
                    <a href="mailto:{{ $settings['contact_email'] ?? '' }}">{{ $settings['contact_email'] ?? '—' }}</a>
                </div>
                <div class="contact-detail-item">
                    <strong>Phone</strong>
                    <a href="tel:{{ $settings['contact_phone'] ?? '' }}">{{ $settings['contact_phone'] ?? '—' }}</a>
                </div>
            </div>
        </div>
    </section>
@endsection
@extends('front.layouts.cinematic')

@section('meta_title', optional($page)->meta_title ?? 'Contact Us')
@section('meta_description', optional($page)->meta_description ?? '')
@section('meta_keywords', optional($page)->meta_keywords ?? '')

@section('content')

    {{-- ══ PAGE HERO ══ --}}
    <section class="cin-page-hero">
        <div class="container" style="display:flex;flex-direction:column;align-items:center;">
            <span class="cin-section-label">Get in Touch</span>
            <h1 class="cin-page-hero__title text-gradient">{{ optional($page)->title ?? 'Contact Us' }}</h1>
            <p class="cin-page-hero__desc">
                Have a project in mind? We'd love to hear from you. Drop us a message
                and we'll get back to you within 24 hours.
            </p>
            <div class="cin-breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <span>Contact</span>
            </div>
        </div>
    </section>

    {{-- ══ CONTACT FORM + DETAILS ══ --}}
    <section class="cin-page-section">
        <div class="container">
            <div class="cin-two-col" style="align-items:start;">

                {{-- Left: Form --}}
                <div class="cin-reveal-left">
                    @if(!empty($status))
                        <div class="cin-form-success cin-reveal">
                            <i class="fa fa-check-circle" style="margin-right:0.5rem;"></i> {{ $status }}
                        </div>
                    @endif

                    <div class="cin-glass-panel">
                        <h2 style="font-size:1.4rem;margin-bottom:0.5rem;">Send Us a Message</h2>
                        <p style="color:var(--text-muted);font-size:0.9rem;margin-bottom:2rem;">Fill out the form below and we'll respond promptly.</p>

                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf

                            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                                <div class="cin-form-group">
                                    <label class="cin-form-label" for="name">Name</label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                                        class="cin-form-input" placeholder="Your full name" required>
                                    @error('name') <p class="cin-form-error">{{ $message }}</p> @enderror
                                </div>
                                <div class="cin-form-group">
                                    <label class="cin-form-label" for="email">Email</label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                                        class="cin-form-input" placeholder="you@example.com" required>
                                    @error('email') <p class="cin-form-error">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="cin-form-group">
                                <label class="cin-form-label" for="subject">Subject</label>
                                <input type="text" name="subject" id="subject" value="{{ old('subject') }}"
                                    class="cin-form-input" placeholder="What's this about?" required>
                                @error('subject') <p class="cin-form-error">{{ $message }}</p> @enderror
                            </div>

                            <div class="cin-form-group">
                                <label class="cin-form-label" for="message">Message</label>
                                <textarea name="message" id="message" rows="5"
                                    class="cin-form-textarea" placeholder="Tell us about your project..." required>{{ old('message') }}</textarea>
                                @error('message') <p class="cin-form-error">{{ $message }}</p> @enderror
                            </div>

                            <button type="submit" class="cin-form-btn" style="width:100%;justify-content:center;">
                                Send Message <i class="fa fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Right: Contact Details --}}
                <div class="cin-reveal-right">
                    <div class="cin-glass-panel cin-tilt-card" style="margin-bottom:2rem;">
                        <h3 style="font-size:1.2rem;margin-bottom:1.5rem;">Contact Information</h3>

                        <div style="display:flex;flex-direction:column;gap:2rem;">
                            <div style="display:flex;align-items:flex-start;gap:1rem;">
                                <div class="cin-feature-icon" style="min-width:50px;height:50px;margin-bottom:0;font-size:1rem;">
                                    <i class="fa fa-map-marker-alt" style="background:linear-gradient(135deg,var(--primary),var(--secondary));-webkit-background-clip:text;-webkit-text-fill-color:transparent;"></i>
                                </div>
                                <div>
                                    <strong style="display:block;font-size:0.82rem;text-transform:uppercase;letter-spacing:2px;color:var(--text-muted);margin-bottom:0.3rem;">Address</strong>
                                    <span style="color:#fff;">{{ $settings['address'] ?? '123 Innovation Drive, Tech City' }}</span>
                                </div>
                            </div>
                            <div style="display:flex;align-items:flex-start;gap:1rem;">
                                <div class="cin-feature-icon" style="min-width:50px;height:50px;margin-bottom:0;font-size:1rem;">
                                    <i class="fa fa-envelope" style="background:linear-gradient(135deg,var(--primary),var(--secondary));-webkit-background-clip:text;-webkit-text-fill-color:transparent;"></i>
                                </div>
                                <div>
                                    <strong style="display:block;font-size:0.82rem;text-transform:uppercase;letter-spacing:2px;color:var(--text-muted);margin-bottom:0.3rem;">Email</strong>
                                    <a href="mailto:{{ $settings['contact_email'] ?? '' }}" style="color:#fff;text-decoration:none;">{{ $settings['contact_email'] ?? 'hello@webzy.com' }}</a>
                                </div>
                            </div>
                            <div style="display:flex;align-items:flex-start;gap:1rem;">
                                <div class="cin-feature-icon" style="min-width:50px;height:50px;margin-bottom:0;font-size:1rem;">
                                    <i class="fa fa-phone" style="background:linear-gradient(135deg,var(--primary),var(--secondary));-webkit-background-clip:text;-webkit-text-fill-color:transparent;"></i>
                                </div>
                                <div>
                                    <strong style="display:block;font-size:0.82rem;text-transform:uppercase;letter-spacing:2px;color:var(--text-muted);margin-bottom:0.3rem;">Phone</strong>
                                    <a href="tel:{{ $settings['contact_phone'] ?? '' }}" style="color:#fff;text-decoration:none;">{{ $settings['contact_phone'] ?? '+1 (555) 123-4567' }}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Quick response time --}}
                    <div class="cin-glass-panel cin-tilt-card" style="text-align:center;">
                        <div style="font-size:2.5rem;margin-bottom:1rem;">⚡</div>
                        <h3 style="font-size:1.2rem;margin-bottom:0.5rem;">Quick Response</h3>
                        <p style="color:var(--text-muted);font-size:0.93rem;line-height:1.7;">
                            We typically respond within 2-4 hours during business days.
                            For urgent inquiries, give us a call.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
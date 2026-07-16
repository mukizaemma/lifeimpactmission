@extends('layouts.frontbase')

@section('title', 'Contact')

@section('content')

    @include('frontend.includes.page-hero', ['pageKey' => 'contact'])

    <section class="ilm-contact-info">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success text-center mb-40">{{ session('success') }}</div>
            @endif

            <div class="text-center mb-50">
                <h2 class="ilm-section-title">Reach out anytime</h2>
                <p class="ilm-section-subtitle">Whether you want to partner, volunteer, or pray with us—we would love to hear from you.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <article class="ilm-contact-card">
                        <div class="ilm-contact-card__icon"><i class="flaticon-phone"></i></div>
                        <h3>Call us</h3>
                        <p>
                            <a href="tel:{{ $contact->phone ?? '' }}">{{ $contact->phone ?? '—' }}</a>
                            @if(!empty($contact->phone1))
                                <br><a href="tel:{{ $contact->phone1 }}">{{ $contact->phone1 }}</a>
                            @endif
                        </p>
                    </article>
                </div>
                <div class="col-md-4">
                    <article class="ilm-contact-card">
                        <div class="ilm-contact-card__icon"><i class="flaticon-email"></i></div>
                        <h3>Email us</h3>
                        <p><a href="mailto:{{ $contact->email ?? '' }}">{{ $contact->email ?? '—' }}</a></p>
                    </article>
                </div>
                <div class="col-md-4">
                    <article class="ilm-contact-card">
                        <div class="ilm-contact-card__icon"><i class="flaticon-location"></i></div>
                        <h3>Visit us</h3>
                        <p>{{ $contact->address ?? 'Rwanda' }}</p>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section class="ilm-contact-form-section">
        <div class="container">
            <div class="row g-5 align-items-start">
                <div class="col-lg-5 wow tpfadeLeft" data-wow-duration=".9s" data-wow-delay=".2s">
                    <h2 class="ilm-section-title">Send a message</h2>
                    <p class="ilm-section-subtitle">Tell us how you’d like to walk with young mothers and youth across Rwanda.</p>
                    <div class="ilm-contact-aside">
                        <p>Prefer a faster path? Explore ways to give, volunteer, or partner.</p>
                        <a class="tp-btn ilm-btn-orange ilm-btn-sm" href="{{ route('getInvolved') }}">Get Involved</a>
                    </div>
                    <div class="tp-contact-form__social-box mt-30">
                        @include('frontend.includes.social-links')
                    </div>
                </div>
                <div class="col-lg-7 wow tpfadeRight" data-wow-duration=".9s" data-wow-delay=".35s">
                    <div class="ilm-contact-form-box">
                        <form class="form" action="{{ route('sendMessage') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-30">
                                    <div class="tp-contact-form__input-box">
                                        <input type="text" placeholder="Your Name" name="names" value="{{ old('names') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-30">
                                    <div class="tp-contact-form__input-box">
                                        <input type="email" placeholder="Your Email" name="email" value="{{ old('email') }}" required>
                                    </div>
                                </div>
                                <div class="col-12 mb-30">
                                    <div class="tp-contact-form__input-box">
                                        <textarea name="message" placeholder="Your Message" required>{{ old('message') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="tp-btn ilm-btn-orange">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ilm-mother-cta-band">
        <div class="container text-center">
            <h2 class="ilm-section-title text-white mb-15">Ready to walk with us?</h2>
            <p class="ilm-section-subtitle text-white mb-30" style="opacity:.85">Your support helps young mothers rebuild with skills, health, and hope.</p>
            <div class="ilm-mother-cta-band__actions">
                <a class="tp-btn ilm-btn-orange" href="https://secure.qgiv.com/for/impactlifemission" target="_blank" rel="noopener">Donate Now</a>
                <a class="tp-btn ilm-btn-outline-light" href="{{ route('getInvolved') }}">Get Involved</a>
            </div>
        </div>
    </section>

@endsection

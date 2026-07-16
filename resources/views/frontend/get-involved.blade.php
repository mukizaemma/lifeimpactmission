@extends('layouts.frontbase')

@section('title', 'Get Involved')

@section('content')

    @include('frontend.includes.page-hero', ['pageKey' => 'get_involved'])

    <section class="ilm-get-involved-intro">
        <div class="container">
            <div class="text-center mb-50">
                <h2 class="ilm-section-title">Walk with young mothers and youth</h2>
                <p class="ilm-section-subtitle">Give, serve, partner, or pray—every step helps restore dignity across Rwanda.</p>
            </div>
        </div>
    </section>

    <section class="ilm-get-involved-ways">
        <div class="container">
            <div class="ilm-mothers-support__grid">
                <article class="ilm-mother-tile ilm-mother-tile--peach">
                    <div class="ilm-mother-tile__icon" aria-hidden="true"><i class="flaticon-heart"></i></div>
                    <h3 class="ilm-mother-tile__title">Donate</h3>
                    <p class="ilm-mother-tile__text">Fund vocational training, food packages, health coverage, and hygiene materials.</p>
                    <a class="tp-btn ilm-btn-sm" href="https://secure.qgiv.com/for/impactlifemission" target="_blank" rel="noopener">Give Now</a>
                </article>
                <article class="ilm-mother-tile ilm-mother-tile--clay">
                    <div class="ilm-mother-tile__icon" aria-hidden="true"><i class="flaticon-user"></i></div>
                    <h3 class="ilm-mother-tile__title">Volunteer</h3>
                    <p class="ilm-mother-tile__text">Share skills in mentoring, training support, outreach, and community care.</p>
                    <a class="tp-btn ilm-btn-sm" href="#volunteer">Offer Your Time</a>
                </article>
                <article class="ilm-mother-tile ilm-mother-tile--sage">
                    <div class="ilm-mother-tile__icon" aria-hidden="true"><i class="flaticon-handshake"></i></div>
                    <h3 class="ilm-mother-tile__title">Partner</h3>
                    <p class="ilm-mother-tile__text">Churches, organizations, and friends who want to build long-term pathways of hope.</p>
                    <a class="tp-btn ilm-btn-sm" href="{{ route('contacts') }}">Start a Conversation</a>
                </article>
                <article class="ilm-mother-tile ilm-mother-tile--sand">
                    <div class="ilm-mother-tile__icon" aria-hidden="true"><i class="flaticon-pray"></i></div>
                    <h3 class="ilm-mother-tile__title">Pray & Share</h3>
                    <p class="ilm-mother-tile__text">Cover our mothers and youth in prayer, and share their stories with your network.</p>
                    <a class="tp-btn ilm-btn-sm" href="{{ route('posts') }}">See Stories</a>
                </article>
            </div>
        </div>
    </section>

    <section class="ilm-get-involved-focus">
        <div class="container">
            <div class="text-center mb-50">
                <h2 class="ilm-section-title">Where your support goes</h2>
                <p class="ilm-section-subtitle">Practical care that helps young mothers rebuild homes, health, skills, and hope.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="ilm-involve-focus-item">
                        <h3>Vocational Training</h3>
                        <p>Tailoring, baking, and small business skills for independence.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="ilm-involve-focus-item">
                        <h3>Shelter & Food</h3>
                        <p>Stable shelter and food packages while mothers rebuild.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="ilm-involve-focus-item">
                        <h3>Health Insurance</h3>
                        <p>Protection for mother and child so progress is not erased.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="ilm-involve-focus-item">
                        <h3>Hygiene & Dignity</h3>
                        <p>Essential materials that safeguard health and affirm worth.</p>
                    </div>
                </div>
            </div>
            <div class="text-center mt-45">
                <a class="tp-btn ilm-btn-orange" href="https://secure.qgiv.com/for/impactlifemission" target="_blank" rel="noopener">Donate Securely</a>
            </div>
        </div>
    </section>

    <section class="ilm-get-involved-volunteer" id="volunteer">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5">
                    <h2 class="ilm-section-title">Volunteer with us</h2>
                    <p class="ilm-section-subtitle">Tell us a little about yourself and how you’d like to serve. We’ll follow up soon.</p>
                </div>
                <div class="col-lg-7">
                    <div class="ilm-contact-form-box">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <form action="{{ route('sendMessage') }}" method="POST" id="ilm-volunteer-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-30">
                                    <div class="tp-contact-form__input-box">
                                        <input type="text" name="names" placeholder="Your Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-30">
                                    <div class="tp-contact-form__input-box">
                                        <input type="email" name="email" placeholder="Your Email" required>
                                    </div>
                                </div>
                                <div class="col-12 mb-30">
                                    <div class="tp-contact-form__input-box">
                                        <textarea name="message" id="vol_message" placeholder="How would you like to volunteer?" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="tp-btn ilm-btn-orange">Submit Interest</button>
                                </div>
                            </div>
                        </form>
                        <script>
                            document.getElementById('ilm-volunteer-form')?.addEventListener('submit', function () {
                                var field = document.getElementById('vol_message');
                                if (field && field.value && field.value.indexOf('[Volunteer]') !== 0) {
                                    field.value = '[Volunteer] ' + field.value;
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ilm-mother-cta-band">
        <div class="container text-center">
            <h2 class="ilm-section-title text-white mb-15">One gift can change a mother’s story</h2>
            <p class="ilm-section-subtitle text-white mb-30" style="opacity:.85">Join Impact Life Mission in restoring hope across Rwanda.</p>
            <div class="ilm-mother-cta-band__actions">
                <a class="tp-btn ilm-btn-orange" href="https://secure.qgiv.com/for/impactlifemission" target="_blank" rel="noopener">Donate Now</a>
                <a class="tp-btn ilm-btn-outline-light" href="{{ route('contacts') }}">Contact Us</a>
            </div>
        </div>
    </section>

@endsection

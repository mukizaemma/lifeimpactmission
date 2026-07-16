@php
    $agriImage = !empty($about->image1)
        ? ilm_image_url('images', $about->image1)
        : (!empty($about->image) ? ilm_image_url('images', $about->image) : asset('assets/img/cta/cta-bg-3.jpg'));
@endphp

<section class="ilm-agriculture" id="agriculture">
    <div class="ilm-agriculture__inner">
        <div class="ilm-agriculture__copy wow tpfadeLeft" data-wow-duration=".9s" data-wow-delay=".2s">
            <h2 class="ilm-agriculture__title">Growing Independence through Agriculture</h2>
            <p class="ilm-agriculture__text">
                A long-term farm vision to feed families, teach skills, and help our mission become more self-sustaining—
                so hope keeps growing beyond each donation cycle.
            </p>
            <ul class="ilm-agriculture__points">
                <li>Food security for mothers and children</li>
                <li>Skills that strengthen community livelihoods</li>
                <li>A pathway to lasting organizational independence</li>
            </ul>
            <a class="tp-btn ilm-btn-orange" href="{{ route('contacts') }}" wire:navigate>Partner on This Vision</a>
        </div>
        <div class="ilm-agriculture__media wow tpfadeRight" data-wow-duration=".9s" data-wow-delay=".35s">
            <img src="{{ $agriImage }}" alt="Agriculture independence vision" loading="lazy" decoding="async" width="720" height="560">
            <div class="ilm-agriculture__overlay" aria-hidden="true"></div>
        </div>
    </div>
</section>

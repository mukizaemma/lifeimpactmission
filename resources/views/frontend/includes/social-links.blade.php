@if(!empty($socialLinks))
    <div class="ilm-social-links">
        @foreach ($socialLinks as $social)
            <a
                href="{{ $social['url'] }}"
                class="ilm-social-links__item"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="{{ $social['label'] }}"
                title="{{ $social['label'] }}"
            >
                <i class="{{ $social['icon'] }}" aria-hidden="true"></i>
            </a>
        @endforeach
    </div>
@endif

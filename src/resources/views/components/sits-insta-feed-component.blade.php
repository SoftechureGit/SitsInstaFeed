



<div class="sits-slider-container">
    <div class="sits-slider-wrapper">
        @foreach ($someData ?? [] as $row)
            <div class="sits-slider-item">
                @if ($row['media_type'] === 'VIDEO')
                    <video class="w-100" loop autoplay muted playsinline>
                        <source src="{{ $row['media_url'] }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @elseif ($row['media_type'] === 'IMAGE')
                    <img src="{{ $row['media_url'] }}" alt="insta feed image" class="w-100">
                @endif
            </div>
        @endforeach
    </div>
    <button class="sits-slider-nav sits-slider-prev">❮</button>
    <button class="sits-slider-nav sits-slider-next">❯</button>
</div>
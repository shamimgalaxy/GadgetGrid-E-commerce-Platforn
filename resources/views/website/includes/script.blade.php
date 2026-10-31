<script src="{{ asset('website/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('website/assets/js/tiny-slider.js') }}"></script>
<script src="{{ asset('website/assets/js/glightbox.min.js') }}"></script>
<script src="{{ asset('website/assets/js/main.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        //========= Hero Slider
        if (document.querySelector('.hero-slider')) {
            tns({
                container: '.hero-slider',
                slideBy: 'page',
                autoplay: true,
                autoplayButtonOutput: false,
                mouseDrag: true,
                gutter: 0,
                items: 1,
                nav: false,
                controls: true,
                controlsText: ['<i class="lni lni-chevron-left"></i>', '<i class="lni lni-chevron-right"></i>'],
            });
        }

        //======== Brand Slider
        if (document.querySelector('.brands-logo-carousel')) {
            tns({
                container: '.brands-logo-carousel',
                autoplay: true,
                autoplayButtonOutput: false,
                mouseDrag: true,
                gutter: 15,
                nav: false,
                controls: false,
                responsive: {
                    0: { items: 1 },
                    540: { items: 3 },
                    768: { items: 5 },
                    992: { items: 6 },
                }
            });
        }

        //======== Deal Countdown
        const daysEl = document.querySelector('#days');
        const hoursEl = document.querySelector('#hours');
        const minutesEl = document.querySelector('#minutes');
        const secondsEl = document.querySelector('#seconds');

        if (!daysEl || !hoursEl || !minutesEl || !secondsEl) return;

        // Set $dealEndsAt (Carbon) from your controller; falls back to 7 days from now
        const finaleDate = new Date(@json(($dealEndsAt ?? now()->addDays(7))->toIso8601String())).getTime();
        const pad = (n, len = 2) => String(n).padStart(len, '0');
        let interval;

        const timer = () => {
            const diff = Math.max(finaleDate - Date.now(), 0);

            daysEl.textContent = pad(Math.floor(diff / 86400000), 3);
            hoursEl.textContent = pad(Math.floor((diff % 86400000) / 3600000));
            minutesEl.textContent = pad(Math.floor((diff % 3600000) / 60000));
            secondsEl.textContent = pad(Math.floor((diff % 60000) / 1000));

            if (diff === 0) clearInterval(interval);
        };

        timer();
        interval = setInterval(timer, 1000);
    });
</script>
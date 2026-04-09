import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// Counter animation for stats
document.addEventListener('DOMContentLoaded', () => {
    const counters = document.querySelectorAll('[data-counter]');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const target = el.dataset.counter;
                const numericTarget = parseInt(target.replace(/\D/g, ''));
                const suffix = target.replace(/[0-9]/g, '');
                let current = 0;
                const step = Math.ceil(numericTarget / 60);
                const timer = setInterval(() => {
                    current = Math.min(current + step, numericTarget);
                    el.textContent = current.toLocaleString() + suffix;
                    if (current >= numericTarget) clearInterval(timer);
                }, 30);
                observer.unobserve(el);
            }
        });
    }, { threshold: 0.5 });

    counters.forEach(el => observer.observe(el));
});

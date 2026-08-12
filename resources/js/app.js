import './bootstrap';

const spinner = document.querySelector('#spinner');

if (spinner) {
    window.setTimeout(() => {
        spinner.classList.remove('show');
    }, 1);
}

const startupNavbar = document.querySelector('.startup2-home .navbar');

if (startupNavbar) {
    const toggleStickyNavbar = () => {
        startupNavbar.classList.toggle('sticky-top', window.scrollY > 45);
        startupNavbar.classList.toggle('shadow-sm', window.scrollY > 45);
    };

    toggleStickyNavbar();
    window.addEventListener('scroll', toggleStickyNavbar, { passive: true });
}

const startupNavToggle = document.querySelector('[data-startup-nav-toggle]');
const startupNav = document.querySelector('[data-startup-nav]');

if (startupNavToggle && startupNav) {
    startupNavToggle.addEventListener('click', () => {
        const isOpen = startupNav.classList.toggle('show');
        startupNavToggle.setAttribute('aria-expanded', String(isOpen));
    });
}

const startupCarousel = document.querySelector('#header-carousel');

if (startupCarousel) {
    const items = [...startupCarousel.querySelectorAll('.carousel-item')];

    const showSlide = (direction) => {
        if (items.length < 2) {
            return;
        }

        const currentIndex = Math.max(0, items.findIndex((item) => item.classList.contains('active')));
        const nextIndex = (currentIndex + direction + items.length) % items.length;

        items[currentIndex].classList.remove('active');
        items[nextIndex].classList.add('active');
    };

    startupCarousel.querySelector('[data-startup-carousel="prev"]')?.addEventListener('click', () => showSlide(-1));
    startupCarousel.querySelector('[data-startup-carousel="next"]')?.addEventListener('click', () => showSlide(1));
}

const backToTop = document.querySelector('[data-back-to-top]');

if (backToTop) {
    const toggleBackToTop = () => {
        backToTop.classList.toggle('is-visible', window.scrollY > 100);
    };

    toggleBackToTop();
    window.addEventListener('scroll', toggleBackToTop, { passive: true });

    backToTop.addEventListener('click', (event) => {
        event.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}

const menuToggle = document.querySelector('[data-menu-toggle]');
const primaryNav = document.querySelector('[data-primary-nav]');

if (menuToggle && primaryNav) {
    const closeMenu = () => {
        menuToggle.setAttribute('aria-expanded', 'false');
        menuToggle.setAttribute('aria-label', 'Open navigation');
        primaryNav.classList.remove('is-open');
        document.body.classList.remove('menu-open');
    };

    menuToggle.addEventListener('click', () => {
        const isOpen = menuToggle.getAttribute('aria-expanded') === 'true';

        menuToggle.setAttribute('aria-expanded', String(! isOpen));
        menuToggle.setAttribute('aria-label', isOpen ? 'Open navigation' : 'Close navigation');
        primaryNav.classList.toggle('is-open', ! isOpen);
        document.body.classList.toggle('menu-open', ! isOpen);
    });

    primaryNav.addEventListener('click', (event) => {
        if (event.target instanceof HTMLAnchorElement) {
            closeMenu();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeMenu();
        }
    });
}

import './bootstrap';

const startupNavbar = document.querySelector('.startup2-home .navbar');

if (startupNavbar) {
    let navbarTicking = false;
    const toggleStickyNavbar = () => {
        startupNavbar.classList.toggle('sticky-top', window.scrollY > 45);
        startupNavbar.classList.toggle('shadow-sm', window.scrollY > 45);
    };
    const scheduleStickyNavbar = () => {
        if (navbarTicking) {
            return;
        }

        navbarTicking = true;
        window.requestAnimationFrame(() => {
            toggleStickyNavbar();
            navbarTicking = false;
        });
    };

    toggleStickyNavbar();
    window.addEventListener('scroll', scheduleStickyNavbar, { passive: true });
}

const startupNavToggle = document.querySelector('[data-startup-nav-toggle]');
const startupNav = document.querySelector('[data-startup-nav]');
const startupNavClose = document.querySelector('[data-startup-nav-close]');
const startupNavBackdrop = document.querySelector('[data-startup-nav-backdrop]');

if (startupNavToggle && startupNav) {
    const startupNavMedia = window.matchMedia('(max-width: 991.98px)');
    const syncStartupNavA11y = () => {
        if (startupNavMedia.matches && ! startupNav.classList.contains('show')) {
            startupNav.setAttribute('aria-hidden', 'true');
            return;
        }

        startupNav.removeAttribute('aria-hidden');
    };

    const openStartupNav = () => {
        startupNav.classList.add('show');
        startupNav.removeAttribute('aria-hidden');
        startupNavToggle.setAttribute('aria-expanded', 'true');
        startupNavToggle.setAttribute('aria-label', 'Close navigation');
        startupNavBackdrop?.removeAttribute('hidden');
        window.requestAnimationFrame(() => startupNavBackdrop?.classList.add('is-visible'));
        document.body.classList.add('startup-nav-open');
        startupNavClose?.focus({ preventScroll: true });
    };

    const closeStartupNav = () => {
        startupNav.classList.remove('show');
        syncStartupNavA11y();
        startupNavToggle.setAttribute('aria-expanded', 'false');
        startupNavToggle.setAttribute('aria-label', 'Open navigation');
        startupNavBackdrop?.classList.remove('is-visible');
        document.body.classList.remove('startup-nav-open');
        window.setTimeout(() => {
            if (! startupNav.classList.contains('show')) {
                startupNavBackdrop?.setAttribute('hidden', '');
            }
        }, 280);
    };

    startupNavToggle.addEventListener('click', () => {
        if (startupNav.classList.contains('show')) {
            closeStartupNav();
            return;
        }

        openStartupNav();
    });

    startupNavClose?.addEventListener('click', closeStartupNav);
    startupNavBackdrop?.addEventListener('click', closeStartupNav);

    startupNav.addEventListener('click', (event) => {
        if (event.target instanceof HTMLAnchorElement) {
            closeStartupNav();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && startupNav.classList.contains('show')) {
            closeStartupNav();
            startupNavToggle.focus({ preventScroll: true });
        }
    });

    startupNavMedia.addEventListener('change', syncStartupNavA11y);
    syncStartupNavA11y();
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
    let backToTopTicking = false;
    const toggleBackToTop = () => {
        backToTop.classList.toggle('is-visible', window.scrollY > 100);
    };
    const scheduleBackToTop = () => {
        if (backToTopTicking) {
            return;
        }

        backToTopTicking = true;
        window.requestAnimationFrame(() => {
            toggleBackToTop();
            backToTopTicking = false;
        });
    };

    toggleBackToTop();
    window.addEventListener('scroll', scheduleBackToTop, { passive: true });

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

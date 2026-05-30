const menuButton = document.querySelector('[data-mobile-menu-toggle]');
const mobileMenu = document.getElementById('mobile-menu');
const themeToggle = document.querySelector('[data-theme-toggle]');
const themeLabels = document.querySelectorAll('[data-theme-label]');
const root = document.documentElement;

const getPreferredTheme = () => {
    const savedTheme = localStorage.getItem('tekvista-theme');

    if (savedTheme) {
        return savedTheme;
    }

    return window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark';
};

const applyTheme = (theme) => {
    root.dataset.theme = theme;

    themeLabels.forEach((label) => {
        label.textContent = theme === 'dark' ? 'Light' : 'Dark';
    });
};

applyTheme(getPreferredTheme());

themeToggle?.addEventListener('click', () => {
    const nextTheme = root.dataset.theme === 'dark' ? 'light' : 'dark';
    localStorage.setItem('tekvista-theme', nextTheme);
    applyTheme(nextTheme);
});

if (menuButton && mobileMenu) {
    const mobileMenuScroll = mobileMenu.querySelector('.mobile-menu-scroll');
    const updateMobileMenuScrollHint = () => {
        if (!mobileMenuScroll || mobileMenu.classList.contains('hidden')) {
            return;
        }

        const isScrollable = mobileMenuScroll.scrollHeight > mobileMenuScroll.clientHeight + 6;
        const isAtEnd = mobileMenuScroll.scrollTop + mobileMenuScroll.clientHeight >= mobileMenuScroll.scrollHeight - 8;

        mobileMenu.classList.toggle('is-scrollable', isScrollable);
        mobileMenu.classList.toggle('is-scroll-end', !isScrollable || isAtEnd);
    };

    menuButton.addEventListener('click', () => {
        const isOpen = !mobileMenu.classList.contains('hidden');

        mobileMenu.classList.toggle('hidden', isOpen);
        menuButton.setAttribute('aria-expanded', String(!isOpen));

        if (!isOpen) {
            requestAnimationFrame(updateMobileMenuScrollHint);
        }
    });

    mobileMenuScroll?.addEventListener('scroll', updateMobileMenuScrollHint, { passive: true });
    window.addEventListener('resize', updateMobileMenuScrollHint);

    mobileMenu.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
            menuButton.setAttribute('aria-expanded', 'false');
        });
    });
}

let installPrompt = null;
const installButton = document.getElementById('install-app');

window.addEventListener('beforeinstallprompt', (event) => {
    event.preventDefault();
    installPrompt = event;
    installButton?.classList.remove('hidden');
});

installButton?.addEventListener('click', async () => {
    if (!installPrompt) {
        return;
    }

    installPrompt.prompt();
    await installPrompt.userChoice;
    installPrompt = null;
    installButton.classList.add('hidden');
});

const whatsappButton = document.querySelector('[data-whatsapp-form]');
const contactForm = document.getElementById('contact-form');

if (whatsappButton && contactForm) {
    whatsappButton.addEventListener('click', () => {
        const formData = new FormData(contactForm);
        const name = formData.get('name') || '';
        const email = formData.get('email') || '';
        const company = formData.get('company') || '';
        const phone = formData.get('phone') || '';
        const service = formData.get('service') || '';
        const message = formData.get('message') || '';

        const text = [
            'Hello Tekvista Team, we need enterprise IT consultation. Please reply in English.',
            `Name: ${name}`,
            `Email: ${email}`,
            `Company: ${company}`,
            `Phone: ${phone}`,
            `Service: ${service}`,
            `Message: ${message}`,
        ].join('\n');

        const url = `https://wa.me/919051433313?text=${encodeURIComponent(text)}`;
        window.open(url, '_blank', 'noopener');
    });
}

const canUseServiceWorker = window.location.protocol === 'https:'
    || ['localhost', '127.0.0.1'].includes(window.location.hostname);

if ('serviceWorker' in navigator && canUseServiceWorker) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/service-worker.js');
    });
}

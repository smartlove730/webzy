/**
 * CINEMATIC PAGES — Lightweight GSAP + Lenis animation engine
 * Used by all inner pages (About, Contact, Services, Portfolio, Blog)
 * No Three.js — keeps pages fast while feeling cinematic
 */
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import Lenis from '@studio-freight/lenis';

gsap.registerPlugin(ScrollTrigger);

let lenis;

document.addEventListener('DOMContentLoaded', () => {
    initLenis();
    initCursorGlow();
    initHeaderScroll();
    initMobileNav();
    initPageHeroAnimation();
    initScrollReveals();
    initGlassCardTilt();
    initParallaxElements();
    initCounterAnimations();
    initStaggerGrids();
});

// ═══════════════════════════════════════════
// LENIS SMOOTH SCROLL
// ═══════════════════════════════════════════
function initLenis() {
    lenis = new Lenis({
        duration: 1.6,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        smoothWheel: true,
        touchMultiplier: 1.5,
    });
    lenis.on('scroll', ScrollTrigger.update);
    gsap.ticker.add((time) => lenis.raf(time * 1000));
    gsap.ticker.lagSmoothing(0);
}

// ═══════════════════════════════════════════
// CURSOR GLOW (follows mouse)
// ═══════════════════════════════════════════
function initCursorGlow() {
    const glow = document.getElementById('cursor-glow');
    if (!glow) return;
    let mx = 0, my = 0, cx = 0, cy = 0;
    window.addEventListener('mousemove', (e) => { mx = e.clientX; my = e.clientY; }, { passive: true });
    function tick() {
        cx += (mx - cx) * 0.08;
        cy += (my - cy) * 0.08;
        glow.style.transform = `translate(${cx - 200}px, ${cy - 200}px)`;
        requestAnimationFrame(tick);
    }
    tick();
}

// ═══════════════════════════════════════════
// HEADER SCROLL + MOBILE NAV
// ═══════════════════════════════════════════
function initHeaderScroll() {
    const header = document.querySelector('.header');
    if (!header) return;
    window.addEventListener('scroll', () => {
        header.classList.toggle('scrolled', window.scrollY > 60);
    }, { passive: true });
}

function initMobileNav() {
    const toggle = document.querySelector('.mobile-toggle');
    const nav = document.querySelector('.mobile-nav');
    if (toggle && nav) {
        toggle.addEventListener('click', () => nav.classList.toggle('open'));
    }
}

// ═══════════════════════════════════════════
// PAGE HERO — cinematic title reveal
// ═══════════════════════════════════════════
function initPageHeroAnimation() {
    const hero = document.querySelector('.cin-page-hero');
    if (!hero) return;

    const tl = gsap.timeline({ defaults: { ease: 'power4.out' } });

    const label = hero.querySelector('.cin-section-label');
    const title = hero.querySelector('.cin-page-hero__title');
    const desc = hero.querySelector('.cin-page-hero__desc');
    const breadcrumb = hero.querySelector('.cin-breadcrumb');

    if (label) tl.from(label, { y: 30, opacity: 0, duration: 1 }, 0.2);
    if (title) tl.from(title, { y: 50, opacity: 0, duration: 1.2, filter: 'blur(8px)' }, 0.3);
    if (desc) tl.from(desc, { y: 40, opacity: 0, duration: 1 }, 0.6);
    if (breadcrumb) tl.from(breadcrumb, { y: 20, opacity: 0, duration: 0.8 }, 0.8);
}

// ═══════════════════════════════════════════
// SCROLL REVEALS — .cin-reveal elements
// ═══════════════════════════════════════════
function initScrollReveals() {
    gsap.utils.toArray('.cin-reveal').forEach((el) => {
        gsap.from(el, {
            y: 60, opacity: 0, duration: 1.2,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: el,
                start: 'top 88%',
                toggleActions: 'play none none reverse',
            },
        });
    });

    // Left reveals
    gsap.utils.toArray('.cin-reveal-left').forEach((el) => {
        gsap.from(el, {
            x: -80, opacity: 0, duration: 1.2,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: el,
                start: 'top 85%',
                toggleActions: 'play none none reverse',
            },
        });
    });

    // Right reveals
    gsap.utils.toArray('.cin-reveal-right').forEach((el) => {
        gsap.from(el, {
            x: 80, opacity: 0, duration: 1.2,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: el,
                start: 'top 85%',
                toggleActions: 'play none none reverse',
            },
        });
    });

    // Scale reveals
    gsap.utils.toArray('.cin-reveal-scale').forEach((el) => {
        gsap.from(el, {
            scale: 0.85, opacity: 0, duration: 1.2,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: el,
                start: 'top 88%',
                toggleActions: 'play none none reverse',
            },
        });
    });
}

// ═══════════════════════════════════════════
// GLASS CARD 3D TILT (mouse-driven)
// ═══════════════════════════════════════════
function initGlassCardTilt() {
    document.querySelectorAll('.cin-tilt-card').forEach((card) => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = (e.clientX - rect.left) / rect.width - 0.5;
            const y = (e.clientY - rect.top) / rect.height - 0.5;
            gsap.to(card, {
                rotateY: x * 12,
                rotateX: -y * 12,
                duration: 0.4,
                ease: 'power2.out',
                transformPerspective: 800,
            });
        });
        card.addEventListener('mouseleave', () => {
            gsap.to(card, { rotateY: 0, rotateX: 0, duration: 0.6, ease: 'power2.out' });
        });
    });
}

// ═══════════════════════════════════════════
// PARALLAX ELEMENTS
// ═══════════════════════════════════════════
function initParallaxElements() {
    gsap.utils.toArray('.cin-parallax').forEach((el) => {
        const speed = parseFloat(el.dataset.speed || '0.3');
        gsap.to(el, {
            yPercent: speed * 100,
            ease: 'none',
            scrollTrigger: {
                trigger: el,
                start: 'top bottom',
                end: 'bottom top',
                scrub: 1.5,
            },
        });
    });
}

// ═══════════════════════════════════════════
// COUNTER ANIMATIONS (e.g. 98%, 150+)
// ═══════════════════════════════════════════
function initCounterAnimations() {
    document.querySelectorAll('.cin-counter').forEach((el) => {
        const target = parseInt(el.dataset.target, 10);
        if (isNaN(target)) return;
        const suffix = el.dataset.suffix || '';

        ScrollTrigger.create({
            trigger: el,
            start: 'top 85%',
            once: true,
            onEnter: () => {
                gsap.to({ val: 0 }, {
                    val: target,
                    duration: 2,
                    ease: 'power2.out',
                    onUpdate: function () {
                        el.textContent = Math.round(this.targets()[0].val) + suffix;
                    },
                });
            },
        });
    });
}

// ═══════════════════════════════════════════
// STAGGER GRIDS — cards animate in sequence
// ═══════════════════════════════════════════
function initStaggerGrids() {
    document.querySelectorAll('.cin-stagger-grid').forEach((grid) => {
        const children = grid.querySelectorAll('.cin-stagger-item');
        if (!children.length) return;

        gsap.from(children, {
            y: 80,
            opacity: 0,
            scale: 0.95,
            duration: 1,
            ease: 'power3.out',
            stagger: 0.12,
            scrollTrigger: {
                trigger: grid,
                start: 'top 85%',
                toggleActions: 'play none none reverse',
            },
        });
    });
}

// Cleanup
window.addEventListener('beforeunload', () => {
    lenis?.destroy();
    ScrollTrigger.getAll().forEach((st) => st.kill());
});

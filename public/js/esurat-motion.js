/**
 * E-Surat Disdukcapil OKI — Lightweight UI Motion & Micro-Interactions
 * Pure Vanilla JS (Zero external dependencies, respects prefers-reduced-motion)
 */
(function () {
    'use strict';

    const prefersReducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function initMetricCountUp() {
        const counters = document.querySelectorAll('[data-countup]');
        if (!counters.length) return;

        counters.forEach(function (el) {
            const rawAttr = el.getAttribute('data-countup');
            const target = parseInt(rawAttr !== '' && rawAttr !== null ? rawAttr : el.textContent.replace(/[^\d-]/g, ''), 10);
            if (isNaN(target) || prefersReducedMotion || target <= 0) {
                el.textContent = isNaN(target) ? el.textContent : target.toLocaleString('id-ID');
                return;
            }

            const duration = 500;
            const startTime = performance.now();

            function tick(now) {
                const elapsed = Math.min((now - startTime) / duration, 1);
                const eased = 1 - Math.pow(1 - elapsed, 3);
                const current = Math.round(target * eased);
                el.textContent = current.toLocaleString('id-ID');

                if (elapsed < 1) {
                    requestAnimationFrame(tick);
                } else {
                    el.textContent = target.toLocaleString('id-ID');
                }
            }

            requestAnimationFrame(tick);
        });
    }

    function initFlashAlertAutoDismiss() {
        const alerts = document.querySelectorAll('.alert.alert-dismissible:not([data-no-autodismiss])');
        if (!alerts.length) return;

        alerts.forEach(function (alertEl) {
            setTimeout(function () {
                if (!document.body.contains(alertEl)) return;
                alertEl.style.transition = 'opacity 300ms ease, transform 300ms ease';
                alertEl.style.opacity = '0';
                alertEl.style.transform = 'translateY(-4px)';
                setTimeout(function () {
                    if (window.bootstrap && window.bootstrap.Alert) {
                        window.bootstrap.Alert.getOrCreateInstance(alertEl).close();
                    } else if (alertEl.parentNode) {
                        alertEl.parentNode.removeChild(alertEl);
                    }
                }, 310);
            }, 6000);
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        initMetricCountUp();
        initFlashAlertAutoDismiss();
    });
})();


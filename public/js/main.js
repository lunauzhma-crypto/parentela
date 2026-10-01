/**
 * Parentela - Main JavaScript
 * Interactive Testimonials Marquee & Submission System
 */

document.addEventListener('DOMContentLoaded', () => {
    initTestimoniSystem();
    initScrollReveal();
    initDirectoryTabs();
});

function initTestimoniSystem() {
    const modal = document.getElementById('testimoniModal');
    const btnOpen = document.getElementById('btnOpenTestiModal');
    const btnClose = document.getElementById('btnCloseTestiModal');
    const btnCancel = document.getElementById('btnCancelTestiModal');
    const form = document.getElementById('formSubmitTesti');
    const toast = document.getElementById('testimoniToast');
    const track1 = document.getElementById('testimoniTrack1');
    const track2 = document.getElementById('testimoniTrack2');

    if (!modal || !btnOpen || !form) return;

    // 1. Modal open & close controls
    function openModal() {
        modal.classList.add('show');
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden'; // prevent background scrolling
        const firstInput = document.getElementById('inputTestiName');
        if (firstInput) setTimeout(() => firstInput.focus(), 150);
    }

    function closeModal() {
        modal.classList.remove('show');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    btnOpen.addEventListener('click', openModal);
    if (btnClose) btnClose.addEventListener('click', closeModal);
    if (btnCancel) btnCancel.addEventListener('click', closeModal);

    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal.classList.contains('show')) {
            closeModal();
        }
    });

    // 2. Interactive Star Rating
    const starContainer = document.getElementById('starRatingContainer');
    const ratingInput = document.getElementById('inputTestiRating');
    if (starContainer && ratingInput) {
        const starButtons = starContainer.querySelectorAll('.star-btn');

        function updateStars(val) {
            starButtons.forEach(btn => {
                const btnVal = parseInt(btn.getAttribute('data-value'), 10);
                if (btnVal <= val) {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            });
        }

        starButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const val = parseInt(btn.getAttribute('data-value'), 10);
                ratingInput.value = val;
                updateStars(val);
            });

            btn.addEventListener('mouseenter', () => {
                const val = parseInt(btn.getAttribute('data-value'), 10);
                starButtons.forEach(s => {
                    const sVal = parseInt(s.getAttribute('data-value'), 10);
                    if (sVal <= val) s.classList.add('hover');
                    else s.classList.remove('hover');
                });
            });

            btn.addEventListener('mouseleave', () => {
                starButtons.forEach(s => s.classList.remove('hover'));
            });
        });
    }

    // 3. Avatar Color Palettes
    const avatarPalettes = [
        { bg: '#FDE8E8', col: '#BC4F4F' },
        { bg: '#FEF08A', col: '#854D0E' },
        { bg: '#E0E7FF', col: '#3730A3' },
        { bg: '#DCFCE7', col: '#166534' },
        { bg: '#CFFAFE', col: '#0E7490' },
        { bg: '#FCE7F3', col: '#BE185D' },
        { bg: '#EDE9FE', col: '#6D28D9' },
        { bg: '#FFEDD5', col: '#C2410C' }
    ];

    function getAvatarColor(name) {
        let hash = 0;
        for (let i = 0; i < name.length; i++) {
            hash = name.charCodeAt(i) + ((hash << 5) - hash);
        }
        const index = Math.abs(hash) % avatarPalettes.length;
        return avatarPalettes[index];
    }

    function escapeHtml(str) {
        const div = document.createElement('div');
        div.textContent = str;
        return div.innerHTML;
    }

    function createTestiCardElement(data, isClone = false) {
        const initial = data.name ? data.name.trim().charAt(0).toUpperCase() : 'P';
        const color = getAvatarColor(data.name || 'Parentela');
        const rating = parseInt(data.rating, 10) || 5;
        const stars = '★'.repeat(rating) + '☆'.repeat(Math.max(0, 5 - rating));

        const card = document.createElement('div');
        card.className = 'testi-card' + (data.isNew ? ' user-submitted' : '');
        if (isClone) card.setAttribute('aria-hidden', 'true');

        card.innerHTML = `
            <div class="testi-card-header">
                <span class="testi-badge">Untuk: ${escapeHtml(data.program)}</span>
                <div class="testi-stars">${stars}</div>
            </div>
            <p class="testi-quote">"${escapeHtml(data.message)}"</p>
            <div class="testi-author">
                <div class="testi-avatar" style="background-color: ${color.bg}; color: ${color.col};">${initial}</div>
                <div class="testi-meta">
                    <strong>${escapeHtml(data.name)}</strong>
                    <span>${escapeHtml(data.child)}</span>
                </div>
            </div>
        `;
        return card;
    }

    // 4. Toast Notification helper
    let toastTimeout = null;
    function showToast() {
        if (!toast) return;
        toast.classList.add('show');
        if (toastTimeout) clearTimeout(toastTimeout);
        toastTimeout = setTimeout(() => {
            toast.classList.remove('show');
        }, 4500);
    }

    // 5. Load and prepend saved testimonials from localStorage
    const STORAGE_KEY = 'parentela_user_testimonials';
    function loadSavedTestimonials() {
        try {
            const raw = localStorage.getItem(STORAGE_KEY);
            if (!raw) return;
            const items = JSON.parse(raw);
            if (Array.isArray(items)) {
                items.forEach((item, idx) => {
                    const card = createTestiCardElement(item, false);
                    const cardClone = createTestiCardElement(item, true);
                    // Distribute across track 1 and track 2
                    if (idx % 2 === 0 && track1) {
                        track1.prepend(card);
                        track1.appendChild(cardClone);
                    } else if (track2) {
                        track2.prepend(card);
                        track2.appendChild(cardClone);
                    }
                });
            }
        } catch (e) {
            console.error('Error loading stored testimonials', e);
        }
    }

    loadSavedTestimonials();

    // 6. Handle Form Submit
    form.addEventListener('submit', (e) => {
        e.preventDefault();

        const name = document.getElementById('inputTestiName').value.trim();
        const child = document.getElementById('inputTestiChild').value.trim();
        const program = document.getElementById('inputTestiProgram').value;
        const rating = parseInt(document.getElementById('inputTestiRating').value, 10) || 5;
        const message = document.getElementById('inputTestiMessage').value.trim();

        if (!name || !child || !message) {
            alert('Mohon lengkapi semua kolom yang bertanda bintang (*).');
            return;
        }

        const newTesti = {
            id: 'testi_' + Date.now(),
            name,
            child,
            program,
            rating,
            message,
            timestamp: new Date().toISOString(),
            isNew: true
        };

        // Prepend to Track 1 so user immediately sees it
        if (track1) {
            const card1 = createTestiCardElement(newTesti, false);
            const cardClone = createTestiCardElement(newTesti, true);
            track1.prepend(card1);
            track1.appendChild(cardClone);
        }

        // Save to localStorage
        try {
            const raw = localStorage.getItem(STORAGE_KEY);
            const current = raw ? JSON.parse(raw) : [];
            current.unshift(newTesti);
            localStorage.setItem(STORAGE_KEY, JSON.stringify(current));
        } catch (err) {
            console.error('Error saving to localStorage', err);
        }

        // Reset form & close modal
        form.reset();
        ratingInput.value = 5;
        updateStars(5);
        closeModal();

        // Show success toast
        showToast();
    });
}

/**
 * Subtle Scroll Reveal Animation System
 * Uses IntersectionObserver for 60fps performance & minimal CPU usage
 */
function initScrollReveal() {
    const revealElements = document.querySelectorAll('.reveal-on-scroll');
    if (!revealElements.length) return;

    // Graceful fallback if IntersectionObserver is unsupported
    if (!('IntersectionObserver' in window)) {
        revealElements.forEach(el => el.classList.add('is-revealed'));
        return;
    }

    // Enable animation styles now that JS observer is active
    document.documentElement.classList.add('js-reveal-enabled');

    const observerOptions = {
        root: null,
        rootMargin: '0px 0px -40px 0px',
        threshold: 0.12
    };

    const revealObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-revealed');
                // Unobserve so it only reveals once gracefully without repetitive layout shifts
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    revealElements.forEach(el => {
        revealObserver.observe(el);
    });
}

/**
 * Interactive Directory Tab Switcher
 * Smoothly toggles between 'Tempat Asuh' and 'Pendidikan'
 */
function initDirectoryTabs() {
    const tabButtons = document.querySelectorAll('.dir-tab-btn');
    if (!tabButtons.length) return;

    tabButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const targetId = btn.getAttribute('data-target');
            const targetPanel = document.querySelector(targetId);
            if (!targetPanel) return;

            tabButtons.forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.directory-tab-panel').forEach(panel => {
                panel.classList.remove('active');
                panel.style.display = 'none';
            });

            btn.classList.add('active');
            targetPanel.style.display = 'block';
            targetPanel.classList.add('active');
        });
    });
}

/**
 * Fitur Pantau - Interactive Quick-Log & Auth Prompt
 */
function handleQuickLog(type, isLoggedIn) {
    if (!isLoggedIn) {
        openAuthModal();
        return;
    }

    let msg = 'Aktivitas berhasil dicatat!';
    if (type === 'sleep') {
        const els = [document.getElementById('statSleepTotal'), document.getElementById('homeStatSleep')];
        els.forEach(el => {
            if (el) {
                let cur = parseFloat(el.textContent) || 11.0;
                cur = Math.min(16.0, cur + 0.5);
                el.textContent = cur.toFixed(1);
            }
        });
        msg = 'Jam tidur berhasil ditambahkan (+0.5 jam)!';
    } else if (type === 'meal') {
        const els = [document.getElementById('statMeals'), document.getElementById('homeStatMeals')];
        els.forEach(el => {
            if (el) {
                let cur = parseInt(el.textContent, 10) || 3;
                el.textContent = cur + 1;
            }
        });
        msg = 'Catatan makan / camilan berhasil ditambahkan!';
    } else if (type === 'water') {
        const els = [document.getElementById('statWater'), document.getElementById('homeStatWater')];
        els.forEach(el => {
            if (el) {
                let cur = parseInt(el.textContent, 10) || 950;
                el.textContent = cur + 100;
            }
        });
        msg = 'Asupan hidrasi (+100 ml) berhasil dicatat!';
    } else if (type === 'diaper') {
        const els = [document.getElementById('statDiaper'), document.getElementById('homeStatDiaper')];
        els.forEach(el => {
            if (el) {
                let cur = parseInt(el.textContent, 10) || 5;
                el.textContent = cur + 1;
            }
        });
        msg = 'Pergantian popok berhasil dicatat!';
    }

    showPantauToast('Berhasil Dicatat!', msg);
}

function openAuthModal() {
    const modal = document.getElementById('authPromptModal');
    if (modal) {
        modal.classList.add('show');
        modal.setAttribute('aria-hidden', 'false');
    } else {
        alert('Fitur ini memerlukan login. Silakan masuk ke akun Parentela untuk mencatat data anak.');
        window.location.href = window.location.origin + '/login';
    }
}

function closeAuthModal() {
    const modal = document.getElementById('authPromptModal');
    if (modal) {
        modal.classList.remove('show');
        modal.setAttribute('aria-hidden', 'true');
    }
}

function openMetricModal(isLoggedIn) {
    if (!isLoggedIn) {
        openAuthModal();
        return;
    }
    const modal = document.getElementById('metricModal');
    if (modal) {
        modal.classList.add('show');
        modal.setAttribute('aria-hidden', 'false');
    }
}

function closeMetricModal() {
    const modal = document.getElementById('metricModal');
    if (modal) {
        modal.classList.remove('show');
        modal.setAttribute('aria-hidden', 'true');
    }
}

function saveMetricData(e) {
    e.preventDefault();
    const w = document.getElementById('inpWeight');
    const h = document.getElementById('inpHeight');
    const dispW = document.getElementById('dispWeight');
    const dispH = document.getElementById('dispHeight');

    if (w && dispW) dispW.innerHTML = `${parseFloat(w.value).toFixed(1)} <small>kg</small>`;
    if (h && dispH) dispH.innerHTML = `${parseFloat(h.value).toFixed(1)} <small>cm</small>`;

    closeMetricModal();
    showPantauToast('Data Diperbarui!', 'Berat dan tinggi badan si kecil berhasil disimpan.');
}

function showPantauToast(title, desc) {
    let toast = document.getElementById('pantauToast');
    if (!toast) {
        toast = document.createElement('div');
        toast.className = 'testi-toast';
        toast.id = 'pantauToast';
        toast.innerHTML = `
            <div class="testi-toast-icon">✓</div>
            <div class="testi-toast-body">
                <strong id="toastTitle">${title}</strong>
                <span id="toastDesc">${desc}</span>
            </div>
        `;
        document.body.appendChild(toast);
    } else {
        const tTitle = document.getElementById('toastTitle');
        const tDesc = document.getElementById('toastDesc');
        if (tTitle) tTitle.textContent = title;
        if (tDesc) tDesc.textContent = desc;
    }

    toast.classList.add('show');
    setTimeout(() => {
        toast.classList.remove('show');
    }, 4000);
}


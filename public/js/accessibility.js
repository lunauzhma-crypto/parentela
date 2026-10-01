/**
 * Parentela - Web Accessibility Engine (A11Y)
 * Inspired by parent.com (accessiBe)
 */

(function () {
    const STORAGE_KEY = 'parentela_a11y_settings';

    // State definition
    const defaultSettings = {
        seizureSafe: false,
        lowVision: false,
        adhdFriendly: false,
        dyslexiaFont: false,
        keyboardNav: false,
        screenReader: false,
        fontSize: 'normal', // 'sm', 'normal', 'md', 'lg', 'xl'
        contrast: 'none',   // 'none', 'dark', 'monochrome'
        highlightLinks: false,
        highlightTitles: false,
        readingRuler: false,
    };

    let state = Object.assign({}, defaultSettings);

    document.addEventListener('DOMContentLoaded', () => {
        loadSettings();
        initUI();
        initReadingRuler();
        initSpeechAssistant();
        applyAllSettings();
    });

    function loadSettings() {
        try {
            const saved = localStorage.getItem(STORAGE_KEY);
            if (saved) {
                state = Object.assign({}, defaultSettings, JSON.parse(saved));
            }
        } catch (e) {
            console.error('Failed to load accessibility preferences:', e);
        }
    }

    function saveSettings() {
        try {
            localStorage.setItem(STORAGE_KEY, JSON.stringify(state));
        } catch (e) {
            console.error('Failed to save accessibility preferences:', e);
        }
    }

    function initUI() {
        const floatingBtn = document.getElementById('accFloatingBtn');
        const modal = document.getElementById('accModal');
        const btnClose = document.getElementById('accBtnClose');
        const btnReset = document.getElementById('accBtnReset');
        const btnStatement = document.getElementById('accBtnStatement');
        const btnHide = document.getElementById('accBtnHide');

        if (!floatingBtn || !modal) return;

        function openModal() {
            modal.classList.add('is-open');
            modal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
            if (btnClose) btnClose.focus();
        }

        function closeModal() {
            modal.classList.remove('is-open');
            modal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
            floatingBtn.focus();
        }

        floatingBtn.addEventListener('click', openModal);
        if (btnClose) btnClose.addEventListener('click', closeModal);

        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeModal();
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && modal.classList.contains('is-open')) {
                closeModal();
            }
        });

        // Reset Settings
        if (btnReset) {
            btnReset.addEventListener('click', () => {
                state = Object.assign({}, defaultSettings);
                saveSettings();
                applyAllSettings();
                updateUIState();
                showSpeechToast('Pengaturan aksesibilitas telah direset ke bawaan.');
            });
        }

        // Statement Button
        if (btnStatement) {
            btnStatement.addEventListener('click', () => {
                showSpeechToast('Parentela berkomitmen mematuhi panduan aksesibilitas WCAG 2.1 Level AA.');
            });
        }

        // Hide Button
        if (btnHide) {
            btnHide.addEventListener('click', () => {
                closeModal();
                floatingBtn.style.display = 'none';
                showSpeechToast('Tombol disembunyikan. Muat ulang halaman untuk menampilkan kembali.');
            });
        }

        // Profile Toggles
        setupToggle('toggleSeizure', (active) => {
            state.seizureSafe = active;
            if (active) state.adhdFriendly = false;
        });

        setupToggle('toggleLowVision', (active) => {
            state.lowVision = active;
            if (active) {
                state.contrast = 'dark';
                state.fontSize = 'lg';
            } else {
                state.contrast = 'none';
                state.fontSize = 'normal';
            }
        });

        setupToggle('toggleADHD', (active) => {
            state.adhdFriendly = active;
            state.readingRuler = active;
            if (active) state.seizureSafe = true;
        });

        setupToggle('toggleDyslexia', (active) => {
            state.dyslexiaFont = active;
        });

        setupToggle('toggleKeyboard', (active) => {
            state.keyboardNav = active;
            state.highlightLinks = active;
        });

        setupToggle('toggleScreenReader', (active) => {
            state.screenReader = active;
            if (active) {
                showSpeechToast('Pembaca suara aktif. Klik atau sorot teks untuk mendengarkan.');
            } else {
                if ('speechSynthesis' in window) window.speechSynthesis.cancel();
            }
        });

        // Content Adjustments
        // Font Size Steppers
        const btnFontDec = document.getElementById('btnFontDec');
        const btnFontInc = document.getElementById('btnFontInc');
        const fontLevels = ['sm', 'normal', 'md', 'lg', 'xl'];

        if (btnFontInc) {
            btnFontInc.addEventListener('click', () => {
                let idx = fontLevels.indexOf(state.fontSize);
                if (idx < fontLevels.length - 1) {
                    state.fontSize = fontLevels[idx + 1];
                    saveSettings();
                    applyAllSettings();
                    updateUIState();
                }
            });
        }

        if (btnFontDec) {
            btnFontDec.addEventListener('click', () => {
                let idx = fontLevels.indexOf(state.fontSize);
                if (idx > 0) {
                    state.fontSize = fontLevels[idx - 1];
                    saveSettings();
                    applyAllSettings();
                    updateUIState();
                }
            });
        }

        // Readable Font
        setupCardBtn('btnReadableFont', () => {
            state.dyslexiaFont = !state.dyslexiaFont;
        });

        // Highlight Titles
        setupCardBtn('btnHighlightTitles', () => {
            state.highlightTitles = !state.highlightTitles;
        });

        // Highlight Links
        setupCardBtn('btnHighlightLinks', () => {
            state.highlightLinks = !state.highlightLinks;
        });

        // Contrast Dark
        setupCardBtn('btnContrastDark', () => {
            state.contrast = state.contrast === 'dark' ? 'none' : 'dark';
        });

        // Monochrome
        setupCardBtn('btnMonochrome', () => {
            state.contrast = state.contrast === 'monochrome' ? 'none' : 'monochrome';
        });

        // Reading Ruler
        setupCardBtn('btnReadingRuler', () => {
            state.readingRuler = !state.readingRuler;
            state.adhdFriendly = state.readingRuler;
        });

        // Stop Motion
        setupCardBtn('btnStopMotion', () => {
            state.seizureSafe = !state.seizureSafe;
        });

        updateUIState();
    }

    function setupToggle(id, callback) {
        const btn = document.getElementById(id);
        if (!btn) return;

        function handleToggle() {
            const isCurrentlyOn = btn.classList.contains('is-on');
            const newState = !isCurrentlyOn;
            callback(newState);
            saveSettings();
            applyAllSettings();
            updateUIState();
        }

        btn.addEventListener('click', handleToggle);
        btn.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                handleToggle();
            }
        });
    }

    function setupCardBtn(id, callback) {
        const btn = document.getElementById(id);
        if (!btn) return;
        btn.addEventListener('click', () => {
            callback();
            saveSettings();
            applyAllSettings();
            updateUIState();
        });
    }

    function updateUIState() {
        // Toggle switches
        setToggleState('toggleSeizure', state.seizureSafe);
        setToggleState('toggleLowVision', state.lowVision);
        setToggleState('toggleADHD', state.adhdFriendly);
        setToggleState('toggleDyslexia', state.dyslexiaFont);
        setToggleState('toggleKeyboard', state.keyboardNav);
        setToggleState('toggleScreenReader', state.screenReader);

        // Content Cards
        setCardActive('btnReadableFont', state.dyslexiaFont);
        setCardActive('btnHighlightTitles', state.highlightTitles);
        setCardActive('btnHighlightLinks', state.highlightLinks);
        setCardActive('btnContrastDark', state.contrast === 'dark');
        setCardActive('btnMonochrome', state.contrast === 'monochrome');
        setCardActive('btnReadingRuler', state.readingRuler);
        setCardActive('btnStopMotion', state.seizureSafe);

        // Update font display label
        const fontVal = document.getElementById('fontScaleVal');
        const fontLabels = { sm: '-10%', normal: 'Default', md: '+15%', lg: '+30%', xl: '+45%' };
        if (fontVal) fontVal.textContent = fontLabels[state.fontSize] || 'Default';
    }

    function setToggleState(id, isOn) {
        const el = document.getElementById(id);
        if (!el) return;
        const row = el.closest('.acc-profile-row');
        if (isOn) {
            el.classList.add('is-on');
            el.setAttribute('aria-checked', 'true');
            if (row) row.classList.add('is-active');
        } else {
            el.classList.remove('is-on');
            el.setAttribute('aria-checked', 'false');
            if (row) row.classList.remove('is-active');
        }
    }

    function setCardActive(id, isActive) {
        const el = document.getElementById(id);
        if (!el) return;
        if (isActive) {
            el.classList.add('is-active');
            el.setAttribute('aria-pressed', 'true');
        } else {
            el.classList.remove('is-active');
            el.setAttribute('aria-pressed', 'false');
        }
    }

    function applyAllSettings() {
        const root = document.documentElement;

        // 1. Font Size
        root.classList.remove('acc-font-sm', 'acc-font-md', 'acc-font-lg', 'acc-font-xl');
        if (state.fontSize !== 'normal') {
            root.classList.add('acc-font-' + state.fontSize);
        }

        // 2. Dyslexia / Readable Font
        if (state.dyslexiaFont) {
            root.classList.add('acc-dyslexic');
        } else {
            root.classList.remove('acc-dyslexic');
        }

        // 3. Stop Animations / Seizure Safety
        if (state.seizureSafe) {
            root.classList.add('acc-seizure-safe');
            root.classList.add('acc-stop-animations');
        } else {
            root.classList.remove('acc-seizure-safe');
            root.classList.remove('acc-stop-animations');
        }

        // 4. Contrast
        root.classList.remove('acc-contrast-dark', 'acc-monochrome');
        if (state.contrast === 'dark') root.classList.add('acc-contrast-dark');
        else if (state.contrast === 'monochrome') root.classList.add('acc-monochrome');

        // 5. Highlights
        if (state.highlightLinks) root.classList.add('acc-highlight-links');
        else root.classList.remove('acc-highlight-links');

        if (state.highlightTitles) root.classList.add('acc-highlight-titles');
        else root.classList.remove('acc-highlight-titles');

        // 6. Reading Ruler
        if (state.readingRuler) root.classList.add('acc-ruler-active');
        else root.classList.remove('acc-ruler-active');
    }

    // Interactive Focus Reading Ruler
    function initReadingRuler() {
        const ruler = document.getElementById('accReadingRuler');
        if (!ruler) return;

        window.addEventListener('mousemove', (e) => {
            if (!state.readingRuler) return;
            ruler.style.top = e.clientY + 'px';
        });
    }

    // Speech Assistant / Text-To-Speech
    function initSpeechAssistant() {
        if (!('speechSynthesis' in window)) return;

        document.addEventListener('mouseup', () => {
            if (!state.screenReader) return;
            const selectedText = window.getSelection().toString().trim();
            if (selectedText.length > 1) {
                speakText(selectedText);
            }
        });

        document.addEventListener('click', (e) => {
            if (!state.screenReader) return;
            if (e.target.closest('#accModal') || e.target.closest('#accFloatingBtn')) return;

            const clickableTarget = e.target.closest('h1, h2, h3, h4, p, .blog-card, .course-card, .shop-card');
            if (clickableTarget) {
                const text = clickableTarget.innerText.trim();
                if (text) speakText(text);
            }
        });
    }

    function speakText(text) {
        if (!('speechSynthesis' in window)) return;
        window.speechSynthesis.cancel();

        const utterance = new SpeechSynthesisUtterance(text);
        utterance.lang = 'id-ID';
        utterance.rate = 1.0;
        utterance.pitch = 1.0;

        utterance.onstart = () => {
            showSpeechToast('Membaca teks: "' + text.substring(0, 30) + '..."');
        };

        window.speechSynthesis.speak(utterance);
    }

    let toastTimer = null;
    function showSpeechToast(msg) {
        let toast = document.getElementById('accSpeechToast');
        if (!toast) {
            toast = document.createElement('div');
            toast.id = 'accSpeechToast';
            toast.className = 'acc-speech-toast';
            document.body.appendChild(toast);
        }
        toast.textContent = msg;
        toast.classList.add('show');

        if (toastTimer) clearTimeout(toastTimer);
        toastTimer = setTimeout(() => {
            toast.classList.remove('show');
        }, 3200);
    }
})();

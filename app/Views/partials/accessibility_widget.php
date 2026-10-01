<!-- ==========================================================================
     PARENTELA ACCESSIBILITY WIDGET (A11Y)
     Pixel-aligned with parent.com (accessiBe) Experience
     ========================================================================== -->

<!-- Floating Trigger Button (Bottom Right) -->
<button type="button" class="acc-floating-btn" id="accFloatingBtn" aria-label="Buka Pengaturan Aksesibilitas" title="Aksesibilitas">
    <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
        <circle cx="12" cy="4.5" r="2.2"></circle>
        <path d="M12 7.8c-3.6 0-7.2 1.3-8.2 2.3l1.4 2c.9-.7 3.5-1.5 6.8-1.5s5.9.8 6.8 1.5l1.4-2c-1-1-4.6-2.3-8.2-2.3z"></path>
        <path d="M10.2 12.5v9h3.6v-9h-3.6z"></path>
        <path d="M9.5 13.5l-2.4 8.5h2.5l1.5-6h1.8l1.5 6h2.5l-2.4-8.5z"></path>
    </svg>
</button>

<!-- Focus Reading Ruler Overlay -->
<div class="acc-reading-ruler" id="accReadingRuler" aria-hidden="true"></div>

<!-- Modal Dialog Backdrop (Right-docked Sidebar) -->
<div class="acc-modal-backdrop" id="accModal" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="accDialogTitle">
    <div class="acc-dialog">
        <!-- Dialog Header (accessiBe Solid Blue with 3 Top Pill Buttons) -->
        <div class="acc-dialog-header">
            <div class="acc-header-topbar">
                <button type="button" class="acc-btn-close-icon" id="accBtnClose" aria-label="Tutup Pengaturan Aksesibilitas">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
                <div class="acc-lang-selector">
                    <span class="lang-flag" style="display:inline-flex;align-items:center;box-shadow:0 0 1px rgba(0,0,0,0.4);border-radius:2px;overflow:hidden;"><svg width="18" height="12" viewBox="0 0 18 12"><rect width="18" height="6" fill="#E70011"/><rect y="6" width="18" height="6" fill="#FFFFFF"/></svg></span>
                    <span>INDONESIA (ID)</span>
                </div>
            </div>

            <h2 id="accDialogTitle" class="acc-header-title">Accessibility Adjustments</h2>

            <div class="acc-header-action-pills">
                <button type="button" class="acc-pill-btn" id="accBtnReset">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l6 5.81"/>
                    </svg>
                    Reset Settings
                </button>
                <button type="button" class="acc-pill-btn" id="accBtnStatement">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                    </svg>
                    Statement
                </button>
                <button type="button" class="acc-pill-btn" id="accBtnHide">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                        <line x1="1" y1="1" x2="23" y2="23"/>
                    </svg>
                    Hide Interface
                </button>
            </div>
        </div>

        <!-- Dialog Body (Scrollable) -->
        <div class="acc-dialog-body">
            <!-- AI Assistant Card -->
            <a href="<?= base_url('luna') ?>" class="acc-ai-card">
                <div class="acc-ai-icon-box">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1868DF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                </div>
                <div class="acc-ai-content">
                    <strong>AI Assistant</strong>
                    <span>Your personal accessibility assistant</span>
                </div>
                <div class="acc-ai-action">
                    <span>Start chat</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </div>
            </a>

            <!-- Section 1: Customize Your Browsing Experience -->
            <div class="acc-section-title">Customize your browsing experience</div>

            <div class="acc-profiles-list">
                <!-- Seizure Safety (With detailed explanation text matching parent.com) -->
                <div class="acc-profile-row" id="rowSeizure">
                    <div class="acc-profile-main">
                        <div class="acc-toggle-switch" id="toggleSeizure" role="switch" aria-checked="false" tabindex="0">
                            <span class="pill-off">OFF</span>
                            <span class="pill-on">ON</span>
                        </div>
                        <div class="acc-profile-text">
                            <strong class="acc-profile-title">Seizure Safety</strong>
                            <span>Reduce motion and visual triggers</span>
                        </div>
                        <div class="acc-row-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                            </svg>
                        </div>
                    </div>
                    <div class="acc-profile-desc-expanded">
                        Limits animations and adjusts color combinations to minimize exposure to flashing and visual patterns that may trigger seizures or discomfort.
                    </div>
                </div>

                <!-- Low Vision Support -->
                <div class="acc-profile-row" id="rowLowVision">
                    <div class="acc-profile-main">
                        <div class="acc-toggle-switch" id="toggleLowVision" role="switch" aria-checked="false" tabindex="0">
                            <span class="pill-off">OFF</span>
                            <span class="pill-on">ON</span>
                        </div>
                        <div class="acc-profile-text">
                            <strong class="acc-profile-title">Low Vision Support</strong>
                            <span>Improve clarity and contrast</span>
                        </div>
                        <div class="acc-row-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </div>
                    </div>
                    <div class="acc-profile-desc-expanded">
                        Enhances visual clarity, optimizes contrast balance, and scales up text and interactive controls for low vision reading comfort.
                    </div>
                </div>

                <!-- ADHD Friendly -->
                <div class="acc-profile-row" id="rowADHD">
                    <div class="acc-profile-main">
                        <div class="acc-toggle-switch" id="toggleADHD" role="switch" aria-checked="false" tabindex="0">
                            <span class="pill-off">OFF</span>
                            <span class="pill-on">ON</span>
                        </div>
                        <div class="acc-profile-text">
                            <strong class="acc-profile-title">ADHD Friendly</strong>
                            <span>Support focus and reduce distractions</span>
                        </div>
                        <div class="acc-row-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="3" y1="9" x2="21" y2="9"></line>
                                <line x1="3" y1="15" x2="21" y2="15"></line>
                            </svg>
                        </div>
                    </div>
                    <div class="acc-profile-desc-expanded">
                        Provides a focused reading guide ruler following your cursor and pauses background distractions to sustain reading flow.
                    </div>
                </div>

                <!-- Reading & Cognitive Support -->
                <div class="acc-profile-row" id="rowDyslexia">
                    <div class="acc-profile-main">
                        <div class="acc-toggle-switch" id="toggleDyslexia" role="switch" aria-checked="false" tabindex="0">
                            <span class="pill-off">OFF</span>
                            <span class="pill-on">ON</span>
                        </div>
                        <div class="acc-profile-text">
                            <strong class="acc-profile-title">Reading & Cognitive Support</strong>
                            <span>Simplify reading and navigation</span>
                        </div>
                        <div class="acc-row-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="22" y1="12" x2="18" y2="12"></line>
                                <line x1="6" y1="12" x2="2" y2="12"></line>
                                <line x1="12" y1="6" x2="12" y2="2"></line>
                                <line x1="12" y1="22" x2="12" y2="18"></line>
                            </svg>
                        </div>
                    </div>
                    <div class="acc-profile-desc-expanded">
                        Switches all fonts to high-legibility sans-serif with expanded letter spacing and generous line height for effortless comprehension.
                    </div>
                </div>

                <!-- Keyboard Navigation -->
                <div class="acc-profile-row" id="rowKeyboard">
                    <div class="acc-profile-main">
                        <div class="acc-toggle-switch" id="toggleKeyboard" role="switch" aria-checked="false" tabindex="0">
                            <span class="pill-off">OFF</span>
                            <span class="pill-on">ON</span>
                        </div>
                        <div class="acc-profile-text">
                            <strong class="acc-profile-title">Keyboard Navigation</strong>
                            <span>Use website with the keyboard</span>
                        </div>
                        <div class="acc-row-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="9 18 15 12 9 6"></polyline>
                                <line x1="3" y1="12" x2="15" y2="12"></line>
                            </svg>
                        </div>
                    </div>
                    <div class="acc-profile-desc-expanded">
                        Activates high-visibility focus borders and highlights all interactive elements for seamless navigation using Tab and Enter keys.
                    </div>
                </div>

                <!-- Screen Reader Compatibility -->
                <div class="acc-profile-row" id="rowScreenReader">
                    <div class="acc-profile-main">
                        <div class="acc-toggle-switch" id="toggleScreenReader" role="switch" aria-checked="false" tabindex="0">
                            <span class="pill-off">OFF</span>
                            <span class="pill-on">ON</span>
                        </div>
                        <div class="acc-profile-text">
                            <strong class="acc-profile-title">Screen Reader Compatibility</strong>
                            <span>Optimize for screen-readers & voice output</span>
                        </div>
                        <div class="acc-row-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"></path>
                                <path d="M19 10v2a7 7 0 0 1-14 0v-2"></path>
                                <line x1="12" y1="19" x2="12" y2="23"></line>
                                <line x1="8" y1="23" x2="16" y2="23"></line>
                            </svg>
                        </div>
                    </div>
                    <div class="acc-profile-desc-expanded">
                        Enables voice speech assistant to read aloud any heading, article paragraph, or selected text when clicked.
                    </div>
                </div>
            </div>

            <!-- Section 2: Content Adjustments -->
            <div class="acc-section-title">Content Adjustments</div>

            <div class="acc-cards-grid">
                <!-- Content Scaling Stepper -->
                <div class="acc-grid-card acc-stepper-card">
                    <div class="acc-card-header-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="15 3 21 3 21 9"></polyline>
                            <polyline points="9 21 3 21 3 15"></polyline>
                            <line x1="21" y1="3" x2="14" y2="10"></line>
                            <line x1="3" y1="21" x2="10" y2="14"></line>
                        </svg>
                        <span>Content Scaling</span>
                    </div>
                    <div class="acc-stepper-inline">
                        <button type="button" class="acc-circle-btn" id="btnFontDec" aria-label="Perkecil skala teks">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </button>
                        <span class="acc-scale-label" id="fontScaleVal">Default</span>
                        <button type="button" class="acc-circle-btn" id="btnFontInc" aria-label="Perbesar skala teks">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="18 15 12 9 6 15"></polyline></svg>
                        </button>
                    </div>
                </div>

                <!-- Readable Font -->
                <button type="button" class="acc-grid-card" id="btnReadableFont" aria-pressed="false">
                    <div class="acc-card-icon-big">
                        <span style="font-weight: 800; font-size: 19px; letter-spacing: -1px;">A≡</span>
                    </div>
                    <div class="acc-card-label">Readable Font</div>
                </button>

                <!-- Highlight Titles -->
                <button type="button" class="acc-grid-card" id="btnHighlightTitles" aria-pressed="false">
                    <div class="acc-card-icon-big">
                        <span style="font-weight: 800; font-size: 22px; font-family: serif;">T</span>
                    </div>
                    <div class="acc-card-label">Highlight Titles</div>
                </button>

                <!-- Highlight Links -->
                <button type="button" class="acc-grid-card" id="btnHighlightLinks" aria-pressed="false">
                    <div class="acc-card-icon-big">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                            <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                        </svg>
                    </div>
                    <div class="acc-card-label">Highlight Links</div>
                </button>

                <!-- High Contrast Dark -->
                <button type="button" class="acc-grid-card" id="btnContrastDark" aria-pressed="false">
                    <div class="acc-card-icon-big">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                        </svg>
                    </div>
                    <div class="acc-card-label">Dark Contrast</div>
                </button>

                <!-- Monochrome / Grayscale -->
                <button type="button" class="acc-grid-card" id="btnMonochrome" aria-pressed="false">
                    <div class="acc-card-icon-big">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M12 2a10 10 0 0 1 0 20z"></path>
                        </svg>
                    </div>
                    <div class="acc-card-label">Monochrome</div>
                </button>

                <!-- Reading Ruler / Focus -->
                <button type="button" class="acc-grid-card" id="btnReadingRuler" aria-pressed="false">
                    <div class="acc-card-icon-big">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="7" width="20" height="10" rx="2"></rect>
                            <line x1="6" y1="7" x2="6" y2="11"></line>
                            <line x1="10" y1="7" x2="10" y2="11"></line>
                            <line x1="14" y1="7" x2="14" y2="11"></line>
                            <line x1="18" y1="7" x2="18" y2="11"></line>
                        </svg>
                    </div>
                    <div class="acc-card-label">Reading Ruler</div>
                </button>

                <!-- Stop Motion Card -->
                <button type="button" class="acc-grid-card" id="btnStopMotion" aria-pressed="false">
                    <div class="acc-card-icon-big">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="10" y1="15" x2="10" y2="9"></line>
                            <line x1="14" y1="15" x2="14" y2="9"></line>
                        </svg>
                    </div>
                    <div class="acc-card-label">Stop Motion</div>
                </button>
            </div>
        </div>

        <!-- Dialog Footer (accessiBe brand bar) -->
        <div class="acc-dialog-footer-brand">
            <span>Web Accessibility By <strong>Parentela</strong></span>
            <a href="<?= base_url('about-us') ?>" class="acc-footer-link">
                Learn More
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </a>
        </div>
    </div>
</div>

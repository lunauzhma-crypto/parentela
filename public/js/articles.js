/**
 * PARENTELA PORTAL ARTIKEL - INTERACTIVITY & FILTERING ENGINE
 * Mendukung filter rentang usia, 10 kategori, tipe konten, pencarian instan,
 * dan fitur simpan artikel (Konten Tersimpan) via localStorage.
 */

document.addEventListener('DOMContentLoaded', () => {
  // ═══════════════════════════════════════════════════════════
  // 1. STATE INITIALIZATION
  // ═══════════════════════════════════════════════════════════
  const state = {
    category: 'semua',
    age: 'semua-usia',
    type: 'semua',
    subtag: 'semua',
    search: '',
    savedTab: 'artikel'
  };

  // Check URL params or active category card rendered by PHP
  const activeCatCard = document.querySelector('.category-card.active');
  if (activeCatCard && activeCatCard.getAttribute('data-category')) {
    state.category = activeCatCard.getAttribute('data-category');
  }

  // Check URL params for initial filters (e.g. ?kategori=kesehatan&usia=2-5-tahun)
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.has('kategori')) {
    state.category = urlParams.get('kategori');
  }
  if (urlParams.has('usia')) {
    state.age = urlParams.get('usia');
  }
  if (urlParams.has('tipe')) {
    state.type = urlParams.get('tipe');
  }
  if (urlParams.has('topik')) {
    state.subtag = urlParams.get('topik');
  }
  if (urlParams.has('q')) {
    state.search = urlParams.get('q');
  }

  // DOM Elements
  const articleCards = document.querySelectorAll('.art-card');
  const noResultsBox = document.getElementById('artNoResults');
  const resultCountText = document.getElementById('resultCountText');
  const activeFilterInfo = document.getElementById('activeFilterInfo');
  const searchInput = document.getElementById('artSearchInput');
  const searchClearBtn = document.getElementById('artSearchClear');
  const ageSelectorBtn = document.getElementById('artAgeSelectorBtn');
  const ageBtnText = document.getElementById('currentAgeLabel');
  const categoryCards = document.querySelectorAll('.category-card');
  const subnavChips = document.querySelectorAll('.filter-chip');
  const scrollTopBtn = document.getElementById('artScrollTopBtn');

  // Modals
  const filterModal = document.getElementById('artFilterModal');
  const btnOpenFilter = document.getElementById('btnOpenFilter');
  const btnCloseFilter = document.getElementById('btnCloseFilter');
  const btnResetFilter = document.getElementById('btnResetFilter');
  const btnApplyFilter = document.getElementById('btnApplyFilter');

  const savedModal = document.getElementById('artSavedModal');
  const btnOpenSaved = document.getElementById('btnOpenSaved');
  const btnCloseSaved = document.getElementById('btnCloseSaved');
  const savedBadgeCount = document.querySelectorAll('.saved-badge-count');
  const savedTabs = document.querySelectorAll('.saved-tab-btn');
  const savedItemsContainer = document.getElementById('savedItemsContainer');
  const savedEmptyState = document.getElementById('savedEmptyState');

  // ═══════════════════════════════════════════════════════════
  // 2. SAVED ARTICLES ENGINE (OBJECT-BASED) VIA LOCALSTORAGE
  // ═══════════════════════════════════════════════════════════
  const STORAGE_KEY = 'parentela_saved_articles_v2'; // v2 = object metadata

  function getSavedItems() {
    try {
      const data = localStorage.getItem(STORAGE_KEY);
      return data ? JSON.parse(data) : [];
    } catch (e) {
      console.warn('Gagal membaca localStorage:', e);
      return [];
    }
  }

  // Legacy: also read old v1 key for IDs-only format (backwards compat)
  function getSavedIds() {
    return getSavedItems().map(item => item.id);
  }

  function setSavedItems(items) {
    try {
      localStorage.setItem(STORAGE_KEY, JSON.stringify(items));
      updateSavedBadgeCount();
      syncBookmarkButtons();
    } catch (e) {
      console.warn('Gagal menyimpan ke localStorage:', e);
    }
  }

  // Keep old setSavedIds alias (used elsewhere)
  function setSavedIds(ids) {
    // no-op: now use setSavedItems
  }

  function updateSavedBadgeCount() {
    const saved = getSavedItems();
    savedBadgeCount.forEach(badge => {
      badge.textContent = saved.length;
      badge.style.display = saved.length > 0 ? 'inline-flex' : 'none';
    });
  }

  function syncBookmarkButtons() {
    const savedIds = new Set(getSavedIds());
    document.querySelectorAll('.art-save-btn').forEach(btn => {
      const id = btn.getAttribute('data-id');
      const isSaved = savedIds.has(id);
      if (isSaved) {
        btn.classList.add('is-saved');
        btn.setAttribute('title', 'Hapus dari Konten Tersimpan');
        btn.setAttribute('aria-label', 'Hapus artikel dari konten tersimpan');
        btn.innerHTML = `
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="1">
            <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
          </svg>
        `;
      } else {
        btn.classList.remove('is-saved');
        btn.setAttribute('title', 'Simpan ke Konten Tersimpan');
        btn.setAttribute('aria-label', 'Simpan artikel ke konten tersimpan');
        btn.innerHTML = `
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
          </svg>
        `;
      }
    });
  }

  // Build base URL once
  function buildDetailUrl(id) {
    const base = window.location.origin + window.location.pathname.replace(/\/articles.*/, '');
    return `${base}/articles/detail/${id}`;
  }

  window.toggleSaveArticle = function (id, event) {
    if (event) {
      event.preventDefault();
      event.stopPropagation();
    }
    const saved = getSavedItems();
    const index = saved.findIndex(item => item.id === id);

    if (index > -1) {
      saved.splice(index, 1);
      setSavedItems(saved);
      showToast('Dihapus dari Konten Tersimpan', 'info');
    } else {
      // Collect metadata from the DOM card
      const card = document.querySelector(`.art-card[data-id="${id}"]`);
      const title    = card?.querySelector('.art-card-title')?.textContent?.trim() || 'Artikel Parentela';
      const img      = card?.querySelector('.art-card-img')?.getAttribute('src') || '';
      const savedType= card?.getAttribute('data-saved-type') || 'artikel';
      const category = card?.querySelector('.art-tag-pill')?.textContent?.trim() || '';
      const ageLabel = card?.querySelector('.art-age-badge')?.textContent?.trim() || '';

      saved.push({ id, title, img, savedType, category, ageLabel });
      setSavedItems(saved);
      showToast('Berhasil disimpan ke Konten Tersimpan', 'success');
    }

    if (savedModal && savedModal.classList.contains('show')) {
      renderSavedItems();
    }
  };

  // Toast Notification
  function showToast(message, type = 'success') {
    let container = document.getElementById('artToastContainer');
    if (!container) {
      container = document.createElement('div');
      container.id = 'artToastContainer';
      container.className = 'art-toast-container';
      document.body.appendChild(container);
    }
    const toast = document.createElement('div');
    toast.className = `art-toast toast-${type}`;
    toast.innerHTML = `<span>${message}</span>`;
    container.appendChild(toast);

    setTimeout(() => {
      if (toast.parentNode) {
        toast.parentNode.removeChild(toast);
      }
    }, 3000);
  }

  // ═══════════════════════════════════════════════════════════
  // 3. FILTERING & SEARCH LOGIC
  // ═══════════════════════════════════════════════════════════
  function applyFilters() {
    let visibleCount = 0;
    const query = state.search.toLowerCase().trim();

    articleCards.forEach(card => {
      const category = card.getAttribute('data-category') || '';
      const age = card.getAttribute('data-age') || '';
      const type = card.getAttribute('data-type') || '';
      const subtags = (card.getAttribute('data-subtags') || '').toLowerCase();
      const title = (card.getAttribute('data-title') || '').toLowerCase();
      const excerpt = (card.querySelector('.art-card-excerpt')?.textContent || '').toLowerCase();

      // Kategori Match
      const matchCategory = (state.category === 'semua' || category === state.category);

      // Usia Match
      const matchAge = (state.age === 'semua-usia' || age === state.age || age === 'semua-usia');

      // Tipe Match
      const matchType = (state.type === 'semua' || type === state.type);

      // Subtag Match
      let matchSubtag = true;
      if (state.subtag !== 'semua') {
        const targetSubtag = state.subtag.replace(/-/g, ' ');
        matchSubtag = subtags.includes(targetSubtag) || subtags.includes(state.subtag);
      }

      // Search Match
      let matchSearch = true;
      if (query.length > 0) {
        matchSearch = title.includes(query) || excerpt.includes(query) || subtags.includes(query);
      }

      if (matchCategory && matchAge && matchType && matchSubtag && matchSearch) {
        card.style.display = 'flex';
        visibleCount++;
      } else {
        card.style.display = 'none';
      }
    });

    // Handle Empty Results
    if (noResultsBox) {
      noResultsBox.style.display = visibleCount === 0 ? 'block' : 'none';
    }

    // Update Counter Text
    if (resultCountText) {
      resultCountText.textContent = `Menampilkan ${visibleCount} konten`;
    }

    updateActiveFilterInfo(visibleCount);
  }

  function updateActiveFilterInfo(count) {
    if (!activeFilterInfo) return;
    const pills = [];

    if (state.category !== 'semua') {
      const activeCatCard = document.querySelector(`.category-card[data-category="${state.category}"]`);
      const label = activeCatCard ? activeCatCard.querySelector('.category-title').textContent : state.category;
      pills.push(`
        <span class="active-pill-item">
          Kategori: ${label}
          <button type="button" onclick="window.clearFilter('category')" aria-label="Hapus filter kategori">&times;</button>
        </span>
      `);
    }

    if (state.age !== 'semua-usia') {
      const label = getAgeLabel(state.age);
      pills.push(`
        <span class="active-pill-item">
          Usia: ${label}
          <button type="button" onclick="window.clearFilter('age')" aria-label="Hapus filter usia">&times;</button>
        </span>
      `);
      if (ageBtnText) {
        ageBtnText.textContent = label;
      }
    } else {
      if (ageBtnText) {
        ageBtnText.textContent = 'Semua Usia';
      }
    }

    if (state.type !== 'semua') {
      pills.push(`
        <span class="active-pill-item">
          Tipe: ${capitalize(state.type)}
          <button type="button" onclick="window.clearFilter('type')" aria-label="Hapus filter tipe">&times;</button>
        </span>
      `);
    }

    if (state.subtag !== 'semua') {
      pills.push(`
        <span class="active-pill-item">
          Topik: ${capitalize(state.subtag.replace(/-/g, ' '))}
          <button type="button" onclick="window.clearFilter('subtag')" aria-label="Hapus filter topik">&times;</button>
        </span>
      `);
    }

    if (state.search.trim().length > 0) {
      pills.push(`
        <span class="active-pill-item">
          Kata Kunci: "${state.search}"
          <button type="button" onclick="window.clearFilter('search')" aria-label="Hapus kata kunci pencarian">&times;</button>
        </span>
      `);
    }

    activeFilterInfo.innerHTML = pills.join('');
  }

  function getAgeLabel(slug) {
    const ageMap = {
      'semua-usia': 'Semua Usia',
      'hamil-trimester-1': 'Hamil Trimester 1',
      'hamil-trimester-2': 'Hamil Trimester 2',
      'hamil-trimester-3': 'Hamil Trimester 3',
      'pasca-persalinan': 'Pasca Persalinan',
      '0-6-bulan': '0 - 6 bulan',
      '6-12-bulan': '6 - 12 bulan',
      '1-2-tahun': '1 - 2 tahun',
      '2-5-tahun': '2 - 5 tahun',
      '5-12-tahun': '5 - 12 tahun',
      'lebih-12-tahun': '> 12 tahun'
    };
    return ageMap[slug] || slug;
  }

  function capitalize(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
  }

  window.clearFilter = function (filterType) {
    if (filterType === 'category') {
      state.category = 'semua';
      categoryCards.forEach(c => c.classList.toggle('active', c.getAttribute('data-category') === 'semua'));
    } else if (filterType === 'age') {
      state.age = 'semua-usia';
    } else if (filterType === 'type') {
      state.type = 'semua';
    } else if (filterType === 'subtag') {
      state.subtag = 'semua';
      subnavChips.forEach(c => c.classList.toggle('active', c.getAttribute('data-subtag') === 'semua'));
    } else if (filterType === 'search') {
      state.search = '';
      if (searchInput) searchInput.value = '';
      if (searchClearBtn) searchClearBtn.style.display = 'none';
    }
    applyFilters();
  };

  window.resetAllFilters = function () {
    state.category = 'semua';
    state.age = 'semua-usia';
    state.type = 'semua';
    state.subtag = 'semua';
    state.search = '';

    if (searchInput) searchInput.value = '';
    if (searchClearBtn) searchClearBtn.style.display = 'none';

    categoryCards.forEach(c => c.classList.toggle('active', c.getAttribute('data-category') === 'semua'));
    subnavChips.forEach(c => c.classList.toggle('active', c.getAttribute('data-subtag') === 'semua'));

    applyFilters();
  };

  // ═══════════════════════════════════════════════════════════
  // 4. EVENT LISTENERS
  // ═══════════════════════════════════════════════════════════

  // Category Cards Click
  categoryCards.forEach(card => {
    card.addEventListener('click', (e) => {
      e.preventDefault();
      const cat = card.getAttribute('data-category');
      state.category = cat;

      categoryCards.forEach(c => c.classList.remove('active'));
      card.classList.add('active');

      applyFilters();

      // Smooth scroll to articles section
      const mainSection = document.querySelector('.articles-subnav-section');
      if (mainSection) {
        mainSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });

  // Subnav Chips Click
  subnavChips.forEach(chip => {
    chip.addEventListener('click', () => {
      const subtag = chip.getAttribute('data-subtag');
      state.subtag = subtag;

      subnavChips.forEach(c => c.classList.remove('active'));
      chip.classList.add('active');

      applyFilters();
    });
  });

  // Live Search Input with Debounce
  let searchTimeout = null;
  if (searchInput) {
    if (state.search) {
      searchInput.value = state.search;
      if (searchClearBtn) searchClearBtn.style.display = 'block';
    }

    searchInput.addEventListener('input', (e) => {
      const val = e.target.value;
      if (searchClearBtn) {
        searchClearBtn.style.display = val.length > 0 ? 'block' : 'none';
      }
      clearTimeout(searchTimeout);
      searchTimeout = setTimeout(() => {
        state.search = val;
        applyFilters();
      }, 180);
    });
  }

  if (searchClearBtn) {
    searchClearBtn.addEventListener('click', () => {
      searchInput.value = '';
      searchClearBtn.style.display = 'none';
      state.search = '';
      applyFilters();
      searchInput.focus();
    });
  }

  // ═══════════════════════════════════════════════════════════
  // 5. ADVANCED FILTER MODAL
  // ═══════════════════════════════════════════════════════════
  function syncModalOptions() {
    // Sync Age
    document.querySelectorAll('#modalAgeOptions .modal-opt-btn').forEach(btn => {
      const val = btn.getAttribute('data-val');
      btn.classList.toggle('active', val === state.age);
    });

    // Sync Type
    document.querySelectorAll('#modalTypeOptions .modal-opt-btn').forEach(btn => {
      const val = btn.getAttribute('data-val');
      btn.classList.toggle('active', val === state.type);
    });

    // Update modal submit button text with estimated results
    updateModalCountText();
  }

  function updateModalCountText() {
    if (!btnApplyFilter) return;
    btnApplyFilter.textContent = 'Tampilkan Konten';
  }

  if (btnOpenFilter) {
    btnOpenFilter.addEventListener('click', () => {
      syncModalOptions();
      filterModal.classList.add('show');
      document.body.style.overflow = 'hidden';
    });
  }

  if (ageSelectorBtn) {
    ageSelectorBtn.addEventListener('click', () => {
      syncModalOptions();
      filterModal.classList.add('show');
      document.body.style.overflow = 'hidden';
    });
  }

  function closeFilterModal() {
    if (filterModal) {
      filterModal.classList.remove('show');
      document.body.style.overflow = '';
    }
  }

  if (btnCloseFilter) {
    btnCloseFilter.addEventListener('click', closeFilterModal);
  }

  if (filterModal) {
    filterModal.addEventListener('click', (e) => {
      if (e.target === filterModal) {
        closeFilterModal();
      }
    });
  }

  // Modal Options Click
  document.querySelectorAll('#modalAgeOptions .modal-opt-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('#modalAgeOptions .modal-opt-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      state.age = btn.getAttribute('data-val');
      updateModalCountText();
    });
  });

  document.querySelectorAll('#modalTypeOptions .modal-opt-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('#modalTypeOptions .modal-opt-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      state.type = btn.getAttribute('data-val');
      updateModalCountText();
    });
  });

  if (btnResetFilter) {
    btnResetFilter.addEventListener('click', () => {
      state.age = 'semua-usia';
      state.type = 'semua';
      syncModalOptions();
    });
  }

  if (btnApplyFilter) {
    btnApplyFilter.addEventListener('click', () => {
      closeFilterModal();
      applyFilters();
    });
  }

  // ═══════════════════════════════════════════════════════════
  // 6. SAVED CONTENT ("KONTEN TERSIMPAN") MODAL
  // ═══════════════════════════════════════════════════════════
  function renderSavedItems() {
    const savedAll = getSavedItems();
    const currentTab = state.savedTab;

    if (!savedItemsContainer || !savedEmptyState) return;

    if (savedAll.length === 0) {
      savedItemsContainer.innerHTML = '';
      savedEmptyState.style.display = 'block';
      return;
    }

    // Filter by tab (artikel vs video)
    const matched = savedAll.filter(item => {
      const t = item.savedType || 'artikel';
      if (currentTab === 'video') return (t === 'video' || t === 'stimulasi');
      return (t === 'artikel');
    });

    if (matched.length === 0) {
      savedItemsContainer.innerHTML = `
        <div style="text-align: center; padding: 30px 10px; color: var(--art-muted); font-size: 13.5px;">
          Tidak ada konten tersimpan pada kategori <strong>${capitalize(currentTab)}</strong>.
        </div>
      `;
      savedEmptyState.style.display = 'none';
      return;
    }

    savedEmptyState.style.display = 'none';
    savedItemsContainer.innerHTML = matched.map(item => {
      const detailUrl = buildDetailUrl(item.id);
      return `
        <a class="saved-item-row" href="${detailUrl}" data-saved-id="${item.id}" style="text-decoration:none; color:inherit;">
          <img src="${item.img || ''}" alt="${item.title}" class="saved-item-thumb" />
          <div class="saved-item-info">
            <h4>${item.title}</h4>
            <div class="saved-item-meta">
              <span>${item.category || ''}</span>
              <span>•</span>
              <span>${item.ageLabel || ''}</span>
            </div>
          </div>
          <button type="button" class="btn-remove-saved" onclick="event.preventDefault(); event.stopPropagation(); window.removeSavedFromModal('${item.id}')" title="Hapus dari tersimpan">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="3 6 5 6 21 6"></polyline>
              <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
            </svg>
          </button>
        </a>
      `;
    }).join('');
  }

  window.removeSavedFromModal = function (id) {
    const saved = getSavedItems();
    const index = saved.findIndex(item => item.id === id);
    if (index > -1) {
      saved.splice(index, 1);
      setSavedItems(saved);
      renderSavedItems();
      showToast('Dihapus dari Konten Tersimpan', 'info');
    }
  };

  function openSavedModal() {
    if (savedModal) {
      renderSavedItems();
      savedModal.classList.add('show');
      document.body.style.overflow = 'hidden';
    }
  }

  function closeSavedModal() {
    if (savedModal) {
      savedModal.classList.remove('show');
      document.body.style.overflow = '';
    }
  }

  if (btnOpenSaved) {
    btnOpenSaved.addEventListener('click', openSavedModal);
  }

  if (btnCloseSaved) {
    btnCloseSaved.addEventListener('click', closeSavedModal);
  }

  if (savedModal) {
    savedModal.addEventListener('click', (e) => {
      if (e.target === savedModal) {
        closeSavedModal();
      }
    });
  }

  savedTabs.forEach(tab => {
    tab.addEventListener('click', () => {
      savedTabs.forEach(t => t.classList.remove('active'));
      tab.classList.add('active');
      state.savedTab = tab.getAttribute('data-tab');
      renderSavedItems();
    });
  });

  window.exploreArticlesFromEmpty = function () {
    closeSavedModal();
    const gridElem = document.querySelector('.articles-main-section');
    if (gridElem) {
      gridElem.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  };

  // ═══════════════════════════════════════════════════════════
  // ═══════════════════════════════════════════════════════════
  // 7. SUBMIT ARTICLE MODAL ENGINE
  // ═══════════════════════════════════════════════════════════
  const submitModal = document.getElementById('artSubmitModal');
  const btnOpenSubmitArticle = document.getElementById('btnOpenSubmitArticle');
  const btnCloseSubmitModal = document.getElementById('btnCloseSubmitModal');
  const btnCancelSubmitModal = document.getElementById('btnCancelSubmitModal');

  function openSubmitModal() {
    if (btnOpenSubmitArticle && btnOpenSubmitArticle.getAttribute('data-logged-in') === '0') {
      window.location.href = (typeof baseUrl !== 'undefined' ? baseUrl : '/') + 'login';
      return;
    }
    if (submitModal) {
      submitModal.classList.add('show');
      document.body.style.overflow = 'hidden';
    }
  }

  function closeSubmitModal() {
    if (submitModal) {
      submitModal.classList.remove('show');
      document.body.style.overflow = '';
    }
  }

  if (btnOpenSubmitArticle) {
    btnOpenSubmitArticle.addEventListener('click', openSubmitModal);
  }

  if (btnCloseSubmitModal) {
    btnCloseSubmitModal.addEventListener('click', closeSubmitModal);
  }

  if (btnCancelSubmitModal) {
    btnCancelSubmitModal.addEventListener('click', closeSubmitModal);
  }

  if (submitModal) {
    submitModal.addEventListener('click', (e) => {
      if (e.target === submitModal) {
        closeSubmitModal();
      }
    });
  }

  // ═══════════════════════════════════════════════════════════
  // 8. SCROLL TO TOP
  // ═══════════════════════════════════════════════════════════
  window.addEventListener('scroll', () => {
    if (scrollTopBtn) {
      scrollTopBtn.classList.toggle('visible', window.scrollY > 450);
    }
  });

  if (scrollTopBtn) {
    scrollTopBtn.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  // ═══════════════════════════════════════════════════════════
  // 9. INITIAL BOOTSTRAP
  // ═══════════════════════════════════════════════════════════
  updateSavedBadgeCount();
  syncBookmarkButtons();
  applyFilters();
});

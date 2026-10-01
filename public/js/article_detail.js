/**
 * PARENTELA DETAIL KONTEN (ARTIKEL & VIDEO) - CLIENT INTERACTIVITY
 */

document.addEventListener('DOMContentLoaded', () => {
  const contentId = document.getElementById('detailContentWrapper')?.getAttribute('data-content-id') || 'art-1';
  
  // ═══════════════════════════════════════════════════════════
  // 1. LIKE BUTTON INTERACTIVITY
  // ═══════════════════════════════════════════════════════════
  const btnLike = document.getElementById('btnDetailLike');
  const likeCountSpan = document.getElementById('detailLikeCount');
  const likesPillSpan = document.getElementById('likesPillCount');
  const LIKES_KEY = 'parentela_liked_items';

  function getLikedItems() {
    try {
      const d = localStorage.getItem(LIKES_KEY);
      return d ? JSON.parse(d) : [];
    } catch(e) {
      return [];
    }
  }

  function setLikedItems(items) {
    try {
      localStorage.setItem(LIKES_KEY, JSON.stringify(items));
    } catch(e) {}
  }

  function syncLikeButton() {
    if (!btnLike) return;
    const liked = getLikedItems();
    const isLiked = liked.includes(contentId);
    btnLike.classList.toggle('is-liked', isLiked);
  }

  if (btnLike) {
    btnLike.addEventListener('click', () => {
      const liked = getLikedItems();
      const index = liked.indexOf(contentId);
      let currentLikes = parseInt(likeCountSpan?.textContent || '0', 10);

      if (index > -1) {
        liked.splice(index, 1);
        currentLikes = Math.max(0, currentLikes - 1);
        btnLike.classList.remove('is-liked');
        showToast('Batal menyukai konten');
      } else {
        liked.push(contentId);
        currentLikes += 1;
        btnLike.classList.add('is-liked');
        showToast('Terima kasih telah menyukai konten ini!');
      }

      setLikedItems(liked);
      if (likeCountSpan) likeCountSpan.textContent = currentLikes;
      if (likesPillSpan) likesPillSpan.textContent = currentLikes;
    });
  }

  syncLikeButton();

  // ═══════════════════════════════════════════════════════════
  // 2. BOOKMARK / SAVE BUTTON (TEMPO WIDGET) - v2 OBJECT STORAGE
  // ═══════════════════════════════════════════════════════════
  const btnTempoSave = document.getElementById('btnTempoSave');
  const STORAGE_KEY = 'parentela_saved_articles_v2';

  function getSavedItems() {
    try {
      const d = localStorage.getItem(STORAGE_KEY);
      return d ? JSON.parse(d) : [];
    } catch(e) {
      return [];
    }
  }

  function setSavedItems(items) {
    try {
      localStorage.setItem(STORAGE_KEY, JSON.stringify(items));
    } catch(e) {}
  }

  function syncSaveButtons() {
    const saved = getSavedItems();
    const isSaved = saved.some(item => item.id === contentId);

    if (btnTempoSave) {
      btnTempoSave.classList.toggle('is-saved', isSaved);
      btnTempoSave.setAttribute('title', isSaved ? 'Hapus dari Tersimpan' : 'Simpan Artikel');
      const svg = btnTempoSave.querySelector('svg');
      if (svg) {
        svg.setAttribute('fill', isSaved ? 'var(--color-primary)' : 'none');
      }
    }
  }

  function toggleSave() {
    const saved = getSavedItems();
    const index = saved.findIndex(item => item.id === contentId);

    if (index > -1) {
      saved.splice(index, 1);
      setSavedItems(saved);
      showToast('Dihapus dari Konten Tersimpan');
    } else {
      // Collect metadata from the page
      const title     = document.querySelector('.detail-title')?.textContent?.trim() || document.title;
      const img       = document.querySelector('.detail-hero-img')?.getAttribute('src') || '';
      const typeLabel = document.querySelector('.meta-col-val')?.textContent?.trim() || 'Artikel';
      const savedType = (typeLabel.toLowerCase().includes('video')) ? 'video' : 'artikel';
      const category  = document.querySelector('.detail-tag-pill')?.textContent?.trim() || '';
      const ageLabel  = document.querySelectorAll('.meta-col-val')[1]?.textContent?.trim() || '';

      saved.push({ id: contentId, title, img, savedType, category, ageLabel });
      setSavedItems(saved);
      showToast('Berhasil disimpan ke Konten Tersimpan!');
    }

    syncSaveButtons();
  }

  if (btnTempoSave) btnTempoSave.addEventListener('click', toggleSave);
  syncSaveButtons();

  // ═══════════════════════════════════════════════════════════
  // 3. SHARE BUTTONS (WA, FB, X, THREADS, SMS, COPY LINK)
  // ═══════════════════════════════════════════════════════════
  (function initShareButtons() {
    const pageUrl   = encodeURIComponent(window.location.href);
    const pageTitle = encodeURIComponent(document.title);

    const shareMap = {
      btnShareWa:      `https://wa.me/?text=${pageTitle}%20${pageUrl}`,
      btnShareFb:      `https://www.facebook.com/sharer/sharer.php?u=${pageUrl}`,
      btnShareX:       `https://twitter.com/intent/tweet?url=${pageUrl}&text=${pageTitle}`,
      btnShareThreads: `https://www.threads.net/intent/post?text=${pageTitle}%20${pageUrl}`,
      btnShareSms:     `sms:?body=${pageTitle}%20${window.location.href}`,
    };

    Object.entries(shareMap).forEach(([id, url]) => {
      const el = document.getElementById(id);
      if (el) {
        el.href = url;
        el.addEventListener('click', (e) => {
          e.preventDefault();
          window.open(url, '_blank', 'width=600,height=500,noopener,noreferrer');
        });
      }
    });

    // Salin link
    const btnCopy = document.getElementById('btnShareCopy');
    if (btnCopy) {
      btnCopy.addEventListener('click', async () => {
        try {
          await navigator.clipboard.writeText(window.location.href);
          // Tampilkan konfirmasi visual sementara
          const origHTML = btnCopy.innerHTML;
          btnCopy.innerHTML = `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#22C55E" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>`;
          btnCopy.style.background = '#F0FDF4';
          setTimeout(() => {
            btnCopy.innerHTML = origHTML;
            btnCopy.style.background = '';
          }, 1800);
          showToast('Tautan berhasil disalin!');
        } catch(e) {
          // Fallback lama
          const ta = document.createElement('textarea');
          ta.value = window.location.href;
          document.body.appendChild(ta);
          ta.select();
          document.execCommand('copy');
          document.body.removeChild(ta);
          showToast('Tautan berhasil disalin!');
        }
      });
    }
  })();


  // ═══════════════════════════════════════════════════════════
  const btnFontSize = document.getElementById('btnTempoFontSize');
  const articleBody = document.querySelector('.detail-body-content');
  const FONT_CLASSES = ['', 'font-size-md', 'font-size-lg'];
  const FONT_TITLES = ['Normal (16px)', 'Sedang (18px)', 'Besar (20px)'];
  let fontIdx = 0;

  if (btnFontSize && articleBody) {
    btnFontSize.addEventListener('click', () => {
      if (FONT_CLASSES[fontIdx]) articleBody.classList.remove(FONT_CLASSES[fontIdx]);
      fontIdx = (fontIdx + 1) % FONT_CLASSES.length;
      if (FONT_CLASSES[fontIdx]) articleBody.classList.add(FONT_CLASSES[fontIdx]);
      showToast(`Ukuran teks: ${FONT_TITLES[fontIdx]}`);
    });
  }

  // ═══════════════════════════════════════════════════════════
  // 4. SHARE HANDLERS (TEMPO INSPIRATION: WA, FB, X, TG, THREADS, COPY)
  // ═══════════════════════════════════════════════════════════
  window.shareToWhatsApp = function() {
    const url = encodeURIComponent(window.location.href);
    const title = encodeURIComponent(document.title);
    window.open(`https://api.whatsapp.com/send?text=${title}%20-%20${url}`, '_blank');
  };

  window.shareToFacebook = function() {
    const url = encodeURIComponent(window.location.href);
    window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank');
  };

  window.shareToX = function() {
    const url = encodeURIComponent(window.location.href);
    const title = encodeURIComponent(document.title);
    window.open(`https://twitter.com/intent/tweet?text=${title}&url=${url}`, '_blank');
  };

  window.shareToTelegram = function() {
    const url = encodeURIComponent(window.location.href);
    const title = encodeURIComponent(document.title);
    window.open(`https://t.me/share/url?url=${url}&text=${title}`, '_blank');
  };

  window.shareToThreads = function() {
    const url = encodeURIComponent(window.location.href);
    const title = encodeURIComponent(document.title);
    window.open(`https://www.threads.net/intent/post?text=${title}%20${url}`, '_blank');
  };

  window.copyPageLink = function() {
    if (navigator.clipboard) {
      navigator.clipboard.writeText(window.location.href).then(() => {
        showToast('Tautan tersalin ke papan klip!');
      }).catch(() => {
        promptShare();
      });
    } else {
      promptShare();
    }
  };

  function promptShare() {
    prompt('Salin tautan ini untuk membagikan artikel:', window.location.href);
  }

  // ═══════════════════════════════════════════════════════════
  // 5. VIDEO EPISODE PLAYLIST SWITCHER (FOR VIDEO TYPE)
  // ═══════════════════════════════════════════════════════════
  const episodeCards = document.querySelectorAll('.episode-card');
  const videoPlayerIframe = document.getElementById('activeVideoPlayer');
  const activeVideoTitle = document.getElementById('activeVideoTitle');

  episodeCards.forEach(card => {
    card.addEventListener('click', () => {
      episodeCards.forEach(c => c.classList.remove('active'));
      card.classList.add('active');

      const epNum = card.getAttribute('data-ep-num');
      const epTitle = card.getAttribute('data-ep-title');
      const videoId = card.getAttribute('data-video-id');

      if (activeVideoTitle) {
        activeVideoTitle.textContent = `SANG EP.0${epNum} - ${epTitle}`;
      }

      if (videoPlayerIframe && videoId) {
        videoPlayerIframe.src = `https://www.youtube-nocookie.com/embed/${videoId}?autoplay=1&rel=0`;
      }

      showToast(`Memutar Episode ${epNum}: ${epTitle}`);

      const playerSection = document.querySelector('.detail-hero-media');
      if (playerSection) {
        playerSection.scrollIntoView({ behavior: 'smooth', block: 'center' });
      }
    });
  });

  // ═══════════════════════════════════════════════════════════
  // 6. KOMENTAR POSTING (HANYA AKTIF UNTUK PENGGUNA YANG LOGIN)
  // ═══════════════════════════════════════════════════════════
  const commentInput = document.getElementById('commentInput');
  const btnSendComment = document.getElementById('btnSendComment');
  const commentsListWrap = document.getElementById('commentsListWrap');

  function postComment() {
    if (!commentInput) return;
    const text = commentInput.value.trim();
    if (!text) {
      alert('Silakan tuliskan komentar Anda terlebih dahulu.');
      commentInput.focus();
      return;
    }

    const authorName = commentInput.getAttribute('data-user-name') || 'Ayah & Bunda';

    const newBubble = document.createElement('div');
    newBubble.className = 'comment-bubble';
    newBubble.innerHTML = `
      <div class="comment-bubble-head">
        <span class="comment-author-name">${escapeHtml(authorName)} (Anda)</span>
        <span class="comment-time">Baru saja</span>
      </div>
      <div class="comment-bubble-body">
        ${escapeHtml(text)}
      </div>
    `;

    if (commentsListWrap) {
      commentsListWrap.prepend(newBubble);
    }

    commentInput.value = '';
    showToast('Komentar Anda berhasil dikirim!');
  }

  if (btnSendComment) {
    btnSendComment.addEventListener('click', postComment);
  }

  if (commentInput) {
    commentInput.addEventListener('keydown', (e) => {
      if (e.key === 'Enter') {
        e.preventDefault();
        postComment();
      }
    });
  }

  function escapeHtml(string) {
    const p = document.createElement('p');
    p.textContent = string;
    return p.innerHTML;
  }

  // Toast Helper
  function showToast(msg) {
    let container = document.getElementById('artToastContainer');
    if (!container) {
      container = document.createElement('div');
      container.id = 'artToastContainer';
      container.className = 'art-toast-container';
      document.body.appendChild(container);
    }
    const t = document.createElement('div');
    t.className = 'art-toast';
    t.innerHTML = `<span>${msg}</span>`;
    container.appendChild(t);
    setTimeout(() => {
      if (t.parentNode) t.parentNode.removeChild(t);
    }, 2800);
  }
});

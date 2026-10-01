<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="profile-page-wrapper" style="background-color: #FFFDF8; background-image: radial-gradient(#F97316 1px, transparent 1px); background-size: 32px 32px; min-height: 85vh; padding: 40px 20px 60px;">
    <div style="max-width: 680px; margin: 0 auto;">

        <!-- Flash Messages -->
        <?php if (session()->getFlashdata('success')): ?>
            <div style="background: #F0FDF4; border: 1px solid #BBF7D0; color: #166534; padding: 14px 18px; border-radius: 14px; margin-bottom: 24px; display: flex; align-items: center; gap: 10px; font-weight: 600; font-size: 14px; box-shadow: 0 4px 12px rgba(22, 101, 52, 0.08);">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                <span><?= esc(session()->getFlashdata('success')) ?></span>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div style="background: #FEF2F2; border: 1px solid #FECACA; color: #991B1B; padding: 14px 18px; border-radius: 14px; margin-bottom: 24px; display: flex; align-items: center; gap: 10px; font-weight: 600; font-size: 14px; box-shadow: 0 4px 12px rgba(153, 27, 27, 0.08);">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                <span><?= esc(session()->getFlashdata('error')) ?></span>
            </div>
        <?php endif; ?>

        <!-- Main Card -->
        <div style="background: #FFFFFF; border-radius: 24px; border: 1px solid rgba(233, 139, 80, 0.2); box-shadow: 0 12px 36px rgba(67, 20, 7, 0.08); overflow: hidden;">
            
            <form action="<?= base_url('profile') ?>" method="post" enctype="multipart/form-data">

                <!-- Card Header Banner -->
                <div style="background: linear-gradient(135deg, #7A2824 0%, #C85A54 100%); padding: 36px 28px; color: #ffffff; position: relative;">
                    <div style="display: flex; align-items: center; gap: 24px; flex-wrap: wrap;">
                        
                        <!-- Avatar Container with Upload Camera Overlay -->
                        <div style="position: relative; width: 84px; height: 84px; flex-shrink: 0;">
                            <?php 
                                $userAvatar = $user['avatar'] ?? session()->get('user_avatar') ?? null;
                            ?>
                            <div id="avatarPreviewBox" style="width: 84px; height: 84px; border-radius: 50%; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(8px); display: flex; align-items: center; justify-content: center; border: 3px solid rgba(255, 255, 255, 0.5); box-shadow: 0 6px 16px rgba(0,0,0,0.2); overflow: hidden;">
                                <?php if ($userAvatar && file_exists(FCPATH . $userAvatar)): ?>
                                    <img id="avatarImage" src="<?= base_url($userAvatar) ?>" alt="Foto Profil" style="width: 100%; height: 100%; object-fit: cover;">
                                <?php else: ?>
                                    <img id="avatarImage" src="" alt="Foto Profil" style="width: 100%; height: 100%; object-fit: cover; display: none;">
                                    <span id="avatarFallbackSvg">
                                        <svg width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                            <circle cx="12" cy="7" r="4" />
                                        </svg>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <!-- Tombol Unggah Foto Kamera -->
                            <label for="avatarInput" title="Unggah / Ubah Foto Profil" style="position: absolute; bottom: 0; right: 0; background: #F97316; color: #ffffff; width: 28px; height: 28px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; border: 2px solid #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.25); transition: transform 0.2s ease;" onmouseover="this.style.transform='scale(1.15)';" onmouseout="this.style.transform='scale(1)';">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                                    <circle cx="12" cy="13" r="4"></circle>
                                </svg>
                            </label>
                            <input type="file" name="avatar" id="avatarInput" accept="image/png, image/jpeg, image/webp" style="display: none;" onchange="previewAvatar(event)">
                        </div>

                        <div>
                            <span style="display: inline-block; background: rgba(255,255,255,0.22); backdrop-filter: blur(4px); padding: 3px 10px; border-radius: 20px; font-size: 11.5px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;">
                                <?= ($user['role'] ?? 'user') === 'admin' ? '🛡️ Administrator' : '🏡 Akun Keluarga Parentela' ?>
                            </span>
                            <h1 style="font-family: 'Playfair Display', serif; font-size: 24px; font-weight: 700; margin: 0; line-height: 1.2;">
                                <?= esc($user['name'] ?? session()->get('user_name') ?? 'Keluarga Parentela') ?>
                            </h1>
                            <p style="font-size: 13px; opacity: 0.92; margin: 4px 0 0; font-family: monospace;">
                                ✉️ <?= esc($maskedEmail ?? '') ?>
                            </p>
                            <small style="display: block; font-size: 11px; opacity: 0.75; margin-top: 2px;">
                                Klik ikon kamera untuk memilih foto profil baru
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Form Body -->
                <div style="padding: 32px 28px;">
                    
                    <!-- Section 1: Data Profil Utama -->
                    <div style="margin-bottom: 24px;">
                        <h3 style="font-size: 15px; font-weight: 700; color: #7A2824; border-bottom: 2px solid #F5ECE8; padding-bottom: 8px; margin-bottom: 16px; font-family: 'Playfair Display', serif;">
                            📋 Informasi Profil
                        </h3>

                        <div style="margin-bottom: 18px;">
                            <label style="display: block; font-size: 13.5px; font-weight: 700; color: #431407; margin-bottom: 8px;">
                                Nama Profil (Nama Lengkap / Nama Panggilan) <span style="color: #DC2626;">*</span>
                            </label>
                            <input type="text" name="name" required value="<?= esc($user['name'] ?? session()->get('user_name') ?? '') ?>" placeholder="Masukkan nama profil Anda..." style="width: 100%; padding: 12px 16px; border: 1.5px solid #E2E8F0; border-radius: 12px; font-size: 14px; font-family: 'Outfit', sans-serif; color: #291F1E; background: #FFFDF8; box-sizing: border-box;" onfocus="this.style.borderColor='#BC4F4F'; this.style.boxShadow='0 0 0 3px rgba(188,79,79,0.15)';" onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none';">
                            <small style="display: block; color: #8C786E; font-size: 12px; margin-top: 6px;">
                                Nama ini akan ditampilkan pada header profil, artikel, dan ucapan selamat datang.
                            </small>
                        </div>

                        <div>
                            <label style="display: block; font-size: 13.5px; font-weight: 700; color: #431407; margin-bottom: 8px;">
                                Alamat Email (Terproteksi / Disensor) 🔒
                            </label>
                            <input type="text" value="<?= esc($maskedEmail ?? '') ?>" disabled style="width: 100%; padding: 12px 16px; border: 1.5px solid #E2E8F0; border-radius: 12px; font-size: 14px; font-family: monospace; color: #64748B; background: #F8FAFC; box-sizing: border-box; cursor: not-allowed; font-weight: 600;">
                            <small style="display: block; color: #94A3B8; font-size: 11.5px; margin-top: 4px;">
                                Alamat email disensor demi privasi dan keamanan akun Anda.
                            </small>
                        </div>
                    </div>

                    <!-- Section 2: Ganti Kata Sandi Keamanan -->
                    <div style="margin-bottom: 28px; background: #FFF7ED; padding: 20px; border-radius: 16px; border: 1px solid #FFEDD5;">
                        <h3 style="font-size: 15px; font-weight: 700; color: #C2410C; margin-bottom: 6px; font-family: 'Playfair Display', serif;">
                            🔑 Ubah Kata Sandi
                        </h3>
                        <p style="font-size: 12px; color: #9A3412; margin-bottom: 16px;">
                            Kosongkan ketiga bidang di bawah jika Anda tidak ingin mengubah kata sandi akun.
                        </p>

                        <div style="margin-bottom: 14px;">
                            <label style="display: block; font-size: 13px; font-weight: 700; color: #431407; margin-bottom: 6px;">
                                Kata Sandi Lama
                            </label>
                            <input type="password" name="old_password" placeholder="Masukkan kata sandi lama Anda" style="width: 100%; padding: 11px 14px; border: 1.5px solid #CBD5E1; border-radius: 10px; font-size: 13.5px; font-family: 'Outfit', sans-serif; background: #FFFFFF; box-sizing: border-box;" onfocus="this.style.borderColor='#C2410C';" onblur="this.style.borderColor='#CBD5E1';">
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                            <div>
                                <label style="display: block; font-size: 13px; font-weight: 700; color: #431407; margin-bottom: 6px;">
                                    Kata Sandi Baru
                                </label>
                                <input type="password" name="new_password" placeholder="Minimal 6 karakter" style="width: 100%; padding: 11px 14px; border: 1.5px solid #CBD5E1; border-radius: 10px; font-size: 13.5px; font-family: 'Outfit', sans-serif; background: #FFFFFF; box-sizing: border-box;" onfocus="this.style.borderColor='#C2410C';" onblur="this.style.borderColor='#CBD5E1';">
                            </div>
                            <div>
                                <label style="display: block; font-size: 13px; font-weight: 700; color: #431407; margin-bottom: 6px;">
                                    Konfirmasi Kata Sandi Baru
                                </label>
                                <input type="password" name="confirm_password" placeholder="Ketik ulang kata sandi baru" style="width: 100%; padding: 11px 14px; border: 1.5px solid #CBD5E1; border-radius: 10px; font-size: 13.5px; font-family: 'Outfit', sans-serif; background: #FFFFFF; box-sizing: border-box;" onfocus="this.style.borderColor='#C2410C';" onblur="this.style.borderColor='#CBD5E1';">
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div style="display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;">
                        <a href="<?= base_url('/') ?>" style="display: inline-flex; align-items: center; gap: 6px; color: #8C786E; text-decoration: none; font-size: 13.5px; font-weight: 600;">
                            ← Kembali ke Beranda
                        </a>
                        <button type="submit" style="background: linear-gradient(135deg, #BC4F4F 0%, #E98B50 100%); color: #ffffff; border: none; padding: 13px 32px; border-radius: 30px; font-size: 14.5px; font-weight: 700; font-family: 'Outfit', sans-serif; cursor: pointer; box-shadow: 0 4px 14px rgba(188, 79, 79, 0.3); transition: all 0.2s ease;">
                            Simpan Perubahan Profil
                        </button>
                    </div>

                </div>
            </form>
        </div>

    </div>
</div>

<script>
    function previewAvatar(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('avatarImage');
                const svg = document.getElementById('avatarFallbackSvg');
                if (img) {
                    img.src = e.target.result;
                    img.style.display = 'block';
                }
                if (svg) {
                    svg.style.display = 'none';
                }
            };
            reader.readAsDataURL(file);
        }
    }
</script>

<?= $this->endSection() ?>

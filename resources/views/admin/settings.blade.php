@extends('layouts.admin')

@section('title', 'Pengaturan Admin')
@section('page-heading', 'Pengaturan Akun')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css">
<style>
.settings-page{max-width:1160px;margin:0 auto}.settings-heading{display:flex;align-items:flex-end;justify-content:space-between;gap:20px;margin:4px 0 25px}.settings-heading .heading-kicker{display:inline-flex;align-items:center;gap:7px;margin-bottom:9px;color:#315fc4;font-size:10px;font-weight:800;letter-spacing:1.5px;text-transform:uppercase}.settings-heading .heading-kicker:before{content:"";width:22px;height:2px;background:#315fc4}.settings-heading h1{margin:0;color:#14284f;font-size:27px;font-weight:800;letter-spacing:-.8px}.settings-heading p{margin:8px 0 0;color:#718096;font-size:12px;line-height:1.7}.settings-heading-mark{color:#c4d2e8;font-size:42px;font-weight:300;line-height:1}
.settings-alert{display:flex;gap:10px;align-items:flex-start;padding:13px 15px;margin:0 0 17px;border-radius:11px;font-size:12px;line-height:1.6}.settings-alert strong{display:block;margin-bottom:3px}.settings-success{background:#effaf4;border:1px solid #ccebd8;color:#17643a}.settings-error{background:#fff5f5;border:1px solid #f4d0d0;color:#a12d35}.settings-error ul{margin:5px 0 0;padding-left:18px}
.settings-layout{display:grid;grid-template-columns:290px minmax(0,1fr);gap:20px;align-items:start}.settings-aside{position:sticky;top:18px;overflow:hidden;border-radius:18px;background:#142b56;color:#fff;box-shadow:0 14px 35px rgba(20,43,86,.12)}.settings-aside-top{position:relative;min-height:178px;padding:22px;background:radial-gradient(circle at 90% 0%,rgba(113,157,235,.35),transparent 38%),linear-gradient(145deg,#1c3b73,#10244b)}.settings-aside-top:after{content:"";position:absolute;right:-42px;bottom:-86px;width:190px;height:190px;border:1px solid rgba(255,255,255,.12);border-radius:50%;box-shadow:0 0 0 22px rgba(255,255,255,.035),0 0 0 45px rgba(255,255,255,.025)}.settings-aside-label{position:relative;z-index:1;color:#b8c9e8;font-size:9px;font-weight:800;letter-spacing:1.6px;text-transform:uppercase}.settings-aside-profile{position:relative;z-index:1;display:flex;align-items:center;gap:13px;margin-top:23px}.settings-avatar-wrap{position:relative;width:76px;height:76px;flex:0 0 76px;padding:4px;border:1px solid rgba(255,255,255,.38);border-radius:50%;background:rgba(255,255,255,.12)}.settings-avatar{display:block;width:100%;height:100%;object-fit:cover;border-radius:50%;background:#eaf0fa}.settings-avatar-status{position:absolute;right:2px;bottom:3px;width:15px;height:15px;border:3px solid #1b3a70;border-radius:50%;background:#42c58a}.settings-profile-copy{min-width:0}.settings-profile-copy strong{display:block;overflow:hidden;color:#fff;font-size:15px;font-weight:750;text-overflow:ellipsis;white-space:nowrap}.settings-profile-copy span{display:block;margin-top:5px;color:#c1d0e8;font-size:10px}.settings-aside-bottom{position:relative;z-index:1;padding:18px 20px 20px}.settings-upload-button{display:inline-flex;align-items:center;gap:8px;padding:9px 13px;border:1px solid rgba(255,255,255,.25);border-radius:9px;background:rgba(255,255,255,.1);color:#fff;font-size:11px;font-weight:700;cursor:pointer;transition:.18s}.settings-upload-button:hover{background:rgba(255,255,255,.2);border-color:rgba(255,255,255,.5)}.settings-upload-button svg{width:15px;height:15px;fill:none;stroke:currentColor;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}.settings-file-name{display:block;margin-top:9px;color:#b8c9e8;font-size:10px;line-height:1.5;overflow-wrap:anywhere}.settings-file-input{position:absolute!important;width:1px!important;height:1px!important;padding:0!important;margin:-1px!important;overflow:hidden!important;clip:rect(0,0,0,0)!important;white-space:nowrap!important;border:0!important}.settings-photo-tip{display:flex;gap:9px;margin-top:20px;padding-top:16px;border-top:1px solid rgba(255,255,255,.14);color:#b8c9e8;font-size:10px;line-height:1.6}.settings-photo-tip b{color:#fff;font-weight:700}
.settings-main{min-width:0}.settings-panel{margin-bottom:17px;padding:22px 23px;border:1px solid #e3eaf4;border-radius:15px;background:#fff;box-shadow:0 7px 22px rgba(23,45,82,.035)}.settings-panel-head{display:flex;align-items:flex-start;justify-content:space-between;gap:15px;margin-bottom:21px}.settings-panel-title{display:flex;align-items:center;gap:12px}.settings-panel-icon{display:grid;place-items:center;width:39px;height:39px;flex:0 0 39px;border-radius:12px;background:#edf3ff;color:#2856ad}.settings-panel-icon svg{width:19px;height:19px;fill:none;stroke:currentColor;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}.settings-panel-head h2{margin:0;color:#172b50;font-size:14px;font-weight:750}.settings-panel-head p{margin:5px 0 0;color:#8492a8;font-size:10px;line-height:1.5}.settings-panel-index{color:#d1dced;font-size:11px;font-weight:800;letter-spacing:1px}
.settings-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:17px}.settings-field{min-width:0}.settings-field.full{grid-column:1/-1}.settings-field label{display:block;margin:0 0 7px;color:#33445f;font-size:11px;font-weight:700}.settings-field input{display:block;width:100%;min-height:43px;padding:10px 12px;border:1px solid #dce4ef;border-radius:9px;background:#fbfcfe;color:#1e293b;font:inherit;font-size:12px;transition:border-color .15s,box-shadow .15s,background .15s}.settings-field input:focus{outline:none;border-color:#4773c5;background:#fff;box-shadow:0 0 0 3px rgba(55,102,189,.1)}.settings-field small{display:block;margin-top:7px;color:#8795a9;font-size:10px;line-height:1.55}.settings-password-note{display:flex;gap:9px;align-items:flex-start;margin:0 0 17px;padding:11px 12px;border-radius:9px;background:#f5f8fd;color:#70819b;font-size:10px;line-height:1.6}.settings-submit-row{display:flex;align-items:center;justify-content:space-between;gap:15px;margin-top:5px;padding:16px 0 0;border-top:1px solid #e8edf5}.settings-submit-note{color:#8795a9;font-size:10px;line-height:1.5}.settings-submit{display:inline-flex;align-items:center;justify-content:center;gap:9px;min-height:42px;padding:0 19px;border:0;border-radius:9px;background:#2452a8;color:#fff;font:inherit;font-size:11px;font-weight:750;cursor:pointer;box-shadow:0 5px 12px rgba(36,82,168,.17);transition:background .15s,transform .15s}.settings-submit:hover{background:#193f8c;transform:translateY(-1px)}.settings-submit svg{width:15px;height:15px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
.crop-modal{position:fixed;inset:0;z-index:9999;display:none;align-items:center;justify-content:center;padding:20px;background:rgba(15,23,42,.66);backdrop-filter:blur(4px)}.crop-modal.is-open{display:flex}.crop-dialog{width:min(100%,620px);max-height:calc(100vh - 40px);overflow:auto;border-radius:16px;background:#fff;box-shadow:0 24px 70px rgba(0,0,0,.25)}.crop-dialog-head{display:flex;align-items:flex-start;justify-content:space-between;gap:15px;padding:19px 22px;border-bottom:1px solid #edf0f5}.crop-dialog-head h3{margin:0;color:#172554;font-size:15px;font-weight:750}.crop-dialog-head p{margin:5px 0 0;color:#718096;font-size:11px;line-height:1.5}.crop-close{width:32px;height:32px;border:0;border-radius:8px;background:#f1f5f9;color:#475569;font-size:20px;cursor:pointer}.crop-workspace{height:360px;margin:18px 22px 12px;overflow:hidden;background:#f1f4f8;border-radius:10px}.crop-workspace img{display:block;max-width:100%;max-height:100%}.crop-hint{margin:0 22px;color:#718096;font-size:11px;line-height:1.6}.crop-dialog-actions{display:flex;justify-content:flex-end;gap:9px;padding:17px 22px 20px}.crop-action{min-height:38px;padding:0 15px;border:1px solid #dbe2ec;border-radius:8px;background:#fff;color:#475569;font:inherit;font-size:12px;font-weight:650;cursor:pointer}.crop-action.primary{border-color:#234da7;background:#234da7;color:#fff}.crop-action:disabled{opacity:.55;cursor:not-allowed}.cropper-view-box,.cropper-face{border-radius:50%}.cropper-view-box{outline:2px solid #fff;box-shadow:0 0 0 1px rgba(35,77,167,.5)}
@media(max-width:850px){.settings-layout{grid-template-columns:250px minmax(0,1fr);gap:14px}.settings-panel{padding:19px}}@media(max-width:680px){.settings-heading{align-items:flex-start}.settings-heading-mark{display:none}.settings-heading h1{font-size:23px}.settings-layout{grid-template-columns:1fr}.settings-aside{position:relative;top:auto}.settings-aside-top{min-height:150px}.settings-aside-profile{margin-top:17px}.settings-grid{grid-template-columns:1fr;gap:14px}.settings-field.full{grid-column:auto}.settings-panel{padding:17px}.settings-submit-row{align-items:stretch;flex-direction:column}.settings-submit{width:100%}.crop-modal{padding:10px}.crop-dialog{max-height:calc(100vh - 20px)}.crop-workspace{height:300px;margin:14px}.crop-dialog-head{padding:16px}.crop-dialog-actions{padding:14px}.crop-hint{margin:0 14px}}
</style>
@endpush

@section('content')
<div class="settings-page">
    <div class="settings-heading">
        <h1>Pengaturan Akun Admin</h1>
        <p>Perbarui informasi profil dan keamanan akun administrator GUSPELOR.NET.</p>
    </div>

    @if (session('success'))
        <div class="settings-alert settings-success" role="status">
            <span aria-hidden="true">✓</span>
            <div><strong>Perubahan berhasil disimpan</strong>{{ session('success') }}</div>
        </div>
    @endif

    @if ($errors->any())
        <div class="settings-alert settings-error" role="alert">
            <span aria-hidden="true">!</span>
            <div>
                <strong>Periksa kembali data yang dimasukkan.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="settings-layout">
            <aside class="settings-aside">
                <div class="settings-aside-top">
                    <div class="settings-aside-label">Administrator profile</div>
                    <div class="settings-aside-profile">
                        <div class="settings-avatar-wrap">
                            <img id="profilePhotoPreview" class="settings-avatar" src="{{ $admin->foto_profil ? asset('storage/'.$admin->foto_profil) : asset('images/logo.png') }}" alt="Preview foto profil admin">
                            <span class="settings-avatar-status" aria-hidden="true"></span>
                        </div>
                        <div class="settings-profile-copy">
                            <strong>{{ old('nama_akun', $admin->nama_akun ?? 'Administrator') }}</strong>
                            <span>Administrator GUSPELOR.NET</span>
                        </div>
                    </div>
                </div>
                <div class="settings-aside-bottom">
                    <label class="settings-upload-button" for="foto_profil">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 16V4m-4 4 4-4 4 4"/><path d="M4 16v3a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-3"/></svg>
                        Ganti Foto Profil
                    </label>
                    <span class="settings-file-name" id="profilePhotoName">Belum ada foto baru dipilih</span>
                    <input id="foto_profil" class="settings-file-input" type="file" name="foto_profil" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" aria-label="Pilih foto profil">
                    <div class="settings-photo-tip"><span aria-hidden="true">✦</span><div><b>Tips foto profil</b><br>Gunakan foto yang jelas. Kamu bisa mengatur posisi dan memangkas foto sebelum menyimpannya.</div></div>
                </div>
            </aside>
            <div class="settings-main">
                <section class="settings-panel">
                    <div class="settings-panel-head">
                        <div class="settings-panel-title">
                            <span class="settings-panel-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></svg></span>
                            <div><h2>Informasi Akun</h2><p>Atur nama dan alamat email yang terhubung dengan akun.</p></div>
                        </div>
                        <span class="settings-panel-index">01 / PROFILE</span>
                    </div>
                    <div class="settings-grid">
                        <div class="settings-field">
                            <label for="nama_akun">Nama akun admin</label>
                            <input id="nama_akun" type="text" name="nama_akun" value="{{ old('nama_akun', $admin->nama_akun ?? 'Admin') }}" maxlength="100" autocomplete="name" required>
                        </div>
                        <div class="settings-field">
                            <label for="email">Email admin</label>
                            <input id="email" type="email" name="email" value="{{ old('email', $admin->email) }}" maxlength="255" autocomplete="email" required>
                        </div>
                    </div>
                </section>
                <section class="settings-panel">
                    <div class="settings-panel-head">
                        <div class="settings-panel-title">
                            <span class="settings-panel-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="4" y="10" width="16" height="11" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3m-4 5v2"/></svg></span>
                            <div><h2>Keamanan & Password</h2><p>Perbarui password untuk menjaga keamanan akun admin.</p></div>
                        </div>
                        <span class="settings-panel-index">02 / SECURITY</span>
                    </div>
                    <div class="settings-password-note"><span aria-hidden="true">ⓘ</span><span>Password saat ini wajib diisi untuk memverifikasi perubahan. Password baru boleh dikosongkan jika tidak ingin menggantinya.</span></div>
                    <div class="settings-grid">
                        <div class="settings-field full">
                            <label for="current_password">Password saat ini <span aria-hidden="true">*</span></label>
                            <input id="current_password" type="password" name="current_password" autocomplete="current-password" required>
                        </div>
                        <div class="settings-field">
                            <label for="password">Password baru</label>
                            <input id="password" type="password" name="password" minlength="8" autocomplete="new-password">
                            <small>Minimal 8 karakter. Kosongkan jika tidak ingin mengganti password.</small>
                        </div>
                        <div class="settings-field">
                            <label for="password_confirmation">Konfirmasi password baru</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" minlength="8" autocomplete="new-password">
                            <small>Masukkan ulang password baru untuk konfirmasi.</small>
                        </div>
                    </div>
                </section>
                <div class="settings-submit-row">
                    <span class="settings-submit-note">Pastikan informasi akun sudah benar sebelum disimpan.</span>
                    <button type="submit" class="settings-submit">Simpan Perubahan <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></button>
                </div>
            </div>
        </div>
    </form>
</div>


<div class="crop-modal" id="profileCropModal" aria-hidden="true">
    <div class="crop-dialog" role="dialog" aria-modal="true" aria-labelledby="cropDialogTitle">
        <div class="crop-dialog-head">
            <div>
                <h3 id="cropDialogTitle">Atur Foto Profil</h3>
                <p>Geser foto untuk mengatur posisi. Area lingkaran menunjukkan bagian foto yang akan digunakan.</p>
            </div>
            <button type="button" class="crop-close" id="cancelCropTop" aria-label="Tutup">×</button>
        </div>
        <div class="crop-workspace">
            <img id="profileCropImage" alt="Foto yang akan dipangkas">
        </div>
        <p class="crop-hint">Gunakan scroll atau gerakan pinch untuk memperbesar dan memperkecil foto. Hasil akhir berbentuk persegi dan ditampilkan bulat sebagai foto profil.</p>
        <div class="crop-dialog-actions">
            <button type="button" class="crop-action" id="cancelCrop">Batal</button>
            <button type="button" class="crop-action primary" id="applyCrop">Gunakan Foto</button>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const photoInput = document.getElementById('foto_profil');
        const photoPreview = document.getElementById('profilePhotoPreview');
        const photoName = document.getElementById('profilePhotoName');
        const modal = document.getElementById('profileCropModal');
        const cropImage = document.getElementById('profileCropImage');
        const applyButton = document.getElementById('applyCrop');
        const cancelButton = document.getElementById('cancelCrop');
        const closeButton = document.getElementById('cancelCropTop');
        let cropper = null;
        let selectedFile = null;
        let sourceUrl = null;
        let previewUrl = null;

        if (!photoInput || !photoPreview || !photoName || !modal) return;

        function closeCropper(resetInput) {
            modal.classList.remove('is-open');
            modal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
            if (sourceUrl) {
                URL.revokeObjectURL(sourceUrl);
                sourceUrl = null;
            }
            if (resetInput) {
                photoInput.value = '';
                selectedFile = null;
                photoName.textContent = 'Belum ada foto baru dipilih';
            }
        }

        function openCropper(file) {
            selectedFile = file;
            sourceUrl = URL.createObjectURL(file);
            cropImage.src = sourceUrl;
            modal.classList.add('is-open');
            modal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';

            cropImage.onload = function () {
                if (cropper) cropper.destroy();
                cropper = new Cropper(cropImage, {
                    aspectRatio: 1,
                    viewMode: 1,
                    dragMode: 'move',
                    autoCropArea: 1,
                    responsive: true,
                    background: false,
                    guides: false,
                    center: true,
                    highlight: false,
                    cropBoxMovable: false,
                    cropBoxResizable: false,
                    toggleDragModeOnDblclick: false,
                    zoomable: true,
                    scalable: true,
                    rotatable: false,
                    minContainerWidth: 240,
                    minContainerHeight: 240
                });
            };
        }

        photoInput.addEventListener('change', function () {
            const file = this.files && this.files[0];
            if (!file) return;

            const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
            if (!allowedTypes.includes(file.type)) {
                this.value = '';
                photoName.textContent = 'Format file tidak didukung';
                return;
            }

            if (file.size > 2 * 1024 * 1024) {
                this.value = '';
                photoName.textContent = 'Ukuran foto melebihi 2 MB';
                return;
            }

            if (typeof Cropper === 'undefined') {
                photoName.textContent = 'Fitur pangkas gagal dimuat. Periksa koneksi internet.';
                this.value = '';
                return;
            }

            openCropper(file);
        });

        applyButton.addEventListener('click', function () {
            if (!cropper || !selectedFile) return;

            applyButton.disabled = true;
            const canvas = cropper.getCroppedCanvas({
                width: 512,
                height: 512,
                imageSmoothingEnabled: true,
                imageSmoothingQuality: 'high'
            });

            canvas.toBlob(function (blob) {
                applyButton.disabled = false;
                if (!blob) {
                    photoName.textContent = 'Foto gagal diproses. Silakan coba lagi.';
                    return;
                }

                const baseName = selectedFile.name.replace(/\\.[^.]+$/, '') || 'foto-profil';
                const croppedFile = new File([blob], baseName + '-crop.jpg', {
                    type: 'image/jpeg',
                    lastModified: Date.now()
                });

                const transfer = new DataTransfer();
                transfer.items.add(croppedFile);
                photoInput.files = transfer.files;

                if (previewUrl) URL.revokeObjectURL(previewUrl);
                previewUrl = URL.createObjectURL(croppedFile);
                photoPreview.src = previewUrl;
                photoName.textContent = croppedFile.name + ' · sudah dipangkas';
                closeCropper(false);
                selectedFile = null;
            }, 'image/jpeg', 0.92);
        });

        function cancelSelection() {
            closeCropper(true);
        }

        cancelButton.addEventListener('click', cancelSelection);
        closeButton.addEventListener('click', cancelSelection);
        modal.addEventListener('click', function (event) {
            if (event.target === modal) cancelSelection();
        });
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && modal.classList.contains('is-open')) {
                cancelSelection();
            }
        });
    });
</script>
@endpush
@endsection

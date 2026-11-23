@extends('layouts.admin')

@section('title', 'Pengaturan Admin')
@section('page-heading', 'Pengaturan Akun')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css">
<style>
    .settings-page{max-width:1040px}
    .settings-heading{margin-bottom:24px}
    .settings-heading h1{margin:0;color:#172554;font-size:23px;font-weight:750;letter-spacing:-.5px}
    .settings-heading p{margin:7px 0 0;color:#64748b;font-size:13px;line-height:1.65}
    .settings-alert{display:flex;gap:10px;align-items:flex-start;padding:14px 16px;margin:0 0 18px;border-radius:10px;font-size:13px;line-height:1.6}
    .settings-alert strong{display:block;margin-bottom:3px}
    .settings-success{background:#effaf4;border:1px solid #ccebd8;color:#17643a}
    .settings-error{background:#fff5f5;border:1px solid #f4d0d0;color:#a12d35}
    .settings-error ul{margin:5px 0 0;padding-left:18px}
    .settings-card{background:#fff;border:1px solid #e5eaf2;border-radius:14px;box-shadow:0 4px 14px rgba(15,23,42,.025);overflow:hidden;margin-bottom:18px}
    .settings-card-head{display:flex;align-items:center;gap:12px;padding:20px 22px;border-bottom:1px solid #edf0f5}
    .settings-icon{width:38px;height:38px;display:grid;place-items:center;flex:0 0 38px;border-radius:10px;background:#edf3ff;color:#234da7}
    .settings-icon svg{width:19px;height:19px;fill:none;stroke:currentColor;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
    .settings-card-head h2{margin:0;color:#172554;font-size:14px;font-weight:700}
    .settings-card-head p{margin:4px 0 0;color:#718096;font-size:11px;line-height:1.5}
    .settings-card-body{padding:22px}
    .settings-profile{display:flex;align-items:center;gap:22px;padding:2px 0 23px;margin-bottom:21px;border-bottom:1px solid #edf0f5}
    .settings-avatar-wrap{position:relative;width:112px;height:112px;flex:0 0 112px;padding:5px;border:1px solid #dce5f3;border-radius:50%;background:#f7f9fd}
    .settings-avatar{display:block;width:100%;height:100%;object-fit:cover;border-radius:50%;background:#eaf0fa}
    .settings-avatar-status{position:absolute;right:5px;bottom:5px;width:19px;height:19px;border:3px solid #fff;border-radius:50%;background:#22a06b}
    .settings-profile-copy{min-width:0}
    .settings-profile-copy strong{display:block;color:#1e293b;font-size:14px;font-weight:700}
    .settings-profile-copy span{display:block;margin-top:5px;color:#718096;font-size:11px;line-height:1.6}
    .settings-upload{display:flex;flex-wrap:wrap;align-items:center;gap:9px;margin-top:13px}
    .settings-upload-button{display:inline-flex;align-items:center;gap:7px;padding:9px 13px;border:1px solid #d6e0f0;border-radius:8px;background:#fff;color:#234da7;font-size:11px;font-weight:700;cursor:pointer;transition:.15s}
    .settings-upload-button:hover{background:#f1f5fc;border-color:#9db4dc}
    .settings-upload-button svg{width:15px;height:15px;fill:none;stroke:currentColor;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
    .settings-file-name{color:#8290a3;font-size:10px;overflow-wrap:anywhere}
    .settings-file-input{position:absolute!important;width:1px!important;height:1px!important;padding:0!important;margin:-1px!important;overflow:hidden!important;clip:rect(0,0,0,0)!important;white-space:nowrap!important;border:0!important}
    .settings-upload-button:focus-within{outline:3px solid rgba(49,95,196,.18);outline-offset:2px}
    .settings-field .settings-upload-help{margin-top:8px}
    .settings-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px}
    .settings-field{min-width:0}
    .settings-field.full{grid-column:1/-1}
    .settings-field label{display:block;margin:0 0 7px;color:#334155;font-size:12px;font-weight:650}
    .settings-field input{display:block;width:100%;min-height:42px;padding:10px 12px;border:1px solid #dbe2ec;border-radius:8px;background:#fff;color:#1e293b;font:inherit;font-size:12px;transition:border-color .15s,box-shadow .15s}
    .settings-field input:focus{outline:none;border-color:#3766bd;box-shadow:0 0 0 3px rgba(55,102,189,.1)}
    .settings-field input[type=file]{padding:8px;background:#fbfcfe}
    .settings-field small{display:block;margin-top:6px;color:#8290a3;font-size:10px;line-height:1.55}
    .settings-password-note{margin:0 0 18px;padding:11px 13px;border-radius:8px;background:#f7f9fc;color:#64748b;font-size:11px;line-height:1.6}
    .settings-actions{display:flex;justify-content:flex-end;align-items:center;gap:10px;padding:17px 22px;border-top:1px solid #edf0f5;background:#fcfdff}
    .settings-submit{display:inline-flex;align-items:center;justify-content:center;gap:8px;min-height:39px;padding:0 16px;border:0;border-radius:8px;background:#234da7;color:#fff;font:inherit;font-size:12px;font-weight:650;cursor:pointer;transition:background .15s,transform .15s}
    .settings-submit:hover{background:#193d8e;transform:translateY(-1px)}
    .settings-submit:focus-visible{outline:3px solid rgba(49,95,196,.25);outline-offset:2px}

    .crop-modal{position:fixed;inset:0;z-index:9999;display:none;align-items:center;justify-content:center;padding:20px;background:rgba(15,23,42,.66);backdrop-filter:blur(4px)}
    .crop-modal.is-open{display:flex}
    .crop-dialog{width:min(100%,620px);max-height:calc(100vh - 40px);overflow:auto;border-radius:16px;background:#fff;box-shadow:0 24px 70px rgba(0,0,0,.25)}
    .crop-dialog-head{display:flex;align-items:flex-start;justify-content:space-between;gap:15px;padding:19px 22px;border-bottom:1px solid #edf0f5}
    .crop-dialog-head h3{margin:0;color:#172554;font-size:15px;font-weight:750}
    .crop-dialog-head p{margin:5px 0 0;color:#718096;font-size:11px;line-height:1.5}
    .crop-close{width:32px;height:32px;border:0;border-radius:8px;background:#f1f5f9;color:#475569;font-size:20px;cursor:pointer}
    .crop-workspace{height:360px;margin:18px 22px 12px;overflow:hidden;background:#f1f4f8;border-radius:10px}
    .crop-workspace img{display:block;max-width:100%;max-height:100%}
    .crop-hint{margin:0 22px;color:#718096;font-size:11px;line-height:1.6}
    .crop-dialog-actions{display:flex;justify-content:flex-end;gap:9px;padding:17px 22px 20px}
    .crop-action{min-height:38px;padding:0 15px;border:1px solid #dbe2ec;border-radius:8px;background:#fff;color:#475569;font:inherit;font-size:12px;font-weight:650;cursor:pointer}
    .crop-action.primary{border-color:#234da7;background:#234da7;color:#fff}
    .crop-action:disabled{opacity:.55;cursor:not-allowed}
    .cropper-view-box,.cropper-face{border-radius:50%}
    .cropper-view-box{outline:2px solid #fff;box-shadow:0 0 0 1px rgba(35,77,167,.5)}
    @media(max-width:640px){.crop-modal{padding:10px}.crop-dialog{max-height:calc(100vh - 20px)}.crop-workspace{height:300px;margin:14px}.crop-dialog-head{padding:16px}.crop-dialog-actions{padding:14px}.crop-hint{margin:0 14px}}
    @media(max-width:640px){.settings-page{width:100%}.settings-heading h1{font-size:21px}.settings-card-head{padding:16px}.settings-card-body{padding:17px}.settings-grid{grid-template-columns:1fr;gap:15px}.settings-field.full{grid-column:auto}.settings-actions{padding:14px 17px}.settings-submit{width:100%}.settings-profile{align-items:flex-start;gap:15px}.settings-avatar-wrap{width:88px;height:88px;flex-basis:88px}.settings-upload{align-items:flex-start;flex-direction:column}}
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

        <section class="settings-card">
            <div class="settings-card-head">
                <span class="settings-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></svg>
                </span>
                <div>
                    <h2>Informasi Profil</h2>
                    <p>Informasi dasar yang ditampilkan pada akun administrator.</p>
                </div>
            </div>

            <div class="settings-card-body">
                <div class="settings-profile">
                    <div class="settings-avatar-wrap">
                        <img
                            id="profilePhotoPreview"
                            class="settings-avatar"
                            src="{{ $admin->foto_profil ? asset('storage/'.$admin->foto_profil) : asset('images/logo.png') }}"
                            alt="Preview foto profil admin"
                        >
                        <span class="settings-avatar-status" aria-hidden="true"></span>
                    </div>
                    <div class="settings-profile-copy">
                        <strong>{{ old('nama_akun', $admin->nama_akun ?? 'Administrator') }}</strong>
                        <span>Foto ini akan digunakan sebagai foto profil akun administrator.</span>
                        <div class="settings-upload">
                            <label class="settings-upload-button" for="foto_profil">
                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 16V4m-4 4 4-4 4 4"/><path d="M4 16v3a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-3"/></svg>
                                Pilih Foto
                            </label>
                            <span class="settings-file-name" id="profilePhotoName">Belum ada foto baru dipilih</span>
                        </div>
                    </div>
                </div>

                <div class="settings-grid">
                    <div class="settings-field">
                        <label for="nama_akun">Nama akun admin</label>
                        <input
                            id="nama_akun"
                            type="text"
                            name="nama_akun"
                            value="{{ old('nama_akun', $admin->nama_akun ?? 'Admin') }}"
                            maxlength="100"
                            autocomplete="name"
                            required
                        >
                    </div>

                    <div class="settings-field">
                        <label for="email">Email admin</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email', $admin->email) }}"
                            maxlength="255"
                            autocomplete="email"
                            required
                        >
                    </div>

                    <div class="settings-field full">
                        <input
                            id="foto_profil"
                            class="settings-file-input"
                            type="file"
                            name="foto_profil"
                            accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                            aria-label="Pilih foto profil"
                        >
                        <small class="settings-upload-help">Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB. Foto akan langsung ditampilkan sebagai preview setelah dipilih.</small>
                    </div>
                </div>
            </div>
        </section>

        <section class="settings-card">
            <div class="settings-card-head">
                <span class="settings-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><rect x="4" y="10" width="16" height="11" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3m-4 5v2"/></svg>
                </span>
                <div>
                    <h2>Keamanan Akun</h2>
                    <p>Gunakan bagian ini jika ingin mengganti password administrator.</p>
                </div>
            </div>

            <div class="settings-card-body">
                <p class="settings-password-note">Password saat ini wajib diisi setiap kali menyimpan perubahan. Jika tidak ingin mengganti password, biarkan kolom password baru tetap kosong.</p>

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
                        <small>Isi ulang password baru untuk memastikan tidak ada kesalahan pengetikan.</small>
                    </div>
                </div>
            </div>

            <div class="settings-actions">
                <button type="submit" class="settings-submit">Simpan Perubahan</button>
            </div>
        </section>
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

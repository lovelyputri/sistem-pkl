<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - GUSPELOR.NET</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        html, body {
            width: 100%;
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            color: #0f172a;
            background: linear-gradient(135deg, #f0f6ff 0%, #e5effd 100%);
            overflow-x: hidden;
        }

        /* ==========================================
           TOAST — SINGLE SLOT (anti numpuk)
        ========================================== */
        #toastContainer {
            position: fixed !important;
            top: 20px !important;
            right: 20px !important;
            z-index: 999999 !important;
            display: flex !important;
            flex-direction: column !important;
            gap: 12px !important;
            max-width: 400px !important;
            pointer-events: none !important;
        }

        .toast {
            display: flex !important;
            align-items: flex-start !important;
            gap: 12px !important;
            background: #ffffff !important;
            border-radius: 14px !important;
            padding: 14px 16px !important;
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.18) !important;
            border-left: 4px solid #2563eb !important;
            pointer-events: auto !important;
            animation: toastIn 0.3s cubic-bezier(0.22, 1, 0.36, 1) !important;
            position: relative !important;
            overflow: hidden !important;
            min-width: 300px !important;
        }

        @keyframes toastIn {
            from { opacity: 0; transform: translateX(60px) scale(0.95); }
            to   { opacity: 1; transform: translateX(0) scale(1); }
        }

        @keyframes toastOut {
            from { opacity: 1; transform: translateX(0); }
            to   { opacity: 0; transform: translateX(60px); }
        }

        .toast.hiding {
            animation: toastOut 0.25s ease forwards !important;
        }

        .toast-icon {
            width: 32px;
            height: 32px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .toast-body { flex: 1; min-width: 0; }

        .toast-title {
            font-size: 13px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 2px;
        }

        .toast-message {
            font-size: 12px;
            color: #475569;
            font-weight: 500;
            line-height: 1.4;
            word-wrap: break-word;
        }

        .toast-close {
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 2px;
            display: flex;
            align-items: center;
            flex-shrink: 0;
        }

        .toast-close:hover { color: #dc2626; }

        .toast.success { border-left-color: #16a34a !important; }
        .toast.success .toast-icon { background: #dcfce7; color: #16a34a; }

        .toast.error { border-left-color: #dc2626 !important; }
        .toast.error .toast-icon { background: #fee2e2; color: #dc2626; }

        .toast.warning { border-left-color: #d97706 !important; }
        .toast.warning .toast-icon { background: #fef3c7; color: #d97706; }

        .toast.info { border-left-color: #2563eb !important; }
        .toast.info .toast-icon { background: #dbeafe; color: #2563eb; }

        .toast-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 2px;
            background: currentColor;
            opacity: 0.4;
            animation: toastProgress 3s linear forwards;
        }

        @keyframes toastProgress {
            from { width: 100%; }
            to   { width: 0%; }
        }

        /* ==========================================
           MODAL
        ========================================== */
        #modalOverlay {
            position: fixed !important;
            inset: 0 !important;
            background: rgba(15, 23, 42, 0.55) !important;
            backdrop-filter: blur(4px) !important;
            z-index: 999998 !important;
            display: none !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 20px !important;
        }

        #modalOverlay.active {
            display: flex !important;
            animation: fadeIn 0.2s ease !important;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to   { opacity: 1; }
        }

        .modal-box {
            background: #ffffff;
            border-radius: 24px;
            padding: 32px 28px 24px;
            max-width: 440px;
            width: 100%;
            text-align: center;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
            animation: modalIn 0.3s cubic-bezier(0.22, 1, 0.36, 1);
        }

        @keyframes modalIn {
            from { opacity: 0; transform: scale(0.9) translateY(15px); }
            to   { opacity: 1; transform: scale(1) translateY(0); }
        }

        .modal-icon {
            width: 68px;
            height: 68px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }

        .modal-icon.success { background: #dcfce7; color: #16a34a; }
        .modal-icon.error { background: #fee2e2; color: #dc2626; }
        .modal-icon.warning { background: #fef3c7; color: #d97706; }
        .modal-icon.info { background: #dbeafe; color: #2563eb; }

        .modal-title {
            font-size: 19px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .modal-message {
            font-size: 13px;
            color: #64748b;
            font-weight: 500;
            line-height: 1.55;
            margin-bottom: 20px;
        }

        .modal-list {
            text-align: left;
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 20px;
            max-height: 200px;
            overflow-y: auto;
        }

        .modal-list-item {
            font-size: 12.5px;
            color: #991b1b;
            font-weight: 600;
            padding: 5px 0;
            display: flex;
            align-items: flex-start;
            gap: 8px;
            line-height: 1.4;
        }

        .modal-list-item::before {
            content: "•";
            color: #dc2626;
            font-weight: 900;
            flex-shrink: 0;
        }

        .modal-btn {
            width: 100%;
            height: 48px;
            border-radius: 12px;
            border: none;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
            color: #ffffff;
            background: #2563eb;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3);
        }

        .modal-btn:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        .modal-btn.error {
            background: #dc2626;
            box-shadow: 0 4px 14px rgba(220, 38, 38, 0.3);
        }

        .modal-btn.error:hover { background: #b91c1c; }

        .modal-btn.success {
            background: #16a34a;
            box-shadow: 0 4px 14px rgba(22, 163, 74, 0.3);
        }

        .modal-btn.success:hover { background: #15803d; }

        /* ==========================================
           FORM STATES
        ========================================== */
        .form-group.has-error .form-control {
            border-color: #dc2626 !important;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1) !important;
        }

        .form-group.has-success .form-control {
            border-color: #16a34a !important;
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.1) !important;
        }

        .form-group.has-error .input-icon { color: #dc2626 !important; }
        .form-group.has-success .input-icon { color: #16a34a !important; }

        .error-message {
            font-size: 11.5px;
            color: #dc2626;
            font-weight: 600;
            margin-top: 6px;
            display: none;
            align-items: center;
            gap: 5px;
        }

        .form-group.has-error .error-message { display: flex; }

        .success-message {
            font-size: 11.5px;
            color: #16a34a;
            font-weight: 600;
            margin-top: 6px;
            display: none;
            align-items: center;
            gap: 5px;
        }

        .form-group.has-success .success-message { display: flex; }

        /* PASSWORD STRENGTH */
        .password-strength {
            display: none;
            margin-top: 8px;
            gap: 5px;
        }

        .password-strength.active { display: flex; }

        .strength-bar {
            flex: 1;
            height: 4px;
            background: #e2e8f0;
            border-radius: 2px;
            transition: background 0.3s ease;
        }

        .strength-bar.weak { background: #dc2626; }
        .strength-bar.medium { background: #d97706; }
        .strength-bar.strong { background: #16a34a; }

        .strength-text {
            font-size: 11px;
            font-weight: 700;
            margin-top: 5px;
            display: block;
        }

        .strength-text.weak { color: #dc2626; }
        .strength-text.medium { color: #d97706; }
        .strength-text.strong { color: #16a34a; }

        /* BUTTON LOADING */
        .btn-next.loading {
            pointer-events: none;
            opacity: 0.75;
        }

        .btn-next .spinner {
            display: none;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255,255,255,0.3);
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }

        .btn-next.loading .spinner { display: inline-block; }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* ==========================================
           ORIGINAL LAYOUT
        ========================================== */
        .register-wrapper {
            width: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 40px 60px 0 60px;
            position: relative;
            overflow: hidden;
        }

        @keyframes floatSlow {
            0%, 100% { transform: translate(-50%, 0) rotate(0deg); }
            50%      { transform: translate(-50%, -14px) rotate(4deg); }
        }

        @keyframes floatMedium {
            0%, 100% { transform: translate(-50%, 0) rotate(0deg); }
            50%      { transform: translate(-50%, -10px) rotate(-3deg); }
        }

        .floating-badge {
            position: absolute;
            z-index: 3;
            background: #ffffff;
            padding: 10px 16px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.8);
            pointer-events: none;
        }

        .floating-badge .badge-icon {
            width: 32px; height: 32px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
        }

        .floating-badge span { font-size: 12px; font-weight: 700; color: #1e293b; }

        .badge-1 { top: 18%; left: 46%; animation: floatSlow 5s ease-in-out infinite; }
        .badge-1 .badge-icon { background: #dbeafe; color: #2563eb; }
        .badge-2 { top: 48%; left: 32%; animation: floatMedium 4s ease-in-out infinite 1s; }
        .badge-2 .badge-icon { background: #dcfce7; color: #16a34a; }
        .badge-3 { top: 76%; left: 44%; animation: floatSlow 6s ease-in-out infinite 0.5s; }
        .badge-3 .badge-icon { background: #fef3c7; color: #d97706; }

        .left-content {
            flex: 1;
            max-width: 500px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            z-index: 2;
            align-self: stretch;
            padding-top: 10px;
        }

        .left-text-group { display: flex; flex-direction: column; }
        .brand { display: flex; align-items: center; gap: 12px; margin-bottom: 24px; }

        .brand-icon {
            width: 40px; height: 40px;
            background: #2563eb;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        }

        .brand-text h2 { font-size: 16px; font-weight: 800; color: #0f172a; line-height: 1.1; letter-spacing: -0.2px; }
        .brand-text p { font-size: 11px; color: #64748b; font-weight: 600; margin-top: 1px; }

        .step-badge {
            display: inline-block;
            background: #dbeafe;
            color: #2563eb;
            font-size: 12px;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 20px;
            margin-bottom: 16px;
            width: fit-content;
        }

        .main-title {
            font-size: 30px;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.25;
            margin-bottom: 12px;
            letter-spacing: -0.5px;
        }

        .main-title span { color: #2563eb; }

        .main-desc {
            font-size: 13.5px;
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 16px;
            font-weight: 500;
        }

        .illustration-box {
            width: calc(100% + 60px);
            margin-left: -60px;
            display: flex;
            justify-content: flex-start;
            align-items: flex-end;
            margin-top: auto;
        }

        .register-img {
            width: 108%;
            max-width: 500px;
            height: auto;
            object-fit: contain;
            pointer-events: none;
            filter: drop-shadow(0 10px 20px rgba(37, 99, 235, 0.08));
        }

        .right-content {
            flex: 1.2;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            z-index: 2;
            padding-bottom: 40px;
        }

        .register-card {
            width: 100%;
            max-width: 680px;
            background: #ffffff;
            border-radius: 28px;
            padding: 36px 40px;
            box-shadow: 0 20px 45px -10px rgba(30, 58, 138, 0.08);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        .stepper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
            padding: 0 20px;
            position: relative;
        }

        .step-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            position: relative;
            z-index: 2;
        }

        .step-circle {
            width: 36px; height: 36px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; font-weight: 700;
            background: #ffffff;
            border: 2px solid #e2e8f0;
            color: #94a3b8;
            transition: all 0.3s ease;
        }

        .step-item.active .step-circle {
            background: #2563eb;
            border-color: #2563eb;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .step-label { font-size: 11.5px; font-weight: 600; color: #94a3b8; }
        .step-item.active .step-label { color: #2563eb; font-weight: 700; }

        .step-line {
            flex: 1;
            height: 2px;
            background: #e2e8f0;
            margin: 0 12px;
            position: relative;
            top: -12px;
            z-index: 1;
        }

        .card-header-title {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 22px;
        }

        .header-icon-box {
            width: 42px; height: 42px;
            background: #eff6ff;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            color: #2563eb;
            border: 1px solid #dbeafe;
        }

        .header-text h3 { font-size: 18px; font-weight: 800; color: #0f172a; line-height: 1.2; }
        .header-text p { font-size: 12.5px; color: #64748b; font-weight: 500; }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .form-group label {
            font-size: 12.5px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 6px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            color: #2563eb;
            display: flex;
            align-items: center;
            pointer-events: none;
            transition: color 0.2s ease;
        }

        .form-control {
            width: 100%;
            height: 46px;
            border: 1.5px solid #d0e1fd;
            border-radius: 12px;
            padding: 0 14px 0 42px;
            font-size: 13px;
            color: #0f172a;
            background: #ffffff;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .form-control::placeholder { color: #94a3b8; font-weight: 400; }

        .form-control:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .password-toggle {
            position: absolute;
            right: 14px;
            background: none;
            border: none;
            color: #64748b;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .radio-group {
            display: flex;
            align-items: center;
            gap: 24px;
            height: 46px;
        }

        .radio-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            cursor: pointer;
        }

        .radio-label input[type="radio"] {
            appearance: none;
            width: 18px; height: 18px;
            border: 2px solid #cbd5e1;
            border-radius: 50%;
            outline: none;
            cursor: pointer;
            position: relative;
            transition: all 0.2s ease;
        }

        .radio-label input[type="radio"]:checked {
            border-color: #2563eb;
            background-color: #ffffff;
        }

        .radio-label input[type="radio"]:checked::after {
            content: "";
            position: absolute;
            top: 3px; left: 3px;
            width: 8px; height: 8px;
            background-color: #2563eb;
            border-radius: 50%;
        }

        .info-notice {
            margin-top: 22px;
            background: #f0f7ff;
            border: 1px solid #d0e1fd;
            border-radius: 14px;
            padding: 14px 18px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .info-notice-icon {
            width: 36px; height: 36px;
            background: #ffffff;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: #2563eb;
            flex-shrink: 0;
            box-shadow: 0 2px 6px rgba(37, 99, 235, 0.08);
        }

        .info-notice p {
            font-size: 12px;
            color: #334155;
            font-weight: 600;
            line-height: 1.45;
        }

        .form-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 24px;
        }

       .btn-back {
    display: inline-flex !important;
    flex-direction: row !important;
    flex-wrap: nowrap !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 8px !important;
    height: 46px !important;
    padding: 0 22px !important;
    border-radius: 12px;
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    color: #334155;
    font-size: 13.5px;
    font-weight: 700;
    line-height: 1;
    text-decoration: none;
    box-sizing: border-box;
    transition: all 0.2s ease;
    white-space: nowrap;
}

.btn-back svg {
    display: block !important;
    flex-shrink: 0 !important;
    width: 16px;
    height: 16px;
    position: relative;
    top: 1px;
}

.btn-back span {
    display: inline-block;
    line-height: 1;
}

.btn-back:hover { background: #f8fafc; border-color: #cbd5e1; } 
       .btn-next {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    height: 46px;
    padding: 0 28px;
    border-radius: 12px;
    background: #2563eb;
    border: none;
    color: #ffffff;
    font-size: 13.5px;
    font-weight: 700;
    line-height: 1;
    cursor: pointer;
    box-sizing: border-box;
    box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3);
    transition: all 0.2s ease;
    white-space: nowrap;
}

.btn-next svg {
    display: block;
    flex-shrink: 0;
    position: relative;
    top: 1px;              /* ← geser panah turun 1px juga */
}

.btn-next:hover {
    background: #1d4ed8;
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(37, 99, 235, 0.4);
}

        .datepicker-dropdown {
            display: none;
            position: absolute;
            top: calc(100% + 8px);
            left: 0;
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            border-radius: 20px;
            padding: 20px 22px 22px;
            box-shadow: 0 20px 50px rgba(15, 23, 42, 0.18);
            border: 1px solid #e2e8f0;
            z-index: 50;
        }

        .datepicker-dropdown.active {
            display: block;
            animation: dpDropdown 0.2s ease;
        }

        @keyframes dpDropdown {
            from { opacity: 0; transform: translateY(-8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .datepicker-header {
            display: flex;
            align-items: center;
            gap: 12px;
            padding-bottom: 14px;
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 16px;
        }

        .datepicker-header .dp-head-icon {
            width: 36px; height: 36px;
            border-radius: 10px;
            background: #eff6ff;
            color: #2563eb;
            display: flex; align-items: center; justify-content: center;
        }

        .datepicker-header h4 { font-size: 16px; font-weight: 800; color: #2563eb; }

        .datepicker-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
            position: relative;
        }

        .datepicker-nav button {
            background: none;
            border: none;
            color: #2563eb;
            cursor: pointer;
            padding: 6px;
            border-radius: 8px;
            display: flex;
            align-items: center;
        }

        .datepicker-nav button:hover { background: #eff6ff; }

        .datepicker-title {
            font-size: 15px;
            font-weight: 700;
            color: #0f172a;
            cursor: pointer;
            padding: 6px 14px;
            border-radius: 8px;
            transition: all 0.2s ease;
            user-select: none;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .datepicker-title:hover { background: #eff6ff; color: #2563eb; }

        .datepicker-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 4px;
            text-align: center;
        }

        .dp-day-name {
            font-size: 11.5px;
            font-weight: 700;
            color: #64748b;
            padding: 6px 0;
        }

        .dp-day {
            height: 36px;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.15s ease;
            border: none;
            background: none;
        }

        .dp-day:hover { background: #eff6ff; color: #2563eb; }

        .dp-day.selected {
            background: #2563eb;
            color: #ffffff;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.35);
        }

        .dp-day.empty { cursor: default; visibility: hidden; }

        .datepicker-actions {
            display: flex;
            gap: 10px;
            margin-top: 18px;
        }

        .datepicker-actions button {
            flex: 1;
            height: 42px;
            border-radius: 12px;
            font-size: 13.5px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .dp-btn-cancel {
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            color: #334155;
        }

        .dp-btn-cancel:hover { background: #f8fafc; }

        .dp-btn-save {
            background: #2563eb;
            border: none;
            color: #ffffff;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3);
        }

        .dp-btn-save:hover { background: #1d4ed8; }

        .dp-month-year {
            position: absolute;
            top: 46px;
            left: 0; right: 0;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 50px rgba(15, 23, 42, 0.22);
            border: 1px solid #e2e8f0;
            padding: 16px;
            z-index: 60;
            display: none;
        }

        .dp-month-year.active {
            display: block;
            animation: dpDropdown 0.2s ease;
        }

        .dp-my-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 12px;
            border-bottom: 1px solid #f1f5f9;
            margin-bottom: 14px;
        }

        .dp-my-title {
            font-size: 13.5px;
            font-weight: 800;
            color: #2563eb;
            letter-spacing: 0.2px;
        }

        .dp-my-close {
            width: 28px; height: 28px;
            border-radius: 8px;
            border: none;
            background: #f1f5f9;
            color: #64748b;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: all 0.2s ease;
        }

        .dp-my-close:hover { background: #fee2e2; color: #dc2626; }

        .dp-my-yearnav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f8fafc;
            border-radius: 12px;
            padding: 6px 8px;
            margin-bottom: 14px;
        }

        .dp-my-yearlabel {
            font-size: 16px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: 0.5px;
        }

        .dp-my-yearbtn {
            width: 32px; height: 32px;
            border-radius: 8px;
            border: none;
            background: #ffffff;
            color: #2563eb;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 2px 6px rgba(37, 99, 235, 0.1);
            transition: all 0.2s ease;
        }

        .dp-my-yearbtn:hover { background: #eff6ff; transform: scale(1.05); }

        .dp-month-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }

        .dp-month-item {
            height: 42px;
            display: flex; align-items: center; justify-content: center;
            font-size: 12.5px;
            font-weight: 700;
            color: #334155;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.18s ease;
            border: 1.5px solid transparent;
            background: #f8fafc;
        }

        .dp-month-item:hover {
            background: #eff6ff;
            color: #2563eb;
            border-color: #dbeafe;
            transform: translateY(-1px);
        }

        .dp-month-item.active {
            background: #2563eb;
            color: #ffffff;
            border-color: #2563eb;
            box-shadow: 0 6px 14px rgba(37, 99, 235, 0.35);
        }

        @media (max-width: 1100px) {
            .register-wrapper { flex-direction: column; padding: 30px 20px; }
            .left-content { max-width: 100%; margin-bottom: 30px; }
            .right-content { width: 100%; justify-content: center; padding-bottom: 0; }
            .illustration-box, .floating-badge { display: none; }
        }

        @media (max-width: 640px) {
            .form-grid { grid-template-columns: 1fr; }
            .register-card { padding: 24px 20px; }
            #toastContainer { top: 12px !important; right: 12px !important; left: 12px !important; max-width: none !important; }
            .toast { min-width: auto !important; }
        }

        @keyframes slideInFromRight { 0% { opacity: 0; transform: translateX(60px); } 100% { opacity: 1; transform: translateX(0); } }
        @keyframes slideInFromLeft  { 0% { opacity: 0; transform: translateX(-60px); } 100% { opacity: 1; transform: translateX(0); } }
        @keyframes slideOutToLeft   { 0% { opacity: 1; transform: translateX(0); } 100% { opacity: 0; transform: translateX(-60px); } }
        @keyframes slideOutToRight  { 0% { opacity: 1; transform: translateX(0); } 100% { opacity: 0; transform: translateX(60px); } }

        .page-transition-wrap { width: 100%; min-height: 100vh; will-change: transform, opacity; }
        body.enter-from-right .page-transition-wrap { animation: slideInFromRight 0.55s cubic-bezier(0.22, 1, 0.36, 1) both; }
        body.enter-from-left  .page-transition-wrap { animation: slideInFromLeft  0.55s cubic-bezier(0.22, 1, 0.36, 1) both; }
        body.leave-to-left    .page-transition-wrap { animation: slideOutToLeft   0.45s cubic-bezier(0.55, 0, 0.55, 0.2) forwards; }
        body.leave-to-right   .page-transition-wrap { animation: slideOutToRight  0.45s cubic-bezier(0.55, 0, 0.55, 0.2) forwards; }

        .transition-link { transition: transform 0.2s ease, color 0.2s ease; }
        .transition-link:hover { transform: translateX(2px); color: #2563eb !important; }
        .transition-link:active { transform: scale(0.96); }
    </style>
</head>

<body>

<div id="toastContainer"></div>

<div id="modalOverlay">
    <div class="modal-box" id="modalBox"></div>
</div>

<div class="page-transition-wrap">

<div class="register-wrapper">

    <div class="floating-badge badge-1">
        <div class="badge-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M12 20h.01M5 12.55a11 11 0 0 1 14.08 0M1.42 9a16 16 0 0 1 21.16 0M8.53 16.11a6 6 0 0 1 6.95 0"/>
            </svg>
        </div>
        <span>Realtime Sync</span>
    </div>

    <div class="floating-badge badge-2">
        <div class="badge-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
            </svg>
        </div>
        <span>Terproteksi 100%</span>
    </div>

    <div class="floating-badge badge-3">
        <div class="badge-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12 6 12 12 16 14"/>
            </svg>
        </div>
        <span>Akses Otomatis</span>
    </div>

    <div class="left-content">
        <div class="left-text-group">
            <div class="brand">
                <div class="brand-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12.55a11 11 0 0 1 14.08 0"></path>
                        <path d="M1.42 9a16 16 0 0 1 21.16 0"></path>
                        <path d="M8.53 16.11a6 6 0 0 1 6.95 0"></path>
                        <line x1="12" y1="20" x2="12.01" y2="20"></line>
                    </svg>
                </div>
                <div class="brand-text">
                    <h2>GUSPELOR.NET</h2>
                    <p>Sistem Pengelolaan PKL</p>
                </div>
            </div>

            <div class="step-badge">Langkah 1 dari 3</div>

            <h1 class="main-title">
                Daftar akun baru<br>
                <span>dan mulai perjalanan</span><br>
                <span>PKL-mu bersama kami</span>
            </h1>

            <p class="main-desc">
                Lengkapi data dirimu dengan benar<br>
                untuk mempermudah verifikasi oleh admin.
            </p>
        </div>

        <div class="illustration-box">
            <img src="{{ asset('images/register.png') }}" alt="Ilustrasi Register GUSPELOR.NET" class="register-img">
        </div>
    </div>

    <div class="right-content">
        <div class="register-card">

            <div class="stepper">
                <div class="step-item active">
                    <div class="step-circle">1</div>
                    <span class="step-label">Data Diri</span>
                </div>
                <div class="step-line"></div>
                <div class="step-item">
                    <div class="step-circle">2</div>
                    <span class="step-label">Data Sekolah</span>
                </div>
                <div class="step-line"></div>
                <div class="step-item">
                    <div class="step-circle">3</div>
                    <span class="step-label">Verifikasi</span>
                </div>
            </div>

            <div class="card-header-title">
                <div class="header-icon-box">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
                <div class="header-text">
                    <h3>Data Diri</h3>
                    <p>Lengkapi informasi dirimu dengan benar</p>
                </div>
            </div>

            <form action="{{ route('register.step1.process') }}" method="POST" id="registerForm" data-transition-submit novalidate>
                @csrf

                <div class="form-grid">

                    <div class="form-group" data-field="nama_lengkap">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                            </span>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control"
                                placeholder="Masukkan nama lengkap" value="{{ old('nama_lengkap') }}" required>
                        </div>
                        <div class="error-message">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                            </svg>
                            <span class="error-text">Nama lengkap wajib diisi</span>
                        </div>
                        <div class="success-message">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            <span>Nama lengkap valid</span>
                        </div>
                    </div>

                    <div class="form-group" data-field="tempat_lahir">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                            </span>
                            <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control"
                                placeholder="Masukkan tempat lahir" value="{{ old('tempat_lahir') }}" required>
                        </div>
                        <div class="error-message">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                            </svg>
                            <span class="error-text">Tempat lahir wajib diisi</span>
                        </div>
                        <div class="success-message">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            <span>Tempat lahir valid</span>
                        </div>
                    </div>

                    <div class="form-group" data-field="nisn">
                        <label for="nisn">NISN</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="16" rx="2"/>
                                    <line x1="7" y1="8" x2="17" y2="8"/>
                                    <line x1="7" y1="12" x2="13" y2="12"/>
                                </svg>
                            </span>
                            <input type="text" id="nisn" name="nisn" class="form-control"
                                placeholder="Masukkan NISN (10 digit)" value="{{ old('nisn') }}" required maxlength="10">
                        </div>
                        <div class="error-message">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                            </svg>
                            <span class="error-text">NISN wajib diisi</span>
                        </div>
                        <div class="success-message">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            <span>NISN valid</span>
                        </div>
                    </div>

                    <div class="form-group" data-field="tanggal_lahir">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                            </span>
                            <input type="text" id="tanggal_lahir_display" class="form-control"
                                placeholder="dd/mm/yyyy"
                                value="{{ old('tanggal_lahir') ? \Carbon\Carbon::parse(old('tanggal_lahir'))->format('d/m/Y') : '' }}"
                                readonly style="cursor:pointer;">
                            <input type="hidden" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                            <span class="password-toggle" style="pointer-events:none;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                            </span>
                        </div>
                        <div class="error-message">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                            </svg>
                            <span class="error-text">Tanggal lahir wajib diisi</span>
                        </div>
                        <div class="success-message">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            <span>Tanggal lahir valid</span>
                        </div>

                        <div class="datepicker-dropdown" id="datepickerDropdown">
                            <div class="datepicker-header">
                                <div class="dp-head-icon">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                        <line x1="16" y1="2" x2="16" y2="6"/>
                                        <line x1="8" y1="2" x2="8" y2="6"/>
                                        <line x1="3" y1="10" x2="21" y2="10"/>
                                    </svg>
                                </div>
                                <h4>Pilih Tanggal Lahir</h4>
                            </div>

                            <div class="datepicker-nav">
                                <button type="button" id="dpPrev">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <polyline points="15 18 9 12 15 6"/>
                                    </svg>
                                </button>
                                <div class="datepicker-title" id="dpTitle">
                                    Januari 2000
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                        <polyline points="6 9 12 15 18 9"/>
                                    </svg>
                                </div>
                                <button type="button" id="dpNext">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <polyline points="9 18 15 12 9 6"/>
                                    </svg>
                                </button>
                            </div>

                            <div class="datepicker-grid" id="dpGrid"></div>

                            <div class="datepicker-actions">
                                <button type="button" class="dp-btn-cancel" id="dpCancel">Batal</button>
                                <button type="button" class="dp-btn-save" id="dpSave">Simpan</button>
                            </div>

                            <div class="dp-month-year" id="dpMonthYear"></div>
                        </div>
                    </div>

                    <div class="form-group" data-field="jenis_kelamin">
                        <label>Jenis Kelamin</label>
                        <div class="radio-group">
                            <label class="radio-label">
                                <input type="radio" name="jenis_kelamin" value="Laki-laki" {{ old('jenis_kelamin', 'Laki-laki') == 'Laki-laki' ? 'checked' : '' }}>
                                <span>Laki-laki</span>
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="jenis_kelamin" value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }}>
                                <span>Perempuan</span>
                            </label>
                        </div>
                    </div>

                    <div></div>

                    <div class="form-group" data-field="no_telepon">
                        <label for="no_telepon">No. Telepon</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                </svg>
                            </span>
                            <input type="text" id="no_telepon" name="no_telepon" class="form-control"
                                placeholder="Contoh: 081234567890" value="{{ old('no_telepon') }}" required maxlength="15">
                        </div>
                        <div class="error-message">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                            </svg>
                            <span class="error-text">No. telepon wajib diisi</span>
                        </div>
                        <div class="success-message">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            <span>No. telepon valid</span>
                        </div>
                    </div>

                    <div class="form-group" data-field="password">
                        <label for="password">Password</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                </svg>
                            </span>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Masukkan password" required>
                            <button type="button" class="password-toggle" onclick="togglePass('password', 'eye1')">
                                <svg id="eye1" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </button>
                        </div>
                        <div class="password-strength" id="passwordStrength">
                            <div class="strength-bar" id="bar1"></div>
                            <div class="strength-bar" id="bar2"></div>
                            <div class="strength-bar" id="bar3"></div>
                        </div>
                        <span class="strength-text" id="strengthText"></span>
                        <div class="error-message">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                            </svg>
                            <span class="error-text">Password wajib diisi</span>
                        </div>
                        <div class="success-message">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            <span>Password kuat</span>
                        </div>
                    </div>

                    <div class="form-group" data-field="email">
                        <label for="email">Email</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                    <polyline points="22,6 12,13 2,6"/>
                                </svg>
                            </span>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Masukkan email" value="{{ old('email') }}" required>
                        </div>
                        <div class="error-message">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                            </svg>
                            <span class="error-text">Email wajib diisi</span>
                        </div>
                        <div class="success-message">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            <span>Email valid & tersedia</span>
                        </div>
                    </div>

                    <div class="form-group" data-field="password_confirmation">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                </svg>
                            </span>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                                placeholder="Ulangi password" required>
                            <button type="button" class="password-toggle" onclick="togglePass('password_confirmation', 'eye2')">
                                <svg id="eye2" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </button>
                        </div>
                        <div class="error-message">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                            </svg>
                            <span class="error-text">Konfirmasi password wajib diisi</span>
                        </div>
                        <div class="success-message">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            <span>Password cocok</span>
                        </div>
                    </div>

                </div>

                <div class="info-notice">
                    <div class="info-notice-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                    </div>
                    <p>
                        Pastikan data yang kamu masukkan sudah benar.<br>
                        Data ini akan digunakan untuk verifikasi oleh admin.
                    </p>
                </div>

                <div class="form-actions">
                    <a href="{{ route('login') }}" class="btn-back transition-link" data-transition="back">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <line x1="19" y1="12" x2="5" y2="12"/>
                            <polyline points="12 19 5 12 12 5"/>
                        </svg>
                        <span>Kembali</span>
                    </a>

                    <button type="submit" class="btn-next" id="btnNext">
                        <span class="spinner"></span>
                        <span>Selanjutnya</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <line x1="5" y1="12" x2="19" y2="12"/>
                            <polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

</div>

<script>

console.log('🚀 Script registrasi GUSPELOR.NET dimuat');


// ==========================================
// TOAST — SINGLE SLOT (anti spam)
// ==========================================
const Toast = {
    // Cegah spam: kalau ada toast yang masih tampil, tutup dulu
    _closeCurrent: function() {
        const container = document.getElementById('toastContainer');
        if (!container) return;
        const existing = container.querySelectorAll('.toast');
        existing.forEach(function(el) {
            el.classList.add('hiding');
            setTimeout(function() { el.remove(); }, 250);
        });
    },

    show: function(type, title, message, duration) {
        duration = duration || 3000;

        try {
            const container = document.getElementById('toastContainer');
            if (!container) {
                console.error('❌ toastContainer tidak ditemukan!');
                return;
            }

            // Tutup toast sebelumnya biar tidak numpuk
            this._closeCurrent();

            const icons = {
                success: '<polyline points="20 6 9 17 4 12"/>',
                error: '<circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>',
                warning: '<path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>',
                info: '<circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/>'
            };

            const toast = document.createElement('div');
            toast.className = 'toast ' + type;
            toast.innerHTML =
                '<div class="toast-icon">' +
                    '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">' +
                        (icons[type] || icons.info) +
                    '</svg>' +
                '</div>' +
                '<div class="toast-body">' +
                    '<div class="toast-title">' + title + '</div>' +
                    '<div class="toast-message">' + message + '</div>' +
                '</div>' +
                '<button class="toast-close" type="button">' +
                    '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">' +
                        '<line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>' +
                    '</svg>' +
                '</button>' +
                '<div class="toast-progress"></div>';

            // Delay sedikit biar animasi close yg lama kelar dulu
            setTimeout(function() {
                container.appendChild(toast);
            }, 50);

            console.log('✅ Toast [' + type + ']:', title);

            const removeToast = function() {
                if (!toast.parentElement) return;
                toast.classList.add('hiding');
                setTimeout(function() { toast.remove(); }, 250);
            };

            const timeout = setTimeout(removeToast, duration);
            toast.querySelector('.toast-close').addEventListener('click', function() {
                clearTimeout(timeout);
                removeToast();
            });

        } catch(err) {
            console.error('❌ Toast error:', err);
        }
    },

    success: function(t, m) { this.show('success', t, m); },
    error:   function(t, m) { this.show('error', t, m); },
    warning: function(t, m) { this.show('warning', t, m); },
    info:    function(t, m) { this.show('info', t, m); }
};


// ==========================================
// MODAL
// ==========================================
const Modal = {
    show: function(type, title, message, list, buttonText) {
        try {
            const overlay = document.getElementById('modalOverlay');
            const box = document.getElementById('modalBox');
            if (!overlay || !box) return;

            const icons = {
                success: '<polyline points="20 6 9 17 4 12" stroke-width="3"/>',
                error: '<circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>',
                warning: '<path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>',
                info: '<circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/>'
            };

            let listHTML = '';
            if (list && list.length > 0) {
                listHTML = '<div class="modal-list">';
                list.forEach(function(item) {
                    listHTML += '<div class="modal-list-item">' + item + '</div>';
                });
                listHTML += '</div>';
            }

            box.innerHTML =
                '<div class="modal-icon ' + type + '">' +
                    '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">' +
                        (icons[type] || icons.info) +
                    '</svg>' +
                '</div>' +
                '<div class="modal-title">' + title + '</div>' +
                '<div class="modal-message">' + message + '</div>' +
                listHTML +
                '<button class="modal-btn ' + type + '" id="modalCloseBtn" type="button">' +
                    (buttonText || 'OK, Mengerti') +
                '</button>';

            overlay.classList.add('active');

            const closeModal = function() {
                overlay.classList.remove('active');
            };

            document.getElementById('modalCloseBtn').addEventListener('click', closeModal);
            overlay.addEventListener('click', function(e) {
                if (e.target === overlay) closeModal();
            });

        } catch(err) {
            console.error('❌ Modal error:', err);
        }
    }
};


// ==========================================
// FIELD STATE
// ==========================================
function setFieldState(fieldName, state, message) {
    const group = document.querySelector('[data-field="' + fieldName + '"]');
    if (!group) return;

    group.classList.remove('has-error', 'has-success');

    if (state === 'error') {
        group.classList.add('has-error');
        const errorText = group.querySelector('.error-text');
        if (errorText && message) errorText.textContent = message;
    } else if (state === 'success') {
        group.classList.add('has-success');
    }
}

function clearFieldState(fieldName) {
    const group = document.querySelector('[data-field="' + fieldName + '"]');
    if (!group) return;
    group.classList.remove('has-error', 'has-success');
}


// ==========================================
// VALIDATORS
// ==========================================
const validators = {
    nama_lengkap: function(v) {
        if (!v.trim()) return { valid: false, message: 'Nama lengkap wajib diisi' };
        if (v.trim().length < 3) return { valid: false, message: 'Nama minimal 3 karakter' };
        if (!/^[a-zA-Z\s\.\,\'-]+$/.test(v)) return { valid: false, message: 'Nama hanya boleh huruf, spasi, dan tanda baca' };
        return { valid: true };
    },
    tempat_lahir: function(v) {
        if (!v.trim()) return { valid: false, message: 'Tempat lahir wajib diisi' };
        if (v.trim().length < 3) return { valid: false, message: 'Tempat lahir minimal 3 karakter' };
        if (!/^[a-zA-Z\s\.\,\'-]+$/.test(v)) return { valid: false, message: 'Tempat lahir hanya boleh huruf dan spasi' };
        return { valid: true };
    },
    nisn: function(v) {
        if (!v.trim()) return { valid: false, message: 'NISN wajib diisi' };
        if (!/^\d+$/.test(v)) return { valid: false, message: 'NISN hanya boleh angka' };
        if (v.length !== 10) return { valid: false, message: 'NISN harus tepat 10 digit' };
        return { valid: true };
    },
    tanggal_lahir: function(v) {
        if (!v) return { valid: false, message: 'Tanggal lahir wajib diisi' };
        const parts = v.split('-');
        if (parts.length !== 3) return { valid: false, message: 'Format tanggal tidak valid' };
        const y = parseInt(parts[0], 10);
        const m = parseInt(parts[1], 10) - 1;
        const d = parseInt(parts[2], 10);
        const date = new Date(y, m, d);
        if (date.getFullYear() !== y || date.getMonth() !== m || date.getDate() !== d) {
            return { valid: false, message: 'Tanggal tidak valid' };
        }
        const today = new Date();
        if (date > today) return { valid: false, message: 'Tanggal lahir tidak boleh di masa depan' };
        let age = today.getFullYear() - y;
        const monthDiff = today.getMonth() - m;
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < d)) age--;
        if (age < 10) return { valid: false, message: 'Umur minimal 10 tahun' };
        if (age > 100) return { valid: false, message: 'Umur maksimal 100 tahun' };
        return { valid: true };
    },
    no_telepon: function(v) {
        if (!v.trim()) return { valid: false, message: 'No. telepon wajib diisi' };
        if (!/^\d+$/.test(v)) return { valid: false, message: 'No. telepon hanya boleh angka' };
        if (v.length < 10) return { valid: false, message: 'No. telepon minimal 10 digit' };
        if (v.length > 15) return { valid: false, message: 'No. telepon maksimal 15 digit' };
        if (!v.startsWith('08')) return { valid: false, message: 'No. telepon harus diawali 08' };
        return { valid: true };
    },
    password: function(v) {
        if (!v) return { valid: false, message: 'Password wajib diisi' };
        if (v.length < 8) return { valid: false, message: 'Password minimal 8 karakter' };
        if (!/[A-Z]/.test(v)) return { valid: false, message: 'Password harus ada huruf BESAR' };
        if (!/[a-z]/.test(v)) return { valid: false, message: 'Password harus ada huruf kecil' };
        if (!/[0-9]/.test(v)) return { valid: false, message: 'Password harus ada angka' };
        return { valid: true };
    },
    email: function(v) {
        if (!v.trim()) return { valid: false, message: 'Email wajib diisi' };
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!re.test(v)) return { valid: false, message: 'Format email tidak valid (contoh: nama@email.com)' };
        return { valid: true };
    },
    password_confirmation: function(v, all) {
        if (!v) return { valid: false, message: 'Konfirmasi password wajib diisi' };
        if (v !== all.password) return { valid: false, message: 'Konfirmasi password tidak cocok' };
        return { valid: true };
    }
};


// ==========================================
// CEK DUPLIKAT EMAIL
// ==========================================
const registeredEmails = [
    'admin@guspelor.net',
    'test@example.com',
    'user@mail.com',
    'budi@sekolah.id'
];

function checkEmailDuplicate(email, callback) {
    setTimeout(function() {
        callback(registeredEmails.indexOf(email.toLowerCase().trim()) !== -1);
    }, 400);
}


// ==========================================
// PASSWORD STRENGTH
// ==========================================
function updatePasswordStrength(password) {
    const strengthBox = document.getElementById('passwordStrength');
    const bars = [document.getElementById('bar1'), document.getElementById('bar2'), document.getElementById('bar3')];
    const text = document.getElementById('strengthText');

    if (!password) {
        strengthBox.classList.remove('active');
        text.textContent = '';
        text.className = 'strength-text';
        return;
    }

    strengthBox.classList.add('active');

    let score = 0;
    if (password.length >= 8) score++;
    if (/[A-Z]/.test(password) && /[a-z]/.test(password)) score++;
    if (/[0-9]/.test(password)) score++;
    if (/[^A-Za-z0-9]/.test(password)) score++;

    bars.forEach(function(b) { b.className = 'strength-bar'; });

    if (score <= 1) {
        bars[0].classList.add('weak');
        text.textContent = '🔴 Lemah';
        text.className = 'strength-text weak';
    } else if (score <= 3) {
        bars[0].classList.add('medium');
        bars[1].classList.add('medium');
        text.textContent = '🟡 Sedang';
        text.className = 'strength-text medium';
    } else {
        bars[0].classList.add('strong');
        bars[1].classList.add('strong');
        bars[2].classList.add('strong');
        text.textContent = '🟢 Kuat';
        text.className = 'strength-text strong';
    }
}


// ==========================================
// GET ALL VALUES
// ==========================================
function getAllValues() {
    const jk = document.querySelector('input[name="jenis_kelamin"]:checked');
    return {
        nama_lengkap: document.getElementById('nama_lengkap').value,
        tempat_lahir: document.getElementById('tempat_lahir').value,
        nisn: document.getElementById('nisn').value,
        tanggal_lahir: document.getElementById('tanggal_lahir').value,
        jenis_kelamin: jk ? jk.value : '',
        no_telepon: document.getElementById('no_telepon').value,
        password: document.getElementById('password').value,
        email: document.getElementById('email').value,
        password_confirmation: document.getElementById('password_confirmation').value
    };
}


// ==========================================
// TOGGLE PASSWORD
// ==========================================
function togglePass(inputId, eyeId) {
    const input = document.getElementById(inputId);
    const eye = document.getElementById(eyeId);

    if (input.type === 'password') {
        input.type = 'text';
        eye.innerHTML =
            '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>' +
            '<circle cx="12" cy="12" r="3"/>';
    } else {
        input.type = 'password';
        eye.innerHTML =
            '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>' +
            '<line x1="1" y1="1" x2="23" y2="23"/>';
    }
}


// ==========================================
// REALTIME VALIDATION — hanya update INLINE, tidak toast
// ==========================================
function bindRealTimeValidation() {

    const bind = function(id, field, validatorFn) {
        const el = document.getElementById(id);
        if (!el) return;

        el.addEventListener('blur', function() {
            // Hanya tampilkan inline, TANPA toast
            const r = validatorFn(this.value);
            if (this.value.trim() === '' && field !== 'email') {
                // Kosong → biarkan bersih, jangan langsung marah
                clearFieldState(field);
                return;
            }
            setFieldState(field, r.valid ? 'success' : 'error', r.message);
        });

        el.addEventListener('input', function() {
            clearFieldState(field);
        });
    };

    bind('nama_lengkap', 'nama_lengkap', validators.nama_lengkap);
    bind('tempat_lahir', 'tempat_lahir', validators.tempat_lahir);
    bind('nisn', 'nisn', function(v) {
        v = v.replace(/\D/g, '');
        document.getElementById('nisn').value = v;
        return validators.nisn(v);
    });

    // NISN: filter angka
    document.getElementById('nisn').addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '');
    });

    // No Telp: filter angka
    document.getElementById('no_telepon').addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '');
    });
    bind('no_telepon', 'no_telepon', validators.no_telepon);

    // Password
    const elPass = document.getElementById('password');
    elPass.addEventListener('input', function() {
        updatePasswordStrength(this.value);
        if (this.value) clearFieldState('password');

        const confirm = document.getElementById('password_confirmation');
        if (confirm.value) {
            const r = validators.password_confirmation(confirm.value, getAllValues());
            setFieldState('password_confirmation', r.valid ? 'success' : 'error', r.message);
        }
    });
    elPass.addEventListener('blur', function() {
        if (!this.value) { clearFieldState('password'); return; }
        const r = validators.password(this.value);
        setFieldState('password', r.valid ? 'success' : 'error', r.message);
    });

    // Email — satu-satunya field yang MUNCULKAN TOAST (karena cek server)
    const elEmail = document.getElementById('email');
    elEmail.addEventListener('blur', function() {
        const value = this.value.trim();
        if (!value) { clearFieldState('email'); return; }

        const r = validators.email(value);
        if (!r.valid) {
            setFieldState('email', 'error', r.message);
            return; // tidak toast, cukup inline
        }

        setFieldState('email', 'success');
        const group = document.querySelector('[data-field="email"]');
        const successSpan = group.querySelector('.success-message span');
        successSpan.textContent = 'Memeriksa ketersediaan...';

        checkEmailDuplicate(value, function(isDuplicate) {
            if (isDuplicate) {
                setFieldState('email', 'error', 'Email sudah terdaftar');
                // Toast hanya untuk info penting
                Toast.warning('Email Sudah Terdaftar', 'Gunakan email lain ya');
            } else {
                successSpan.textContent = 'Email valid & tersedia';
                setFieldState('email', 'success');
                Toast.success('Email Tersedia', 'Email bisa digunakan');
            }
        });
    });
    elEmail.addEventListener('input', function() {
        if (this.value.trim()) clearFieldState('email');
    });

    // Konfirmasi Password
    const elConfirm = document.getElementById('password_confirmation');
    elConfirm.addEventListener('input', function() {
        if (!this.value) { clearFieldState('password_confirmation'); return; }
        const r = validators.password_confirmation(this.value, getAllValues());
        setFieldState('password_confirmation', r.valid ? 'success' : 'error', r.message);
    });
    elConfirm.addEventListener('blur', function() {
        if (!this.value) { clearFieldState('password_confirmation'); return; }
        const r = validators.password_confirmation(this.value, getAllValues());
        setFieldState('password_confirmation', r.valid ? 'success' : 'error', r.message);
    });
}


// ==========================================
// VALIDATE ALL
// ==========================================
function validateAll() {
    const values = getAllValues();
    const errors = [];
    const fields = ['nama_lengkap', 'tempat_lahir', 'nisn', 'tanggal_lahir', 'no_telepon', 'password', 'email', 'password_confirmation'];

    fields.forEach(function(field) {
        let r;
        if (field === 'password_confirmation') {
            r = validators[field](values[field], values);
        } else {
            r = validators[field](values[field]);
        }

        if (!r.valid) {
            setFieldState(field, 'error', r.message);
            errors.push({ field: field, message: r.message });
        } else {
            setFieldState(field, 'success');
        }
    });

    return errors;
}


// ==========================================
// DATE PICKER
// ==========================================
(function () {
    const dropdown  = document.getElementById('datepickerDropdown');
    const grid      = document.getElementById('dpGrid');
    const title     = document.getElementById('dpTitle');
    const btnPrev   = document.getElementById('dpPrev');
    const btnNext   = document.getElementById('dpNext');
    const btnCancel = document.getElementById('dpCancel');
    const btnSave   = document.getElementById('dpSave');
    const panel     = document.getElementById('dpMonthYear');

    const inputDisplay = document.getElementById('tanggal_lahir_display');
    const inputHidden  = document.getElementById('tanggal_lahir');

    const monthNames = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    const monthShort = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    const dayNames = ['Sn','Sl','Rb','Km','Jm','Sb','Mg'];

    let viewYear = 2000;
    let viewMonth = 0;
    let selectedDay = 3;

    function formatDisplay(y, m, d) {
        return String(d).padStart(2, '0') + '/' + String(m + 1).padStart(2, '0') + '/' + y;
    }

    function formatDatabase(y, m, d) {
        return y + '-' + String(m + 1).padStart(2, '0') + '-' + String(d).padStart(2, '0');
    }

    function parseDatabaseDate(str) {
        const parts = str.split('-');
        if (parts.length === 3) {
            const y = parseInt(parts[0], 10);
            const m = parseInt(parts[1], 10) - 1;
            const d = parseInt(parts[2], 10);
            if (!isNaN(d) && !isNaN(m) && !isNaN(y)) return { d: d, m: m, y: y };
        }
        return null;
    }

    inputDisplay.addEventListener('click', function (e) {
        e.stopPropagation();
        if (dropdown.classList.contains('active')) closePicker();
        else openPicker();
    });

    function openPicker() {
        if (inputHidden.value) {
            const p = parseDatabaseDate(inputHidden.value);
            if (p) { viewYear = p.y; viewMonth = p.m; selectedDay = p.d; }
        }
        hideMonthYearPanel();
        renderCalendar();
        dropdown.classList.add('active');
    }

    function closePicker() {
        dropdown.classList.remove('active');
        hideMonthYearPanel();
    }

    function renderCalendar() {
        title.innerHTML = monthNames[viewMonth] + ' ' + viewYear +
            ' <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="6 9 12 15 18 9"/></svg>';

        grid.innerHTML = '';

        dayNames.forEach(function (n) {
            const el = document.createElement('div');
            el.className = 'dp-day-name';
            el.textContent = n;
            grid.appendChild(el);
        });

        const firstDay = new Date(viewYear, viewMonth, 1).getDay();
        const offset = (firstDay + 6) % 7;
        const daysInMonth = new Date(viewYear, viewMonth + 1, 0).getDate();

        for (let i = 0; i < offset; i++) {
            const empty = document.createElement('div');
            empty.className = 'dp-day empty';
            grid.appendChild(empty);
        }

        for (let d = 1; d <= daysInMonth; d++) {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'dp-day';
            btn.textContent = d;

            if (d === selectedDay) btn.classList.add('selected');

            btn.addEventListener('click', function (e) {
                e.stopPropagation();
                selectedDay = d;
                renderCalendar();
            });

            grid.appendChild(btn);
        }
    }

    btnPrev.addEventListener('click', function (e) {
        e.stopPropagation();
        viewMonth--;
        if (viewMonth < 0) { viewMonth = 11; viewYear--; }
        renderCalendar();
    });

    btnNext.addEventListener('click', function (e) {
        e.stopPropagation();
        viewMonth++;
        if (viewMonth > 11) { viewMonth = 0; viewYear++; }
        renderCalendar();
    });

    title.addEventListener('click', function (e) {
        e.stopPropagation();
        if (panel.classList.contains('active')) hideMonthYearPanel();
        else openMonthYearPanel();
    });

    let currentPanelYear = viewYear;

    function openMonthYearPanel() {
        currentPanelYear = viewYear;
        renderMonthYearPanel();
        panel.classList.add('active');
    }

    function hideMonthYearPanel() {
        panel.classList.remove('active');
    }

    function renderMonthYearPanel() {
        panel.innerHTML = '';

        const header = document.createElement('div');
        header.className = 'dp-my-header';

        const titleEl = document.createElement('div');
        titleEl.className = 'dp-my-title';
        titleEl.textContent = 'Pilih Bulan & Tahun';

        const closeBtn = document.createElement('button');
        closeBtn.type = 'button';
        closeBtn.className = 'dp-my-close';
        closeBtn.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>';

        closeBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            hideMonthYearPanel();
        });

        header.appendChild(titleEl);
        header.appendChild(closeBtn);
        panel.appendChild(header);

        const yearNav = document.createElement('div');
        yearNav.className = 'dp-my-yearnav';

        const prevY = document.createElement('button');
        prevY.type = 'button';
        prevY.className = 'dp-my-yearbtn';
        prevY.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>';
        prevY.addEventListener('click', function (e) {
            e.stopPropagation();
            currentPanelYear--;
            renderMonthYearPanel();
        });

        const yearLabel = document.createElement('div');
        yearLabel.className = 'dp-my-yearlabel';
        yearLabel.textContent = currentPanelYear;

        const nextY = document.createElement('button');
        nextY.type = 'button';
        nextY.className = 'dp-my-yearbtn';
        nextY.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>';
        nextY.addEventListener('click', function (e) {
            e.stopPropagation();
            currentPanelYear++;
            renderMonthYearPanel();
        });

        yearNav.appendChild(prevY);
        yearNav.appendChild(yearLabel);
        yearNav.appendChild(nextY);
        panel.appendChild(yearNav);

        const monthGrid = document.createElement('div');
        monthGrid.className = 'dp-month-grid';

        for (let i = 0; i < 12; i++) {
            const mBtn = document.createElement('button');
            mBtn.type = 'button';
            mBtn.className = 'dp-month-item';
            mBtn.textContent = monthShort[i];

            if (i === viewMonth && currentPanelYear === viewYear) mBtn.classList.add('active');

            mBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                viewYear = currentPanelYear;
                viewMonth = i;
                hideMonthYearPanel();
                renderCalendar();
            });

            monthGrid.appendChild(mBtn);
        }

        panel.appendChild(monthGrid);
    }

    panel.addEventListener('click', function (e) { e.stopPropagation(); });

    btnCancel.addEventListener('click', function (e) {
        e.stopPropagation();
        closePicker();
    });

    btnSave.addEventListener('click', function (e) {
        e.stopPropagation();
        inputDisplay.value = formatDisplay(viewYear, viewMonth, selectedDay);
        inputHidden.value = formatDatabase(viewYear, viewMonth, selectedDay);
        closePicker();

        const r = validators.tanggal_lahir(inputHidden.value);
        setFieldState('tanggal_lahir', r.valid ? 'success' : 'error', r.message);
        // Tidak toast — inline sudah cukup
    });

    document.addEventListener('click', function (e) {
        if (!dropdown.contains(e.target) && e.target !== inputDisplay) closePicker();
    });

    dropdown.addEventListener('click', function (e) { e.stopPropagation(); });
})();


// ==========================================
// PAGE TRANSITION
// ==========================================
(function () {
    const KEY = 'pageTransition';

    document.addEventListener('DOMContentLoaded', function () {
        const incoming = sessionStorage.getItem(KEY);
        if (incoming === 'forward') document.body.classList.add('enter-from-right');
        else if (incoming === 'back') document.body.classList.add('enter-from-left');
        sessionStorage.removeItem(KEY);

        document.querySelectorAll('a[data-transition]').forEach(function (link) {
            link.addEventListener('click', function (e) {
                const href = link.getAttribute('href');
                if (!href || href.startsWith('#') || href.startsWith('javascript')) return;
                e.preventDefault();
                const dir = link.getAttribute('data-transition');
                sessionStorage.setItem(KEY, dir);
                document.body.classList.add(dir === 'forward' ? 'leave-to-left' : 'leave-to-right');
                setTimeout(function () { window.location.href = href; }, 430);
            });
        });

        window.addEventListener('pageshow', function (event) {
            if (event.persisted) {
                document.body.classList.remove('leave-to-left', 'leave-to-right');
                document.body.classList.add('enter-from-left');
            }
        });
    });
})();


// ==========================================
// SUBMIT
// ==========================================
document.addEventListener('DOMContentLoaded', function () {

    bindRealTimeValidation();

    const form = document.getElementById('registerForm');
    const btnNext = document.getElementById('btnNext');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const errors = validateAll();

        if (errors.length > 0) {
            // 1 toast ringkas + 1 modal detail
            Toast.error(
                'Data Belum Lengkap',
                'Ada <b>' + errors.length + '</b> field yang perlu diperbaiki'
            );

            const errorList = errors.map(function(err) {
                return '<b>' + err.field.replace(/_/g, ' ').toUpperCase() + ':</b> ' + err.message;
            });

            Modal.show(
                'error',
                'Data Belum Lengkap',
                'Silakan perbaiki data berikut sebelum melanjutkan:',
                errorList,
                'OK, Saya Perbaiki'
            );

            const firstError = document.querySelector('.form-group.has-error');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }

            return;
        }

        const email = document.getElementById('email').value;
        btnNext.classList.add('loading');

        checkEmailDuplicate(email, function(isDuplicate) {
            if (isDuplicate) {
                btnNext.classList.remove('loading');
                setFieldState('email', 'error', 'Email sudah terdaftar');

                Toast.warning(
                    'Email Sudah Terdaftar',
                    'Gunakan email lain atau login'
                );

                Modal.show(
                    'warning',
                    'Email Sudah Terdaftar',
                    'Email <b>' + email + '</b> sudah terdaftar di sistem kami. Silakan gunakan email lain atau login jika ini akun Anda.',
                    null,
                    'OK, Ganti Email'
                );
                return;
            }

            Toast.success(
                'Data Valid!',
                'Melanjutkan ke langkah berikutnya...'
            );

            sessionStorage.setItem('pageTransition', 'forward');
            document.body.classList.add('leave-to-left');

            setTimeout(function () {
                form.submit();
            }, 1200);
        });
    });

});

</script>

</body>
</html>
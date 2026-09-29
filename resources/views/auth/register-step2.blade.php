<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Data Sekolah - GUSPELOR.NET</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body {
            width: 100%; min-height: 100vh;
            font-family: 'Inter', sans-serif;
            color: #0f172a;
            background: linear-gradient(135deg, #f0f6ff 0%, #e5effd 100%);
            overflow-x: hidden;
        }

        .register-wrapper {
            width: 100%; min-height: 100vh;
            display: flex; align-items: center; justify-content: space-between;
            padding: 40px 60px 0 60px;
            position: relative; overflow: hidden;
        }

        /* ===== FLOATING BADGE ===== */
        @keyframes floatSlow {
            0%, 100% { transform: translate(-50%, 0) rotate(0deg); }
            50%      { transform: translate(-50%, -14px) rotate(4deg); }
        }
        @keyframes floatMedium {
            0%, 100% { transform: translate(-50%, 0) rotate(0deg); }
            50%      { transform: translate(-50%, -10px) rotate(-3deg); }
        }
        .floating-badge {
            position: absolute; z-index: 3; background: #ffffff;
            padding: 10px 16px; border-radius: 16px;
            display: flex; align-items: center; gap: 10px;
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.8);
            pointer-events: none;
        }
        .floating-badge .badge-icon {
            width: 32px; height: 32px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
        }
        .floating-badge span { font-size: 12px; font-weight: 700; color: #1e293b; }

        .badge-1 { top: 18%; left: 46%; animation: floatSlow 5s ease-in-out infinite; }
        .badge-1 .badge-icon { background: #dbeafe; color: #2563eb; }
        .badge-2 { top: 48%; left: 32%; animation: floatMedium 4s ease-in-out infinite 1s; }
        .badge-2 .badge-icon { background: #dcfce7; color: #16a34a; }
        .badge-3 { top: 76%; left: 44%; animation: floatSlow 6s ease-in-out infinite 0.5s; }
        .badge-3 .badge-icon { background: #fef3c7; color: #d97706; }

        /* ===== SISI KIRI ===== */
        .left-content {
            flex: 1; max-width: 500px;
            display: flex; flex-direction: column;
            justify-content: space-between;
            z-index: 2; align-self: stretch; padding-top: 10px;
        }
        .brand { display: flex; align-items: center; gap: 12px; margin-bottom: 24px; }
        .brand-icon {
            width: 40px; height: 40px; background: #2563eb;
            border-radius: 10px; display: flex; align-items: center;
            justify-content: center; color: #fff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        }
        .brand-text h2 { font-size: 16px; font-weight: 800; color: #0f172a; line-height: 1.1; letter-spacing: -0.2px; }
        .brand-text p { font-size: 11px; color: #64748b; font-weight: 600; margin-top: 1px; }
        .step-badge {
            display: inline-block; background: #dbeafe; color: #2563eb;
            font-size: 12px; font-weight: 700; padding: 6px 14px;
            border-radius: 20px; margin-bottom: 16px; width: fit-content;
        }
        .main-title {
            font-size: 30px; font-weight: 800; color: #0f172a;
            line-height: 1.25; margin-bottom: 12px; letter-spacing: -0.5px;
        }
        .main-title span { color: #2563eb; }
        .main-desc { font-size: 13.5px; color: #64748b; line-height: 1.6; margin-bottom: 16px; font-weight: 500; }
        .illustration-box {
            width: calc(100% + 60px); margin-left: -60px; margin-bottom: 0;
            display: flex; justify-content: flex-start; align-items: flex-end; margin-top: auto;
        }
        .register-img {
            width: 108%; max-width: 500px; height: auto;
            object-fit: contain; pointer-events: none;
            filter: drop-shadow(0 10px 20px rgba(37, 99, 235, 0.08));
        }

        /* ===== SISI KANAN ===== */
        .right-content {
            flex: 1.2; display: flex; justify-content: flex-end;
            align-items: center; z-index: 2; padding-bottom: 40px;
        }
        .register-card {
            width: 100%; max-width: 680px;
            background: #ffffff; border-radius: 28px;
            padding: 36px 40px;
            box-shadow: 0 20px 45px -10px rgba(30, 58, 138, 0.08);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        /* STEPPER */
        .stepper {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 30px; padding: 0 20px; position: relative;
        }
        .step-item { display: flex; flex-direction: column; align-items: center; gap: 6px; position: relative; z-index: 2; }
        .step-circle {
            width: 36px; height: 36px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; font-weight: 700;
            background: #ffffff; border: 2px solid #e2e8f0; color: #94a3b8;
            transition: all 0.3s ease;
        }
        .step-item.completed .step-circle { background: #ffffff; border-color: #cbd5e1; color: #2563eb; }
        .step-item.completed .step-label { color: #64748b; font-weight: 600; }
        .step-item.active .step-circle {
            background: #2563eb; border-color: #2563eb; color: #fff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }
        .step-label { font-size: 11.5px; font-weight: 600; color: #94a3b8; }
        .step-item.active .step-label { color: #2563eb; font-weight: 700; }
        .step-line { flex: 1; height: 2px; background: #e2e8f0; margin: 0 12px; position: relative; top: -12px; z-index: 1; }
        .step-line.completed { background: #cbd5e1; }

        /* HEADER CARD */
        .card-header-title { display: flex; align-items: center; gap: 14px; margin-bottom: 22px; }
        .header-icon-box {
            width: 42px; height: 42px; background: #eff6ff; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            color: #2563eb; border: 1px solid #dbeafe;
        }
        .header-text h3 { font-size: 18px; font-weight: 800; color: #0f172a; line-height: 1.2; }
        .header-text p { font-size: 12.5px; color: #64748b; font-weight: 500; }

        /* FORM */
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px 20px; }
        .form-group { display: flex; flex-direction: column; position: relative; }
        .form-group.full-width { grid-column: span 2; }
        .form-group label { font-size: 12.5px; font-weight: 700; color: #1e293b; margin-bottom: 6px; }

        .input-wrapper { position: relative; display: flex; align-items: center; }
        .input-icon {
            position: absolute; left: 14px; color: #2563eb;
            display: flex; align-items: center; pointer-events: none; z-index: 2;
        }
        .form-control {
            width: 100%; height: 46px;
            border: 1.5px solid #d0e1fd; border-radius: 12px;
            padding: 0 14px 0 42px;
            font-size: 13px; color: #0f172a; background: #ffffff;
            transition: all 0.2s ease; font-weight: 500;
        }
        .form-control::placeholder { color: #94a3b8; font-weight: 400; }
        .form-control:focus {
            outline: none; border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        /* CUSTOM SELECT */
        .custom-select { position: relative; }
        .custom-select-trigger {
            width: 100%; height: 46px;
            border: 1.5px solid #d0e1fd; border-radius: 12px;
            background: #ffffff; cursor: pointer;
            display: flex; align-items: center;
            padding: 0 14px 0 42px;
            font-size: 13px; font-weight: 500;
            color: #94a3b8;
            transition: all 0.2s ease;
            position: relative; text-align: left;
        }
        .custom-select-trigger.filled { color: #0f172a; }
        .custom-select.open .custom-select-trigger {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }
        .custom-select-trigger .cs-arrow {
            position: absolute; right: 14px; top: 50%;
            transform: translateY(-50%);
            transition: transform 0.25s ease; color: #2563eb;
        }
        .custom-select.open .cs-arrow { transform: translateY(-50%) rotate(180deg); }

        .custom-select-panel {
            position: absolute; top: calc(100% + 8px); left: 0;
            width: 100%; background: #ffffff; border-radius: 18px;
            box-shadow: 0 20px 50px rgba(15, 23, 42, 0.18);
            border: 1px solid #e2e8f0; padding: 14px;
            z-index: 100; display: none; opacity: 0;
            transform: translateY(-8px);
            transition: all 0.22s ease;
        }
        .custom-select.open .custom-select-panel {
            display: block; opacity: 1; transform: translateY(0);
        }

        .cs-search { position: relative; margin-bottom: 10px; }
        .cs-search input {
            width: 100%; height: 42px;
            border: 1.5px solid #e2e8f0; border-radius: 12px;
            background: #f1f5f9; padding: 0 14px 0 42px;
            font-size: 13px; font-family: inherit; color: #0f172a;
            transition: all 0.2s ease;
        }
        .cs-search input::placeholder { color: #94a3b8; }
        .cs-search input:focus {
            outline: none; background: #ffffff;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10);
        }
        .cs-search-icon {
            position: absolute; left: 14px; top: 50%;
            transform: translateY(-50%); color: #64748b;
            pointer-events: none; display: flex;
        }

        .cs-list {
            max-height: 230px; overflow-y: auto;
            padding-right: 4px; margin-right: -4px;
        }
        .cs-list::-webkit-scrollbar { width: 6px; }
        .cs-list::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }

        .cs-item {
            display: flex; align-items: center; gap: 12px;
            padding: 11px 12px; border-radius: 10px;
            font-size: 13px; font-weight: 600; color: #2563eb;
            cursor: pointer; transition: all 0.15s ease;
            border-bottom: 1px solid #f1f5f9;
        }
        .cs-item:last-child { border-bottom: none; }
        .cs-item:hover { background: #eff6ff; transform: translateX(2px); }
        .cs-item.selected { background: #dbeafe; }
        .cs-item svg { flex-shrink: 0; color: #2563eb; }
        .cs-empty { padding: 16px; text-align: center; color: #94a3b8; font-size: 12.5px; }
        .cs-footer {
            margin-top: 10px; padding-top: 12px;
            border-top: 1px solid #e2e8f0;
            display: flex; align-items: center; gap: 8px;
            color: #2563eb; font-size: 12.5px; font-weight: 700;
            cursor: pointer; transition: all 0.2s ease; padding-left: 4px;
        }
        .cs-footer:hover { color: #1d4ed8; transform: translateX(2px); }

        /* ===== MASA MAGANG (DATE RANGE PICKER) ===== */
        .range-picker {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            width: 920px;
            max-width: 95vw;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 25px 60px rgba(15, 23, 42, 0.22);
            border: 1px solid #e2e8f0;
            z-index: 200;
            display: none;
        }
        .range-picker.active { display: block; animation: rpDropdown 0.25s ease; }
        @keyframes rpDropdown {
            from { opacity: 0; transform: translateY(-8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .rp-header {
            display: flex; align-items: center; gap: 12px;
            padding: 16px 22px;
            border-bottom: 1px solid #e2e8f0;
        }
        .rp-head-icon {
            width: 36px; height: 36px; border-radius: 10px;
            background: #eff6ff; color: #2563eb;
            display: flex; align-items: center; justify-content: center;
        }
        .rp-header h4 { font-size: 16px; font-weight: 800; color: #2563eb; }

        .rp-body {
            display: flex;
            padding: 18px;
            gap: 14px;
        }

        .rp-calendars {
            flex: 1;
            display: flex;
            gap: 20px;
        }

        .rp-calendar { flex: 1; position: relative; }

        .rp-cal-head {
            display: flex; align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
            position: relative;
        }
        .rp-cal-title {
            font-size: 15px; font-weight: 700; color: #0f172a;
            cursor: pointer;
            padding: 4px 12px;
            border-radius: 8px;
            transition: all 0.2s ease;
            user-select: none;
            display: flex; align-items: center; gap: 6px;
        }
        .rp-cal-title:hover {
            background: #eff6ff;
            color: #2563eb;
        }
        .rp-nav-btn {
            background: none; border: none; color: #2563eb;
            cursor: pointer; padding: 6px; border-radius: 8px;
            display: flex; align-items: center;
        }
        .rp-nav-btn:hover { background: #eff6ff; }

        .rp-grid {
            display: grid; grid-template-columns: repeat(7, 1fr);
            gap: 2px; text-align: center;
        }
        .rp-day-name {
            font-size: 11px; font-weight: 700;
            color: #64748b; padding: 6px 0;
        }
        .rp-day {
            height: 34px;
            display: flex; align-items: center; justify-content: center;
            font-size: 12.5px; font-weight: 600; color: #334155;
            border-radius: 50%; cursor: pointer;
            transition: background 0.15s ease, color 0.15s ease;
            border: none; background: none;
        }
        .rp-day:hover { background: #eff6ff; color: #2563eb; }
        .rp-day.other { color: #cbd5e1; visibility: hidden; }
        .rp-day.start, .rp-day.end {
            background: #2563eb !important; color: #ffffff !important;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.35);
            border-radius: 50% !important;
        }
        .rp-day.in-range {
            background: #dbeafe !important; color: #1e40af !important;
            border-radius: 50% !important;
        }

        /* ===== PANEL PILIH BULAN & TAHUN (DISAMAKAN DGN STEP 1) ===== */
        .rp-month-year {
            position: absolute;
            top: 52px;
            left: 0;
            right: 0;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 50px rgba(15, 23, 42, 0.22);
            border: 1px solid #e2e8f0;
            padding: 16px;
            z-index: 20;
            display: none;
        }
        .rp-month-year.active {
            display: block;
            animation: rpDropdown 0.2s ease;
        }

        .rp-my-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 12px;
            border-bottom: 1px solid #f1f5f9;
            margin-bottom: 14px;
        }
        .rp-my-title {
            font-size: 13.5px;
            font-weight: 800;
            color: #2563eb;
            letter-spacing: 0.2px;
        }
        .rp-my-close {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            border: none;
            background: #f1f5f9;
            color: #64748b;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }
        .rp-my-close:hover {
            background: #fee2e2;
            color: #dc2626;
        }

        .rp-my-yearnav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f8fafc;
            border-radius: 12px;
            padding: 6px 8px;
            margin-bottom: 14px;
        }
        .rp-my-yearlabel {
            font-size: 16px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: 0.5px;
        }
        .rp-my-yearbtn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: none;
            background: #ffffff;
            color: #2563eb;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 6px rgba(37, 99, 235, 0.1);
            transition: all 0.2s ease;
        }
        .rp-my-yearbtn:hover {
            background: #eff6ff;
            transform: scale(1.05);
        }

        .rp-month-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }
        .rp-month-item {
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12.5px;
            font-weight: 700;
            color: #334155;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.18s ease;
            border: 1.5px solid transparent;
            background: #f8fafc;
        }
        .rp-month-item:hover {
            background: #eff6ff;
            color: #2563eb;
            border-color: #dbeafe;
            transform: translateY(-1px);
        }
        .rp-month-item.active {
            background: #2563eb;
            color: #ffffff;
            border-color: #2563eb;
            box-shadow: 0 6px 14px rgba(37, 99, 235, 0.35);
        }

        .rp-info {
            width: 210px;
            border-left: 1px solid #e2e8f0;
            padding-left: 16px;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }
        .rp-info-item {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .rp-info-item .rp-ii-icon {
            width: 34px; height: 34px; border-radius: 9px;
            background: #eff6ff; color: #2563eb;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .rp-info-item .rp-ii-text small {
            display: block; font-size: 11px; font-weight: 600;
            color: #94a3b8;
        }
        .rp-info-item .rp-ii-text strong {
            display: block; font-size: 12.5px; font-weight: 800;
            color: #0f172a; margin-top: 2px;
        }

        .rp-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding: 14px 22px 18px;
        }
        .rp-btn {
            height: 42px; padding: 0 28px;
            border-radius: 30px;
            font-size: 13.5px; font-weight: 700;
            cursor: pointer; border: none;
            transition: all 0.2s ease;
        }
        .rp-btn-cancel {
            background: #ffffff; border: 1.5px solid #e2e8f0; color: #334155;
        }
        .rp-btn-cancel:hover { background: #f8fafc; }
        .rp-btn-save {
            background: #2563eb; color: #ffffff;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3);
        }
        .rp-btn-save:hover { background: #1d4ed8; }

        /* INFO & BUTTON */
        .info-notice {
            margin-top: 22px;
            background: #f0f7ff; border: 1px solid #d0e1fd;
            border-radius: 14px; padding: 14px 18px;
            display: flex; align-items: center; gap: 14px;
        }
        .info-notice-icon {
            width: 36px; height: 36px; background: #ffffff;
            border-radius: 10px; display: flex; align-items: center;
            justify-content: center; color: #2563eb; flex-shrink: 0;
            box-shadow: 0 2px 6px rgba(37, 99, 235, 0.08);
        }
        .info-notice p { font-size: 12px; color: #334155; font-weight: 600; line-height: 1.45; }

        .form-actions {
            display: flex; align-items: center; justify-content: space-between;
            margin-top: 24px;
        }
        .btn-back {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 12px 22px; border-radius: 12px;
            background: #ffffff; border: 1.5px solid #e2e8f0;
            color: #334155; font-size: 13.5px; font-weight: 700;
            text-decoration: none; transition: all 0.2s ease;
        }
        .btn-back:hover { background: #f8fafc; border-color: #cbd5e1; }
        .btn-next {
            display: inline-flex; align-items: center; gap: 10px;
            padding: 12px 28px; border-radius: 12px;
            background: #2563eb; border: none; color: #fff;
            font-size: 13.5px; font-weight: 700; cursor: pointer;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3);
            transition: all 0.2s ease;
        }
        .btn-next:hover {
            background: #1d4ed8; transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(37, 99, 235, 0.4);
        }

        /* ===== POPUP "TIDAK DITEMUKAN" ===== */
        .modal-notfound {
            position: fixed; inset: 0;
            background: rgba(15, 23, 42, 0.45);
            z-index: 9999; display: none;
            align-items: center; justify-content: center;
            padding: 20px;
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }
        .modal-notfound.active { display: flex; animation: mnFade 0.2s ease; }
        @keyframes mnFade { from { opacity: 0; } to { opacity: 1; } }

        .mn-box {
            background: #ffffff; border-radius: 22px;
            padding: 32px 28px 26px; width: 100%; max-width: 400px;
            box-shadow: 0 25px 60px rgba(15, 23, 42, 0.25);
            text-align: center; position: relative;
            animation: mnPop 0.25s cubic-bezier(0.34, 1.56, 0.64, 1) both;
        }
        @keyframes mnPop {
            from { opacity: 0; transform: scale(0.9) translateY(10px); }
            to   { opacity: 1; transform: scale(1) translateY(0); }
        }

        .mn-close {
            position: absolute; top: 14px; right: 14px;
            width: 32px; height: 32px; border-radius: 8px;
            border: none; background: transparent; color: #94a3b8;
            cursor: pointer; display: flex; align-items: center;
            justify-content: center; transition: all 0.2s ease;
        }
        .mn-close:hover { background: #f1f5f9; color: #334155; }

        .mn-icon-wrap {
            width: 72px; height: 72px; margin: 0 auto 18px;
            border-radius: 50%; background: #eff6ff;
            display: flex; align-items: center; justify-content: center;
            position: relative;
        }
        .mn-icon-wrap::before {
            content: ""; position: absolute; inset: -6px;
            border-radius: 50%; border: 2px solid rgba(37, 99, 235, 0.15);
            animation: mnRing 2s ease-out infinite;
        }
        @keyframes mnRing {
            0% { transform: scale(0.9); opacity: 0.6; }
            100% { transform: scale(1.2); opacity: 0; }
        }
        .mn-icon-wrap svg { color: #2563eb; }

        .mn-title {
            font-size: 17px; font-weight: 800;
            color: #2563eb; margin-bottom: 8px;
        }
        .mn-desc {
            font-size: 12.5px; color: #64748b;
            font-weight: 500; line-height: 1.55;
            margin-bottom: 18px; padding: 0 6px;
        }

        .mn-wa-box {
            background: #dbeafe; border-radius: 14px;
            padding: 14px 16px; margin-bottom: 14px;
            text-align: left; display: flex;
            align-items: center; gap: 12px;
        }
        .mn-wa-icon {
            width: 42px; height: 42px; border-radius: 50%;
            background: #25D366; display: flex; align-items: center;
            justify-content: center; color: #fff; flex-shrink: 0;
            box-shadow: 0 4px 10px rgba(37, 211, 102, 0.35);
        }
        .mn-wa-text small {
            display: block; font-size: 11.5px; color: #475569;
            font-weight: 600; margin-bottom: 2px;
        }
        .mn-wa-text strong {
            display: block; font-size: 15px; color: #2563eb;
            font-weight: 800; letter-spacing: 0.3px;
        }

        .mn-note {
            font-size: 11px; color: #64748b; font-weight: 500;
            line-height: 1.5; margin-bottom: 18px; padding: 0 6px;
        }

        .mn-btn-close {
            display: inline-flex; align-items: center;
            justify-content: center; gap: 8px;
            padding: 11px 40px; border-radius: 30px;
            background: #ffffff; border: 1.5px solid #e2e8f0;
            color: #334155; font-size: 13.5px; font-weight: 700;
            cursor: pointer; transition: all 0.2s ease;
        }
        .mn-btn-close:hover { background: #f8fafc; border-color: #cbd5e1; }

        /* RESPONSIVE */
        @media (max-width: 1100px) {
            .register-wrapper { flex-direction: column; padding: 30px 20px; }
            .left-content { max-width: 100%; margin-bottom: 30px; }
            .right-content { width: 100%; justify-content: center; padding-bottom: 0; }
            .illustration-box, .floating-badge { display: none; }
            .range-picker { width: 100%; right: auto; left: 0; }
            .rp-body { flex-direction: column; }
            .rp-info { width: 100%; border-left: none; border-top: 1px solid #e2e8f0; padding-left: 0; padding-top: 14px; }
            .rp-calendars { flex-direction: column; gap: 12px; }
        }
        @media (max-width: 640px) {
            .form-grid { grid-template-columns: 1fr; }
            .form-group.full-width { grid-column: span 1; }
            .register-card { padding: 24px 20px; }
        }

        /* SLIDE PAGE TRANSITION */
        @keyframes slideInFromRight { 0% { opacity: 0; transform: translateX(60px); } 100% { opacity: 1; transform: translateX(0); } }
        @keyframes slideInFromLeft  { 0% { opacity: 0; transform: translateX(-60px); } 100% { opacity: 1; transform: translateX(0); } }
        @keyframes slideOutToLeft   { 0% { opacity: 1; transform: translateX(0); } 100% { opacity: 0; transform: translateX(-60px); } }
        @keyframes slideOutToRight  { 0% { opacity: 1; transform: translateX(0); } 100% { opacity: 0; transform: translateX(60px); } }

        .page-transition-wrap { width: 100%; min-height: 100vh; will-change: transform, opacity; }
        body.enter-from-right .page-transition-wrap { animation: slideInFromRight 0.55s cubic-bezier(0.22, 1, 0.36, 1) both; }
        body.enter-from-left  .page-transition-wrap { animation: slideInFromLeft  0.55s cubic-bezier(0.22, 1, 0.36, 1) both; }
        body.leave-to-left    .page-transition-wrap { animation: slideOutToLeft   0.45s cubic-bezier(0.55, 0, 0.55, 0.2) forwards; }
        body.leave-to-right   .page-transition-wrap { animation: slideOutToRight  0.45s cubic-bezier(0.55, 0, 0.55, 0.2) forwards; }
        .transition-link { transition: transform 0.2s ease, color 0.2s ease; display: inline-block; }
        .transition-link:hover { transform: translateX(2px); color: #2563eb !important; }
    </style>
</head>

<body>

<div class="page-transition-wrap">
<div class="register-wrapper">

    <!-- BADGE -->
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

    <!-- SISI KIRI -->
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

            <div class="step-badge">Langkah 2 dari 3</div>

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
            <img src="{{ asset('images/register.png') }}" alt="Ilustrasi Register" class="register-img">
        </div>
    </div>

    <!-- SISI KANAN -->
    <div class="right-content">
        <div class="register-card">

            <div class="stepper">

                <div class="step-item completed">
                    <div class="step-circle">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                    <span class="step-label">Data Diri</span>
                </div>

                <div class="step-line completed"></div>

                <div class="step-item active">
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
                        <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                        <path d="M6 12H4a2 2 0 0 0-2 2v8"></path>
                        <path d="M18 9h2a2 2 0 0 1 2 2v11"></path>
                        <path d="M10 6h4"></path>
                        <path d="M10 10h4"></path>
                        <path d="M10 14h4"></path>
                        <path d="M10 18h4"></path>
                    </svg>
                </div>

                <div class="header-text">
                    <h3>Data Sekolah</h3>
                    <p>Lengkapi informasi dirimu dengan benar</p>
                </div>
            </div>

            <form action="{{ route('register.step2.process') }}" method="POST" id="formStep2">
                @csrf

                <div class="form-grid">

                    <!-- ASAL SEKOLAH -->
                    <div class="form-group">
                        <label>Asal Sekolah</label>

                        <div class="custom-select" id="selAsalSekolah">

                            <button type="button" class="custom-select-trigger" data-placeholder="Pilih asal sekolah">

                                <span class="input-icon">
                                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                                        <path d="M6 12H4a2 2 0 0 0-2 2v8"/>
                                        <path d="M18 9h2a2 2 0 0 1 2 2v11"/>
                                        <path d="M10 6h4"/>
                                        <path d="M10 10h4"/>
                                        <path d="M10 14h4"/>
                                        <path d="M10 18h4"/>
                                    </svg>
                                </span>

                                <span class="cs-label">Pilih asal sekolah</span>

                                <span class="cs-arrow">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <polyline points="6 9 12 15 18 9"/>
                                    </svg>
                                </span>

                            </button>

                            <div class="custom-select-panel">

                                <div class="cs-search">
                                    <span class="cs-search-icon">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="11" cy="11" r="8"/>
                                            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                                        </svg>
                                    </span>

                                    <input type="text" placeholder="Cari sekolah..." data-search>
                                </div>

                                <div class="cs-list" data-list></div>

                                <div class="cs-footer" data-notfound="sekolah">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                                        <circle cx="12" cy="12" r="10"/>
                                        <line x1="12" y1="8" x2="12" y2="16"/>
                                        <line x1="8" y1="12" x2="16" y2="12"/>
                                    </svg>
                                    Sekolah tidak ditemukan?
                                </div>

                            </div>

                            <input
                                type="hidden"
                                name="asal_sekolah"
                                value="{{ old('asal_sekolah') }}"
                            >

                        </div>
                    </div>


                    <!-- KELAS -->
                    <div class="form-group">

                        <label>Kelas</label>

                        <div class="custom-select" id="selKelas">

                            <button type="button" class="custom-select-trigger" data-placeholder="Pilih kelas">

                                <span class="input-icon">
                                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                                        <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                                    </svg>
                                </span>

                                <span class="cs-label">Pilih kelas</span>

                                <span class="cs-arrow">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <polyline points="6 9 12 15 18 9"/>
                                    </svg>
                                </span>

                            </button>

                            <div class="custom-select-panel">

                                <div class="cs-search">

                                    <span class="cs-search-icon">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="11" cy="11" r="8"/>
                                            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                                        </svg>
                                    </span>

                                    <input type="text" placeholder="Cari kelas..." data-search>

                                </div>

                                <div class="cs-list" data-list></div>

                            </div>

                            <input
                                type="hidden"
                                name="kelas"
                                value="{{ old('kelas') }}"
                            >

                        </div>

                    </div>


                    <!-- JURUSAN -->
                    <div class="form-group">

                        <label>Jurusan</label>

                        <div class="custom-select" id="selJurusan">

                            <button type="button" class="custom-select-trigger" data-placeholder="Pilih jurusan">

                                <span class="input-icon">
                                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                                        <polyline points="14 2 14 8 20 8"/>
                                        <line x1="16" y1="13" x2="8" y2="13"/>
                                        <line x1="16" y1="17" x2="8" y2="17"/>
                                    </svg>
                                </span>

                                <span class="cs-label">Pilih jurusan</span>

                                <span class="cs-arrow">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <polyline points="6 9 12 15 18 9"/>
                                    </svg>
                                </span>

                            </button>

                            <div class="custom-select-panel">

                                <div class="cs-search">

                                    <span class="cs-search-icon">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="11" cy="11" r="8"/>
                                            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                                        </svg>
                                    </span>

                                    <input type="text" placeholder="Cari jurusan..." data-search>

                                </div>

                                <div class="cs-list" data-list></div>

                                <div class="cs-footer" data-notfound="jurusan">

                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                                        <circle cx="12" cy="12" r="10"/>
                                        <line x1="12" y1="8" x2="12" y2="16"/>
                                        <line x1="8" y1="12" x2="16" y2="12"/>
                                    </svg>

                                    Jurusan tidak ditemukan?

                                </div>

                            </div>

                            <input
                                type="hidden"
                                name="jurusan"
                                value="{{ old('jurusan') }}"
                            >

                        </div>

                    </div>


                    <!-- MASA MAGANG -->
                    <div class="form-group">

                        <label>Masa Magang</label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                            </span>

                            <input
                                type="text"
                                id="masaMagangInput"
                                class="form-control"
                                placeholder="Pilih masa magang"
                                readonly
                                style="cursor:pointer;"
                            >

                        </div>


                        <div class="range-picker" id="rangePicker">

                            <div class="rp-header">

                                <div class="rp-head-icon">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                        <line x1="16" y1="2" x2="16" y2="6"/>
                                        <line x1="8" y1="2" x2="8" y2="6"/>
                                        <line x1="3" y1="10" x2="21" y2="10"/>
                                    </svg>
                                </div>

                                <h4>Pilih Tanggal Magang</h4>

                            </div>


                            <div class="rp-body">

                                <div class="rp-calendars">
                                    <div class="rp-calendar" id="rpCal1"></div>
                                    <div class="rp-calendar" id="rpCal2"></div>
                                </div>


                                <div class="rp-info">

                                    <div class="rp-info-item">

                                        <div class="rp-ii-icon">
                                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                                <line x1="16" y1="2" x2="16" y2="6"/>
                                                <line x1="8" y1="2" x2="8" y2="6"/>
                                                <line x1="3" y1="10" x2="21" y2="10"/>
                                            </svg>
                                        </div>

                                        <div class="rp-ii-text">
                                            <small>Mulai</small>
                                            <strong id="rpStartText">-</strong>
                                        </div>

                                    </div>


                                    <div class="rp-info-item">

                                        <div class="rp-ii-icon">
                                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                                <line x1="16" y1="2" x2="16" y2="6"/>
                                                <line x1="8" y1="2" x2="8" y2="6"/>
                                                <line x1="3" y1="10" x2="21" y2="10"/>
                                            </svg>
                                        </div>

                                        <div class="rp-ii-text">
                                            <small>Selesai</small>
                                            <strong id="rpEndText">-</strong>
                                        </div>

                                    </div>


                                    <div class="rp-info-item">

                                        <div class="rp-ii-icon">
                                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <circle cx="12" cy="12" r="10"/>
                                                <polyline points="12 6 12 12 16 14"/>
                                            </svg>
                                        </div>

                                        <div class="rp-ii-text">
                                            <small>Durasi</small>
                                            <strong id="rpDurationText">-</strong>
                                        </div>

                                    </div>

                                </div>

                            </div>


                            <div class="rp-actions">

                                <button type="button" class="rp-btn rp-btn-cancel" id="rpCancel">
                                    Batal
                                </button>

                                <button type="button" class="rp-btn rp-btn-save" id="rpSave">
                                    Simpan
                                </button>

                            </div>

                        </div>


                        <input
                            type="hidden"
                            name="tanggal_mulai"
                            id="rpStartHidden"
                            value="{{ old('tanggal_mulai') }}"
                        >

                        <input
                            type="hidden"
                            name="tanggal_selesai"
                            id="rpEndHidden"
                            value="{{ old('tanggal_selesai') }}"
                        >

                    </div>


                    <!-- ALAMAT SEKOLAH -->
                    <div class="form-group full-width">

                        <label for="alamat_sekolah">Alamat Sekolah</label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                            </span>

                            <input
                                type="text"
                                id="alamat_sekolah"
                                name="alamat_sekolah"
                                class="form-control"
                                placeholder="Masukan alamat sekolah"
                                value="{{ old('alamat_sekolah') }}"
                                required
                            >

                        </div>

                    </div>


                    <!-- NAMA PEMBIMBING -->
                    <div class="form-group">

                        <label for="nama_pembimbing">Nama Guru Pembimbing</label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                            </span>

                            <input
                                type="text"
                                id="nama_pembimbing"
                                name="nama_pembimbing"
                                class="form-control"
                                placeholder="Masukkan nama pembimbing"
                                value="{{ old('nama_pembimbing') }}"
                                required
                            >

                        </div>

                    </div>


                    <!-- NO TELEPON -->
                    <div class="form-group">

                        <label for="no_telepon_pembimbing">No. Telepon Pembimbing</label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                </svg>
                            </span>

                            <input
                                type="text"
                                id="no_telepon_pembimbing"
                                name="no_telepon_pembimbing"
                                class="form-control"
                                placeholder="Contoh: 081234567890"
                                value="{{ old('no_telepon_pembimbing') }}"
                                required
                            >

                        </div>

                    </div>

                </div>


                <div class="info-notice">

                    <div class="info-notice-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="11" width="18" height="11" rx="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                    </div>

                    <p>
                        Pastikan data yang kamu masukkan sudah benar.<br>
                        Data ini akan digunakan untuk verifikasi oleh admin.
                    </p>

                </div>


                <div class="form-actions">

                    <a
                        href="{{ route('register.step1.process') }}"
                        class="btn-back transition-link"
                        data-transition="back"
                    >
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <line x1="19" y1="12" x2="5" y2="12"/>
                            <polyline points="12 19 5 12 12 5"/>
                        </svg>

                        <span>Kembali</span>
                    </a>


                    <button type="submit" class="btn-next" id="btnNext">

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


<!-- ======================
     POPUP "TIDAK DITEMUKAN"
====================== -->

<div class="modal-notfound" id="modalNotFound">

    <div class="mn-box">

        <button type="button" class="mn-close" id="mnClose" aria-label="Tutup">

            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <line x1="18" y1="6" x2="6" y2="18"/>
                <line x1="6" y1="6" x2="18" y2="18"/>
            </svg>

        </button>


        <div class="mn-icon-wrap">

            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="16" x2="12" y2="12"/>
                <line x1="12" y1="8" x2="12.01" y2="8"/>
            </svg>

        </div>


        <div class="mn-title" id="mnTitle">
            Jurusan tidak ditemukan
        </div>

        <div class="mn-desc" id="mnDesc">
            Jurusan yang kamu cari tidak tersedia dalam daftar.<br>
            Silahkan hubungi admin untuk bantuan lebih lanjut.
        </div>


        <div class="mn-wa-box">

            <div class="mn-wa-icon">

                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                </svg>

            </div>

            <div class="mn-wa-text">
                <small>Hubungi Admin via WhatsApp</small>
                <strong>0812-3456-7890</strong>
            </div>

        </div>


        <div class="mn-note" id="mnNote">
            Admin akan membantu menambah jurusan yang sesuai
        </div>


        <button type="button" class="mn-btn-close" id="mnBtnClose">
            Tutup
        </button>

    </div>

</div>


<script>

    // ==========================================
    // SLIDE PAGE TRANSITION
    // ==========================================

    (function () {

        const KEY = 'pageTransition';

        document.addEventListener('DOMContentLoaded', function () {

            const incoming = sessionStorage.getItem(KEY);

            if (incoming === 'forward') {
                document.body.classList.add('enter-from-right');
            } else if (incoming === 'back') {
                document.body.classList.add('enter-from-left');
            }

            sessionStorage.removeItem(KEY);


            document.querySelectorAll('a[data-transition]').forEach(function (link) {

                link.addEventListener('click', function (e) {

                    const href = link.getAttribute('href');

                    if (
                        !href ||
                        href.startsWith('#') ||
                        href.startsWith('javascript')
                    ) {
                        return;
                    }

                    e.preventDefault();

                    const dir = link.getAttribute('data-transition');

                    sessionStorage.setItem(KEY, dir);

                    document.body.classList.add(
                        dir === 'forward'
                            ? 'leave-to-left'
                            : 'leave-to-right'
                    );

                    setTimeout(function () {
                        window.location.href = href;
                    }, 430);

                });

            });


            const form = document.getElementById('formStep2');

            if (form) {

                form.addEventListener('submit', function (e) {

                    e.preventDefault();


                    const asalSekolah =
                        form.querySelector('input[name="asal_sekolah"]').value.trim();

                    const kelas =
                        form.querySelector('input[name="kelas"]').value.trim();

                    const jurusan =
                        form.querySelector('input[name="jurusan"]').value.trim();

                    const tglMulai =
                        form.querySelector('input[name="tanggal_mulai"]').value.trim();

                    const tglSelesai =
                        form.querySelector('input[name="tanggal_selesai"]').value.trim();


                    if (!asalSekolah) {
                        alert('Silakan pilih Asal Sekolah terlebih dahulu!');
                        return;
                    }

                    if (!kelas) {
                        alert('Silakan pilih Kelas terlebih dahulu!');
                        return;
                    }

                    if (!jurusan) {
                        alert('Silakan pilih Jurusan terlebih dahulu!');
                        return;
                    }

                    if (!tglMulai || !tglSelesai) {
                        alert('Silakan pilih Masa Magang terlebih dahulu!');
                        return;
                    }


                    if (!form.checkValidity()) {
                        form.reportValidity();
                        return;
                    }


                    sessionStorage.setItem(KEY, 'forward');

                    document.body.classList.add('leave-to-left');


                    setTimeout(function () {
                        HTMLFormElement.prototype.submit.call(form);
                    }, 430);

                });

            }


            window.addEventListener('pageshow', function (event) {

                if (event.persisted) {

                    document.body.classList.remove(
                        'leave-to-left',
                        'leave-to-right'
                    );

                    document.body.classList.add('enter-from-left');

                }

            });

        });

    })();



    // ==========================================
    // POPUP "TIDAK DITEMUKAN"
    // ==========================================

    (function () {

        const modal = document.getElementById('modalNotFound');
        const mnTitle = document.getElementById('mnTitle');
        const mnDesc = document.getElementById('mnDesc');
        const mnNote = document.getElementById('mnNote');
        const btnClose = document.getElementById('mnClose');
        const btnTutup = document.getElementById('mnBtnClose');


        function openModal(type) {

            if (type === 'sekolah') {

                mnTitle.textContent = 'Sekolah tidak ditemukan';

                mnDesc.innerHTML =
                    'Sekolah yang kamu cari tidak tersedia dalam daftar.<br>' +
                    'Silahkan hubungi admin untuk bantuan lebih lanjut.';

                mnNote.textContent =
                    'Admin akan membantu menambah sekolah yang sesuai';

            } else {

                mnTitle.textContent = 'Jurusan tidak ditemukan';

                mnDesc.innerHTML =
                    'Jurusan yang kamu cari tidak tersedia dalam daftar.<br>' +
                    'Silahkan hubungi admin untuk bantuan lebih lanjut.';

                mnNote.textContent =
                    'Admin akan membantu menambah jurusan yang sesuai';

            }

            modal.classList.add('active');

        }


        function closeModal() {
            modal.classList.remove('active');
        }


        btnClose.addEventListener('click', closeModal);
        btnTutup.addEventListener('click', closeModal);


        modal.addEventListener('click', function (e) {

            if (e.target === modal) {
                closeModal();
            }

        });


        window.openNotFoundModal = openModal;

    })();



    // ==========================================
    // CUSTOM SELECT
    // TERHUBUNG DENGAN DATABASE
    // ==========================================

    (function () {

        const DATA = {
            selAsalSekolah: {
                items: @json($sekolahData),
                values: @json($sekolahData),
                icon: '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/><path d="M6 12H4a2 2 0 0 0-2 2v8"/><path d="M18 9h2a2 2 0 0 1 2 2v11"/><path d="M10 6h4"/><path d="M10 10h4"/><path d="M10 14h4"/><path d="M10 18h4"/></svg>'
            },

            selKelas: {
                items: @json($kelasData),
                values: @json($kelasValues),
                icon: '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>'
            },

            selJurusan: {
                items: @json($jurusanData),
                values: @json($jurusanValues),
                icon: '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>'
            }
        };


        // ==========================================================
        // TUTUP SEMUA DROPDOWN JIKA KLIK DI LUAR
        // ==========================================================

        document.addEventListener('click', function (e) {

            if (!e.target.closest('.custom-select')) {

                document
                    .querySelectorAll('.custom-select')
                    .forEach(function (el) {
                        el.classList.remove('open');
                    });

            }

        });


        // ==========================================================
        // PROSES SETIAP CUSTOM SELECT
        // ==========================================================

        Object.keys(DATA).forEach(function (key) {

            const wrapper = document.getElementById(key);

            if (!wrapper) {
                return;
            }


            const trigger =
                wrapper.querySelector('.custom-select-trigger');

            const label =
                wrapper.querySelector('.cs-label');

            const search =
                wrapper.querySelector('[data-search]');

            const list =
                wrapper.querySelector('[data-list]');

            const hidden =
                wrapper.querySelector('input[type="hidden"]');

            const panel =
                wrapper.querySelector('.custom-select-panel');

            const footer =
                wrapper.querySelector('.cs-footer');

            const config =
                DATA[key];


            // ======================================================
            // POPUP TIDAK DITEMUKAN
            // ======================================================

            if (footer) {

                footer.addEventListener('click', function (e) {

                    e.stopPropagation();

                    wrapper.classList.remove('open');

                    const type =
                        footer.getAttribute('data-notfound') || 'sekolah';

                    if (window.openNotFoundModal) {
                        window.openNotFoundModal(type);
                    }

                });

            }


            // ======================================================
            // RENDER DATA DARI DATABASE
            // ======================================================

            function renderList(filter) {

                list.innerHTML = '';

                const f =
                    (filter || '').toLowerCase();


                const filtered =
                    config.items.filter(function (item) {

                        return item
                            .toLowerCase()
                            .includes(f);

                    });


                if (filtered.length === 0) {

                    const empty =
                        document.createElement('div');

                    empty.className =
                        'cs-empty';

                    empty.textContent =
                        'Tidak ada hasil ditemukan';

                    list.appendChild(empty);

                    return;
                }


                filtered.forEach(function (item) {

                    const el =
                        document.createElement('div');

                    el.className =
                        'cs-item';


                    const itemValue =
                        config.values
                            ? (config.values[item] ?? item)
                            : item;


                    el.innerHTML =
                        config.icon +
                        '<span>' +
                        item +
                        '</span>';


                    if (hidden.value === itemValue) {

                        el.classList.add('selected');

                    }


                    el.addEventListener('click', function (e) {

                        e.stopPropagation();


                        hidden.value =
                            itemValue;


                        label.textContent =
                            item;


                        trigger.classList.add('filled');

                        wrapper.classList.remove('open');

                        search.value = '';

                        renderList('');

                    });


                    list.appendChild(el);

                });

            }


            // ======================================================
            // BUKA DROPDOWN
            // ======================================================

            trigger.addEventListener('click', function (e) {

                e.stopPropagation();


                const isOpen =
                    wrapper.classList.contains('open');


                document
                    .querySelectorAll('.custom-select')
                    .forEach(function (el) {
                        el.classList.remove('open');
                    });


                if (!isOpen) {

                    wrapper.classList.add('open');

                    renderList('');

                    setTimeout(function () {

                        if (search) {
                            search.focus();
                        }

                    }, 100);

                }

            });


            // ======================================================
            // SEARCH
            // ======================================================

            if (search) {

                search.addEventListener('input', function () {

                    renderList(search.value);

                });


                search.addEventListener('click', function (e) {

                    e.stopPropagation();

                });

            }


            // ======================================================
            // TAMPILKAN DATA OLD() KETIKA VALIDASI GAGAL
            // ======================================================

            if (hidden.value) {

                let selectedLabel =
                    hidden.value;


                if (config.values) {

                    const found =
                        Object.keys(config.values).find(function (labelText) {

                            return config.values[labelText] === hidden.value;

                        });


                    if (found) {

                        selectedLabel =
                            found;

                    }

                }


                label.textContent =
                    selectedLabel;

                trigger.classList.add('filled');

            }


            // ======================================================
            // JANGAN BIARKAN KLIK PANEL MENUTUP DROPDOWN
            // ======================================================

            panel.addEventListener('click', function (e) {

                e.stopPropagation();

            });

        });

    })();



    // ==========================================
    // MASA MAGANG — DATE RANGE PICKER
    // ==========================================

    (function () {

        const picker =
            document.getElementById('rangePicker');

        const input =
            document.getElementById('masaMagangInput');

        const cal1 =
            document.getElementById('rpCal1');

        const cal2 =
            document.getElementById('rpCal2');

        const startText =
            document.getElementById('rpStartText');

        const endText =
            document.getElementById('rpEndText');

        const durationText =
            document.getElementById('rpDurationText');

        const btnCancel =
            document.getElementById('rpCancel');

        const btnSave =
            document.getElementById('rpSave');

        const startHidden =
            document.getElementById('rpStartHidden');

        const endHidden =
            document.getElementById('rpEndHidden');


        const monthNames = [
            'Januari','Februari','Maret','April','Mei','Juni',
            'Juli','Agustus','September','Oktober','November','Desember'
        ];


        const monthShort = [
            'Jan','Feb','Mar','Apr','May','Jun',
            'Jul','Aug','Sep','Oct','Nov','Dec'
        ];


        const dayNames = [
            'Sn','Sl','Rb','Km','Jm','Sb','Mg'
        ];


        let today = new Date();
        let baseYear = today.getFullYear();
        let baseMonth = today.getMonth();

        let tempStart = null;
        let tempEnd = null;
        let hoverDate = null;


        function stripTime(d) {
            return new Date(d.getFullYear(), d.getMonth(), d.getDate());
        }


        function formatID(d) {

            if (!d) return '-';

            return String(d.getDate()).padStart(2, '0')
                + ' ' + monthNames[d.getMonth()]
                + ' ' + d.getFullYear();

        }


        function formatISO(d) {

            if (!d) return '';

            const mm = String(d.getMonth() + 1).padStart(2, '0');
            const dd = String(d.getDate()).padStart(2, '0');

            return d.getFullYear() + '-' + mm + '-' + dd;

        }


        function sameDay(a, b) {

            return a && b &&
                a.getFullYear() === b.getFullYear() &&
                a.getMonth() === b.getMonth() &&
                a.getDate() === b.getDate();

        }


        function isBetween(d, s, e) {

            if (!s || !e) return false;

            const t = stripTime(d).getTime();

            return t > stripTime(s).getTime()
                && t < stripTime(e).getTime();

        }


        // ==========================================
        // BUILD KALENDER
        // ==========================================

        function buildCalendar(container, year, month) {

            container.innerHTML = '';


            const head =
                document.createElement('div');

            head.className =
                'rp-cal-head';


            const btnPrev =
                document.createElement('button');

            btnPrev.type =
                'button';

            btnPrev.className =
                'rp-nav-btn';

            btnPrev.innerHTML =
                '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>';


            btnPrev.onclick =
                function (e) {

                    e.stopPropagation();

                    baseMonth--;

                    if (baseMonth < 0) {
                        baseMonth = 11;
                        baseYear--;
                    }

                    redraw();

                };


            const titleEl =
                document.createElement('div');

            titleEl.className =
                'rp-cal-title';

            titleEl.innerHTML =
                monthNames[month]
                + ' '
                + year
                + ' <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="6 9 12 15 18 9"/></svg>';


            titleEl.onclick =
                function (e) {

                    e.stopPropagation();

                    openMonthYearPanel(container, year, month);

                };


            const btnNext =
                document.createElement('button');

            btnNext.type =
                'button';

            btnNext.className =
                'rp-nav-btn';

            btnNext.innerHTML =
                '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>';


            btnNext.onclick =
                function (e) {

                    e.stopPropagation();

                    baseMonth++;

                    if (baseMonth > 11) {
                        baseMonth = 0;
                        baseYear++;
                    }

                    redraw();

                };


            head.appendChild(btnPrev);
            head.appendChild(titleEl);
            head.appendChild(btnNext);

            container.appendChild(head);


            const grid =
                document.createElement('div');

            grid.className =
                'rp-grid';


            dayNames.forEach(function (n) {

                const el =
                    document.createElement('div');

                el.className =
                    'rp-day-name';

                el.textContent =
                    n;

                grid.appendChild(el);

            });


            const firstDay =
                new Date(year, month, 1).getDay();

            const offset =
                (firstDay + 6) % 7;

            const daysInMonth =
                new Date(year, month + 1, 0).getDate();


            for (let i = 0; i < offset; i++) {

                const empty =
                    document.createElement('div');

                empty.className =
                    'rp-day other';

                grid.appendChild(empty);

            }


            for (let d = 1; d <= daysInMonth; d++) {

                const dateObj =
                    new Date(year, month, d);

                const btn =
                    document.createElement('button');

                btn.type =
                    'button';

                btn.className =
                    'rp-day';

                btn.textContent =
                    d;

                btn.dataset.ts =
                    dateObj.getTime();


                if (sameDay(dateObj, tempStart)) {
                    btn.classList.add('start');
                }

                if (sameDay(dateObj, tempEnd)) {
                    btn.classList.add('end');
                }


                if (
                    tempStart &&
                    tempEnd &&
                    isBetween(dateObj, tempStart, tempEnd)
                ) {
                    btn.classList.add('in-range');
                }


                if (
                    tempStart &&
                    !tempEnd &&
                    hoverDate &&
                    isBetween(dateObj, tempStart, hoverDate)
                ) {
                    btn.classList.add('in-range');
                }


                btn.onclick =
                    function (e) {

                        e.stopPropagation();
                        e.preventDefault();


                        if (!tempStart || (tempStart && tempEnd)) {

                            tempStart = dateObj;
                            tempEnd = null;
                            hoverDate = null;

                        } else {

                            if (dateObj.getTime() < tempStart.getTime()) {

                                tempStart = dateObj;
                                tempEnd = null;

                            } else if (dateObj.getTime() === tempStart.getTime()) {

                                tempStart = null;
                                tempEnd = null;

                            } else {

                                tempEnd = dateObj;

                            }

                            hoverDate = null;

                        }

                        redraw();

                    };


                btn.onmouseenter =
                    function () {

                        if (tempStart && !tempEnd) {

                            hoverDate = dateObj;

                            const allDays =
                                container.querySelectorAll('.rp-day');


                            allDays.forEach(function (el) {

                                const ts =
                                    parseInt(el.dataset.ts, 10);

                                el.classList.remove('in-range');


                                if (!isNaN(ts)) {

                                    const dt =
                                        new Date(ts);

                                    if (dt > tempStart && dt <= hoverDate) {

                                        el.classList.add('in-range');

                                    }

                                }

                            });

                        }

                    };


                grid.appendChild(btn);

            }


            container.appendChild(grid);

        }


        // ==========================================
        // PANEL PILIH BULAN & TAHUN
        // (DISAMAKAN DENGAN STEP 1)
        // ==========================================

        function openMonthYearPanel(container, year, month) {

            // Hapus panel lama kalau ada
            const oldPanel = container.querySelector('.rp-month-year');
            if (oldPanel) oldPanel.remove();

            // Hapus listener global lama kalau ada
            if (window.__closeMonthYearPanel) {
                document.removeEventListener('mousedown', window.__closeMonthYearPanel);
                window.__closeMonthYearPanel = null;
            }

            let currentYear = year;

            const panel = document.createElement('div');
            panel.className = 'rp-month-year active';


            function render() {

                panel.innerHTML = '';

                // HEADER
                const header = document.createElement('div');
                header.className = 'rp-my-header';

                const title = document.createElement('div');
                title.className = 'rp-my-title';
                title.textContent = 'Pilih Bulan & Tahun';

                const closeBtn = document.createElement('button');
                closeBtn.type = 'button';
                closeBtn.className = 'rp-my-close';
                closeBtn.innerHTML =
                    '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">' +
                    '<line x1="18" y1="6" x2="6" y2="18"/>' +
                    '<line x1="6" y1="6" x2="18" y2="18"/>' +
                    '</svg>';

                closeBtn.onclick = function (e) {
                    e.stopPropagation();
                    closePanel();
                };

                header.appendChild(title);
                header.appendChild(closeBtn);
                panel.appendChild(header);


                // NAVIGASI TAHUN
                const yearNav = document.createElement('div');
                yearNav.className = 'rp-my-yearnav';

                const prevY = document.createElement('button');
                prevY.type = 'button';
                prevY.className = 'rp-my-yearbtn';
                prevY.innerHTML =
                    '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">' +
                    '<polyline points="15 18 9 12 15 6"/></svg>';

                prevY.onclick = function (e) {
                    e.stopPropagation();
                    currentYear--;
                    render();
                };

                const yearLabel = document.createElement('div');
                yearLabel.className = 'rp-my-yearlabel';
                yearLabel.textContent = currentYear;

                const nextY = document.createElement('button');
                nextY.type = 'button';
                nextY.className = 'rp-my-yearbtn';
                nextY.innerHTML =
                    '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">' +
                    '<polyline points="9 18 15 12 9 6"/></svg>';

                nextY.onclick = function (e) {
                    e.stopPropagation();
                    currentYear++;
                    render();
                };

                yearNav.appendChild(prevY);
                yearNav.appendChild(yearLabel);
                yearNav.appendChild(nextY);
                panel.appendChild(yearNav);


                // GRID BULAN
                const monthGrid = document.createElement('div');
                monthGrid.className = 'rp-month-grid';

                for (let i = 0; i < 12; i++) {

                    const mBtn = document.createElement('button');
                    mBtn.type = 'button';
                    mBtn.className = 'rp-month-item';
                    mBtn.textContent = monthShort[i];

                    if (i === month && currentYear === year) {
                        mBtn.classList.add('active');
                    }

                    mBtn.onclick = function (e) {
                        e.stopPropagation();
                        baseYear = currentYear;
                        baseMonth = i;
                        closePanel();
                        redraw();
                    };

                    monthGrid.appendChild(mBtn);

                }

                panel.appendChild(monthGrid);

            }


            function closePanel() {

                panel.remove();

                if (window.__closeMonthYearPanel) {
                    document.removeEventListener('mousedown', window.__closeMonthYearPanel);
                    window.__closeMonthYearPanel = null;
                }

            }


            // Event klik di luar panel
            window.__closeMonthYearPanel = function (ev) {

                if (panel.contains(ev.target)) return;

                if (ev.target.closest('.rp-cal-title')) return;

                closePanel();

            };


            setTimeout(function () {
                document.addEventListener('mousedown', window.__closeMonthYearPanel);
            }, 0);


            panel.addEventListener('mousedown', function (e) {
                e.stopPropagation();
            });


            render();

            container.appendChild(panel);

        }


        // ==========================================
        // REDRAW
        // ==========================================

        function redraw() {

            buildCalendar(cal1, baseYear, baseMonth);


            let m2 = baseMonth + 1;
            let y2 = baseYear;


            if (m2 > 11) {
                m2 = 0;
                y2++;
            }


            buildCalendar(cal2, y2, m2);


            startText.textContent =
                formatID(tempStart);

            endText.textContent =
                formatID(tempEnd);


            if (tempStart && tempEnd) {

                const diffDays =
                    Math.round(
                        (stripTime(tempEnd) - stripTime(tempStart))
                        / (1000 * 60 * 60 * 24)
                    ) + 1;


                let label = diffDays + ' Hari';


                if (diffDays >= 365) {

                    const th = (diffDays / 365).toFixed(1).replace('.0', '');
                    label = th + ' Tahun';

                } else if (diffDays >= 30) {

                    const bl = (diffDays / 30).toFixed(1).replace('.0', '');
                    label = bl + ' Bulan';

                }


                durationText.textContent = label;

            } else {

                durationText.textContent = '-';

            }

        }


        // ==========================================
        // EVENT INPUT MASA MAGANG
        // ==========================================

        input.addEventListener('click', function (e) {

            e.stopPropagation();


            if (picker.classList.contains('active')) {

                picker.classList.remove('active');

                return;

            }


            if (startHidden.value) {

                tempStart = new Date(startHidden.value);
                baseYear = tempStart.getFullYear();
                baseMonth = tempStart.getMonth();

            }


            if (endHidden.value) {

                tempEnd = new Date(endHidden.value);

            }


            redraw();

            picker.classList.add('active');

        });


        document.addEventListener('click', function (e) {

            if (
                !e.target.closest('#rangePicker') &&
                e.target !== input
            ) {

                picker.classList.remove('active');

            }

        });


        picker.addEventListener('click', function (e) {

            e.stopPropagation();

        });


        btnCancel.addEventListener('click', function (e) {

            e.stopPropagation();


            tempStart =
                startHidden.value ? new Date(startHidden.value) : null;


            tempEnd =
                endHidden.value ? new Date(endHidden.value) : null;


            hoverDate = null;


            picker.classList.remove('active');

        });


        btnSave.addEventListener('click', function (e) {

            e.stopPropagation();


            if (!tempStart || !tempEnd) {

                alert('Pilih tanggal mulai dan selesai dulu ya!');

                return;

            }


            startHidden.value = formatISO(tempStart);
            endHidden.value = formatISO(tempEnd);


            input.value =
                formatID(tempStart) + ' - ' + formatID(tempEnd);


            picker.classList.remove('active');

        });


        if (startHidden.value && endHidden.value) {

            const s = new Date(startHidden.value);
            const e2 = new Date(endHidden.value);


            input.value =
                formatID(s) + ' - ' + formatID(e2);

        }

    })();

</script>

</body>
</html>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f5f0e8">
    <meta name="description" content="Sistem prediksi persentase kehadiran mahasiswa berdasarkan kebiasaan akademik.">
    <title>Prediksi Kehadiran Mahasiswa | Politeknik Caltex Riau</title>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
    <div class="app-shell">
        <header class="site-header">
            <div class="header-inner">
                <a class="brand" href="{{ url('/') }}" aria-label="Prediksi Kehadiran Mahasiswa — halaman utama">
                    <span class="brand-mark" aria-hidden="true">
                        <svg viewBox="0 0 48 48" fill="none">
                            <path d="M9 34.5V14.8c0-1.1.9-2 2-2h26c1.1 0 2 .9 2 2v19.7" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
                            <path d="M15 20h18M15 26h18M15 32h10" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
                            <path d="M5.5 38.5h37" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
                        </svg>
                    </span>
                    <span class="brand-copy">
                        <span class="brand-kicker">SISTEM PREDIKSI AKADEMIK</span>
                        <span class="brand-title">Prediksi Kehadiran Mahasiswa</span>
                        <span class="brand-description">Estimasi kehadiran berdasarkan kebiasaan akademik</span>
                    </span>
                </a>

                <div class="institution-mark" aria-label="Identitas Politeknik Caltex Riau">
                    <img
                        src="{{ asset('images/logo-pcr-unggul.webp') }}"
                        alt="Logo Politeknik Caltex Riau"
                        width="2048"
                        height="265"
                        fetchpriority="high"
                    >
                </div>
            </div>
        </header>

        <main class="main-content">
            <section class="page-intro" aria-labelledby="page-title">
                <div class="page-intro-copy">
                    <p class="eyebrow"><span class="eyebrow-line" aria-hidden="true"></span> PREDIKSI AKADEMIK</p>
                    <h1 id="page-title">Pahami pola kehadiran Anda.</h1>
                    <p class="page-description">Isi tiga informasi sederhana untuk melihat estimasi persentase kehadiran berdasarkan pola akademik Anda.</p>
                </div>
                <div class="intro-chip">
                    <span class="intro-chip-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none"><path d="M12 3.5 14.6 9l5.9.8-4.3 4.2 1 5.9-5.2-2.8-5.2 2.8 1-5.9-4.3-4.2 5.9-.8L12 3.5Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>
                    </span>
                    <span><strong>3 faktor penilaian</strong><small>Proses singkat dan mudah</small></span>
                </div>
            </section>

            <div class="content-grid">
                <section class="surface-card form-card" aria-labelledby="form-title">
                    <div class="card-heading">
                        <div>
                            <p class="section-kicker">FORMULIR PREDIKSI</p>
                            <h2 id="form-title">Lengkapi informasi akademik</h2>
                            <p class="card-description">Pilih jawaban yang paling sesuai dengan kondisi Anda.</p>
                        </div>
                        <div class="factor-count" aria-label="Tiga pertanyaan">
                            <strong>03</strong>
                            <span>FAKTOR</span>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('predict') }}" id="predictionForm" class="prediction-form">
                        @csrf
                        <div class="form-fields">
                            <div class="form-field">
                                <label for="on_time_frequency"><span class="field-number">01</span> Frekuensi hadir tepat waktu</label>
                                <div class="select-wrap">
                                    <select class="form-select" id="on_time_frequency" name="on_time_frequency" required>
                                        <option value="" selected disabled>Pilih frekuensi kehadiran</option>
                                        <option value="Selalu">Selalu</option>
                                        <option value="Jarang">Jarang</option>
                                        <option value="Tidak Pernah">Tidak Pernah</option>
                                    </select>
                                    <svg class="select-chevron" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="m5 7.5 5 5 5-5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </div>
                            </div>

                            <div class="form-field">
                                <label for="semester_compensations"><span class="field-number">02</span> Jumlah kompen per semester</label>
                                <div class="select-wrap">
                                    <select class="form-select" id="semester_compensations" name="semester_compensations" required>
                                        <option value="" selected disabled>Pilih jumlah jam kompen</option>
                                        <option value="0 - 5 jam">0 - 5 jam</option>
                                        <option value="6 - 9 jam">6 - 9 jam</option>
                                        <option value="> 10 jam">&gt; 10 jam</option>
                                    </select>
                                    <svg class="select-chevron" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="m5 7.5 5 5 5-5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </div>
                            </div>

                            <div class="form-field">
                                <label for="organization_absences"><span class="field-number">03</span> Absen karena kegiatan organisasi</label>
                                <div class="select-wrap">
                                    <select class="form-select" id="organization_absences" name="organization_absences" required>
                                        <option value="" selected disabled>Pilih frekuensi ketidakhadiran</option>
                                        <option value="Tidak Pernah">Tidak Pernah</option>
                                        <option value="Jarang">Jarang</option>
                                        <option value="Selalu">Selalu</option>
                                    </select>
                                    <svg class="select-chevron" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="m5 7.5 5 5 5-5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </div>
                            </div>
                        </div>

                        <div class="form-feedback" id="formError" role="alert" aria-live="assertive" hidden></div>

                        <div class="form-actions">
                            <button type="submit" class="primary-button" id="submitButton">
                                <span class="button-spinner" aria-hidden="true"></span>
                                <span class="button-label">Hitung prediksi</span>
                                <svg class="button-arrow" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M3.5 10h12m-5-5 5 5-5 5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </button>
                            <p class="form-hint"><svg viewBox="0 0 20 20" fill="none" aria-hidden="true"><circle cx="10" cy="10" r="7.1" stroke="currentColor" stroke-width="1.4"/><path d="M10 9v4m0-6.2v.1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg> Pastikan pilihan Anda sudah sesuai sebelum menghitung.</p>
                        </div>
                    </form>
                </section>

                <aside class="surface-card insight-card" aria-labelledby="insight-title">
                    <div class="insight-topline">
                        <span class="insight-symbol" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none"><path d="M12 3.5v2m0 13v2m8.5-8.5h-2m-13 0h-2m14.01-6.01-1.42 1.42M7.91 16.09l-1.42 1.42m12.02 0-1.42-1.42M7.91 7.91 6.49 6.49" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><circle cx="12" cy="12" r="4.2" stroke="currentColor" stroke-width="1.5"/></svg>
                        </span>
                        <span class="section-kicker">FAKTOR YANG DIPERTIMBANGKAN</span>
                    </div>
                    <h2 id="insight-title">Tiga kebiasaan, satu estimasi.</h2>
                    <p class="insight-description">Sistem menggunakan informasi berikut sebagai dasar untuk menentukan rentang prediksi kehadiran.</p>

                    <ul class="factor-list">
                        <li class="factor-item">
                            <span class="factor-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="8.3" stroke="currentColor" stroke-width="1.6"/><path d="M12 7.2v5.1l3.3 2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                            <span class="factor-copy"><strong>Kedisiplinan waktu</strong><small>Kebiasaan hadir tepat waktu di kelas.</small></span>
                            <span class="factor-index">01</span>
                        </li>
                        <li class="factor-item">
                            <span class="factor-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none"><rect x="4.2" y="5.5" width="15.6" height="14.2" rx="2.2" stroke="currentColor" stroke-width="1.6"/><path d="M8 3.8v3.4m8-3.4v3.4M4.5 9.5h15" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><path d="M8 13h2m4 0h2m-8 3h2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                            </span>
                            <span class="factor-copy"><strong>Jam kompensasi</strong><small>Jumlah jam kompen dalam satu semester.</small></span>
                            <span class="factor-index">02</span>
                        </li>
                        <li class="factor-item">
                            <span class="factor-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none"><path d="M16.2 19.3v-1.5a3.2 3.2 0 0 0-3.2-3.2H7a3.2 3.2 0 0 0-3.2 3.2v1.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><circle cx="10" cy="7.5" r="3.1" stroke="currentColor" stroke-width="1.6"/><path d="M16 4.7a3.1 3.1 0 0 1 0 5.9m4.2 8.7v-1.5a3.2 3.2 0 0 0-2.4-3.1" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                            </span>
                            <span class="factor-copy"><strong>Aktivitas organisasi</strong><small>Frekuensi absen karena kegiatan organisasi.</small></span>
                            <span class="factor-index">03</span>
                        </li>
                    </ul>

                    <div class="insight-note">
                        <span class="note-icon" aria-hidden="true"><svg viewBox="0 0 20 20" fill="none"><path d="M10 2.7a7.3 7.3 0 1 0 0 14.6 7.3 7.3 0 0 0 0-14.6Z" stroke="currentColor" stroke-width="1.4"/><path d="M10 9v4m0-6.1v.1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg></span>
                        <p>Hasil merupakan estimasi berdasarkan aturan prediksi yang tersedia. Kombinasi tertentu mungkin belum memiliki hasil.</p>
                    </div>
                </aside>
            </div>
        </main>

        <footer class="site-footer">
            <div class="footer-inner">
                <p><strong>Prediksi Kehadiran Mahasiswa</strong><span> · Politeknik Caltex Riau</span></p>
                <p>© {{ date('Y') }} <span class="footer-divider" aria-hidden="true">·</span> Sistem prediksi kehadiran mahasiswa</p>
            </div>
        </footer>
    </div>

    <dialog class="prediction-modal" id="predictionModal" aria-labelledby="predictionModalTitle" aria-describedby="predictionResult">
        <div class="modal-content">
            <button type="button" class="modal-close" data-modal-close aria-label="Tutup hasil prediksi">
                <svg viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="m5 5 10 10M15 5 5 15" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
            </button>
            <div class="modal-emblem" aria-hidden="true">
                <svg viewBox="0 0 28 28" fill="none"><path d="M14 3.5v3m0 15v3m10.5-10.5h-3m-15 0h-3m18.4-7.4-2.1 2.1M8.2 19.8l-2.1 2.1m15.8 0-2.1-2.1M8.2 8.2 6.1 6.1" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><circle cx="14" cy="14" r="5" stroke="currentColor" stroke-width="1.6"/></svg>
            </div>
            <p class="modal-kicker">RINGKASAN ESTIMASI</p>
            <h2 id="predictionModalTitle">Hasil prediksi kehadiran</h2>
            <p class="modal-intro">Berikut hasil yang diberikan oleh sistem berdasarkan jawaban Anda.</p>
            <div class="prediction-result-panel">
                <p id="predictionResult" aria-live="polite"></p>
            </div>
            <p class="modal-disclaimer">Gunakan hasil ini sebagai gambaran awal dan tetap perhatikan kehadiran aktual Anda.</p>
            <button type="button" class="modal-primary-button" data-modal-close>Tutup hasil</button>
        </div>
    </dialog>
</body>
</html>

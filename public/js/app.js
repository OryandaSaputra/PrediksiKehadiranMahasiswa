const form = document.querySelector('#predictionForm');
const submitButton = document.querySelector('#submitButton');
const buttonLabel = submitButton?.querySelector('.button-label');
const formError = document.querySelector('#formError');
const predictionModal = document.querySelector('#predictionModal');
const predictionResult = document.querySelector('#predictionResult');
const modalCloseButtons = document.querySelectorAll('[data-modal-close]');

let returnFocusTo = null;
let closeTimer = null;

function showFormError(message) {
    if (!formError) return;

    formError.textContent = message;
    formError.hidden = false;
}

function clearFormError() {
    if (!formError) return;

    formError.textContent = '';
    formError.hidden = true;
}

function setLoading(isLoading) {
    if (!submitButton) return;

    submitButton.disabled = isLoading;
    submitButton.classList.toggle('is-loading', isLoading);
    submitButton.setAttribute('aria-busy', String(isLoading));

    if (buttonLabel) {
        buttonLabel.textContent = isLoading ? 'Memproses prediksi...' : 'Hitung prediksi';
    }
}

function openPredictionModal(message) {
    if (!predictionModal || !predictionResult) return;

    window.clearTimeout(closeTimer);
    predictionModal.classList.remove('is-closing');
    predictionResult.textContent = message;
    returnFocusTo = document.activeElement;

    if (!predictionModal.open) {
        predictionModal.showModal();
    }

    predictionModal.querySelector('[data-modal-close]')?.focus();
}

function closePredictionModal() {
    if (!predictionModal?.open || predictionModal.classList.contains('is-closing')) return;

    predictionModal.classList.add('is-closing');
    const closeDelay = window.matchMedia?.('(prefers-reduced-motion: reduce)').matches ? 0 : 170;

    closeTimer = window.setTimeout(() => {
        if (predictionModal.open) {
            predictionModal.close();
        }

        predictionModal.classList.remove('is-closing');

        if (returnFocusTo instanceof HTMLElement && returnFocusTo.isConnected) {
            returnFocusTo.focus();
        }
    }, closeDelay);
}

function getValidationMessage(payload) {
    const firstError = payload?.errors
        ? Object.values(payload.errors).flat().find((message) => typeof message === 'string')
        : null;

    return firstError ? 'Mohon periksa kembali pilihan yang Anda masukkan.' : null;
}

if (form) {
    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        clearFormError();

        if (!form.reportValidity()) return;

        setLoading(true);

        try {
            const response = await fetch(form.action, {
                method: form.method || 'POST',
                headers: {
                    Accept: 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: new FormData(form),
                credentials: 'same-origin',
            });

            let payload;

            try {
                payload = await response.json();
            } catch {
                throw new Error('Respons server tidak dapat dibaca. Silakan coba kembali.');
            }

            if (!response.ok) {
                if (response.status === 422) {
                    const validationMessage = getValidationMessage(payload);
                    showFormError(validationMessage || 'Mohon lengkapi seluruh pilihan sebelum menghitung.');
                    return;
                }

                throw new Error('Prediksi belum dapat diproses. Silakan coba beberapa saat lagi.');
            }

            if (typeof payload.message !== 'string') {
                throw new Error('Hasil prediksi tidak tersedia dalam respons server.');
            }

            openPredictionModal(payload.message);
        } catch (error) {
            showFormError(error instanceof Error
                ? error.message
                : 'Terjadi kendala saat memproses prediksi. Silakan coba kembali.');
        } finally {
            setLoading(false);
        }
    });
}

modalCloseButtons.forEach((button) => {
    button.addEventListener('click', closePredictionModal);
});

predictionModal?.addEventListener('cancel', (event) => {
    event.preventDefault();
    closePredictionModal();
});

predictionModal?.addEventListener('click', (event) => {
    if (event.target === predictionModal) {
        closePredictionModal();
    }
});

predictionModal?.addEventListener('close', () => {
    predictionModal.classList.remove('is-closing');
});

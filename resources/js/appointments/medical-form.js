document.addEventListener('DOMContentLoaded', () => {
    const steps = Array.from(document.querySelectorAll('.form-step'));
    const prevBtn = document.getElementById('prev-step');
    const nextBtn = document.getElementById('next-step');
    const saveBtn = document.getElementById('save-form');

    if (!steps.length || !prevBtn || !nextBtn || !saveBtn) return;

    let currentStep = 1;

    const renderStep = () => {
        steps.forEach((step, index) => {
            const stepNumber = index + 1;
            step.classList.toggle('hidden', stepNumber !== currentStep);
        });

        if (currentStep === steps.length) {
            nextBtn.classList.add('hidden');
            saveBtn.classList.remove('hidden');
        } else {
            nextBtn.classList.remove('hidden');
            saveBtn.classList.add('hidden');
        }

        prevBtn.disabled = currentStep === 1;
    };

    prevBtn.addEventListener('click', () => {
        if (currentStep > 1) {
            currentStep -= 1;
            renderStep();
        }
    });

    nextBtn.addEventListener('click', () => {
        if (currentStep < steps.length) {
            currentStep += 1;
            renderStep();
        }
    });

    renderStep();
});

window.showAppointmentDetail = async (id) => {
    const detailPanel = document.getElementById('detail-panel');
    const detailContent = document.getElementById('detail-content');
    const container = document.getElementById('appointment-container');
    const baseUrl = container ? container.getAttribute('data-url') : '';

    if (!detailPanel || !detailContent || !baseUrl) return;

    detailContent.innerHTML = '<div class="p-6 animate-pulse flex flex-col gap-4"><div class="h-4 bg-gray-200 rounded w-3/4"></div><div class="h-4 bg-gray-200 rounded w-1/2"></div></div>';

    // Open panel
    detailPanel.classList.remove('w-0', 'opacity-0');
    detailPanel.classList.add('w-full', 'md:w-5/12', 'lg:w-4/12', 'opacity-100');

    try {
        const response = await fetch(`${baseUrl}/${id}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            }
        });

        if (!response.ok) throw new Error('Failed to fetch details');

        const html = await response.text();
        detailContent.innerHTML = html;

        const closeDetail = () => {
            detailPanel.classList.add('w-0', 'opacity-0');
            detailPanel.classList.remove('w-full', 'md:w-5/12', 'lg:w-4/12', 'opacity-100');
        };

        const closeBtn = document.getElementById('close-detail');
        if (closeBtn) {
            closeBtn.addEventListener('click', closeDetail);
        }

    } catch (error) {
        console.error('Error:', error);
        detailContent.innerHTML = '<p class="p-6 text-danger">Error loading details. Please try again.</p>';
    }
};

document.addEventListener('DOMContentLoaded', () => {
    const list = document.getElementById('appointment-list');
    if (!list) return;

    list.addEventListener('click', (e) => {
        const item = e.target.closest('.appointment-item');
        if (item) {
            // Remove active class from all items
            list.querySelectorAll('.appointment-item').forEach(el => {
                el.classList.remove('active');
            });
            // Add active class to clicked item
            item.classList.add('active');

            const id = item.getAttribute('data-id');
            window.showAppointmentDetail(id);
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('appointment-container');
    const list = document.getElementById('appointment-list');
    const trigger = document.getElementById('infinite-scroll-trigger');

    if (!container || !trigger) return;

    const baseUrl = container.getAttribute('data-url');
    let page = 1;
    let isLoading = false;
    let hasMore = true;

    const loadMore = async () => {
        if (isLoading || !hasMore) return;

        isLoading = true;
        page++;

        try {
            const response = await fetch(`${baseUrl}?page=${page}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html'
                }
            });

            if (!response.ok) throw new Error('Network response was not ok');

            const html = await response.text();
            const trimmed = html.trim();

            if (response.status === 204 || !trimmed) {
                hasMore = false;
                observer.unobserve(trigger);
                trigger.innerHTML = '<span class="text-sm italic text-muted">No more appointments.</span>';
                return;
            }

            list.insertAdjacentHTML('beforeend', trimmed);

        } catch (error) {
            console.error("Error fetching appointments:", error);
            trigger.innerHTML = '<button onclick="location.reload()" class="text-danger text-sm underline">Error loading. Click to retry.</button>';
        } finally {
            isLoading = false;
        }
    };

    const observer = new IntersectionObserver((entries) => {
        if (entries[0].isIntersecting) {
            loadMore();
        }
    }, {
        root: container,
        threshold: 0.1,
        rootMargin: '150px'
    });

    observer.observe(trigger);
});

window.AppointmentCalendar = (() => {
    const container = document.getElementById('appointment-view-container');
    const calendarPanel = document.getElementById('calendar-panel');
    const calendarGridContainer = document.getElementById('calendar-grid'); // This is the wrapper
    const monthYearLabel = document.getElementById('calendar-month-year');
    const prevBtn = document.getElementById('prev-month');
    const nextBtn = document.getElementById('next-month');
    const todayBtn = document.getElementById('calendar-today');

    if (!container || !calendarPanel || !calendarGridContainer) return {};

    const calendarUrl = container.getAttribute('data-calendar-url');
    let currentDate = new Date();

    const render = async () => {
        const month = currentDate.getMonth() + 1;
        const year = currentDate.getFullYear();

        try {
            const response = await fetch(`${calendarUrl}?month=${month}&year=${year}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                }
            });

            if (!response.ok) throw new Error('Failed to fetch calendar data');
            
            const data = await response.json();
            
            // Update Label
            if (monthYearLabel) {
                monthYearLabel.textContent = data.monthName;
            }

            // Replace Grid content
            const gridContainer = document.getElementById('calendar-grid');
            if (gridContainer) {
                gridContainer.outerHTML = data.html;
            }

        } catch (error) {
            console.error("Error fetching calendar data:", error);
        }
    };

    // Events
    prevBtn.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        render();
    });

    nextBtn.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        render();
    });

    todayBtn.addEventListener('click', () => {
        currentDate = new Date();
        render();
    });

    return {
        init: () => render(),
        refresh: () => render()
    };
})();

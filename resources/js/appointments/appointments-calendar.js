window.AppointmentCalendar = (() => {
    const container = document.getElementById('appointment-view-container');
    const calendarPanel = document.getElementById('calendar-panel');
    const calendarGrid = document.getElementById('calendar-grid');
    const monthYearLabel = document.getElementById('calendar-month-year');
    const prevBtn = document.getElementById('prev-month');
    const nextBtn = document.getElementById('next-month');
    const todayBtn = document.getElementById('calendar-today');

    if (!container || !calendarPanel || !calendarGrid) return {};

    const calendarUrl = container.getAttribute('data-calendar-url');
    let currentDate = new Date();

    const fetchMonthData = async (month, year) => {
        try {
            const response = await fetch(`${calendarUrl}?month=${month + 1}&year=${year}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });
            if (!response.ok) throw new Error('Failed to fetch calendar data');
            return await response.json();
        } catch (error) {
            console.error("Error fetching calendar data:", error);
            return {};
        }
    };

    const render = async () => {
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();

        // Update Label
        const monthName = currentDate.toLocaleString('default', { month: 'long' });
        monthYearLabel.textContent = `${monthName} ${year}`;

        // Clear Grid
        calendarGrid.innerHTML = '';

        // Calculate days
        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const prevMonthDays = new Date(year, month, 0).getDate();

        // Fetch counts
        const counts = await fetchMonthData(month, year);

        // Previous Month Padding
        for (let i = 0; i < firstDay; i++) {
            const day = prevMonthDays - firstDay + i + 1;
            calendarGrid.appendChild(createDayElement(day, false));
        }

        // Current Month
        const today = new Date();
        const isCurrentMonth = today.getFullYear() === year && today.getMonth() === month;

        for (let i = 1; i <= daysInMonth; i++) {
            const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
            const isToday = isCurrentMonth && today.getDate() === i;

            // Ensure we handle both object and array response formats from Laravel
            let dayAppointments = counts[dateStr] || [];
            if (typeof dayAppointments === 'object' && !Array.isArray(dayAppointments)) {
                dayAppointments = Object.values(dayAppointments);
            }

            calendarGrid.appendChild(createDayElement(i, true, isToday, dayAppointments, dateStr));
        }

        // Next Month Padding
        const totalCells = 42; // 6 rows
        const currentCells = firstDay + daysInMonth;
        for (let i = 1; i <= (totalCells - currentCells); i++) {
            calendarGrid.appendChild(createDayElement(i, false));
        }
    };

    const createDayElement = (day, isCurrentMonth, isToday = false, dayAppointments = [], dateStr = '') => {
        const div = document.createElement('div');
        // Use bg-white for current month to match image, and a light gray for empty padding days
        div.className = `h-[100px] md:h-[120px] p-2 flex flex-col gap-1 transition-colors ${isCurrentMonth ? 'bg-white' : 'bg-gray-50'} overflow-hidden`;

        const header = document.createElement('div');
        header.className = 'flex justify-between items-start mb-0.5';

        const daySpan = document.createElement('span');
        // Match image date styling: Cyan text if today, standard dark text otherwise (no circle background)
        daySpan.className = `text-sm font-medium ${isToday ? 'text-cyan-400 font-bold' : (isCurrentMonth ? 'text-gray-800' : 'text-gray-400')}`;
        daySpan.textContent = day;
        header.appendChild(daySpan);

        div.appendChild(header);

        if (isCurrentMonth && dayAppointments.length > 0) {
            const pillsContainer = document.createElement('div');
            pillsContainer.className = 'flex-1 flex flex-col gap-1 overflow-y-auto scrollbar-hide pb-1 min-w-0';

            dayAppointments.forEach(appt => {
                const pill = document.createElement('button');

                // Match status borders to the image (Cyan for normal/scheduled, Red for Cancelled/No Show)
                let borderColorClass = 'border-cyan-400';
                const status = (appt.status || '').toLowerCase();
                if (status.includes('cancel') || status.includes('no show')) {
                    borderColorClass = 'border-red-400';
                } else if (status.includes('complete')) {
                    borderColorClass = 'border-green-400';
                }

                // Match image pill layout: centered text, white background, colored border
                pill.className = `block w-full text-center px-1 py-0.5 border ${borderColorClass} bg-white text-gray-800 text-[10px] leading-tight truncate transition-transform cursor-pointer rounded-sm shadow-sm`;
                pill.textContent = appt.patient_name;
                pill.title = appt.patient_name;

                pill.addEventListener('click', (e) => {
                    e.stopPropagation();
                    if (window.showAppointmentDetail) {
                        window.showAppointmentDetail(appt.id);
                    }
                });

                pillsContainer.appendChild(pill);
            });
            div.appendChild(pillsContainer);
        }

        return div;
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

import './appointments-scroll';
import './appointments-detail';
import './appointments-calendar';

document.addEventListener('DOMContentLoaded', () => {
    const sortBtn = document.getElementById('date-sort-btn');
    const sortIcon = document.getElementById('date-sort-icon');
    const searchInput = document.getElementById('appointment-search');
    const toggleViewBtn = document.getElementById('toggle-view-btn');
    const viewText = document.getElementById('view-text');
    const listPanel = document.getElementById('appointment-container');
    const calendarPanel = document.getElementById('calendar-panel');
    const infiniteTrigger = document.getElementById('infinite-scroll-trigger');

    let sortOrder = 'asc';
    let searchTimeout;
    let isCalendarView = false;

    if (toggleViewBtn && listPanel && calendarPanel) {
        toggleViewBtn.addEventListener('click', () => {
            isCalendarView = !isCalendarView;
            
            if (isCalendarView) {
                listPanel.classList.add('hidden');
                infiniteTrigger.classList.add('hidden');
                calendarPanel.classList.remove('hidden');
                viewText.textContent = 'List View';
                
                if (window.AppointmentCalendar && typeof window.AppointmentCalendar.init === 'function') {
                    window.AppointmentCalendar.init();
                }
            } else {
                listPanel.classList.remove('hidden');
                infiniteTrigger.classList.remove('hidden');
                calendarPanel.classList.add('hidden');
                viewText.textContent = 'Calendar View';
            }
        });
    }

    if (sortBtn && sortIcon) {
        sortBtn.addEventListener('click', () => {
            sortOrder = sortOrder === 'asc' ? 'desc' : 'asc';
            
            // Toggle icon flip
            if (sortOrder === 'desc') {
                sortIcon.classList.add('rotate-180');
            } else {
                sortIcon.classList.remove('rotate-180');
            }

            // Trigger list update
            if (window.AppointmentList && typeof window.AppointmentList.setSort === 'function') {
                window.AppointmentList.setSort(sortOrder);
            }
        });
    }

    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                if (window.AppointmentList && typeof window.AppointmentList.setSearch === 'function') {
                    window.AppointmentList.setSearch(e.target.value);
                }
            }, 300);
        });
    }

    const dateFilterInput = document.getElementById('date-filter-input');

    if (dateFilterInput) {
        dateFilterInput.addEventListener('change', (e) => {
            const val = e.target.value; // YYYY-MM-DD
            if (window.AppointmentList && typeof window.AppointmentList.setDate === 'function') {
                window.AppointmentList.setDate(val);
            }
        });
    }

    const statusFilterSelect = document.getElementById('status-filter');

    if (statusFilterSelect) {
        statusFilterSelect.addEventListener('change', (e) => {
            const val = e.target.value;
            if (window.AppointmentList && typeof window.AppointmentList.setStatus === 'function') {
                window.AppointmentList.setStatus(val);
            }
        });
    }
});

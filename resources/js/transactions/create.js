const ledgerTbl = document.getElementById('ledger-info-table');
const transactionTbl = document.getElementById('transaction-info-table');

const selectAppointment = async (id) => {
    const res = await fetch(`/appointments/${id}/full`);
    const appointmentDetails = await res.json();
    if (!appointmentDetails) {
        console.log('No appointment details found.');
        return;
    }

    console.log(appointmentDetails);

    const { procedures } = appointmentDetails;
    const transactions = procedures.flatMap(p => p.transactions);
    renderLedger(procedures);
    renderTransactions(transactions);
}

const renderLedger = (entries) => {
    ledgerTbl.innerHTML = entries.length
    ? entries.map(entry => `
        <tr>
            <td>${entry.procedure_name}</td>
            <td>#${entry.ledger_id}</td>
            <td>₱${entry.charged_price}</td>
        </tr>        
    `).join('')
    :`
        <tr>
            <td colspan="3" class="text-center italic text-gray-400 py-3">
                No ledger entries yet.
            </td>
        </tr>
    `;
}

const renderTransactions = (transactions) => {
    transactionTbl.innerHTML = transactions.length 
        ? transactions.map(tx => `
            <tr>
                <td>${tx.procedure_name}</td>
                <td>#${tx.ledger_id}</td>
                <td>₱${tx.charged_price}</td>
            </tr>      
        `).join('')
        : `
            <tr>
                <td colspan="5" class="text-center italic text-gray-400 py-3">
                    No transactions yet.
                </td>
            </tr>
        `;
}

document.addEventListener('patientSelected', async (e) => {
    const patient = e.detail;

    const patientInfoContainer = document.getElementById('patient-info-container');
    if (!patientInfoContainer) return;

    patientInfoContainer.innerHTML = `
        <p class="italic text-sm">${patient.patient_id}</p>
        <p class="font-semibold text-lg">${patient.full_name}</p>
        <p class="text-gray-500">${patient.contact_no}</p>
        <p class="text-gray-500">${patient.age} year(s) old</p>
    `;

    const appointmentContainer = document.getElementById('appointment-container');
    if (!appointmentContainer) return;

    appointmentContainer.innerHTML = `<p class="italic text-gray-400">Loading...</p>`;
    try {
        const res = await fetch(`/patients/${patient.patient_id}/appointments`);
        const appointments = await res.json();
        if (appointments.length === 0) {
            appointmentContainer.innerHTML = `<p class="italic text-gray-400">No appointments found.</p>`;
            return;
        }

        console.log(appointments);
        appointmentContainer.innerHTML = appointments.map(appointment => `
            <div 
                class="flex appointment-card flex-col gap-1"
                data-appointment-id="${appointment.appointment_id}"
            >
                <div class="flex justify-between">
                    <p>${appointment.scheduled_at_fmt} | ${appointment.slot} </p>
                    <p>${appointment.status}</p>
                </div>
                <p>Dr. ${appointment.dentist.full_name}</p>
            </div>
        `).join(' ');

        const appointmentCards = document.querySelectorAll('.appointment-card').forEach(el => {
            el.addEventListener('click', () => {
                const id = el.dataset.appointmentId;
                selectAppointment(id);
            })
        });
        
    } catch (err) {
        console.log(err);
        appointmentContainer.innerHTML = `<p class="text-red-500">Failed to load appointments.</p>`;
    }
})
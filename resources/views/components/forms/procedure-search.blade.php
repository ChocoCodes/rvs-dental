<div id="procedure-container">
    <input type="text" id="procedure-search" placeholder="Search procedures..." autocomplete="off">
    <ul id="procedure-dropdown" class="hidden"></ul>
</div>

@push('scripts')
<script>
    const searchInput = document.getElementById('procedure-search');
    const procedureDropdown = document.getElementById('procedure-dropdown');

    const fetchProcedures = async () => {
        const procedures = await fetch(`/procedures`)
    }
</script>
@endpush
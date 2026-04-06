<x-forms.container
    action="{{ $action }}"
    method="POST"
    class="flex flex-col gap-2 w-1/4"
>
    @method($method ?? 'POST')
    
    @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded p-3">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li class="text-red-500 text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <x-ui.dentist-dropdown :selected="old('dentist_id', $appointment->dentist_id)" />
    <x-ui.button 
        type="submit" 
        variant="primary" 
        class="px-1 py-3"
    >
        {{ $submitLabel }}
    </x-ui.button>
</x-forms.container>
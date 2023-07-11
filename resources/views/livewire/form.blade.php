<div>
    <form wire:submit.prevent="submit" class="max-w-3xl mx-auto w-full p-8 space-y-6">
        {{ $this->form }}

        <x-filament::button type="submit">
            Submit
        </x-filament::button>
    </form>

    <div class="max-w-3xl mx-auto w-full px-8 py-24 space-y-6">
        {{ json_encode($data) }}
    </div>
</div>

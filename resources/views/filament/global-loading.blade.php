{{-- FULL PAGE LOADING --}}
<div
    id="page-loader"
    class="fixed inset-0 z-[9999] flex items-center justify-center bg-white">
    <x-filament::loading-indicator class="h-12 w-12 text-primary-600" />
</div>

{{-- LIVEWIRE LOADING --}}
<div
    wire:loading.delay.flex
    class="fixed inset-0 z-[9999] items-center justify-center bg-white">
    <x-filament::loading-indicator class="h-12 w-12 text-primary-600" />
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const loader = document.getElementById('page-loader');

        // hilangkan loader setelah page siap
        setTimeout(() => {
            loader?.classList.add('hidden');
        }, 200);
    });
</script>
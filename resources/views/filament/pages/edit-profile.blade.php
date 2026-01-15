<x-filament-panels::page>
    {{-- Full Page Loading Overlay --}}
    <div
        wire:loading.flex
        wire:target="updateProfile,updatePassword"
        class="fixed inset-0 z-50 items-center justify-center bg-white">
        <x-filament::loading-indicator class="h-12 w-12 text-primary-600" />
    </div>
    {{-- Page content --}}
    <x-filament::card>
        <form wire:submit.prevent="updateProfile">
            {{ $this->editProfileForm }}
        </form>
    </x-filament::card>

    <form wire:submit.prevent="savePassword" class="mt-10 space-y-6">
        {{ $this->editPasswordForm }}
    </form>
</x-filament-panels::page>
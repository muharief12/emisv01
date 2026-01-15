<?php

namespace App\Filament\Pages;

use BackedEnum;
use Exception;
use Filament\Forms;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class EditProfile extends Page implements HasForms
{
    use InteractsWithForms;

    protected static bool $shouldRegisterNavigation = true;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserCircle;

    protected string $view = 'filament.pages.edit-profile';

    protected static ?string $slug = 'edit-profile';


    public ?array $profileData = [];
    public ?array $passwordData = [];

    public function mount(): void
    {
        $this->fillForms();
    }

    protected function getForms(): array
    {
        return [
            'editProfileForm',
            'editPasswordForm',
        ];
    }

    /* ================= PROFILE FORM ================= */

    public function editProfileForm(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Profile Information')
                ->description('Update your profile information.')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->required(),

                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->required()
                        ->unique(ignoreRecord: true),
                    Action::make('updateProfile')
                        ->label(__('Save'))
                        ->submit('editProfileForm'),
                ]),
        ])
            ->model($this->getUser())
            ->statePath('profileData');
    }

    /* ================= PASSWORD FORM ================= */

    public function editPasswordForm(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Update Password')
                ->description('Use a strong password.')
                ->schema([
                    Forms\Components\TextInput::make('current_password')
                        ->password()
                        ->required()
                        ->currentPassword(),

                    Forms\Components\TextInput::make('password')
                        ->password()
                        ->required()
                        ->rule(Password::default())
                        ->same('password_confirmation')
                        ->dehydrateStateUsing(fn($state) => Hash::make($state)),

                    Forms\Components\TextInput::make('password_confirmation')
                        ->password()
                        ->required()
                        ->dehydrated(false),
                ]),
        ])
            ->model($this->getUser())
            ->statePath('passwordData');
    }

    /* ================= ACTIONS ================= */

    // protected function getProfileFormActions(): array
    // {
    //     return [
    //         Action::make('saveProfile')
    //             ->label(__('Save'))
    //             ->action('updateProfile'),
    //     ];
    // }

    // protected function getPasswordFormActions(): array
    // {
    //     return [
    //         Action::make('savePassword')
    //             ->label(__('Save'))
    //             ->action('updatePassword'),
    //     ];
    // }

    /* ================= HANDLERS ================= */

    public function updateProfile(): void
    {
        $this->getUser()->update(
            $this->editProfileForm->getState()
        );

        $this->notifySuccess();

        // ✅ FULL PAGE RELOAD (AVATAR & TOPBAR IKUT UPDATE)
        $this->js('window.location.reload()');
    }

    public function updatePassword(): void
    {
        $this->getUser()->update(
            $this->editPasswordForm->getState()
        );

        $this->editPasswordForm->fill();
        $this->notifySuccess();
    }

    /* ================= UTILITIES ================= */

    protected function getUser(): Authenticatable & Model
    {
        $user = Filament::auth()->user();

        if (! $user instanceof Model) {
            throw new Exception('Authenticated user must be an Eloquent model.');
        }

        return $user;
    }

    protected function fillForms(): void
    {
        $this->editProfileForm->fill(
            $this->getUser()->attributesToArray()
        );

        $this->editPasswordForm->fill();
    }

    protected function notifySuccess(): void
    {
        Notification::make()
            ->success()
            ->title(__('Profile updated successfully'))
            ->send();
    }
}

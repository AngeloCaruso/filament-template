<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Support\Exceptions\Halt;
use Illuminate\Support\Facades\Hash;


class EditProfile extends Page implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];
    protected static ?string $model = User::class;
    protected static bool $shouldRegisterNavigation = false;
    protected static string $view = 'filament.pages.edit-profile';
    protected static ?string $title = "Perfil";

    public function mount(): void
    {
        /** @var \App\User|null $user */
        $user = auth()->user();
        $user->role = $user->getRoleNames()->first();
        $this->form->fill($user->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Editar datos del usuario')->schema([
                    TextInput::make('name')
                        ->label('Nombres')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('last_name')
                        ->label('Apellidos')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('phone')
                        ->label('Teléfono')
                        ->required()
                        ->tel()
                        ->mask('999 999 99 99')
                        ->maxLength(255),
                    TextInput::make('email')
                        ->label('Correo electrónico')
                        ->email()
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true),

                ])->columnSpan(2),
                Section::make()->schema([
                    TextInput::make('password')
                        ->label('Contraseña')
                        ->password()
                        ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                        ->dehydrated(fn (?string $state): bool => filled($state))
                        ->required(fn (string $operation): bool => $operation === 'create'),
                    TextInput::make('role')
                        ->label('Rol')
                        ->disabled()
                        ->dehydrated(),
                    FileUpload::make('firm_url')
                        ->label('Firma')
                        ->image(),

                ])->columnSpan(1),
            ])->columns(3)
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
            ->label('Guardar datos')
            ->submit('save'),
        ];
    }

    public function save(): void
    {
        try {
            /** @var \App\User|null $user */
            $user = auth()->user();
            $data = $this->form->getState();
            $user->update($data);

            Notification::make()
                ->title('Datos actualizados con exito')
                ->success()
                ->send();
        } catch (Halt $exception){
            Notification::make()
                ->title('Error: ' . $exception->getMessage())
                ->danger()
                ->color('danger')
                ->send();
        }
    }
}

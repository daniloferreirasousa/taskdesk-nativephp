<?php

namespace App\Providers;

use Native\Desktop\Facades\Window;
use Native\Desktop\Contracts\ProvidesPhpIni;
use Native\Desktop\Facades\Menu;
use Native\Desktop\Facades\MenuBar;


class NativeAppServiceProvider implements ProvidesPhpIni
{
    /**
     * Executed once the native application has been booted.
     * Use this method to open windows, register global shortcuts, etc.
     */
    public function boot(): void
    {
        Window::open('main')
            ->title('TaskDesk')
            ->width(900)
            ->height(700)
            ->minWidth(700)
            ->minHeight(500)
            ->rememberState();

        Window::open('settings')
            ->title('Configurações')
            ->route('configuracoes')
            ->width(600)
            ->height(500)
            ->minWidth(500)
            ->minHeight(400);

        Window::open('about')
            ->title('Sobre o TaskDesk')
            ->route('sobre')
            ->width(450)
            ->height(300)
            ->resizable(false);

        MenuBar::create()
            ->showDockIcon()
            ->tooltip('TaskDeks')
            ->withContextMenu(
                Menu::new()
                    ->label('TaskDesk')
                    ->separator()
                    ->route(
                        'tarefas.index',
                        'Tarefas'
                    )
                    ->route(
                        'configuracoes',
                        'Configurações'
                    )
                    ->route(
                        'sobre',
                        'Sobre'
                    )
                    ->separator()
                    ->quit('Sair')
            );
        
    }

    /**
     * Return an array of php.ini directives to be set.
     */
    public function phpIni(): array
    {
        return [
        ];
    }
}

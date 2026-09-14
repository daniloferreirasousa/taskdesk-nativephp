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
        Window::open()
            ->title('TaskDesk')
            ->width(900)
            ->height(700)
            ->minWidth(700)
            ->minHeight(500)
            ->rememberState();
            
        Menu::default();

        MenuBar::create()
            ->showDockIcon()
            ->tooltip('TaskDeks')
            ->withContextMenu(
                Menu::create(
                    Menu::label('TaskDesk'),
                    Menu::separator(),
                    Menu::route(
                        'tarefas.index',
                        'Abir TaskDeks'
                    ),
                    Menu::separator(),
                    Menu::quit(),
                )
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

<?php

namespace App\Providers;

use Native\Desktop\Facades\Window;
use Native\Desktop\Contracts\ProvidesPhpIni;
use Native\Desktop\Facades\Menu;
use Native\Desktop\Facades\MenuBar;
use Native\Desktop\Facades\GlobalShortcut;
use Native\Desktop\Facades\Notification;


class NativeAppServiceProvider implements ProvidesPhpIni
{
    /**
     * Executed once the native application has been booted.
     * Use this method to open windows, register global shortcuts, etc.
     */
    public function boot(): void
    {
        // 1. Configuração da Janela Principal
        Window::open('main')
            ->title('TaskDesk')
            ->route('tarefas.index')
            ->width(1100)
            ->height(750)
            ->minWidth(800)
            ->minHeight(600)
            ->rememberState();

        // 2. Menu Nativo Superior
        Menu::create(
            Menu::label('TaskDesk'),
            Menu::separator(),
            Menu::route('tarefas.index', 'Tarefas'),
            Menu::route('configuracoes', 'Configurações'),
            Menu::separator(),
            Menu::quit()
        );

        // 3. System Tray (Barra de Tarefas)
        MenuBar::create()
            ->showDockIcon()
            ->tooltip('TaskDesk')
            ->withContextMenu(
                Menu::create(
                    Menu::route('tarefas.index', 'Abrir TaskDesk'),
                    Menu::route('relatorios.index', 'Relatórios'),
                    Menu::separator(),
                    Menu::quit()
                )
            );

        // 4. Atalhos Globais
        GlobalShortcut::key('CmdOrCtrl+Shift+T')
            ->event(function () {
                Window::open('main')->focus();
                Notification::new()
                    ->title('TaskDesk')
                    ->message('Aplicação focada via atalho global.')
                    ->show();
            })
            ->register();

        GlobalShortcut::key('CmdOrCtrl+Shift+N')
            ->event(function () {
                Window:open('about')
                    ->title('Sobre o TaskDesk')
                    ->route('sobre')
                    ->width(450)
                    ->height(300)
                    ->resizable(false);
            })
            ->register();

        
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

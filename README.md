# 🚀 TaskDesk (Powered by NativePHP)

**TaskDesk** é uma aplicação nativa de gerenciamento de tarefas desktop construída com o ecossistema **Laravel** e **NativePHP Desktop**. O software une a produtividade do Laravel com a integração nativa aos sistemas operacionais Windows, macOS e Linux.

---

**Arquitetura do Sistema**

O sistema funciona com base na **Arquitetura de Duas Dimensões**:

```text
+-----------------------------------------------------------------------+
|                           TASKDESK                                    |
+-----------------------------------+-----------------------------------+
|         DIMENSÃO LARAVEL          |        DIMENSÃO NATIVEPHP         |
+-----------------------------------+-----------------------------------+
| • Regras de Negócio e Validações  | • Gerenciamento de Janelas        |
| • Controllers, Actions & Services | • Menus Nativos e System Tray     |
| • Eloquent ORM & Migrations       | • Notificações do SO              |
| • Views Blade (Tailwind CSS)      | • Atalhos Globais (Hotkeys)       |
| • Banco de Dados SQLite Local     | • Integração Shell com o SO       |
+-----------------------------------+-----------------------------------+

```

---

**Funcionalidades & Recursos Nativos**

* **Gestão de Tarefas Completa:** Cadastro, listagem, filtros por status/prioridade/categoria e alteração dinâmica de status.


* **Relatórios Nativos Exportáveis:** Geração de relatórios em arquivos TXT no armazenamento local e abertura automatizada via gerenciador do sistema.


* **System Tray / Menu Bar:** Execução contínua em segundo plano com atalhos de contexto no menu da barra de tarefas.


* **Notificações Nativas:** Disparo de alertas visuais do SO ao criar, remover tarefas ou acionar atalhos do sistema.


* **Atalhos Globais de Teclado:** Abertura e foco rápido da janela principal (`CmdOrCtrl+Shift+T`) ou da tela "Sobre" (`CmdOrCtrl+Shift+N`) mesmo com o app minimizado.


* **Integração Shell Segura:** Navegação até diretórios locais e execução de arquivos via `Shell::openFile()` e `Shell::showInFolder()`.



---

**Stack Tecnológica**

* **Framework Base:** PHP 8.2+ / Laravel 11


* **Engine Desktop:** NativePHP Desktop (`nativephp/desktop`)


* **Banco de Dados:** SQLite Local


* **Frontend:** Blade Views & Tailwind CSS


* **Testes Automatizados:** PHPUnit / Pest Framework



---

**Estrutura do Projeto**

```text
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── TarefaController.php     # Gestão e notificações de tarefas
│   │       └── RelatorioController.php  # Exportação e integração Shell
│   ├── Models/
│   │   └── Tarefa.php                   # Entidade principal do banco local
│   └── Providers/
│       └── NativeAppServiceProvider.php # Registro de Janelas, Menus e Atalhos
├── config/
│   └── nativephp.php                    # App ID, Ícones e SemVer
├── database/
│   ├── migrations/                      # Estrutura da tabela tarefas
│   └── seeders/                         # Dados iniciais de teste
├── resources/
│   └── views/
│       ├── layouts/                     # Layout principal (app.blade.php)
│       ├── tarefas/                     # Listagem e formulários
│       ├── relatorios.blade.php          # Painel de exportação local
│       ├── configuracoes.blade.php      # Informações do ambiente nativo
│       └── sobre.blade.php              # Janela nativa secundária
└── routes/
    └── web.php                          # Mapeamento de rotas web/desktop

```

---

**Instalação & Configuração**

**Pré-requisitos**

* PHP >= 8.3


* Composer


* Node.js & NPM



**Passo a Passo**

1. **Clonar o repositório:**
```bash
git clone https://github.com/seu-usuario/taskdesk.git
cd taskdesk

```


2. **Instalar dependências do PHP:**
```bash
composer install

```


3. **Configurar variáveis de ambiente:**
```bash
cp .env.example .env
php artisan key:generate

```


4. **Instalar o ecossistema NativePHP:**
```bash
php artisan native:install

```


5. **Executar em modo de desenvolvimento:**
```bash
php artisan native:run

```



---

**Comandos Utilitários (Cheatsheet)**

| Categoria | Comando | Finalidade |
| --- | --- | --- |
| **Desenvolvimento** | `php artisan native:run` | Inicia o aplicativo em modo desktop com suporte a logs.

 |
| **Banco Local** | `php artisan native:migrate` | Aplica as alterações no banco SQLite nativo.

 |
| **Reset Local** | `php artisan native:migrate:fresh` | Apaga e recria a base local *(Apenas em desenvolvimento)*.

 |
| **Build Windows** | `php artisan native:build win` | Compila o instalador nativo `.exe`.

 |
| **Build macOS** | `php artisan native:build mac` | Gera o pacote instalador `.dmg`.

 |
| **Build Linux** | `php artisan native:build linux` | Gera a imagem executável `.AppImage`.

 |

---

**Decisões Arquiteturais & Boas Práticas (ADRs)**

1. **Isolamento de Responsabilidades do `NativeAppServiceProvider`:**
O provider nativo é mantido sem consultas ao banco de dados ou regras de negócio. Sua função é restrita a registrar componentes nativos como janelas, menubars, atalhos e notificações.


2. **Estratégia de Persistência Sem Perda de Dados:**
Em ambiente de produção ou atualização, utiliza-se exclusivamente `php artisan native:migrate`. O uso de `migrate:fresh` é vetado fora do desenvolvimento para garantir a preservação do histórico de tarefas do usuário.


3. **Segurança e Higienização com a Facade `Shell`:**
Entradas enviadas para a Facade `Shell` passam obrigatoriamente pela validação de Form Requests ou `$request->validate()` no `TarefaController` para prevenir a execução não autorizada de comandos no SO.


4. **Modo Seguro por Padrão:**
A integração direta do Node.js permanece desabilitada na configuração padrão do NativePHP para reduzir a superfície de vulnerabilidades no sistema cliente.



---

**Roadmap de Evolução (v1.0 Desktop ➔ v2.0 Mobile)**

* [x] **v1.0 (Desktop Native):**
* Interface adaptada com Tailwind CSS e suporte a múltiplas janelas.


* Notificações locais, tray/menubar e atalhos de teclado globais.


* Exportação de relatórios TXT com abertura automática no SO.




* [ ] **v2.0 (Mobile Native - Em Planejamento):**
* Adaptação de layout responsivo voltado para touch screen e navegação por abas inferiores (*Bottom Navigation*).
* Sincronização offline-first entre SQLite Desktop e SQLite Mobile.
* Notificações push nativas para dispositivos iOS e Android.
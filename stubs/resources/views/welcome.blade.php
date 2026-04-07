<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="{{ Module }} – Modular Mini Framework for Laravel. Execute 'php artisan assets:publish' within the module to make the public folder (containing assets) publicly accessible.">
    <title>{{ __('{{ Module }} – Modular Mini Framework for Laravel') }}</title>

    <link rel="icon" href="{{ asset('third-party/{{ module }}/favicon.png') }}" type="image/png">

    <link nonce={{ $nonce }} href="{{ module_mix('css/app.css') }}" rel="stylesheet">
    <style nonce="{{ $nonce }}">
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .glass-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(99, 102, 241, 0.2);
        }

        .gradient-border {
            position: relative;
            background: linear-gradient(15deg, #0f172a, #0f172a) padding-box,
                linear-gradient(135deg, #6366f1, #8b5cf6, #06b6d4) border-box;
            border: 2px solid transparent;
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(99, 102, 241, 0.4);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(99, 102, 241, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(99, 102, 241, 0);
            }
        }

        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .code-block {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        }

        /* Responsive fixes for Spanish text */
        .responsive-text {
            line-height: 1.6;
        }

        .word-wrap-fix {
            overflow-wrap: break-word;
            word-wrap: break-word;
            hyphens: auto;
        }

        .responsive-grid {
            display: grid;
            gap: 1.5rem;
        }

        /* Mobile navigation */
        .mobile-menu {
            display: none;
        }

        @media (max-width: 768px) {
            .mobile-menu {
                display: flex;
            }

            .desktop-nav {
                display: none !important;
            }

            .text-responsive {
                font-size: clamp(1.5rem, 4vw, 2.5rem) !important;
                line-height: 1.3 !important;
            }

            .subtext-responsive {
                font-size: clamp(1rem, 3vw, 1.25rem) !important;
            }

            .section-padding {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }
        }
    </style>
</head>

<body class="bg-slate-950 text-slate-100">

    <!-- Navigation -->
    <nav class="sticky top-0 z-50 glass-card border-b border-slate-800/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div
                    class="w-8 h-8 rounded-lg bg-linear-to-br from-indigo-600 to-purple-600 flex items-center justify-center">
                    <i class="fas fa-cube text-white"></i>
                </div>
                <span class="text-xl font-bold">{{ __('Elymod') }}</span>
            </div>

            <!-- Desktop Navigation -->
            <div class="desktop-nav hidden md:flex gap-6 lg:gap-8">
                <a href="#purpose"
                    class="text-slate-300 hover:text-indigo-400 transition whitespace-nowrap">{{ __('Purpose') }}</a>
                <a href="#architecture"
                    class="text-slate-300 hover:text-indigo-400 transition whitespace-nowrap">{{ __('Architecture') }}</a>
                <a href="#features"
                    class="text-slate-300 hover:text-indigo-400 transition whitespace-nowrap">{{ __('Features') }}</a>
                <a href="#isolation"
                    class="text-slate-300 hover:text-indigo-400 transition whitespace-nowrap">{{ __('Module Isolation') }}</a>
            </div>

            <!-- Mobile Menu Button -->
            <button class="mobile-menu md:hidden text-slate-300 hover:text-indigo-400">
                <i class="fas fa-bars text-xl"></i>
            </button>

            <div class="hidden md:flex items-center gap-4"> 
                @if (Route::has('module.{{ module }}.admin.admin'))
                    <a href="{{ route('module.{{ module }}.admin.admin') }}"
                        class="rounded-lg bg-slate-800 hover:bg-slate-700 px-4 py-2 transition whitespace-nowrap text-sm lg:text-base">
                        <i class="fa-solid fa-lock-open mr-2"></i>{{ __('My Admin') }}
                    </a>
                @endif
                <a href="https://github.com/elyerrlabs/elymod" target="_blank"
                    class="rounded-lg bg-slate-800 hover:bg-slate-700 px-4 py-2 transition whitespace-nowrap text-sm lg:text-base">
                    <i class="fab fa-github mr-2"></i>GitHub
                </a>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div class="mobile-nav hidden md:hidden bg-slate-900 border-t border-slate-800 px-4 py-4">
            <div class="flex flex-col gap-4">
                <a href="#purpose" class="text-slate-300 hover:text-indigo-400 transition py-2">{{ __('Purpose') }}</a>
                <a href="#architecture"
                    class="text-slate-300 hover:text-indigo-400 transition py-2">{{ __('Architecture') }}</a>
                <a href="#features"
                    class="text-slate-300 hover:text-indigo-400 transition py-2">{{ __('Features') }}</a>
                <a href="#isolation"
                    class="text-slate-300 hover:text-indigo-400 transition py-2">{{ __('Module Isolation') }}</a>
                <div class="pt-4 border-t border-slate-800">
                    @if (Route::has('module.{{ module }}.admin.admin'))
                        <a href="{{ route('module.{{ module }}.admin.admin') }}"
                            class="block rounded-lg bg-slate-800 hover:bg-slate-700 px-4 py-3 transition text-center mb-3">
                            <i class="fa-solid fa-lock-open mr-2"></i>{{ __('My Admin') }}
                        </a>
                    @endif
                    <a href="https://github.com/elyerrlabs/elymod" target="_blank"
                        class="block rounded-lg bg-slate-800 hover:bg-slate-700 px-4 py-3 transition text-center">
                        <i class="fab fa-github mr-2"></i>GitHub
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="relative overflow-hidden">
        <!-- Animated background -->
        <div class="absolute inset-0 bg-linear-to-br from-indigo-900/30 via-purple-900/20 to-cyan-900/30"></div>
        <div class="absolute top-10 left-10 w-72 h-72 bg-purple-600/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-cyan-600/10 rounded-full blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 py-16 md:py-28 section-padding">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 bg-slate-800/50 rounded-full px-4 py-2 mb-6">
                    <span class="w-2 h-2 rounded-full bg-green-500 pulse"></span>
                    <span class="text-sm">{{ __('Modular Framework v1.0') }}</span>
                </div>

                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-7xl font-bold leading-tight text-responsive">
                    {{ __('Build') }}
                    <span class="gradient-text">{{ __('Modular') }}</span>
                    <br class="hidden sm:block">
                    {{ __('OAuth2 Modules') }}
                </h1>
                <p class="mt-6 text-lg md:text-xl text-slate-300 max-w-2xl subtext-responsive responsive-text">
                    {{ __('Elymod is a lightweight mini-framework designed specifically for building') }}
                    <span class="text-white font-semibold">{{ __('independent modules') }}</span>
                    {{ __('for OAuth2 Passport servers. Each module is self-contained with its own dependencies, licensing, and functionality.') }}
                </p>
                <div class="mt-10 flex flex-wrap gap-4">
                    <a href="#architecture"
                        class="flex-1 min-w-[200px] rounded-xl bg-linear-to-r from-indigo-600 to-purple-600 px-6 py-4 font-semibold hover:from-indigo-500 hover:to-purple-500 transition hover-lift flex items-center justify-center gap-2 text-center">
                        <i class="fas fa-layer-group"></i> {{ __('Explore Architecture') }}
                    </a>
                    <a href="#isolation"
                        class="flex-1 min-w-[200px] rounded-xl glass-card border border-slate-700 px-6 py-4 font-medium hover:bg-slate-800/50 transition hover-lift flex items-center justify-center gap-2 text-center">
                        <i class="fas fa-shield-alt"></i> {{ __('Module Isolation') }}
                    </a>
                </div>

                <div class="mt-16 responsive-grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="text-center p-4">
                        <div class="text-2xl sm:text-3xl font-bold text-indigo-400">{{ __('Independent') }}</div>
                        <div class="text-sm text-slate-400 mt-1">{{ __('Self-contained modules') }}</div>
                    </div>
                    <div class="text-center p-4">
                        <div class="text-2xl sm:text-3xl font-bold text-purple-400">{{ __('Laravel Bridge') }}</div>
                        <div class="text-sm text-slate-400 mt-1">{{ __('Familiar Artisan commands') }}</div>
                    </div>
                    <div class="text-center p-4">
                        <div class="text-2xl sm:text-3xl font-bold text-cyan-400">{{ __('Dependency Isolation') }}
                        </div>
                        <div class="text-sm text-slate-400 mt-1">{{ __('No parent dependency conflicts') }}</div>
                    </div>
                    <div class="text-center p-4">
                        <div class="text-2xl sm:text-3xl font-bold text-green-400">{{ __('OAuth2 Ready') }}</div>
                        <div class="text-sm text-slate-400 mt-1">{{ __('Passport integration') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Purpose -->
    <section id="purpose" class="max-w-7xl mx-auto px-4 sm:px-6 py-12 md:py-20 section-padding">
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 mb-8 md:mb-12">
            <div
                class="w-12 h-12 rounded-xl bg-linear-to-br from-indigo-600 to-purple-600 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-bullseye text-white"></i>
            </div>
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold word-wrap-fix">
                {{ __('Purpose: Modular OAuth2 Extension Framework') }}</h2>
        </div>

        <div class="grid lg:grid-cols-2 gap-8 md:gap-12 items-start">
            <div>
                <p class="mt-4 text-base md:text-lg text-slate-300 responsive-text">
                    {{ __('Elymod is specifically designed to extend') }}
                    <span class="text-white font-semibold">{{ __('OAuth2 Passport Authorization Servers') }}</span>
                    {{ __('with pluggable modules. Each module is completely independent with its own:') }}
                </p>

                <div class="mt-6 md:mt-8 space-y-4">
                    <div class="flex items-start gap-3">
                        <div
                            class="w-8 h-8 rounded-lg bg-indigo-900/30 flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-box text-indigo-400 text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-base">{{ __('Independent Dependencies') }}</h4>
                            <p class="text-slate-400 text-sm mt-1 responsive-text">
                                {{ __('Modules install dependencies in their own vendor directory, never relying on the parent application.') }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div
                            class="w-8 h-8 rounded-lg bg-purple-900/30 flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-balance-scale text-purple-400 text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-base">{{ __('Separate Licensing') }}</h4>
                            <p class="text-slate-400 text-sm mt-1 responsive-text">
                                {{ __('Each module can have its own license, allowing different teams to develop and distribute modules independently.') }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div
                            class="w-8 h-8 rounded-lg bg-cyan-900/30 flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-cogs text-cyan-400 text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-base">{{ __('Self-Contained Functionality') }}</h4>
                            <p class="text-slate-400 text-sm mt-1 responsive-text">
                                {{ __('Modules include all necessary code, configuration, and assets. No shared codebase conflicts.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rounded-2xl gradient-border p-6 md:p-8 hover-lift mt-8 lg:mt-0">
                <h3 class="text-xl md:text-2xl font-semibold mb-4 md:mb-6 text-center">
                    {{ __('The Problem We Solve') }}</h3>
                <div class="space-y-4 md:space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-lg bg-red-900/30 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-red-400"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-base">{{ __('Traditional Module Systems') }}</h4>
                            <p class="text-sm text-slate-400 mt-1 responsive-text">
                                {{ __('Modules depend on parent application dependencies, causing version conflicts and breaking changes.') }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div
                            class="w-10 h-10 rounded-lg bg-green-900/30 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-check-circle text-green-400"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-base">{{ __('Elymod Solution') }}</h4>
                            <p class="text-sm text-slate-400 mt-1 responsive-text">
                                {{ __('Each module is truly independent. Dependencies are installed within the module, never searching the parent vendor.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Architecture -->
    <section id="architecture" class="bg-linear-to-b from-slate-950 to-slate-900 border-y border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12 md:py-20 section-padding">
            <div class="text-center mb-8 md:mb-16">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4">
                    {{ __('Architecture: Independent Module Framework') }}</h2>
                <p class="text-slate-300 max-w-3xl mx-auto text-base md:text-lg responsive-text">
                    {{ __('Elymod provides a complete Laravel-like environment for each module, powered by Laravel Runtime bridge.') }}
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-8 md:gap-12">
                <!-- Left Column: Architecture Flow -->
                <div>
                    <h3 class="text-xl md:text-2xl font-semibold mb-6">{{ __('Dependency Flow') }}</h3>

                    <div class="relative">
                        <!-- Vertical line -->
                        <div
                            class="absolute left-6 top-0 bottom-0 w-0.5 bg-linear-to-b from-indigo-500/30 to-purple-500/30 hidden md:block">
                        </div>

                        <!-- Step 1 -->
                        <div class="relative mb-8 md:ml-12">
                            <div
                                class="w-12 h-12 rounded-xl bg-linear-to-br from-green-500 to-emerald-600 flex items-center justify-center absolute -left-0 md:-left-16">
                                <i class="fas fa-server text-white"></i>
                            </div>
                            <div class="rounded-2xl bg-slate-800/50 p-4 md:p-6 border border-slate-700 ml-16 md:ml-0">
                                <h4 class="font-bold text-lg mb-2">{{ __('OAuth2 Passport Server') }}</h4>
                                <p class="text-sm text-slate-400">{{ __('Main application that loads modules') }}</p>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="relative mb-8 md:ml-12">
                            <div
                                class="w-12 h-12 rounded-xl bg-linear-to-br from-purple-500 to-pink-600 flex items-center justify-center absolute -left-0 md:-left-16">
                                <i class="fas fa-cube text-white"></i>
                            </div>
                            <div class="rounded-2xl gradient-border p-4 md:p-6 bg-slate-900/80 ml-16 md:ml-0">
                                <h4 class="font-bold text-lg mb-2">{{ __('Module (Shop/Auth/Users)') }}</h4>
                                <p class="text-sm text-slate-400">{{ __('Independent module with own dependencies') }}
                                </p>
                                <div class="mt-3 pt-3 border-t border-slate-800">
                                    <div class="text-xs text-slate-500">{{ __('Depends on:') }}</div>
                                    <div class="text-sm text-purple-400 font-medium">elyerr/elymod</div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="relative mb-8 md:ml-12">
                            <div
                                class="w-12 h-12 rounded-xl bg-linear-to-br from-indigo-600 to-purple-600 flex items-center justify-center absolute -left-0 md:-left-16">
                                <i class="fas fa-cogs text-white"></i>
                            </div>
                            <div class="rounded-2xl bg-slate-800/50 p-4 md:p-6 border border-slate-700 ml-16 md:ml-0">
                                <h4 class="font-bold text-lg mb-2">{{ __('Elymod Framework') }}</h4>
                                <p class="text-sm text-slate-400">{{ __('Mini-framework with Laravel Runtime') }}</p>
                                <div class="mt-3 pt-3 border-t border-slate-800">
                                    <div class="text-xs text-slate-500">{{ __('Provides:') }}</div>
                                    <div class="text-sm text-cyan-400 font-medium">
                                        {{ __('Artisan commands, Service Container, etc.') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Key Features -->
                <div class="mt-8 lg:mt-0">
                    <h3 class="text-xl md:text-2xl font-semibold mb-6">{{ __('Laravel Runtime Bridge') }}</h3>

                    <div class="rounded-2xl code-block border border-slate-800 p-4 md:p-6 mb-6 md:mb-8">
                        <div class="flex items-center gap-2 mb-4">
                            <i class="fas fa-terminal text-green-400"></i>
                            <h4 class="font-medium text-slate-300">{{ __('Familiar Artisan Experience') }}</h4>
                        </div>
                        <p class="text-slate-400 text-sm mb-4 responsive-text">
                            {{ __('Laravel Runtime provides a minimal Laravel bridge that enables familiar Artisan commands while removing unnecessary overhead.') }}
                        </p>
                        <pre class="text-xs sm:text-sm text-slate-300 font-mono bg-slate-900/50 rounded-lg p-4 overflow-x-auto">
<span class="text-cyan-400">php artisan</span> make:controller ShopController
<span class="text-cyan-400">php artisan</span> make:model Product
<span class="text-cyan-400">php artisan</span> make:migration create_products_table
<span class="text-cyan-400">php artisan</span> make:serviceprovider ShopServiceProvider</pre>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div
                                class="w-10 h-10 rounded-lg bg-indigo-900/30 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-code text-indigo-400"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold">{{ __('Laravel-Like Structure') }}</h4>
                                <p class="text-slate-400 text-sm mt-1 responsive-text">
                                    {{ __('Maintains familiar Laravel directory structure (app/, config/, database/) but lightweight.') }}
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div
                                class="w-10 h-10 rounded-lg bg-purple-900/30 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-tools text-purple-400"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold">{{ __('Essential Commands Only') }}</h4>
                                <p class="text-slate-400 text-sm mt-1 responsive-text">
                                    {{ __('Includes only make:* commands and essential utilities. Removes unnecessary Laravel components.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Module Isolation -->
    <section id="isolation" class="max-w-7xl mx-auto px-4 sm:px-6 py-12 md:py-20 section-padding">
        <div class="text-center mb-8 md:mb-16">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4">{{ __('Complete Module Isolation') }}</h2>
            <p class="text-slate-300 max-w-3xl mx-auto text-base md:text-lg responsive-text">
                {{ __('Each module is a self-contained unit with its own dependencies, preventing conflicts with other modules or the parent application.') }}
            </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-8 md:gap-12">
            <!-- Module Structure -->
            <div>
                <div class="rounded-2xl code-block border border-slate-800 p-4 md:p-6 mb-6 md:mb-8">
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-folder-tree text-emerald-400"></i>
                            <h4 class="font-medium text-slate-300">{{ __('Module Directory Structure') }}</h4>
                        </div>
                        <div class="flex items-center gap-1">
                            <div class="w-2 h-2 rounded-full bg-red-500"></div>
                            <div class="w-2 h-2 rounded-full bg-yellow-500"></div>
                            <div class="w-2 h-2 rounded-full bg-green-500"></div>
                        </div>
                    </div>
                    <pre class="text-xs sm:text-sm text-slate-300 font-mono overflow-x-auto">
<span class="text-emerald-400">modules/shop/</span>                    <span class="text-slate-500"># Independent Shop Module</span>
├── <span class="text-cyan-400">src/</span>                     <span class="text-slate-500"># Module source code</span>
│   ├── <span class="text-blue-400">Controllers/</span>
│   ├── <span class="text-blue-400">Models/</span>
│   ├── <span class="text-blue-400">Services/</span>
│   └── <span class="text-purple-400">ShopServiceProvider.php</span>
├── <span class="text-cyan-400">config/</span>                 <span class="text-slate-500"># Module configuration</span>
├── <span class="text-cyan-400">database/</span>               <span class="text-slate-500"># Module migrations & seeders</span>
├── <span class="text-cyan-400">resources/</span>              <span class="text-slate-500"># Views, lang, assets</span>
├── <span class="text-cyan-400">public/</span>                 <span class="text-slate-500"># Assets folder (run: php artisan assets:publish)</span>
├── <span class="text-cyan-400">vendor/</span>                 <span class="text-slate-500"># Module's own dependencies</span>
│   └── <span class="text-blue-400">some/package/</span>        <span class="text-slate-500"># Independent from parent</span>
└── <span class="text-cyan-400">composer.json</span>          <span class="text-slate-500"># Module-specific dependencies</span></pre>
                </div>
            </div>

            <!-- Dependency Resolution -->
            <div>
                <div class="rounded-2xl glass-card p-4 md:p-6 mb-6 md:mb-8">
                    <div class="flex items-center gap-3 mb-4">
                        <div
                            class="w-10 h-10 rounded-lg bg-linear-to-br from-purple-600 to-pink-600 flex items-center justify-center">
                            <i class="fas fa-project-diagram text-white"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">{{ __('Dependency Resolution') }}</h4>
                            <p class="text-sm text-slate-400">{{ __('How modules find and load dependencies') }}</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div
                                class="w-6 h-6 rounded-full bg-green-500 flex items-center justify-center flex-shrink-0 mt-1">
                                <span class="text-white text-xs font-bold">1</span>
                            </div>
                            <div>
                                <h5 class="font-medium">{{ __('Module Vendor Directory') }}</h5>
                                <p class="text-slate-400 text-sm mt-1 responsive-text">
                                    {{ __('First checks modules/shop/vendor/ for dependencies. Never looks in parent vendor.') }}
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div
                                class="w-6 h-6 rounded-full bg-blue-500 flex items-center justify-center flex-shrink-0 mt-1">
                                <span class="text-white text-xs font-bold">2</span>
                            </div>
                            <div>
                                <h5 class="font-medium">{{ __('Elymod Framework') }}</h5>
                                <p class="text-slate-400 text-sm mt-1 responsive-text">
                                    {{ __('If not found in module, uses elyerr/elymod dependencies. The mini-framework provides core functionality.') }}
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div
                                class="w-6 h-6 rounded-full bg-indigo-500 flex items-center justify-center flex-shrink-0 mt-1">
                                <span class="text-white text-xs font-bold">3</span>
                            </div>
                            <div>
                                <h5 class="font-medium">{{ __('No Parent Fallback') }}</h5>
                                <p class="text-slate-400 text-sm mt-1 responsive-text">
                                    {{ __('Crucially, modules NEVER fall back to parent application dependencies. Complete isolation.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Benefits -->
        <div class="mt-8 md:mt-12 responsive-grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
            <div class="rounded-xl glass-card p-4 md:p-6">
                <div
                    class="w-10 h-10 md:w-12 md:h-12 rounded-lg bg-indigo-900/30 flex items-center justify-center mb-4">
                    <i class="fas fa-lock text-indigo-400"></i>
                </div>
                <h4 class="font-semibold mb-2 text-base md:text-lg">{{ __('Version Safety') }}</h4>
                <p class="text-sm text-slate-400 responsive-text">
                    {{ __('Modules can use different dependency versions without conflicting with the parent or other modules.') }}
                </p>
            </div>

            <div class="rounded-xl glass-card p-4 md:p-6">
                <div
                    class="w-10 h-10 md:w-12 md:h-12 rounded-lg bg-purple-900/30 flex items-center justify-center mb-4">
                    <i class="fas fa-code-branch text-purple-400"></i>
                </div>
                <h4 class="font-semibold mb-2 text-base md:text-lg">{{ __('Independent Development') }}</h4>
                <p class="text-sm text-slate-400 responsive-text">
                    {{ __('Teams can develop modules independently, without coordinating dependency updates with the main application.') }}
                </p>
            </div>

            <div class="rounded-xl glass-card p-4 md:p-6">
                <div class="w-10 h-10 md:w-12 md:h-12 rounded-lg bg-cyan-900/30 flex items-center justify-center mb-4">
                    <i class="fas fa-rocket text-cyan-400"></i>
                </div>
                <h4 class="font-semibold mb-2 text-base md:text-lg">{{ __('Easy Distribution') }}</h4>
                <p class="text-sm text-slate-400 responsive-text">
                    {{ __('Modules can be packaged and distributed independently, including all their dependencies.') }}
                </p>
            </div>
        </div>

        <!-- Asset Publishing Note -->
        <div class="mt-8 md:mt-12 rounded-xl bg-slate-800/50 border border-slate-700 p-4 md:p-6">
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 rounded-lg bg-green-900/30 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-upload text-green-400"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-base md:text-lg mb-2">{{ __('Publishing Module Assets') }}</h4>
                    <p class="text-slate-400 text-sm md:text-base responsive-text mb-3">
                        {{ __('Each module has its own public folder containing CSS, JavaScript, and image assets. To make these assets publicly accessible, run the following command within your module directory:') }}
                    </p>
                    <div class="bg-slate-900 rounded-lg p-4">
                        <code class="text-green-400 font-mono text-sm">php artisan assets:publish</code>
                        <p class="text-slate-400 text-sm mt-2 responsive-text">
                            {{ __('This command will publish the module\'s public folder contents to the main application\'s public directory, making them accessible via the web.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="bg-linear-to-b from-slate-900 to-slate-950 py-12 md:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 section-padding">
            <div class="text-center mb-8 md:mb-16">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4">{{ __('Core Features') }}</h2>
                <p class="text-slate-300 max-w-2xl mx-auto text-base md:text-lg responsive-text">
                    {{ __('Everything you need for building truly independent OAuth2 modules') }}
                </p>
            </div>

            <div class="responsive-grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                <div class="rounded-2xl glass-card p-6 md:p-8 hover-lift">
                    <div
                        class="w-12 h-12 md:w-14 md:h-14 rounded-xl bg-linear-to-br from-indigo-600 to-indigo-700 flex items-center justify-center mb-4 md:mb-6">
                        <i class="fas fa-box text-white text-xl md:text-2xl"></i>
                    </div>
                    <h3 class="text-lg md:text-xl font-semibold mb-3">{{ __('Self-Contained Dependencies') }}</h3>
                    <p class="text-slate-400 text-sm md:text-base responsive-text">
                        {{ __('Each module installs and manages its own dependencies. No reliance on parent application packages.') }}
                    </p>
                </div>

                <div class="rounded-2xl glass-card p-6 md:p-8 hover-lift">
                    <div
                        class="w-12 h-12 md:w-14 md:h-14 rounded-xl bg-linear-to-br from-purple-600 to-purple-700 flex items-center justify-center mb-4 md:mb-6">
                        <i class="fas fa-terminal text-white text-xl md:text-2xl"></i>
                    </div>
                    <h3 class="text-lg md:text-xl font-semibold mb-3">{{ __('Laravel Artisan Commands') }}</h3>
                    <p class="text-slate-400 text-sm md:text-base responsive-text">
                        {{ __('Full Laravel development experience with make commands, migrations, and familiar workflows.') }}
                    </p>
                </div>

                <div class="rounded-2xl glass-card p-6 md:p-8 hover-lift">
                    <div
                        class="w-12 h-12 md:w-14 md:h-14 rounded-xl bg-linear-to-br from-cyan-600 to-cyan-700 flex items-center justify-center mb-4 md:mb-6">
                        <i class="fas fa-shield-alt text-white text-xl md:text-2xl"></i>
                    </div>
                    <h3 class="text-lg md:text-xl font-semibold mb-3">{{ __('Service Container Integration') }}</h3>
                    <p class="text-slate-400 text-sm md:text-base responsive-text">
                        {{ __('Full service container support. Modules can register their own service providers and bindings.') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="max-w-4xl mx-auto px-4 sm:px-6 py-12 md:py-20 text-center section-padding">
        <div class="rounded-3xl gradient-border p-6 md:p-8 lg:p-12">
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-4 md:mb-6">
                {{ __('Start Building Independent Modules') }}</h2>
            <p class="text-slate-300 text-base md:text-lg mb-6 md:mb-8 max-w-2xl mx-auto responsive-text">
                {{ __('Build truly independent OAuth2 modules with Elymod. No dependency conflicts, separate licensing, and familiar Laravel workflow.') }}
            </p>
            <div class="flex flex-wrap justify-center gap-3 md:gap-4">
                <a href="https://github.com/elyerrlabs/elymod" target="_blank"
                    class="flex-1 min-w-[200px] rounded-xl bg-linear-to-r from-indigo-600 to-purple-600 px-6 py-3 md:px-8 md:py-4 font-semibold hover:from-indigo-500 hover:to-purple-500 transition hover-lift">
                    {{ __('Get Started on GitHub') }}
                </a>
                <a href="#architecture"
                    class="flex-1 min-w-[200px] rounded-xl glass-card border border-slate-700 px-6 py-3 md:px-8 md:py-4 font-medium hover:bg-slate-800/50 transition hover-lift">
                    {{ __('View Documentation') }}
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-slate-800/50 bg-slate-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8 md:py-12">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div
                            class="w-8 h-8 md:w-10 md:h-10 rounded-lg bg-linear-to-br from-indigo-600 to-purple-600 flex items-center justify-center">
                            <i class="fas fa-cube text-white"></i>
                        </div>
                        <span class="text-lg md:text-xl font-bold">Elymod</span>
                    </div>
                    <p class="text-slate-500 text-xs md:text-sm responsive-text">
                        {{ __('A lightweight modular mini‑framework for Laravel OAuth2 modules.') }}
                    </p>
                </div>
                <div>
                    <h4 class="font-semibold mb-3 md:mb-4">{{ __('Community') }}</h4>
                    <ul class="space-y-1 md:space-y-2">
                        <li><a href="https://github.com/elyerr" target="_blank"
                                class="text-slate-400 hover:text-indigo-400 text-xs md:text-sm transition">{{ __('GitHub') }}</a>
                        </li>
                        <li><a href="https://gitlab.com/elyerr" target="_blank"
                                class="text-slate-400 hover:text-indigo-400 text-xs md:text-sm transition">{{ __('GitLab') }}</a>
                        </li>
                        <li><a href="https://packagist.org/packages/elyerr" target="_blank"
                                class="text-slate-400 hover:text-indigo-400 text-xs md:text-sm transition">{{ __('Packagist') }}</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold mb-3 md:mb-4">{{ __('Legal') }}</h4>
                    <ul class="space-y-1 md:space-y-2">
                        <li><a href="https://github.com/elyerrlabs/elymod/blob/main/LICENSE"
                                class="text-slate-400 hover:text-indigo-400 text-xs md:text-sm transition">{{ __('License') }}</a>
                        </li>
                    </ul>
                </div>

                <div class="sm:col-span-2 lg:col-span-1">
                    <h4 class="font-semibold mb-3 md:mb-4">{{ __('Asset Publishing') }}</h4>
                    <p class="text-slate-400 text-xs md:text-sm responsive-text">
                        {{ __('Execute within module:') }}
                    </p>
                    <code class="text-green-400 font-mono text-xs md:text-sm block mt-2 bg-slate-900 p-2 rounded">
                        php artisan assets:publish
                    </code>
                </div>
            </div>

            <div
                class="border-t border-slate-800 mt-6 md:mt-12 pt-6 md:pt-8 flex flex-col md:flex-row justify-between gap-3 md:gap-4">
                <p class="text-slate-500 text-xs md:text-sm">
                    &copy; 2025 Elymod — {{ __('Modular Mini Framework') }}
                </p>
                <p class="text-slate-500 text-xs md:text-sm">
                    {{ __('Designed & built by') }} <span class="text-slate-300">Elvis Yerel Roman Concha</span>
                </p>
            </div>
        </div>
    </footer>

    <script nonce="{{ $nonce }}">
        // Mobile menu toggle
        document.querySelector('.mobile-menu').addEventListener('click', function() {
            const mobileNav = document.querySelector('.mobile-nav');
            mobileNav.classList.toggle('hidden');
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const mobileNav = document.querySelector('.mobile-nav');
            const mobileMenuBtn = document.querySelector('.mobile-menu');

            if (!mobileNav.contains(event.target) && !mobileMenuBtn.contains(event.target) && !mobileNav.classList
                .contains('hidden')) {
                mobileNav.classList.add('hidden');
            }
        });

        (function() {
            const savedTheme = localStorage.getItem('theme');
            const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

            let theme = 'light';

            if (savedTheme === 'dark' || (savedTheme === 'auto' && systemPrefersDark)) {
                theme = 'dark';
            }

            document.documentElement.classList.remove('light', 'dark');
            document.documentElement.classList.add(theme);
        })();
    </script>
</body>

</html>

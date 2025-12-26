<?php

include './../../App/bootstrap.php';
session_start();
$logged = $_SESSION['loggeduser'] ?? '';
if (!$logged || $logged->role !== 'admin') {
    header('Location: ./../auth/login.php');
    exit();
}


?>

<!DOCTYPE html>

<html class="dark" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>ASSAD Admin - Virtual Zoo Dashboard</title>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&amp;display=swap" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#11d452",
                        "background-light": "#f6f8f6",
                        "background-dark": "#102216",
                        "surface-dark": "#28392e",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #102216;
        }

        ::-webkit-scrollbar-thumb {
            background: #28392e;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #11d452;
        }
    </style>
</head>

<body
    class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-white h-screen flex overflow-hidden font-display selection:bg-primary selection:text-black">
    
    <aside
        class="w-64 bg-background-dark border-r border-[#28392e] flex flex-col flex-shrink-0 transition-all duration-300 hidden md:flex">
        <div class="p-6 flex items-center gap-3">
            <div class="bg-center bg-no-repeat bg-cover rounded-full h-10 w-10 shrink-0 shadow-lg shadow-primary/20">
                <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" fill="#000000"
                    transform="matrix(-1, 0, 0, 1, 0, 0)">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <title>lion</title>
                        <g id="lion">
                            <circle cx="36.5" cy="25.5" r="21.5" style="fill:#e5efef"></circle>
                            <circle cx="13" cy="7" r="2"
                                style="fill:none;stroke:#4c241d;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px">
                            </circle>
                            <circle cx="56.044" cy="22.014" r="1.069" style="fill:#4c241d"></circle>
                            <line x1="53" y1="5" x2="56" y2="8"
                                style="fill:none;stroke:#4c241d;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px">
                            </line>
                            <line x1="56" y1="5" x2="53" y2="8"
                                style="fill:none;stroke:#4c241d;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px">
                            </line>
                            <polygon points="9 17 21 17 21 19 15 28 5 27 3 22 7 20 9 17"
                                style="fill:#ffce56;stroke:#4c241d;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px">
                            </polygon>
                            <path d="M16,34V55h-.862A2.138,2.138,0,0,0,13,57.138V59h7l2.5-15.5"
                                style="fill:#ffce56;stroke:#4c241d;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px">
                            </path>
                            <path d="M40.007,42s0,6,7,8l-3,5h-.862a2.138,2.138,0,0,0-2.138,2.138V59h6l4-10s7-20-7-21"
                                style="fill:#ffce56;stroke:#4c241d;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px">
                            </path>
                            <path
                                d="M20,41V55h-.862A2.138,2.138,0,0,0,17,57.138V59h7l2.5-15.5A14.594,14.594,0,0,0,34,45c5.27-.6,11.532-3.578,15-3a7.966,7.966,0,0,0,6.5,7.5l-1,5.5h-.862A2.138,2.138,0,0,0,51.5,57.138V59h6l2-10.5-1-4s8-16-6-17-17-1-17-1"
                                style="fill:#ffce56;stroke:#4c241d;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px">
                            </path>
                            <path
                                d="M38,15l1.138.853A10.729,10.729,0,0,0,45.578,18H58a5,5,0,0,1,5,5v1a5,5,0,0,1-5,5h-.283"
                                style="fill:none;stroke:#4c241d;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px">
                            </path>
                            <ellipse cx="35.5" cy="12" rx="2.5" ry="3.703"
                                transform="translate(0.223 24.639) rotate(-38.389)"
                                style="fill:#bf7e68;stroke:#4c241d;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px">
                            </ellipse>
                            <circle cx="11.044" cy="20.014" r="1.069" style="fill:#4c241d"></circle>
                            <line x1="49" y1="42" x2="49" y2="38"
                                style="fill:#ffce56;stroke:#4c241d;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px">
                            </line>
                            <line x1="5" y1="59" x2="35" y2="59"
                                style="fill:none;stroke:#4c241d;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px">
                            </line>
                            <line x1="39" y1="59" x2="62" y2="59"
                                style="fill:none;stroke:#4c241d;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px">
                            </line>
                            <path
                                d="M41,26l-6.74-2.384L29.7,16.324a8.578,8.578,0,0,0-8.089-4c-1.563.147-3.444.361-5.613.671-7,1-7,4-7,4h8.5a1.5,1.5,0,0,1,0,3H16v2l-5,5H5l1,3h4L20,41,31,31l8.4-1.778C40,29,41.888,27.331,41,26Z"
                                style="fill:#bf7e68;stroke:#4c241d;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px">
                            </path>
                            <polyline points="27 24 27 27 31 31"
                                style="fill:#bf7e68;stroke:#4c241d;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px">
                            </polyline>
                            <polyline points="20 25 20 30 25.678 35.838"
                                style="fill:#bf7e68;stroke:#4c241d;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px">
                            </polyline>
                        </g>
                    </g>
                </svg>
            </div>
            <div class="flex flex-col overflow-hidden">
                <h1 class="text-white text-base font-bold leading-tight truncate">ASSAD Admin</h1>
                <p class="text-[#9db9a6] text-xs font-normal truncate">Virtual Zoo Portal</p>
            </div>
        </div>
        <nav class="flex-1 overflow-y-auto px-4 py-4 flex flex-col gap-2">
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-surface-dark border-l-4 border-primary shadow-sm group"
                href="/ASSAD_V2/Public/Admin/dashboard.php">
                <span
                    class="material-symbols-outlined text-primary group-hover:scale-110 transition-transform">dashboard</span>
                <p class="text-white text-sm font-medium leading-normal">Dashboard</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-surface-dark/50 transition-colors group text-[#9db9a6] hover:text-white"
                href="/ASSAD_V2/Public/Admin/users/users.php">
                <span class="material-symbols-outlined group-hover:scale-110 transition-transform">group</span>
                <p class="text-sm font-medium leading-normal">User Management</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-surface-dark/50 transition-colors group text-[#9db9a6] hover:text-white"
                href="/ASSAD_V2/Public/Admin/animals/animals.php">
                <span class="material-symbols-outlined group-hover:scale-110 transition-transform">pets</span>
                <p class="text-sm font-medium leading-normal">Animal Management</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-surface-dark/50 transition-colors group text-[#9db9a6] hover:text-white"
                href="/ASSAD_V2/Public/Admin/habitats/habitats.php">
                <span class="material-symbols-outlined group-hover:scale-110 transition-transform">landscape</span>
                <p class="text-sm font-medium leading-normal">Habitats</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-surface-dark/50 transition-colors group text-[#9db9a6] hover:text-white"
                href="/ASSAD_V2/Public/Admin/Tours/tours.php">
                <span class="material-symbols-outlined group-hover:scale-110 transition-transform">map</span>
                <p class="text-sm font-medium leading-normal">Guided Tours</p>
            </a>

        </nav>
        <div class="p-4 border-t border-[#28392e]">
            <div
                class="flex items-center gap-3 p-2 rounded-lg bg-surface-dark/50 hover:bg-surface-dark transition-colors group">
                <div class="bg-center bg-no-repeat bg-cover rounded-full h-8 w-8 shrink-0"
                    data-alt="Profile picture of the admin user"
                    style='background-image: url("https://avatars.githubusercontent.com/u/209652052?v=4");'>
                </div>

                <div class="flex flex-col flex-1 min-w-0">
                    <p class="text-white text-xs font-bold truncate"><?= $logged->nom ?></p>
                    <p class="text-[#9db9a6] text-[10px] truncate"><?= $logged->email ?></p>
                </div>
                <a href="./../logout.php">
                    <button onclick="location.href='logout.php'"
                        class="p-1.5 rounded-md text-[#9db9a6] hover:text-red-400 hover:bg-red-400/10 transition-all"
                        title="Logout">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                    </button></a>
            </div>
        </div>
    </aside>
    <main class="flex-1 flex flex-col h-full overflow-hidden relative">
        <header
            class="flex items-center justify-between px-6 py-4 bg-background-dark/95 border-b border-[#28392e] backdrop-blur-sm z-10">
            <div class="flex items-center gap-4 text-white md:hidden">
                <button class="p-1 rounded-md hover:bg-surface-dark text-white">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <h2 class="text-lg font-bold">Dashboard</h2>
            </div>
            <div class="hidden md:flex items-center gap-4 text-white">
                <h2 class="text-xl font-bold tracking-tight">Overview</h2>
            </div>
            <div class="flex flex-1 justify-end gap-4 items-center">
                <div class="hidden sm:flex relative w-full max-w-md">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-[#9db9a6]">
                        <span class="material-symbols-outlined">search</span>
                    </div>
                    <input id="admin-search"
                        class="block w-full pl-10 pr-3 py-2 border-none rounded-lg leading-5 bg-surface-dark text-white placeholder-[#9db9a6] focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm transition-all"
                        placeholder="Search animals, users, tours..." type="text" />
                </div>

            </div>
        </header>
        <div class="flex-1 overflow-y-auto p-4 md:p-8 scroll-smooth">
            <div class="max-w-7xl mx-auto flex flex-col gap-8">
                <div>
                    <h2 class="text-white text-2xl font-bold">Welcome back, <?= $logged->nom ?> 👋</h2>
                    <p class="text-[#9db9a6] mt-1">Here is what is happening with CAN 2025 Virtual Zoo today.</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div
                        class="flex flex-col p-5 bg-surface-dark rounded-xl border border-white/5 hover:border-primary/30 transition-colors shadow-sm">
                        <div class="flex justify-between items-start mb-4">
                            <div class="p-2 bg-primary/10 rounded-lg text-primary">
                                <span class="material-symbols-outlined">group</span>
                            </div>
                            <span
                                class="text-[#0bda43] text-xs font-bold bg-[#0bda43]/10 px-2 py-1 rounded-full">+12%</span>
                        </div>
                        <p class="text-[#9db9a6] text-sm font-medium">Total Visitors</p>
                        <p class="text-white text-3xl font-bold mt-1">
                            <?php
                            $visitor = new Visiteur();
                            $visitors = $visitor->getAllVisitors();
                            echo count($visitors);
                            ?>
                        </p>
                    </div>
                    <div
                        class="flex flex-col p-5 bg-surface-dark rounded-xl border border-white/5 hover:border-primary/30 transition-colors shadow-sm">
                        <div class="flex justify-between items-start mb-4">
                            <div class="p-2 bg-blue-500/10 rounded-lg text-blue-500">
                                <span class="material-symbols-outlined">pets</span>
                            </div>
                            <span
                                class="text-[#0bda43] text-xs font-bold bg-[#0bda43]/10 px-2 py-1 rounded-full">+2%</span>
                        </div>
                        <p class="text-[#9db9a6] text-sm font-medium">Total Animals</p>
                        <p class="text-white text-3xl font-bold mt-1">
                            <?php
                            $animal = new Animal();
                            $animals = $animal->getAnimals();
                            echo count($animals);
                            ?>
                        </p>
                    </div>
                    <div
                        class="flex flex-col p-5 bg-surface-dark rounded-xl border border-white/5 hover:border-primary/30 transition-colors shadow-sm">
                        <div class="flex justify-between items-start mb-4">
                            <div class="p-2 bg-yellow-500/10 rounded-lg text-yellow-500">
                                <span class="material-symbols-outlined">pending_actions</span>
                            </div>
                            <span
                                class="text-yellow-500 text-xs font-bold bg-yellow-500/10 px-2 py-1 rounded-full">Action
                                Req.</span>
                        </div>
                        <p class="text-[#9db9a6] text-sm font-medium">Pending Approvals(guides)</p>
                        <p class="text-white text-3xl font-bold mt-1">
                            <?php
                            $guide = new Guide();
                            $guides = $guide->getAllGuides();
                            echo count($guides);

                            ?>
                        </p>
                    </div>
                    <div
                        class="flex flex-col p-5 bg-surface-dark rounded-xl border border-white/5 hover:border-primary/30 transition-colors shadow-sm">
                        <div class="flex justify-between items-start mb-4">
                            <div class="p-2 bg-purple-500/10 rounded-lg text-purple-500">
                                <span class="material-symbols-outlined">tour</span>
                            </div>
                            <span
                                class="text-[#9db9a6] text-xs font-bold bg-white/5 px-2 py-1 rounded-full">Stable</span>
                        </div>
                        <p class="text-[#9db9a6] text-sm font-medium">Active Tours</p>
                        <p class="text-white text-3xl font-bold mt-1">
                            <?php
                            $visite = new VisitesGuidees();
                            $status = 'ACTIVE';
                            $visites = $visite->getAllVisites($status);
                            echo count($visites);
                            ?></p>
                    </div>
                </div>
                <!-- GLOBAL REACH + MOST VIEWED ANIMALS -->
                <!-- <div class="flex flex-col lg:flex-row gap-6">

                    <div class="bg-surface-dark rounded-xl border border-white/5 p-6
                flex flex-col
                lg:w-[60%]
                max-h-[420px] overflow-y-auto">

                        <div class="flex justify-between items-center mb-6 shrink-0">
                            <h3 class="text-white text-lg font-bold">Global Reach</h3>
                            <button class="text-sm text-primary hover:text-white transition-colors">
                                View Report
                            </button>
                        </div>

                        <div class="space-y-4">

                            <div class="space-y-1">
                                <div class="flex justify-between text-sm">
                                    <span class="text-white">Ivory Coast</span>
                                    <span class="text-primary font-bold">45%</span>
                                </div>
                                <div class="h-2 w-full bg-white/5 rounded-full overflow-hidden">
                                    <div class="h-full bg-primary w-[45%] rounded-full"></div>
                                </div>
                            </div>


                            <div class="space-y-1">
                                <div class="flex justify-between text-sm">
                                    <span class="text-white">Cameroon</span>
                                    <span class="text-[#9db9a6]">24%</span>
                                </div>
                                <div class="h-2 w-full bg-white/5 rounded-full overflow-hidden">
                                    <div class="h-full bg-[#9db9a6] w-[24%] rounded-full"></div>
                                </div>
                            </div>


                            <div class="space-y-1">
                                <div class="flex justify-between text-sm">
                                    <span class="text-white">Senegal</span>
                                    <span class="text-[#9db9a6]">18%</span>
                                </div>
                                <div class="h-2 w-full bg-white/5 rounded-full overflow-hidden">
                                    <div class="h-full bg-[#9db9a6] w-[18%] rounded-full"></div>
                                </div>
                            </div>


                            <div class="space-y-1">
                                <div class="flex justify-between text-sm">
                                    <span class="text-white">France</span>
                                    <span class="text-[#9db9a6]">8%</span>
                                </div>
                                <div class="h-2 w-full bg-white/5 rounded-full overflow-hidden">
                                    <div class="h-full bg-[#9db9a6] w-[8%] rounded-full"></div>
                                </div>
                            </div>


                            <div class="space-y-1">
                                <div class="flex justify-between text-sm">
                                    <span class="text-white">Other</span>
                                    <span class="text-[#9db9a6]">5%</span>
                                </div>
                                <div class="h-2 w-full bg-white/5 rounded-full overflow-hidden">
                                    <div class="h-full bg-[#9db9a6] w-[5%] rounded-full"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MOST VIEWED ANIMALS (40%) -->
                <div class="bg-surface-dark rounded-xl border border-white/5 p-6
                flex flex-col
                
                max-h-[420px] overflow-hidden">

                    <h3 class="text-white text-lg font-bold mb-6 shrink-0">
                        Most Viewed Animals
                    </h3>

                    <!-- Scrollable list -->
                    <div class="flex flex-col gap-4 overflow-y-auto flex-1 pr-1">
                        <?php
                        $animal = new Animal();
                        $animals = $animal->getAnimals();
                        ?>
                        <?php foreach ($animals as $animal): ?>
                            <div class="flex items-center gap-4 group cursor-pointer">
                                <div class="h-12 w-12 rounded-lg bg-cover bg-center shrink-0"
                                    style='background-image: url("<?= $animal->image ?>");'>
                                </div>

                                <div class="flex-1">
                                    <div class="flex justify-between mb-1">
                                        <span
                                            class="text-white text-sm font-medium group-hover:text-primary transition-colors">
                                            <?= $animal->nom ?>
                                        </span>
                                        <span class="text-[#9db9a6] text-xs">
                                            <?= $animal->visites ?> views
                                        </span>
                                    </div>

                                    <div class="h-1.5 w-full bg-white/5 rounded-full">
                                        <div class="h-full bg-primary w-[85%] rounded-full"></div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>


                    <a href="/ASSAD_V2/Public/Admin/Animals/animals.php"
                        class="mt-4 w-full py-2.5 rounded-lg border border-white/10
                                                                        text-[#9db9a6] text-sm text-center
                                                                        hover:text-white hover:border-white/30 hover:bg-white/5 transition-all">
                        Manage Animals
                    </a>

                </div>

            </div>
            <div class="h-4"></div>

            <div class="bg-surface-dark rounded-xl border border-white/5 p-6 flex flex-col">
                <h3 class="text-white text-lg font-bold mb-6">Reservation Stats</h3>

                <!-- Top summary boxes -->
                <div class="grid grid-cols-3 gap-4 mb-6">
                    <div class="bg-[#1f2a33] rounded-lg p-4 flex flex-col items-center">
                        <span class="text-xs text-[#9db9a6]">Total Visits</span>
                        <span class="text-2xl font-bold text-white"><?= count($visites) ?? '0' ?></span>
                    </div>
                    <div class="bg-[#1f2a33] rounded-lg p-4 flex flex-col items-center">
                        <span class="text-xs text-[#9db9a6]">Bookings</span>
                        <span class="text-2xl font-bold text-white">
                            <?php
                            $reservat = new Reservation();
                            $reservations = $reservat->getAllReservations();
                            $total_r = (array) $reservations;

                            echo count($total_r);
                            ?>
                        </span>
                    </div>
                    <div class="bg-[#1f2a33] rounded-lg p-4 flex flex-col items-center">
                        <span class="text-xs text-[#9db9a6]">Pending</span>
                        <span class="text-2xl font-bold text-white">
                            <?php
                            $counter = 0;
                            if ($visites) {
                                foreach ($visites as $visit) {
                                    if ($visit->status == 'OFFLINE') {
                                        $counter++;
                                    }
                                }
                                echo $counter;
                                $counter = 0;
                            } else {
                                $counter = 0;
                                echo $counter;
                            }
                            ?>
                        </span>
                    </div>
                </div>


            </div>
        </div>
        </div>
        </div>
    </main>
</body>

</html>
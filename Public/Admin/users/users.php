<?php

include './../../../App/bootstrap.php';
session_start();
$logged = $_SESSION['loggeduser'] ?? '';
if (!$logged) {
    header('Location: ./../auth/login.php');
    exit();
}

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id'] ?? '';
    $action = $_GET['action'] ?? '';
    $email = $_GET['email'] ?? '';
    if (isset($id) && isset($action)) {
        $g = new Guide();
        $g->approve($id, $action);
    }
    if (isset($email)) {
        $v = new Visiteur();
        $v->changeStatus($email);
    }
}

// print_r($logged);
?>

<!DOCTYPE html>

<html class="dark" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>ASSAD Admin - User Management</title>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&amp;display=swap" rel="stylesheet" />
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
                        primary: "#39E079",
                        "background-light": "#f6f8f7",
                        "background-dark": "#122017",
                        "surface-dark": "#28392e"
                    },
                    fontFamily: {
                        display: "Inter"
                    },
                    borderRadius: {
                        DEFAULT: "0.25rem",
                        lg: "0.5rem",
                        xl: "0.75rem",
                        full: "9999px"
                    }
                }
            }
        };
    </script>
    <link rel="stylesheet" href="/ASSAD_V2/assets/css/styles.css">
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
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-surface-dark/50 transition-colors group text-[#9db9a6] hover:text-white"
                href="/ASSAD_V2/Public/Admin/dashboard.php">
                <span class="material-symbols-outlined group-hover:scale-110 transition-transform">dashboard</span>
                <p class="text-sm font-medium leading-normal">Dashboard</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-surface-dark border-l-4 border-primary shadow-sm group"
                href="/ASSAD_V2/Public/Admin/users/users.php">
                <span
                    class="material-symbols-outlined text-primary group-hover:scale-110 transition-transform">group</span>
                <p class="text-white text-sm font-medium leading-normal">User Management</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-surface-dark/50 transition-colors group text-[#9db9a6] hover:text-white"
                href="/ASSAD_V2/Public/Admin/Animals/animals.php">
                <span class="material-symbols-outlined group-hover:scale-110 transition-transform">pets</span>
                <p class="text-sm font-medium leading-normal">Animal Management</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-surface-dark/50 transition-colors group text-[#9db9a6] hover:text-white"
                href="/ASSAD_V2/Public/Admin/habitats/habitats.php">
                <span class="material-symbols-outlined group-hover:scale-110 transition-transform">landscape</span>
                <p class="text-sm font-medium leading-normal">Habitats</p>
            </a>

        </nav>
        <div class="p-4 border-t border-[#28392e] profile-admin">
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
                <a href="/ASSAD_V2/Public/Auth/logout.php">
                    <button
                        class="p-1.5 rounded-md text-[#9db9a6] hover:text-red-400 hover:bg-red-400/10 transition-all"
                        title="Logout">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                    </button>
                </a>
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
                <h2 class="text-lg font-bold">User Management</h2>
            </div>
            <div class="hidden md:flex items-center gap-4 text-white">
                <h2 class="text-xl font-bold tracking-tight">User Management</h2>
            </div>
            <div class="flex flex-1 justify-end gap-4 items-center">
                <div class="hidden sm:flex relative w-full max-w-md">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-[#9db9a6]">
                        <span class="material-symbols-outlined">search</span>
                    </div>
                    <input
                        class="block w-full pl-10 pr-3 py-2 border-none rounded-lg leading-5 bg-surface-dark text-white placeholder-[#9db9a6] focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm transition-all"
                        placeholder="Quick search..." type="text" />
                </div>
                <!-- <div class="flex gap-2">
                    <button
                        class="flex items-center justify-center h-10 w-10 rounded-lg bg-surface-dark text-white hover:bg-primary hover:text-black transition-colors relative">
                        <span class="material-symbols-outlined text-[20px]">notifications</span>
                        <span
                            class="absolute top-2 right-2 h-2 w-2 rounded-full bg-red-500 border border-surface-dark"></span>
                    </button>
                    <button
                        class="flex items-center justify-center h-10 w-10 rounded-lg bg-surface-dark text-white hover:bg-primary hover:text-black transition-colors">
                        <span class="material-symbols-outlined text-[20px]">person_add</span>
                    </button>
                </div> -->
            </div>
        </header>
        <div class="flex-1 overflow-y-auto p-4 md:p-8 scroll-smooth">
            <div class="max-w-7xl mx-auto flex flex-col gap-8">
                <div
                    class="bg-surface-dark rounded-xl border border-white/5 overflow-hidden flex flex-col shadow-lg shadow-black/20">
                    <div
                        class="p-6 border-b border-white/5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-gradient-to-r from-surface-dark to-[#1a2d21]">
                        <div class="flex items-start gap-4">
                            <div class="p-3 bg-yellow-500/10 rounded-xl text-yellow-500 hidden sm:block">
                                <span class="material-symbols-outlined">pending_actions</span>
                            </div>
                            <div>
                                <h3 class="text-white text-lg font-bold flex items-center gap-2">
                                    Pending Registrations
                                    <span
                                        class="bg-yellow-500 text-black text-[10px] px-2 py-0.5 rounded-full font-bold">
                                        <?php
                                        $user = new Utilisateur();
                                        $approved = false;
                                        $users = $user->getUsersByApproval($approved);
                                        echo isset($users) ? count($users) : '0';
                                        ?>
                                        new</span>
                                </h3>
                                <p class="text-[#9db9a6] text-sm mt-1">Review and approve new registrations accounts
                                    requests.
                                </p>
                            </div>
                        </div>
                        <!-- <div class="flex gap-2">
                            <button
                                class="px-4 py-2 text-sm font-medium text-[#9db9a6] hover:text-white transition-colors">Dismiss
                                All</button>
                            <button
                                class="px-4 py-2 rounded-lg bg-primary/10 text-primary hover:bg-primary hover:text-black text-sm font-bold transition-all flex items-center gap-2">
                                <span class="material-symbols-outlined text-[18px]">check_circle</span>
                                Approve All
                            </button>
                        </div> -->
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-black/20 text-[#9db9a6] text-xs uppercase font-medium">
                                <tr>
                                    <th class="px-6 py-4">Applicant</th>
                                    <th class="px-6 py-4">Email</th>
                                    <th class="px-6 py-4">Role Requested</th>
                                    <th class="px-6 py-4 text-center">Actions</th>

                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">

                                <?php if (isset($users) && count($users) > 0): ?>
                                    <?php foreach ($users as $user): ?>
                                        <?php if ($user->approved == 0 && $user->role !== 'NOTAPPROVED'): ?>
                                            <tr class="group hover:bg-white/5 transition-colors">
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center gap-3">
                                                        <div
                                                            class="h-9 w-9 rounded-full bg-surface-dark border border-white/10 flex items-center justify-center text-white font-bold text-xs shadow-sm">
                                                            <?= $user->nom[0] . strtoupper($user->nom[1]) ?>
                                                        </div>
                                                        <div>
                                                            <p class="text-white text-sm font-medium"><?= $user->nom ?></p>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="px-6 py-4 text-[#9db9a6] text-sm"><?= $user->email ?></td>
                                                <td class="px-6 py-4">
                                                    <span
                                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium <?= $user->role == 'Visitor' ? 'bg-white/5 text-[#9db9a6] border border-white/10' : 'bg-purple-500/10 text-purple-400 border border-purple-500/20' ?>">
                                                        <?= $user->role ?>
                                                    </span>
                                                </td>

                                                <td class="px-6 py-4 text-right">
                                                    <div class="flex justify-end gap-2">
                                                        <a href="?id=<?= $user->id_user ?>&action=reject"
                                                            class="h-8 px-3 rounded-lg border border-red-500/30 text-red-500 hover:bg-red-500 hover:text-white transition-colors text-xs font-medium flex items-center gap-1">
                                                            Reject
                                                        </a>
                                                        <a href="?id=<?= $user->id_user ?>&action=approve"
                                                            class="h-8 px-3 rounded-lg bg-primary text-black hover:bg-white transition-colors text-xs font-bold flex items-center gap-1 shadow-lg shadow-primary/20">
                                                            Approve
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <td class="px-6 py-4 text-[#9db9a6] text-lg text-center">No new registrations!</td>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col sm:flex-row justify-between items-end sm:items-center gap-4">
                        <h3 class="text-white text-xl font-bold">Registered Users <span
                                class="text-[#9db9a6] text-sm font-normal ml-2">Total: <?php
                                                                                        $registers_count = 0;
                                                                                        if (isset($users)) {
                                                                                            foreach ($users as $user) {
                                                                                                if ($user['approved'] == 1) {
                                                                                                    $registers_count++;
                                                                                                }
                                                                                            }
                                                                                        }

                                                                                        echo $registers_count;
                                                                                        ?></span></h3>
                    </div>
                    <div class="bg-surface-dark rounded-xl border border-white/5 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead class="bg-black/20 text-[#9db9a6] text-xs uppercase font-medium">
                                    <tr>
                                        <th class="px-6 py-4">User Details</th>
                                        <th class="px-6 py-4">Role</th>
                                        <th class="px-6 py-4">Status</th>
                                        <th class="px-6 py-4 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/5">
                                    <?php
                                    $v = new Visiteur();
                                    $registeredUsers = $v->getAllVisitors();
                                    ?>
                                    <?php if (isset($registeredUsers)): ?>
                                        <?php foreach ($registeredUsers as $user): ?>
                                            <?php

                                            if ($user->approved == 1 && $user->role !== 'NOTAPPROVED' && $user->role !== 'admin'):

                                                $words = explode(" ", $user->nom);
                                                $initials = strtoupper(substr($words[0], 0, 1));
                                                if (count($words) > 1) {
                                                    $initials .= strtoupper(substr($words[1], 0, 1));
                                                }
                                            ?>
                                                <tr class="group hover:bg-white/5 transition-colors">
                                                    <td class="px-6 py-4">
                                                        <div class="flex items-center gap-3">
                                                            <div
                                                                class="h-10 w-10 rounded-full bg-gradient-to-tr from-emerald-500 to-teal-500 flex items-center justify-center text-white font-bold text-xs">
                                                                <?= htmlspecialchars($initials) ?>
                                                            </div>
                                                            <div>
                                                                <p class="text-white text-sm font-medium">
                                                                    <?= htmlspecialchars($user->nom) ?></p>
                                                                <p class="text-[#9db9a6] text-xs">
                                                                    <?= htmlspecialchars($user->email) ?></p>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="px-6 py-4">
                                                        <div class="flex items-center gap-2">
                                                            <span
                                                                class="material-symbols-outlined <?= $user->role === 'admin' ? 'text-purple-400' : 'text-blue-400' ?> text-[18px]">
                                                                <?= $user->role === 'admin' ? 'verified_user' : 'person' ?>
                                                            </span>
                                                            <span
                                                                class="text-white text-sm capitalize"><?= htmlspecialchars($user->role) ?></span>
                                                        </div>
                                                    </td>

                                                    <td class="px-6 py-4">
                                                        <?php if ($user->isactive): ?>
                                                            <span
                                                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-[#0bda43]/10 text-[#0bda43] border border-[#0bda43]/20">
                                                                <span class="h-1.5 w-1.5 rounded-full bg-[#0bda43]"></span>
                                                                Active
                                                            </span>
                                                        <?php else: ?>
                                                            <span
                                                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-red-500/10 text-red-400 border border-red-500/20">
                                                                <span class="h-1.5 w-1.5 rounded-full bg-red-400"></span>
                                                                Inactive
                                                            </span>
                                                        <?php endif; ?>
                                                    </td>

                                                    <td class="px-6 py-4 text-right">
                                                        <div class="flex justify-end items-center gap-2">

                                                            <div class="h-4 w-[1px] bg-white/10"></div>
                                                            <a href="?email=<?= $user->email ?>"
                                                                class="p-2 rounded-lg <?= $user->isactive ? 'text-red-400' : 'text-primary' ?> hover:bg-white/10 transition-colors">
                                                                <span class="material-symbols-outlined text-[20px]">
                                                                    <?= $user->isactive ? 'block' : 'power_settings_new' ?>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endif;  ?>
                                        <?php endforeach;  ?>
                                    <?php else: ?>
                                        <td class="px-6 py-4 text-[#9db9a6] text-lg text-center">No registered users yet!</td>

                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
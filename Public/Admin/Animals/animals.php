<?php
include "./../../config.php";
session_start();
$loggeduser = $_SESSION['loggeduser'];
if (!$loggeduser) {
    header('Location: ./../../auth/login.php');
    exit;
}
$habitat_stmt = $conn->prepare("SELECT id_habitat, nom FROM habitat ORDER BY nom ASC");
$habitat_stmt->execute();
$results = $habitat_stmt->get_result();


$habitats_filter_stmt = $conn->prepare("SELECT nom FROM habitat ORDER BY nom ASC");
$habitats_filter_stmt->execute();
$habitats_filter_result = $habitats_filter_stmt->get_result();
$query = "SELECT a.*, h.nom as habitat_name 
              FROM animal a 
              LEFT JOIN habitat h ON a.id_habitat = h.id_habitat 
              ORDER BY a.id_animal DESC";

$animals_stmt = $conn->prepare($query);
$animals_stmt->execute();
$animals_result = $animals_stmt->get_result();

$total_animals = $animals_result->num_rows;
?>

<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>ASSAD Admin - Animal Management</title>
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
    <!-- <div id="loader">
        <div class="spinner" aria-hidden="true"></div>
        <div class="text-sm text-white mt-2">Loading...</div>
    </div> -->
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
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-surface-dark/50 transition-colors group text-[#9db9a6] hover:text-white"
                href="/ASSAD_V2/Public/Admin/users/users.php">
                <span class="material-symbols-outlined group-hover:scale-110 transition-transform">group</span>
                <p class="text-sm font-medium leading-normal">User Management</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-surface-dark border-l-4 border-primary shadow-sm group"
                href="/ASSAD_V2/Public/Admin/Animals/animals.php">
                <span
                    class="material-symbols-outlined text-primary group-hover:scale-110 transition-transform">pets</span>
                <p class="text-white text-sm font-medium leading-normal">Animal Management</p>
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
        <div class="p-4 border-t border-[#28392e] profile-admin">
            <div
                class="flex items-center gap-3 p-2 rounded-lg bg-surface-dark/50 hover:bg-surface-dark transition-colors group">
                <div class="bg-center bg-no-repeat bg-cover rounded-full h-8 w-8 shrink-0"
                    data-alt="Profile picture of the admin user"
                    style='background-image: url("https://avatars.githubusercontent.com/u/209652052?v=4");'>
                </div>

                <div class="flex flex-col flex-1 min-w-0">
                    <p class="text-white text-xs font-bold truncate"><?= $loggeduser['nom'] ?></p>
                    <p class="text-[#9db9a6] text-[10px] truncate"><?= $loggeduser['email'] ?></p>
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
            class="flex items-center justify-between px-6 py-4 bg-background-dark/95 border-b border-[#28392e] backdrop-blur-sm ">
            <div class="flex items-center gap-4 text-white md:hidden">
                <button class="p-1 rounded-md hover:bg-surface-dark text-white">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <h2 class="text-lg font-bold">Animal Management</h2>
            </div>
            <div class="hidden md:flex items-center gap-4 text-white">
                <h2 class="text-xl font-bold tracking-tight">Animal Management</h2>
            </div>
            <div class="flex flex-1 justify-end gap-4 items-center">
                <div class="hidden sm:flex relative w-full max-w-md">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-[#9db9a6]">
                        <span class="material-symbols-outlined">search</span>
                    </div>
                    <input
                        class="block w-full pl-10 pr-3 py-2 border-none rounded-lg leading-5 bg-surface-dark text-white placeholder-[#9db9a6] focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm transition-all"
                        placeholder="Search globally..." type="text" />
                </div>
                <div class="flex gap-2">
                    <button
                        class="flex items-center justify-center h-10 w-10 rounded-lg bg-surface-dark text-white hover:bg-primary hover:text-black transition-colors relative">
                        <span class="material-symbols-outlined text-[20px]">notifications</span>
                        <span
                            class="absolute top-2 right-2 h-2 w-2 rounded-full bg-red-500 border border-surface-dark"></span>
                    </button>
                    <button
                        class="flex items-center justify-center h-10 w-10 rounded-lg bg-surface-dark text-white hover:bg-primary hover:text-black transition-colors">
                        <span class="material-symbols-outlined text-[20px]">account_circle</span>
                    </button>
                </div>
            </div>
        </header>
        <div class="flex-1 flex overflow-hidden">
            <div class="flex-1 flex flex-col min-w-0 bg-background-dark relative">
                <div
                    class="px-6 py-5 border-b border-[#28392e] flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div class="flex gap-4 items-center">
                        <div class="relative">
                            <span
                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-[#9db9a6]">
                                <span class="material-symbols-outlined text-[20px]">filter_list</span>
                            </span>
                            <select
                                class="pl-10 pr-8 py-2 bg-surface-dark border border-white/10 rounded-lg text-sm text-white focus:ring-1 focus:ring-primary focus:border-primary cursor-pointer appearance-none">
                                <option>All Habitats</option>
                                <?php while ($h = $habitats_filter_result->fetch_assoc()): ?>
                                    <option value="<?= htmlspecialchars($h['nom']) ?>"><?= htmlspecialchars($h['nom']) ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="text-sm text-[#9db9a6]">
                            Showing <span class="text-white font-bold"><?= $total_animals ?></span> animals
                        </div>
                    </div>
                    <div class="relative w-full sm:w-64">
                        <input
                            class="block w-full px-4 py-2 bg-surface-dark border border-white/10 rounded-lg text-sm text-white placeholder-[#5a6b60] focus:ring-1 focus:ring-primary focus:border-primary"
                            placeholder="Search by name or species..." type="text" />
                        <span
                            class="material-symbols-outlined absolute right-3 top-2.5 text-[#5a6b60] text-[18px]">search</span>
                    </div>
                </div>

                <div class="flex-1 overflow-y-auto p-6">
                    <div class="grid grid-cols-1 xl:grid-cols-2 gap-4">

                        <?php if ($animals_result->num_rows > 0): ?>
                            <?php while ($animal = $animals_result->fetch_assoc()): ?>
                                <div
                                    class="bg-surface-dark rounded-xl border border-white/5 p-4 flex gap-4 group hover:border-primary/30 transition-all">
                                    <div class="w-24 h-24 sm:w-32 sm:h-32 rounded-lg bg-cover bg-center shrink-0 border border-white/5"
                                        style='background-image: url("<?= htmlspecialchars($animal['image']) ?>");'>
                                    </div>

                                    <div class="flex-1 flex flex-col">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h3 class="text-white font-bold text-lg"><?= htmlspecialchars($animal['nom']) ?>
                                                </h3>
                                                <p class="text-[#9db9a6] text-xs italic">
                                                    <?= htmlspecialchars($animal['espece']) ?>
                                                </p>
                                            </div>
                                            <div
                                                class="px-2 py-1 rounded bg-primary/10 border border-primary/20 text-primary text-[10px] uppercase font-bold tracking-wide">
                                                <?= htmlspecialchars($animal['habitat_name'] ?? 'Unassigned') ?>
                                            </div>
                                        </div>

                                        <p class="mt-2 text-[#9db9a6] text-sm line-clamp-2">
                                            <?= htmlspecialchars($animal['description']) ?>
                                        </p>

                                        <div class="mt-auto pt-3 flex items-center justify-between border-t border-white/5">
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[16px] text-[#9db9a6]">analytics</span>
                                                <span class="text-xs text-[#9db9a6] font-medium">
                                                    <span class="text-white"><?= $animal['visites'] ?></span> Views
                                                </span>
                                            </div>

                                            <div class="flex gap-1">

                                                <button
                                                    class="p-1.5 text-primary hover:bg-primary/10 rounded transition-colors edit-animal-btn"
                                                    data-id="<?= $animal['id_animal'] ?>"
                                                    data-nom="<?= htmlspecialchars($animal['nom']) ?>"
                                                    data-espece="<?= htmlspecialchars($animal['espece']) ?>"
                                                    data-alimentation="<?= htmlspecialchars($animal['alimentation']) ?>"
                                                    data-pays="<?= htmlspecialchars($animal['paysorigine']) ?>"
                                                    data-habitat="<?= $animal['id_habitat'] ?>"
                                                    data-desc="<?= htmlspecialchars($animal['description']) ?>"
                                                    data-image="<?= htmlspecialchars($animal['image']) ?>">
                                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                                </button>
                                                <a href="./delete.php?id=<?= $animal['id_animal'] ?>"
                                                    class="p-1.5 text-red-400 hover:text-red-300 hover:bg-red-400/10 rounded transition-colors"
                                                    title="Delete">
                                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <div class="col-span-full py-20 text-center">
                                <span class="material-symbols-outlined text-6xl text-white/10">pets</span>
                                <p class="text-[#9db9a6] mt-4">No animals found in the database.</p>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
            <button id="add-new-animal"
                class="fixed bottom-4 right-4 z-40 px-4 py-2 bg-primary rounded-lg text-black hover:bg-green-400 transition-colors shadow-lg shadow-primary/20 text-sm font-bold">
                + Add new animal
            </button>

            <div id="new-animal-form"
                class="hidden fixed inset-0 z-50 flex items-center justify-center backdrop-blur-md bg-black/40">
                <form method="POST" action="./create.php"
                    class="w-11/12 lg:w-3/5 h-[90vh] lg:h-3/4 bg-[#1a2a22] rounded-xl border border-[#28392e] flex flex-col overflow-hidden">
                    <div class="p-6 border-b border-[#28392e] flex justify-between items-center">
                        <h3 class="text-white font-bold text-lg">Add New Animal</h3>
                        <button type="button" class="close-modal-btn text-[#9db9a6] hover:text-white">
                            <span class="material-symbols-outlined">close</span>
                        </button>
                    </div>
                    <div class="p-6 flex-1 space-y-6 overflow-y-auto">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-[#9db9a6]">Image URL</label>
                            <input type="url" name="image"
                                class="w-full px-4 py-3 bg-transparent border-2 border-dashed border-[#5a6b60] rounded-lg text-white"
                                required>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <input name="nom" placeholder="Common Name"
                                class="w-full bg-transparent border border-[#5a6b60] rounded-lg px-3 py-2 text-white"
                                type="text" required />
                            <input name="espece" placeholder="Species"
                                class="w-full bg-transparent border border-[#5a6b60] rounded-lg px-3 py-2 text-white"
                                type="text" required />
                            <input name="alimentation" placeholder="Diet"
                                class="w-full bg-transparent border border-[#5a6b60] rounded-lg px-3 py-2 text-white"
                                type="text" required />
                            <input name="paysorigine" placeholder="Country"
                                class="w-full bg-transparent border border-[#5a6b60] rounded-lg px-3 py-2 text-white"
                                type="text" required />
                            <div class="md:col-span-2">
                                <select name="id_habitat"
                                    class="w-full bg-[#1a2a22] border border-[#5a6b60] rounded-lg px-3 py-2 text-white"
                                    required>
                                    <option value="" disabled selected>Select habitat</option>
                                    <?php $results->data_seek(0);
                                    while ($row = $results->fetch_assoc()): ?>
                                        <option value="<?= $row['id_habitat'] ?>"><?= htmlspecialchars($row['nom']) ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <textarea name="description" placeholder="Description..."
                            class="w-full bg-transparent border border-[#5a6b60] rounded-lg px-3 py-2 text-white"
                            rows="4"></textarea>
                    </div>
                    <div class="p-6 border-t border-[#28392e] flex gap-3">
                        <button type="button"
                            class="close-modal-btn flex-1 px-4 py-2 border border-[#5a6b60] rounded-lg text-white">Cancel</button>
                        <button type="submit" name="add_animal"
                            class="flex-1 px-4 py-2 bg-primary rounded-lg text-black font-bold">Save Animal</button>
                    </div>
                </form>
            </div>

            <div id="edit-animal-form"
                class="hidden fixed inset-0 z-50 flex items-center justify-center backdrop-blur-md bg-black/40">
                <form method="POST" action="./edit.php"
                    class="w-11/12 lg:w-3/5 h-[90vh] lg:h-3/4 bg-[#1a2a22] rounded-xl border border-[#28392e] flex flex-col overflow-hidden">
                    <div class="p-6 border-b border-[#28392e] flex justify-between items-center">
                        <h3 class="text-white font-bold text-lg">Edit Animal</h3>
                        <button type="button" class="close-modal-btn text-[#9db9a6] hover:text-white">
                            <span class="material-symbols-outlined">close</span>
                        </button>
                    </div>
                    <div class="p-6 flex-1 space-y-6 overflow-y-auto">
                        <input type="hidden" name="id_animal" id="edit-id_animal">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-[#9db9a6]">Image URL</label>
                            <input id="edit-image" type="url" name="image"
                                class="w-full px-4 py-3 bg-transparent border-2 border-dashed border-[#5a6b60] rounded-lg text-white"
                                required>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <input id="edit-nom" name="nom"
                                class="w-full bg-transparent border border-[#5a6b60] rounded-lg px-3 py-2 text-white"
                                type="text" required />
                            <input id="edit-espece" name="espece"
                                class="w-full bg-transparent border border-[#5a6b60] rounded-lg px-3 py-2 text-white"
                                type="text" required />
                            <input id="edit-alimentation" name="alimentation"
                                class="w-full bg-transparent border border-[#5a6b60] rounded-lg px-3 py-2 text-white"
                                type="text" required />
                            <input id="edit-paysorigine" name="paysorigine"
                                class="w-full bg-transparent border border-[#5a6b60] rounded-lg px-3 py-2 text-white"
                                type="text" required />
                            <div class="md:col-span-2">
                                <select id="edit-id_habitat" name="id_habitat"
                                    class="w-full bg-[#1a2a22] border border-[#5a6b60] rounded-lg px-3 py-2 text-white"
                                    required>
                                    <?php $results->data_seek(0);
                                    while ($row = $results->fetch_assoc()): ?>
                                        <option value="<?= $row['id_habitat'] ?>"><?= htmlspecialchars($row['nom']) ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <textarea id="edit-description" name="description"
                            class="w-full bg-transparent border border-[#5a6b60] rounded-lg px-3 py-2 text-white"
                            rows="4"></textarea>
                    </div>
                    <div class="p-6 border-t border-[#28392e] flex gap-3">
                        <button type="button"
                            class="close-modal-btn flex-1 px-4 py-2 border border-[#5a6b60] rounded-lg text-white">Cancel</button>
                        <button type="submit" name="save_animal"
                            class="flex-1 px-4 py-2 bg-primary rounded-lg text-black font-bold">Save Changes</button>
                    </div>
                </form>
            </div>

        </div>
    </main>
    <script src="/ASSAD_V2/assets/js/script.js"></script>
</body>

</html>
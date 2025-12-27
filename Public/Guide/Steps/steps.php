<?php
include './../../../App/bootstrap.php';
session_start();

// 1. Authentication Check
$logged = $_SESSION['loggeduser'] ?? null;
if (!$logged) {
    header('Location: /ASSAD/auth/login.php');
    exit();
}

if (isset($_SERVER['REQUEST_METHOD'])  && $_SERVER['REQUEST_METHOD'] == 'GET') {
    $id_visite = $_GET['id'] ?? '';
    if ($id_visite) {
        $v = new VisitesGuidees();
        $visite = $v->getVisiteById($id_visite);
    }
}
if (isset($_SERVER['REQUEST_METHOD'])  && $_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['step_id'])) {
        $e = new EtapesVisites();
        $e->deleteEtape($_POST['step_id']);
    } elseif (isset($_POST['titre'])) {
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $id_visite = $_POST['id_visite'];

        $whatOrder = new EtapesVisites();
        $order = $whatOrder->getNextOrder($id_visite);

        $e = new EtapesVisites($titre, $description, $order, $id_visite);
        $e->addEtape();
    }
    $id_visite = $_POST['id_visite'];
    header('Location:'  . $_SERVER['PHP_SELF'] . '?id=' . $id_visite);
    exit();
}
?>

<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Manage Steps - <?= $visite->titre ?></title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#11d452",
                        "background-light": "#f6f8f6",
                        "background-dark": "#102216",
                        "surface-dark": "#1c2e22",
                        "surface-light": "#ffffff",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                },
            },
        }
    </script>
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-gray-900 dark:text-gray-100 min-h-screen flex flex-col overflow-x-hidden">

    <header
        class="sticky top-0 z-50 w-full border-b border-gray-200 dark:border-[#28392e] bg-surface-light dark:bg-[#111813]">
        <div class="px-6 lg:px-10 py-3 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div
                    class="bg-center bg-no-repeat bg-cover rounded-full h-10 w-10 shrink-0 shadow-lg shadow-primary/20">
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
                                <path
                                    d="M40.007,42s0,6,7,8l-3,5h-.862a2.138,2.138,0,0,0-2.138,2.138V59h6l4-10s7-20-7-21"
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
                    <h1
                        class="text-gray-900 dark:text-white text-lg font-bold leading-tight tracking-[-0.015em] hidden sm:block">
                        ASSAD Guide</h1>
                </div>
            </div>
            <div class="flex items-center gap-4 sm:gap-8">
                <nav class="hidden md:flex items-center gap-6">
                    <a class="text-gray-600 dark:text-gray-300 hover:text-primary dark:hover:text-primary text-sm font-medium transition-colors"
                        href="/ASSAD_V2/Public/Guide/dashboard.php">Home</a>
                    <a class="text-primary text-sm font-medium" href="/ASSAD_V2/Public/Guide/Tours/tours.php">My Tours</a>
                </nav>
                <button
                    class="hidden sm:flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-9 px-4 bg-primary text-[#111813] text-sm font-bold shadow-lg hover:bg-opacity-90 transition-all">
                    <span>Create Tour</span>
                </button>
                <a href="/ASSAD_V2/Public/Auth/logout.php" title="Logout"
                    class="hidden md:inline-flex items-center justify-center size-9 rounded-lg text-gray-600 dark:text-gray-300 hover:text-red-500 transition-colors">
                    <span class="material-symbols-outlined">logout</span>
                </a>
                <a href="#" title="Profile">
                    <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10 border-2 border-transparent hover:border-primary transition-colors cursor-pointer"
                        data-alt="User profile avatar showing a smiling guide in uniform"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCoCV4spzIBmv7a6A9BMjRgr_a0agYRa3LNyDSYHzzGnguO62dec_My0oka-Oxvi_uaolPsu0PM5LiuCTdcutulEdx2zQ49D4wy4z5h0fQ9mhp3Z8iKFoS0m47NIlOsAnEN2C8cDVCtr7YHZcgQcqlAFbBghwbmb5o6ckkCC8blFRwJKx71mavngHe1PiHJ8S3ZKp_dlOEIGgzYWrcUjAjgo9tk0yo2aBJ9z6x1CtkdEUG-yDr_hnHiDheFPxMH4gXm_yyiO8GCR7ZW");'>
                    </div>
                </a>
            </div>
        </div>
    </header>

    <main class="flex-grow flex justify-center py-6 sm:py-10 px-4 sm:px-6 md:px-10 lg:px-40">
        <div class="flex flex-col w-full max-w-6xl gap-8">

            <div class="flex flex-wrap gap-2 text-sm">
                <a class="text-gray-500 dark:text-[#9db9a6]" href="/ASSAD_V2/Public/Guide/Tours/tours.php">My Tours</a>
                <span class="text-gray-400">/</span>
                <span class="text-gray-900 dark:text-white font-medium">Itinerary Steps</span>
            </div>

            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-4 border-b border-gray-200 dark:border-[#28392e]">
                <div class="flex flex-col gap-2">
                    <h1 class="text-3xl md:text-4xl font-black tracking-tight text-gray-900 dark:text-white">Manage Itinerary</h1>
                    <p class="text-gray-500 dark:text-[#9db9a6] text-base max-w-2xl">
                        Managing experience for: <span class="text-primary font-semibold"><?= $visite->titre ?></span>
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-1 flex flex-col gap-4">
                    <div class="bg-surface-light dark:bg-surface-dark rounded-xl p-6 shadow-sm border border-gray-200 dark:border-[#28392e] sticky top-24">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">add_location_alt</span>
                            Add New Step
                        </h3>

                        <form action="" method="POST" class="flex flex-col gap-5">
                            <input type="hidden" name="id_visite" value="<?= $visite->id_visite ?>">

                            <div class="flex flex-col gap-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-[#9db9a6]">Step Title</label>
                                <input required name="titre" class="w-full h-11 px-4 rounded-lg bg-gray-50 dark:bg-[#1a2920] border-gray-200 dark:border-[#28392e] text-gray-900 dark:text-white focus:ring-2 focus:ring-primary text-sm" placeholder="e.g. Watering Hole" type="text" />
                            </div>

                            <div class="flex flex-col gap-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-[#9db9a6]">Description</label>
                                <textarea required name="description" class="w-full h-32 p-4 rounded-lg bg-gray-50 dark:bg-[#1a2920] border-gray-200 dark:border-[#28392e] text-gray-900 dark:text-white focus:ring-2 focus:ring-primary text-sm resize-none" placeholder="Describe what visitors will see..."></textarea>
                            </div>



                            <div class="pt-2">
                                <button type="submit" class="w-full h-12 rounded-xl bg-surface-dark dark:bg-[#28392e] hover:bg-gray-800 text-white text-sm font-bold transition-all shadow-md flex items-center justify-center gap-2 group">
                                    <span class="material-symbols-outlined text-primary group-hover:scale-110 transition-transform">add</span>
                                    Add Step to Itinerary
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="lg:col-span-2 flex flex-col gap-4">


                    <?php
                    $e = new EtapesVisites();
                    $steps = $e->getEtapesByvisiteId($visite->id_visite)
                    ?>
                    <?php if (count($steps) > 0): ?>
                        <?php foreach ($steps as $index => $step): ?>
                            <div class="group bg-surface-light dark:bg-surface-dark border border-gray-200 dark:border-[#28392e] rounded-xl p-4 shadow-sm hover:border-primary/50 transition-all flex items-start sm:items-center gap-4 relative">
                                <div class="text-gray-300 dark:text-[#344a3c] p-1 self-start sm:self-auto mt-1 sm:mt-0">
                                    <span class="material-symbols-outlined text-2xl">drag_indicator</span>
                                </div>

                                <div class="size-8 rounded-full bg-gray-100 dark:bg-[#111813] border border-gray-200 dark:border-[#28392e] flex items-center justify-center text-sm font-bold text-gray-700 dark:text-primary shrink-0">
                                    <?= $index + 1 ?>
                                </div>

                                <div class="flex-grow min-w-0">
                                    <div class="flex flex-wrap items-center gap-x-3 gap-y-1 mb-1">
                                        <h4 class="text-base font-bold text-gray-900 dark:text-white truncate"><?= htmlspecialchars($step->titreetape) ?></h4>

                                    </div>
                                    <p class="text-sm text-gray-500 dark:text-[#9db9a6] line-clamp-1"><?= htmlspecialchars($step->descriptionetape) ?></p>
                                </div>

                                <div class="flex items-center gap-1 sm:gap-2 ml-auto pl-2 border-l border-gray-100 dark:border-[#28392e]">

                                    <form action="" method="POST">
                                        <input type="hidden" name="step_id" value="<?= $step->id_etape ?>">
                                        <input type="hidden" name="id_visite" value="<?= $visite->id_visite ?>">
                                        <button type="submit" class="p-2 rounded-lg text-gray-400 dark:text-[#5e7164] hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors" title="Remove Step">
                                            <span class="material-symbols-outlined text-xl">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="border-2 border-dashed border-gray-200 dark:border-[#28392e] rounded-xl p-8 flex flex-col items-center justify-center text-center text-gray-400">
                            <span class="material-symbols-outlined text-3xl mb-2">playlist_add</span>
                            <span class="text-sm font-medium">No steps added yet. Use the form on the left.</span>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </main>
</body>

</html>
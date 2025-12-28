<?php
include "./../../App/bootstrap.php";
session_start();
$logged = $_SESSION['loggeduser'] ?? null;

if (!$logged || (isset($logged->role) && trim($logged->role) !== 'visitor')) {
    header('Location: ./../Auth/login.php');
    exit();
}

$searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';
$habitatFilter = isset($_GET['habitat']) ? (int)$_GET['habitat'] : 0;
$countryFilter = isset($_GET['country']) ? trim($_GET['country']) : '';

$animalObj = new Animal();
$habitatObj = new Habitat();

$allAnimals = $animalObj->getAnimals() ?? [];
$habitats = $habitatObj->getHabitats() ?? [];

$filteredAnimals = $allAnimals;

if ($searchQuery !== '') {
    $filteredAnimals = array_filter($filteredAnimals, function ($animal) use ($searchQuery) {
        return stripos($animal->nom, $searchQuery) !== false ||
            stripos($animal->espece, $searchQuery) !== false;
    });
}

if ($habitatFilter > 0) {
    $filteredAnimals = array_filter($filteredAnimals, function ($animal) use ($habitatFilter) {
        return $animal->id_habitat == $habitatFilter;
    });
}

if ($countryFilter !== '') {
    $filteredAnimals = array_filter($filteredAnimals, function ($animal) use ($countryFilter) {
        return stripos($animal->paysorigine, $countryFilter) !== false;
    });
}

$animals = array_values($filteredAnimals);
?>
<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>ASSAD - Meet the Team of the Wild</title>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&amp;family=Noto+Sans:wght@300..800&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#13ec5b",
                        "background-light": "#f6f8f6",
                        "background-dark": "#0a1610",
                        "card-light": "#ffffff",
                        "card-dark": "#12251a",
                        "text-main": "#ffffff",
                        "text-muted": "#a0b3a6"
                    },
                    fontFamily: {
                        "display": ["Lexend", "sans-serif"],
                        "body": ["Noto Sans", "sans-serif"],
                    },
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg": "1rem",
                        "xl": "1.5rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Lexend', sans-serif;
        }

        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-background-dark text-white transition-colors duration-300">
    <div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">
        <header
            class="sticky top-0 z-50 flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#f0f4f2] dark:border-b-[#1f3b2a] bg-white/90 dark:bg-background-dark/90 backdrop-blur-md px-10 py-3 transition-colors duration-300">
            <div class="flex items-center gap-4 text-[#111813] dark:text-white">
                <div class="size-8 flex items-center justify-center text-primary">
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
                <h2 class="text-[#111813] dark:text-white text-lg font-bold leading-tight tracking-[-0.015em]">ASSAD Virtual Zoo
                </h2>
            </div>
            <div class="hidden lg:flex flex-1 justify-end gap-8">
                <nav class="flex items-center gap-9">
                    <a class="text-[#111813] dark:text-white text-sm font-medium leading-normal hover:text-primary transition-colors"
                        href="./home.php">Home</a>
                    <a class="text-white  text-sm font-medium leading-normal hover:text-primary transition-colors"
                        href="./tours.php">Tours</a>
                    <a class="text-yellow-500 text-sm font-medium leading-normal hover:text-primary transition-colors"
                        href="#">Animals</a>
                    <a class="text-[#111813] dark:text-white text-sm font-medium leading-normal hover:text-primary transition-colors"
                        href="./special.php">CAN 2025 Specials</a>

                </nav>
                <button
                    class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 px-4 bg-primary text-[#111813] text-sm font-bold leading-normal tracking-[0.015em] hover:bg-[#0fdc52] transition-colors shadow-lg shadow-primary/20">
                    <span class="truncate">Book a Tour</span>
                </button>
            </div>
            <div class="lg:hidden text-[#111813] dark:text-white">
                <span class="material-symbols-outlined cursor-pointer">menu</span>
            </div>
        </header>
        <main class="flex-1 flex flex-col items-center w-full">
            <div class="w-full max-w-[1440px] px-4 md:px-10 lg:px-20 py-6 md:py-10 flex flex-col gap-8">
                <section class="@container">
                    <div class="flex min-h-[400px] flex-col gap-6 bg-cover bg-center bg-no-repeat rounded-2xl items-center justify-center p-8 relative overflow-hidden shadow-2xl ring-1 ring-white/10"
                        data-alt="Cinematic shot of a lion resting in tall grass under a sunset"
                        style='background-image: linear-gradient(rgba(10, 22, 16, 0.4) 0%, rgba(10, 22, 16, 0.8) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuAwabsAUrVYYZRG0ASYhAc8gcFQXaSuE6gN3YmM2TWD5UVYvvIGTGcvR8IuBfUVeAPLxvk8MG5pF3yFUR7HBpxEz0Aj6SrBc6rZqe22O5bhyOnPy0aqYQQS3aoKSEopjixRUEBM5rUK3j5FyKX-KtuW0N5Xh6RbOyU-HfDs2RpSXdLrABtXW5uVRixm8EjnJEGMxS5zkWAfsltcVF4a6lnm1fZEEmMC1l9OBg1AW_dWOVP6YfGtInzCA6Q-vfbozgI3CcsZPAe_WVM");'>
                        <div class="flex flex-col gap-4 text-center z-10 max-w-2xl">
                            <div
                                class="inline-flex items-center justify-center gap-2 px-3 py-1 bg-primary/90 text-[#0a1610] rounded-full w-fit mx-auto text-xs font-bold uppercase tracking-wider backdrop-blur-sm shadow-lg shadow-primary/20">
                                <span class="material-symbols-outlined text-sm">sports_soccer</span>
                                CAN 2025 Special
                            </div>
                            <h1
                                class="text-white text-4xl md:text-5xl lg:text-6xl font-black leading-tight tracking-tight drop-shadow-lg">
                                Meet the Team of the Wild
                            </h1>
                            <h2 class="text-gray-200 text-lg md:text-xl font-medium leading-relaxed drop-shadow-md">
                                Discover the majestic animals representing the spirit of African football.
                            </h2>
                        </div>
                        <div class="w-full max-w-[600px] z-10 mt-4">
                            <form method="GET" action="" class="flex flex-col w-full h-14 md:h-16 relative group">
                                <div
                                    class="flex w-full flex-1 items-stretch rounded-xl h-full shadow-2xl shadow-black/50 transition-transform group-focus-within:scale-[1.02] duration-200 ring-1 ring-white/10">
                                    <div
                                        class="text-[#a0b3a6] flex border-y border-l border-[#2a4533] bg-[#12251a] items-center justify-center pl-[20px] rounded-l-xl border-r-0">
                                        <span class="material-symbols-outlined text-xl">search</span>
                                    </div>
                                    <input
                                        name="search"
                                        class="flex w-full min-w-0 flex-1 resize-none overflow-hidden text-white focus:outline-0 focus:ring-0 border-y border-[#2a4533] bg-[#12251a] h-full placeholder:text-[#a0b3a6]/50 px-3 text-base font-normal leading-normal"
                                        placeholder="Search for an animal (e.g. 'Lion', 'Eagle')..."
                                        value="<?= htmlspecialchars($searchQuery) ?>" />
                                    <div
                                        class="flex items-center justify-center rounded-r-xl border-y border-r border-l-0 border-[#2a4533] bg-[#12251a] pr-[7px]">
                                        <button
                                            type="submit"
                                            class="flex cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-6 md:h-12 bg-primary hover:bg-[#0fd650] text-[#0a1610] text-base font-bold leading-normal transition-all active:scale-95 shadow-lg shadow-primary/20">
                                            <span class="truncate">Find</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
                <section
                    class="flex flex-col lg:flex-row gap-6 lg:items-end justify-between border-b border-[#1f3326] pb-6">
                    <div class="flex flex-col gap-2">
                        <h3 class="text-white text-3xl font-bold leading-tight tracking-tight">All Animals</h3>
                        <p class="text-[#a0b3a6] text-sm font-normal">Filter by habitat or country to find your favorite
                            mascots.</p>
                    </div>
                    <div class="flex flex-wrap items-center gap-4">
                        <div class="flex gap-2 overflow-x-auto hide-scrollbar pb-1 max-w-[100vw] lg:max-w-none">
                            <a href="?<?= $searchQuery ? 'search=' . urlencode($searchQuery) : '' ?>"
                                class="flex h-10 shrink-0 items-center justify-center gap-x-2 rounded-xl <?= $habitatFilter === 0 ? 'bg-primary shadow-lg shadow-primary/20' : 'bg-[#1f3326] hover:bg-[#2a4533] border border-white/5' ?> px-5 transition-transform hover:-translate-y-0.5">
                                <p class="<?= $habitatFilter === 0 ? 'text-[#0a1610]' : 'text-white' ?> text-sm font-bold">All</p>
                            </a>
                            <?php foreach ($habitats as $habitat): ?>
                                <a href="?habitat=<?= $habitat->id_habitat ?><?= $searchQuery ? '&search=' . urlencode($searchQuery) : '' ?>"
                                    class="flex h-10 shrink-0 items-center justify-center gap-x-2 rounded-xl <?= $habitatFilter === (int)$habitat->id_habitat ? 'bg-primary shadow-lg shadow-primary/20' : 'bg-[#1f3326] hover:bg-[#2a4533] border border-white/5' ?> px-5 transition-colors">
                                    <span class="material-symbols-outlined text-[18px] <?= $habitatFilter === (int)$habitat->id_habitat ? 'text-[#0a1610]' : 'text-white' ?>">landscape</span>
                                    <p class="<?= $habitatFilter === (int)$habitat->id_habitat ? 'text-[#0a1610] font-bold' : 'text-white font-medium' ?> text-sm"><?= htmlspecialchars($habitat->nom) ?></p>
                                </a>
                            <?php endforeach; ?>
                        </div>
                        <div class="h-8 w-[1px] bg-[#1f3326] hidden lg:block"></div>
                        <div class="relative min-w-[200px] flex-1 lg:flex-none">
                            <select
                                onchange="window.location.href='?country=' + this.value + '<?= $habitatFilter ? '&habitat=' . $habitatFilter : '' ?><?= $searchQuery ? '&search=' . urlencode($searchQuery) : '' ?>'"
                                class="appearance-none w-full h-10 rounded-xl border border-[#2a4533] bg-[#12251a] px-4 pr-10 text-sm font-medium text-white focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary cursor-pointer">
                                <option <?= $countryFilter === '' ? 'selected' : '' ?> value="">All African Nations</option>
                                <?php
                                $countries = [];
                                foreach ($allAnimals as $animal) {
                                    if ($animal->paysorigine && !in_array($animal->paysorigine, $countries)) {
                                        $countries[] = $animal->paysorigine;
                                    }
                                }
                                sort($countries);
                                foreach ($countries as $country):
                                ?>
                                    <option <?= $countryFilter === $country ? 'selected' : '' ?> value="<?= htmlspecialchars($country) ?>"><?= htmlspecialchars($country) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-[#a0b3a6]">
                                <span class="material-symbols-outlined text-xl">expand_more</span>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <?php if (empty($animals)): ?>
                        <div class="col-span-full text-center py-12">
                            <span class="material-symbols-outlined text-6xl text-[#a0b3a6] mb-4">search_off</span>
                            <h3 class="text-xl font-bold text-white mb-2">No Animals Found</h3>
                            <p class="text-[#a0b3a6]">Try adjusting your search or filters</p>
                            <a href="animals.php" class="inline-block mt-4 px-6 py-2 bg-primary text-[#0a1610] font-bold rounded-lg hover:bg-[#0fd650] transition-colors">
                                Clear Filters
                            </a>
                        </div>
                    <?php else: ?>
                        <?php foreach ($animals as $animal):
                            $alimentationIcon = 'restaurant';
                            $alimentationTitle = htmlspecialchars($animal->alimentation);
                            if (stripos($animal->alimentation, 'herbivore') !== false) {
                                $alimentationIcon = 'grass';
                            } elseif (stripos($animal->alimentation, 'omnivore') !== false) {
                                $alimentationIcon = 'restaurant_menu';
                            }
                        ?>
                            <article
                                class="group relative flex flex-col overflow-hidden rounded-2xl bg-[#12251a] shadow-lg hover:shadow-2xl hover:shadow-primary/10 transition-all duration-300 hover:-translate-y-1 border border-[#1f3326] hover:border-primary/50">
                                <div class="relative aspect-[4/3] w-full overflow-hidden bg-[#0a1610]">
                                    <img alt="<?= htmlspecialchars($animal->nom . ' - ' . $animal->espece) ?>"
                                        class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110 opacity-90 group-hover:opacity-100"
                                        loading="lazy"
                                        src="<?= htmlspecialchars($animal->image) ?>"
                                        onerror="this.src='https://via.placeholder.com/400x300/12251a/a0b3a6?text=No+Image'" />
                                    <?php if ($animal->paysorigine): ?>
                                        <div class="absolute top-3 right-3">
                                            <span
                                                class="inline-flex items-center gap-1 rounded-lg bg-black/60 backdrop-blur-md px-2 py-1 text-xs font-bold text-white shadow-sm border border-white/10">
                                                <span class="material-symbols-outlined text-sm text-primary">flag</span> <?= htmlspecialchars($animal->paysorigine) ?>
                                            </span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="flex flex-1 flex-col p-5">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <h3 class="text-xl font-bold text-white leading-tight"><?= htmlspecialchars($animal->nom) ?></h3>
                                            <p class="text-sm font-medium text-[#a0b3a6]"><?= htmlspecialchars($animal->espece) ?></p>
                                        </div>
                                        <span class="material-symbols-outlined text-[#a0b3a6]"
                                            title="<?= $alimentationTitle ?>"><?= $alimentationIcon ?></span>
                                    </div>
                                    <?php if ($animal->description): ?>
                                        <p class="text-xs text-[#a0b3a6] mb-3 line-clamp-2"><?= htmlspecialchars(substr($animal->description, 0, 80)) ?><?= strlen($animal->description) > 80 ? '...' : '' ?></p>
                                    <?php endif; ?>
                                    <div class="mt-auto pt-4 flex items-center justify-between gap-4">
                                        <div
                                            class="flex items-center gap-1.5 text-xs font-semibold text-primary uppercase tracking-wide">
                                            <span
                                                class="size-2 rounded-full bg-primary animate-pulse shadow-[0_0_8px_rgba(19,236,91,0.6)]"></span>
                                            <?= $animal->habitat_name ?? 'On Display' ?>
                                        </div>
                                        <button
                                            onclick="viewAnimal(<?= $animal->id_animal ?>)"
                                            class="rounded-lg bg-[#1f3326] group-hover:bg-primary px-4 py-2 text-sm font-bold text-white group-hover:text-[#0a1610] transition-colors duration-300">
                                            View Profile
                                        </button>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </section>
                <?php if (count($animals) > 0): ?>
                    <div class="text-center py-6">
                        <p class="text-[#a0b3a6] text-sm">
                            Showing <span class="text-white font-bold"><?= count($animals) ?></span> animal<?= count($animals) !== 1 ? 's' : '' ?>
                            <?= $searchQuery ? ' matching "<span class="text-primary font-bold">' . htmlspecialchars($searchQuery) . '</span>"' : '' ?>
                        </p>
                    </div>
                <?php endif; ?>
                <footer class="mt-10 border-t border-[#1f3326] pt-10 pb-5 text-center">
                    <div class="flex flex-col gap-4 items-center justify-center">
                        <div class="flex items-center gap-2 text-white opacity-80">
                            <span class="material-symbols-outlined text-primary">pets</span>
                            <span class="font-bold">ASSAD Zoo</span>
                        </div>
                        <p class="text-sm text-[#a0b3a6]">Celebrating African Wildlife &amp; Football • CAN 2025 Morocco
                        </p>
                    </div>
                </footer>
            </div>
        </main>
    </div>

    <script>
        function viewAnimal(animalId) {
            // TODO: Navigate to animal profile page
            alert('Animal profile page coming soon! Animal ID: ' + animalId);
        }
    </script>

</body>

</html>
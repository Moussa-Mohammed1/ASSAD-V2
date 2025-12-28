<?php
include "./../../App/bootstrap.php";
session_start();
$logged = $_SESSION['loggeduser'] ?? null;

if (!$logged || (isset($logged->role) && $logged->role !== 'visitor')) {
    header('Location: ./../Auth/login.php');
    exit();
}

$query = isset($_GET['q']) ? trim($_GET['q']) : '';
$booked = isset($_GET['booked']) ? $_GET['booked'] : 0;

$visiteObj = new VisitesGuidees();
$tours = $query !== ''
    ? $visiteObj->searchPublicVisites($query, 6)
    : $visiteObj->getPublicVisites(3);

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_visite_id'])) {
    $bookVisiteId = $_POST['book_visite_id'];
    if ($bookVisiteId > 0) {
        $reservation = new Reservation($bookVisiteId, $logged->id_user, 1, date('Y-m-d H:i:s'));
        $reservation->reserver();
    }

    $redirect = './home.php?booked=1';
    if ($query !== '') {
        $redirect .= '&q=' . urlencode($query);
    }
    header('Location: ' . $redirect);
    exit();
}

?>

<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>ASSAD - Visitor Homepage</title>
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
                        "background-light": "#ffffff",
                        "background-dark": "#102216",
                        "text-dark": "#111813",
                        "text-light": "#f0f4f2",
                        "secondary-dark": "#1a3825",
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
</head>

<body
    class="bg-background-light dark:bg-background-dark text-text-dark dark:text-text-light font-display antialiased selection:bg-primary selection:text-text-dark">
    <div class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden">
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
                    <a class="text-yellow-500 text-sm font-medium leading-normal hover:text-primary transition-colors"
                        href="#">Home</a>
                    <a class="text-white  text-sm font-medium leading-normal hover:text-primary transition-colors"
                        href="./tours.php">Tours</a>
                    <a class="text-[#111813] dark:text-white text-sm font-medium leading-normal hover:text-primary transition-colors"
                        href="./animals.php">Animals</a>
                    <a class="text-[#111813] dark:text-white text-sm font-medium leading-normal hover:text-primary transition-colors"
                        href="#specials">CAN 2025 Specials</a>

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
        <main class="flex flex-col items-center">
            <section class="w-full max-w-[1440px] px-4 md:px-10 lg:px-20 py-5">
                <div class="@container">
                    <div class="flex min-h-[560px] flex-col gap-6 bg-cover bg-center bg-no-repeat rounded-xl md:rounded-[2rem] items-start justify-end px-6 pb-12 md:px-12 md:pb-16 relative overflow-hidden group"
                        data-alt="Majestic Atlas Lion resting on a rock with Moroccan mountains in the background"
                        style='background-image: linear-gradient(rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.6) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuCK3Ylw8A0UHXJnk1bO6bLDpgurssjzjEMZQCOMpJObZ0a3XRVPQ-PPAsO7o4cJ46GB2sWJmJXScahror6tDkPuIAuTCDSDfjmoSWw88eH16SkMhHZnw-wgYt32w12kxQ_uE-Nthi_zz3pbDpxRvAEnBas0oEE1IW9oKhOcrGpCN3LDDeq-9yukBUqBeTKkF82A3v_UR46slQQJRtx9DT_F3lafrVPWS9vrh4u2DL2Peyj7wCBh28b3xbSLaZzUrZ26vYuTIqfjmvc");'>
                        <div
                            class="absolute top-6 right-6 md:top-10 md:right-10 bg-white/10 backdrop-blur-md border border-white/20 rounded-full px-4 py-2 flex items-center gap-2">
                            <span class="material-symbols-outlined text-white">sports_soccer</span>
                            <span class="text-white text-sm font-bold tracking-wide">CAN 2025 PARTNER</span>
                        </div>
                        <div class="flex flex-col gap-4 text-left max-w-2xl relative z-10">
                            <h1 class="text-white text-4xl md:text-6xl font-black leading-tight tracking-[-0.033em]">
                                Roar with the <br /><span class="text-primary">Lions of the Atlas</span>
                            </h1>
                            <h2 class="text-gray-200 text-base md:text-xl font-normal leading-relaxed max-w-xl">
                                The perfect family adventure between matches. Meet Asaad, our mascot, and explore the
                                wild side of Morocco.
                            </h2>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                            <button
                                class="flex min-w-[140px] cursor-pointer items-center justify-center rounded-xl h-12 px-6 bg-primary hover:bg-green-400 transition-transform hover:scale-105 text-text-dark text-base font-bold leading-normal tracking-[0.015em]">
                                <span class="mr-2 material-symbols-outlined text-xl">pets</span>
                                <span class="truncate">Meet Asaad</span>
                            </button>

                        </div>
                    </div>
                </div>
            </section>
            <section class="w-full max-w-[960px] px-4 py-8 md:px-0">
                <div
                    class="bg-gray-50 dark:bg-secondary-dark rounded-2xl p-6 md:p-10 shadow-sm border border-gray-100 dark:border-gray-800">
                    <div class="flex flex-col gap-6 text-center">
                        <div class="space-y-2">
                            <h2 class="text-text-dark dark:text-white text-2xl md:text-3xl font-bold leading-tight">
                                Find your next adventure
                            </h2>
                            <p class="text-gray-500 dark:text-gray-400 text-sm md:text-base">
                                Search for guided tours, specific animals, or match day specials
                            </p>
                        </div>
                        <div class="flex justify-center w-full">
                            <form class="flex w-full max-w-[600px] flex-col sm:flex-row items-stretch gap-2" method="GET" action="">
                                <div class="relative flex-1">
                                    <span
                                        class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 material-symbols-outlined">search</span>
                                    <input
                                        class="w-full h-12 md:h-14 pl-12 pr-4 rounded-xl bg-white dark:bg-background-dark border border-gray-200 dark:border-gray-700 text-text-dark dark:text-white focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent placeholder:text-gray-400"
                                        placeholder="Try 'Lion Feeding' or 'Family Tour'..." type="text" name="q" value="<?= htmlspecialchars($query) ?>" />
                                </div>
                                <div class="relative w-full sm:w-auto">
                                    <button
                                        type="submit"
                                        class="w-full sm:w-auto h-12 md:h-14 px-8 bg-text-dark dark:bg-white text-white dark:text-text-dark rounded-xl font-bold hover:opacity-90 transition-opacity flex items-center justify-center gap-2">
                                        <span>Search Tour</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <?php if ($booked === 1): ?>
                            <p class="text-sm text-primary font-bold">Reservation created.</p>
                        <?php endif; ?>
                        <div class="flex flex-wrap justify-center gap-2">
                            <span
                                class="px-3 py-1 bg-white dark:bg-background-dark border border-gray-200 dark:border-gray-700 rounded-full text-xs font-medium text-gray-600 dark:text-gray-300 cursor-pointer hover:border-primary transition-colors">🦁
                                Big Cats</span>
                            <span
                                class="px-3 py-1 bg-white dark:bg-background-dark border border-gray-200 dark:border-gray-700 rounded-full text-xs font-medium text-gray-600 dark:text-gray-300 cursor-pointer hover:border-primary transition-colors">⚽
                                Match Day Specials</span>
                            <span
                                class="px-3 py-1 bg-white dark:bg-background-dark border border-gray-200 dark:border-gray-700 rounded-full text-xs font-medium text-gray-600 dark:text-gray-300 cursor-pointer hover:border-primary transition-colors">🎟️
                                VIP Tours</span>
                        </div>
                    </div>
                </div>
            </section>
            <section id="specials" class="w-full max-w-[1440px] px-4 md:px-10 lg:px-20 py-12">
                <div class="flex flex-col md:flex-row justify-between items-end mb-8 gap-4">
                    <div>
                        <span class="text-primary font-bold tracking-wider text-sm uppercase mb-2 block">Don't Miss
                            Out</span>
                        <h2 class="text-text-dark dark:text-white text-3xl font-bold leading-tight">
                            <?= $query !== '' ? 'Search Results' : 'CAN 2025 Day Specials' ?>
                        </h2>
                        <p class="text-gray-500 dark:text-gray-400 mt-2">
                            <?= $query !== '' ? "Matching tours for: \"" . htmlspecialchars($query) . "\"" : 'Exclusive tours scheduled around the big games.' ?>
                        </p>
                    </div>
                    <a class="text-text-dark dark:text-white font-medium hover:text-primary flex items-center gap-1 transition-colors"
                        href="#specials">
                        <?= $query !== '' ? 'Back to specials' : 'View all specials' ?> <span class="material-symbols-outlined text-lg">arrow_forward</span>
                    </a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php
                    if (!$tours || count($tours) === 0) {
                        echo '<div class="sm:col-span-2 lg:col-span-3 p-8 rounded-2xl bg-white dark:bg-secondary-dark border border-gray-100 dark:border-gray-800 text-center">'
                            . '<h3 class="text-lg font-bold text-text-dark dark:text-white">No tours found</h3>'
                            . '<p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Try a different keyword.</p>'
                            . '</div>';
                    } else {
                        foreach ($tours as $tour) {
                            $badge = date('M d • h:i A', strtotime($tour->dateheure));
                            $lang = htmlspecialchars((string)$tour->langue);
                            $title = htmlspecialchars((string)$tour->titre);
                            $desc = 'Language: ' . $lang . ' • Duration: ' . (int)$tour->duree . ' mins • Max: ' . (int)$tour->capacite_max;

                            echo '<div class="group flex flex-col gap-4 bg-white dark:bg-secondary-dark p-6 rounded-2xl border border-gray-100 dark:border-gray-800 hover:shadow-lg transition-shadow">'
                                . '<div class="flex items-center justify-between mb-2">'
                                . '<div class="bg-primary/10 dark:bg-primary/20 px-3 py-1 rounded-full text-xs font-bold text-primary border border-primary/30">'
                                . htmlspecialchars($badge)
                                . '</div>'
                                . '</div>'
                                . '<div class="flex flex-col flex-1 gap-2">'
                                . '<h3 class="text-xl font-bold text-text-dark dark:text-white">' . $title . '</h3>'
                                . '<p class="text-sm text-gray-500 dark:text-gray-400">' . htmlspecialchars($desc) . '</p>'
                                . '<div class="mt-auto pt-4 flex items-center justify-between border-t border-gray-100 dark:border-gray-800">'
                                . '<span class="text-lg font-bold text-primary">$' . number_format((float)$tour->prix, 2) . '<span class="text-xs text-gray-400 font-normal ml-1">/person</span></span>'
                                . '<a href="./tours.php" class="px-4 py-2 bg-gray-100 dark:bg-background-dark hover:bg-primary hover:text-text-dark text-text-dark dark:text-white rounded-lg text-sm font-bold transition-colors inline-block">Book Now</a>'
                                . '</div>'
                                . '</div>'
                                . '</div>';
                        }
                    }
                    ?>
                </div>
            </section>

            <footer
                class="w-full border-t border-gray-100 dark:border-gray-800 bg-white dark:bg-background-dark pt-16 pb-8">
                <div class="max-w-[1440px] mx-auto px-4 md:px-10 lg:px-20">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
                        <div class="col-span-1 md:col-span-1">
                            <div class="flex items-center gap-2 mb-4">
                                <span class="material-symbols-outlined text-primary text-3xl">pets</span>
                                <h3 class="text-xl font-bold text-text-dark dark:text-white">ASSAD</h3>
                            </div>
                            <p class="text-gray-500 dark:text-gray-400 text-sm mb-6">
                                Bringing the wild heart of Morocco to football fans and families from around the world.
                            </p>
                            <div class="flex gap-4">
                                <a class="w-10 h-10 rounded-full bg-gray-100 dark:bg-secondary-dark flex items-center justify-center text-text-dark dark:text-white hover:bg-primary transition-colors"
                                    href="#">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path clip-rule="evenodd"
                                            d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                            fill-rule="evenodd"></path>
                                    </svg>
                                </a>
                                <a class="w-10 h-10 rounded-full bg-gray-100 dark:bg-secondary-dark flex items-center justify-center text-text-dark dark:text-white hover:bg-primary transition-colors"
                                    href="#">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path clip-rule="evenodd"
                                            d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772 4.902 4.902 0 011.772-1.153c.636-.247 1.363-.416 2.427-.465C9.673 2.013 10.03 2 12.48 2h-.165zm-3.77 14.762a6.762 6.762 0 016.762-6.762 6.762 6.762 0 01-6.762 6.762zm7.69-9.206a1.44 1.44 0 110 2.88 1.44 1.44 0 010-2.88zm-5.99 3.206a5.72 5.72 0 100 11.44 5.72 5.72 0 000-11.44z"
                                            fill-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-bold text-text-dark dark:text-white mb-4">Plan Your Visit</h4>
                            <ul class="space-y-2 text-sm text-gray-500 dark:text-gray-400">
                                <li><a class="hover:text-primary transition-colors" href="#">Buy Tickets</a></li>
                                <li><a class="hover:text-primary transition-colors" href="#">Opening Hours</a></li>
                                <li><a class="hover:text-primary transition-colors" href="#">Zoo Map</a></li>
                                <li><a class="hover:text-primary transition-colors" href="#">Directions</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-bold text-text-dark dark:text-white mb-4">Animals &amp; Tours</h4>
                            <ul class="space-y-2 text-sm text-gray-500 dark:text-gray-400">
                                <li><a class="hover:text-primary transition-colors" href="#">Meet Asaad</a></li>
                                <li><a class="hover:text-primary transition-colors" href="#">Guided Tours</a></li>
                                <li><a class="hover:text-primary transition-colors" href="#">Animal Encyclopedia</a>
                                </li>
                                <li><a class="hover:text-primary transition-colors" href="#">Conservation</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-bold text-text-dark dark:text-white mb-4">CAN 2025 Info</h4>
                            <ul class="space-y-2 text-sm text-gray-500 dark:text-gray-400">
                                <li><a class="hover:text-primary transition-colors" href="#">Fan Zone Partners</a></li>
                                <li><a class="hover:text-primary transition-colors" href="#">Match Day Shuttle</a></li>
                                <li><a class="hover:text-primary transition-colors" href="#">Special Offers</a></li>
                            </ul>
                        </div>
                    </div>
                    <div
                        class="border-t border-gray-100 dark:border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                        <p class="text-sm text-gray-400">© 2024 ASSAD Zoo. All rights reserved.</p>
                        <div class="flex gap-6 text-sm text-gray-400">
                            <a class="hover:text-text-dark dark:hover:text-white transition-colors" href="#">Privacy</a>
                            <a class="hover:text-text-dark dark:hover:text-white transition-colors" href="#">Terms</a>
                        </div>
                    </div>
                </div>
            </footer>
        </main>
    </div>

</body>

</html>
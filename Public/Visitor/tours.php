<?php
include "./../../App/bootstrap.php";
session_start();
$logged = $_SESSION['loggeduser'] ?? null;

if (!$logged || (isset($logged->role) && trim($logged->role) !== 'visitor')) {
    header('Location: ./../Auth/login.php');
    exit();
}

$query = isset($_GET['q']) ? trim($_GET['q']) : '';

$visiteObj = new VisitesGuidees();
$allVisites = $visiteObj->getAllVisites() ?? [];
$searchedVisites = [];
if ($query !== '') {
    $found = $visiteObj->rechercherVisite($query);
    $searchedVisites = $found ? [$found] : [];
}
$visites = ($query !== '' && !empty($searchedVisites)) ? $searchedVisites : $allVisites;

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_feedback'])) {
    $visiteId = $_POST['visite_id'];
    $rating = $_POST['rating'];
    $feedbackText = trim($_POST['feedback_text']);

    if ($visiteId > 0 && $rating >= 1 && $rating <= 5 && !empty($feedbackText)) {
        $commentObj = new Commentaire($visiteId, $logged->id_user, $rating, $feedbackText, date('Y-m-d H:i:s'));
        $commentObj->addComment();
    }

    $redirect = './tours.php';
    if ($query !== '') {
        $redirect .= '?q=' . urlencode($query);
    }
    header('Location: ' . $redirect);
    exit();
}

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_visite_id']) && isset($_POST['nbr_personnes'])) {
    $bookVisiteId = $_POST['book_visite_id'];
    $nbrPersonnes = $_POST['nbr_personnes'];

    if ($bookVisiteId > 0 && $nbrPersonnes > 0) {
        $visite = $visiteObj->getVisiteById($bookVisiteId);

        if ($visite && isset($visite->status) && $visite->status === 'ACTIVE') {
            $reservationObj = new Reservation();
            $totalReserved = (int)$reservationObj->getAllReservationByvisite($bookVisiteId);
            $capacity = (int)$visite->capacite_max;
            $remaining = $capacity - $totalReserved;

            if ($remaining >= $nbrPersonnes) {
                $reservation = new Reservation($bookVisiteId, $logged->id_user, $nbrPersonnes, date('Y-m-d H:i:s'));
                $reservation->reserver();
            }
        }
    }

    $redirect = './tours.php';
    if ($query !== '') {
        $redirect .= '?q=' . urlencode($query);
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
    <title>Available Guided Tours - ASSAD Zoo</title>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&amp;display=swap" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script
        id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#22c55e",
                        "background-light": "#f7f7f7",
                        "background-dark": "#191919"
                    },
                    fontFamily: {
                        display: "Lexend"
                    },
                    borderRadius: {
                        DEFAULT: "0.5rem",
                        lg: "1rem",
                        xl: "1.5rem",
                        full: "9999px"
                    }
                }
            }
        };
    </script>
    <style>
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #b3b3b3;
        }

        .material-symbols-outlined {
            font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-[#111813] dark:text-white font-display overflow-x-hidden">
    <div class="relative flex h-auto min-h-screen w-full flex-col group/design-root">
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
                    <a class="text-yellow-500  text-sm font-medium leading-normal hover:text-primary transition-colors"
                        href="#">Tours</a>
                    <a class="text-[#111813] dark:text-white text-sm font-medium leading-normal hover:text-primary transition-colors"
                        href="./animals.php">Animals</a>
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
        <main class="layout-container flex h-full grow flex-col">
            <div class="@container w-full">
                <div class="relative flex min-h-[400px] flex-col gap-6 bg-cover bg-center bg-no-repeat items-center justify-center p-8"
                    data-alt="Close up of a majestic lion roaring with a stadium crowd background blurred"
                    style='background-image: linear-gradient(rgba(0, 0, 0, 0.4) 0%, rgba(16, 34, 22, 0.8) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuCAoh6GCI1itGXH6L-aGVzupvbSvtZB6stcuduaZHux0ti-ZGSwHJJK1C9D5JbDsgPYVDaxTJrZzfTzRs_w5l80fUMVCxxrNhCQR-8olFIL8aSbOdNtE6RTGwELqAk2tzZCDs8MM1cR2Iit7NNrF6W_y2aAqPE8lo9Y0Y0pHp9ADVTUvDMspPpUeF0rAlELSuceUflkk6oFtCeRsAApD7Odu5ezfrj2v9mgvHGxyeHrE06D1kD1h77_8uWcC1i2XgAlHbhseP8YUP4");'>
                    <div class="flex flex-col gap-4 text-center max-w-[800px]">
                        <div
                            class="inline-flex items-center justify-center gap-2 px-3 py-1 bg-primary/20 backdrop-blur-sm border border-primary/40 rounded-full w-fit mx-auto">
                            <span class="material-symbols-outlined text-primary text-sm">live_tv</span>
                            <span class="text-white text-xs font-bold tracking-wide uppercase">Live Virtual
                                Experience</span>
                        </div>
                        <h1
                            class="text-white text-4xl font-black leading-tight tracking-[-0.033em] @[480px]:text-6xl drop-shadow-lg">
                            The Roar of Morocco
                        </h1>
                        <p class="text-white/90 text-lg font-normal leading-relaxed max-w-2xl mx-auto">
                            Join live virtual safaris during CAN 2025. Experience the Atlas Lions up close from your
                            screen. Perfect for football fans and families.
                        </p>
                    </div>
                </div>
            </div>
            <div class="px-4 md:px-10 lg:px-40 -mt-8 relative z-10 mb-8">
                <div
                    class="bg-white dark:bg-[#1a2e22] rounded-2xl shadow-xl p-4 md:p-6 border border-[#f0f4f2] dark:border-[#2a4535]">
                    <form class="flex flex-col md:flex-row gap-4 mb-3" method="GET" action="">
                        <div class="flex-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="material-symbols-outlined text-[#61896f] dark:text-[#9dbfb0]">search</span>
                            </div>
                            <input
                                class="w-full h-12 rounded-xl bg-[#f0f4f2] dark:bg-[#102216] border-none pl-12 pr-4 text-[#111813] dark:text-white placeholder:text-[#61896f] dark:placeholder:text-[#9dbfb0] focus:ring-2 focus:ring-primary focus:outline-none"
                                placeholder="Search tours by title..." type="text" name="q" value="<?= htmlspecialchars($query) ?>" />
                        </div>
                        <div class="flex gap-4">
                            <button
                                type="submit"
                                class="h-12 px-6 rounded-xl bg-primary text-[#111813] font-bold hover:bg-[#0fdc52] transition-colors flex items-center gap-2">
                                <span>Search</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="px-4 md:px-10 lg:px-40 pb-20 flex-1">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-[#111813] dark:text-white text-[28px] font-bold leading-tight">Upcoming Virtual
                        Safaris</h2>

                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                    <?php
                    $reservationObj = new Reservation();
                    ?>

                    <?php foreach ($visites as $visite): ?>
                        <div
                            class="group flex flex-col bg-white dark:bg-[#1a2e22] rounded-2xl overflow-hidden border border-[#f0f4f2] dark:border-[#2a4535] hover:shadow-xl hover:shadow-primary/10 hover:-translate-y-1 transition-all duration-300">


                            <div class="p-6 flex flex-col flex-1 h-full">
                                <div class="flex flex-wrap gap-2 mb-3">
                                    <?php
                                    $statusColor = '';
                                    switch ($visite->status) {
                                        case 'CONFIRMED':
                                        case 'ACTIVE':
                                            $statusColor = 'bg-green-100 text-green-700 border border-green-500/20  dark:bg-green-900/30 dark:text-green-400';
                                            break;
                                        case 'PENDING':
                                            $statusColor = 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400';
                                            break;
                                        case 'CANCELLED':
                                        case 'OFFLINE':
                                            $statusColor = 'bg-red-100 border border-red-500/20 text-red-700 dark:bg-red-900/30 dark:text-red-400';
                                            break;
                                        default:
                                            $statusColor = 'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-400';
                                            break;
                                    } ?>
                                    <span
                                        class="inline-flex items-center gap-1   text-[10px] font-bold px-2 py-1 rounded-md uppercase tracking-wider border <?= $statusColor ?>">
                                        <?= $visite->status ?>

                                    </span>
                                </div>
                                <div class="flex justify-between items-start mb-6">
                                    <h3 class="text-2xl font-bold text-[#111813] dark:text-white leading-tight pr-4"><?= $visite->titre ?></h3>
                                    <span class="text-xl font-bold text-primary whitespace-nowrap">$<?= $visite->prix ?></span>
                                </div>
                                <div
                                    class="grid grid-cols-3 gap-2 mb-6 p-3 bg-[#f6f8f6] dark:bg-[#102216] rounded-xl border border-[#f0f4f2] dark:border-[#2a4535]">
                                    <div class="flex flex-col items-center justify-center text-center">
                                        <span
                                            class="text-[#61896f] dark:text-[#9dbfb0] text-xs font-medium mb-1 flex items-center gap-1"><span
                                                class="material-symbols-outlined text-[14px]">calendar_month</span>
                                            Date</span>
                                        <span class="text-[#111813] dark:text-white font-bold text-sm"><?= date(('M-d'), strtotime($visite->dateheure)) ?></span>
                                    </div>
                                    <div
                                        class="flex flex-col items-center justify-center text-center border-l border-[#dbe5e0] dark:border-[#2a4535]">
                                        <span
                                            class="text-[#61896f] dark:text-[#9dbfb0] text-xs font-medium mb-1 flex items-center gap-1"><span
                                                class="material-symbols-outlined text-[14px]">schedule</span> Time</span>
                                        <span class="text-[#111813] dark:text-white font-bold text-sm"><?= date('h-i A', strtotime($visite->dateheure)) ?></span>
                                    </div>
                                    <div
                                        class="flex flex-col items-center justify-center text-center border-l border-[#dbe5e0] dark:border-[#2a4535]">
                                        <span
                                            class="text-[#61896f] dark:text-[#9dbfb0] text-xs font-medium mb-1 flex items-center gap-1"><span
                                                class="material-symbols-outlined text-[14px]">timer</span> Duration</span>
                                        <span class="text-[#111813] dark:text-white font-bold text-sm"><?= $visite->duree ?>Min</span>
                                    </div>
                                </div>

                                <div class="mt-auto pt-5 border-t border-[#f0f4f2] dark:border-[#2a4535]">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="text-xs font-medium text-[#61896f] dark:text-[#9dbfb0]">Languages:</span>
                                            <div class="flex gap-1">
                                                <span class="text-base" title="English"><?= $visite->langue ?></span>
                                            </div>
                                        </div>
                                        <div
                                            class="flex items-center gap-1 text-xs text-[#61896f] dark:text-[#9dbfb0] font-medium">
                                            <span class="material-symbols-outlined text-[14px]">group</span>

                                            <?php
                                            $total = $reservationObj->getAllReservationByvisite($visite->id_visite);
                                            $capacity = $visite->capacite_max;
                                            $remaining = $capacity - $total;
                                            echo $total . '/' . $capacity;
                                            
                                            $hasBooked = $reservationObj->hasUserBookedVisite($logged->id_user, $visite->id_visite);
                                            $tourDate = strtotime($visite->dateheure);
                                            $isPastTour = $tourDate < time();
                                            ?>
                                        </div>
                                    </div>
                                    <?php if ($hasBooked): ?>
                                        <button
                                            type="button"
                                            disabled
                                            class="w-full h-11 rounded-xl bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 border border-green-500/20 font-bold cursor-default flex items-center justify-center gap-2">
                                            <span class="material-symbols-outlined text-lg">check_circle</span>
                                            <span>Booked</span>
                                        </button>
                                        <?php if ($isPastTour): ?>
                                            <?php 
                                            $commentObj = new Commentaire();
                                            $hasCommented = $commentObj->hasUserCommented($logged->id_user, $visite->id_visite);
                                            ?>
                                            <?php if (!$hasCommented): ?>
                                                <button
                                                    type="button"
                                                    onclick="openFeedbackModal('feedback-<?= $visite->id_visite ?>')"
                                                    class="w-full h-11 mt-2 rounded-xl bg-primary/10 dark:bg-primary/20 text-primary border border-primary/30 font-bold hover:bg-primary hover:text-[#111813] transition-all flex items-center justify-center gap-2">
                                                    <span class="material-symbols-outlined text-lg">rate_review</span>
                                                    <span>Leave Feedback</span>
                                                </button>
                                            <?php else: ?>
                                                <button
                                                    type="button"
                                                    disabled
                                                    class="w-full h-11 mt-2 rounded-xl bg-[#f0f4f2] dark:bg-[#2a4535] text-[#61896f] dark:text-[#9dbfb0] font-bold cursor-default flex items-center justify-center gap-2">
                                                    <span class="material-symbols-outlined text-lg">task_alt</span>
                                                    <span>Feedback Submitted</span>
                                                </button>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <button
                                            type="button"
                                            <?= ($remaining <= 0) ? 'disabled' : '' ?>
                                            onclick="openModal('modal-<?= $visite->id_visite ?>')"
                                            class="w-full h-11 rounded-xl <?= ($remaining <= 0) ? 'bg-[#f0f4f2] dark:bg-[#2a4535] text-[#61896f] dark:text-[#9dbfb0] cursor-not-allowed' : 'bg-[#f0f4f2] dark:bg-[#102216] border border-primary text-primary hover:bg-primary hover:text-[#111813]' ?> font-bold transition-all active:scale-95 flex items-center justify-center gap-2">
                                            <span><?= ($remaining <= 0) ? 'Fully Booked' : 'View Details & Book' ?></span>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Modal for this tour -->
                        <div id="modal-<?= $visite->id_visite ?>" class="modal-overlay hidden fixed inset-0 z-50 overflow-y-auto bg-black/60 backdrop-blur-sm" onclick="if(event.target===this) closeModal('modal-<?= $visite->id_visite ?>')">
                            <div class="flex min-h-screen items-center justify-center p-4">
                                <div class="relative bg-white dark:bg-[#1a2e22] rounded-2xl shadow-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto border border-[#f0f4f2] dark:border-[#2a4535]">
                                    <div class="sticky top-0 bg-white dark:bg-[#1a2e22] border-b border-[#f0f4f2] dark:border-[#2a4535] px-6 py-4 flex items-center justify-between z-10">
                                        <h2 class="text-2xl font-bold text-[#111813] dark:text-white">Tour Details</h2>
                                        <button onclick="closeModal('modal-<?= $visite->id_visite ?>')" class="text-[#61896f] dark:text-[#9dbfb0] hover:text-primary transition-colors">
                                            <span class="material-symbols-outlined text-3xl">close</span>
                                        </button>
                                    </div>

                                    <div class="p-6">
                                        <div class="mb-6">
                                            <div class="flex items-start justify-between mb-4">
                                                <h3 class="text-3xl font-bold text-[#111813] dark:text-white pr-4"><?= htmlspecialchars($visite->titre) ?></h3>
                                                <span class="text-2xl font-bold text-primary whitespace-nowrap">$<?= $visite->prix ?></span>
                                            </div>

                                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                                                <div class="p-4 bg-[#f6f8f6] dark:bg-[#102216] rounded-xl border border-[#f0f4f2] dark:border-[#2a4535]">
                                                    <div class="flex items-center gap-2 text-[#61896f] dark:text-[#9dbfb0] mb-2">
                                                        <span class="material-symbols-outlined text-lg">calendar_month</span>
                                                        <span class="text-xs font-medium">Date</span>
                                                    </div>
                                                    <p class="font-bold text-[#111813] dark:text-white"><?= date('M d, Y', strtotime($visite->dateheure)) ?></p>
                                                </div>

                                                <div class="p-4 bg-[#f6f8f6] dark:bg-[#102216] rounded-xl border border-[#f0f4f2] dark:border-[#2a4535]">
                                                    <div class="flex items-center gap-2 text-[#61896f] dark:text-[#9dbfb0] mb-2">
                                                        <span class="material-symbols-outlined text-lg">schedule</span>
                                                        <span class="text-xs font-medium">Time</span>
                                                    </div>
                                                    <p class="font-bold text-[#111813] dark:text-white"><?= date('h:i A', strtotime($visite->dateheure)) ?></p>
                                                </div>

                                                <div class="p-4 bg-[#f6f8f6] dark:bg-[#102216] rounded-xl border border-[#f0f4f2] dark:border-[#2a4535]">
                                                    <div class="flex items-center gap-2 text-[#61896f] dark:text-[#9dbfb0] mb-2">
                                                        <span class="material-symbols-outlined text-lg">timer</span>
                                                        <span class="text-xs font-medium">Duration</span>
                                                    </div>
                                                    <p class="font-bold text-[#111813] dark:text-white"><?= $visite->duree ?> Min</p>
                                                </div>

                                                <div class="p-4 bg-[#f6f8f6] dark:bg-[#102216] rounded-xl border border-[#f0f4f2] dark:border-[#2a4535]">
                                                    <div class="flex items-center gap-2 text-[#61896f] dark:text-[#9dbfb0] mb-2">
                                                        <span class="material-symbols-outlined text-lg">language</span>
                                                        <span class="text-xs font-medium">Language</span>
                                                    </div>
                                                    <p class="font-bold text-[#111813] dark:text-white"><?= htmlspecialchars($visite->langue) ?></p>
                                                </div>
                                            </div>

                                            <div class="p-4 bg-primary/10 dark:bg-primary/20 rounded-xl border border-primary/30 mb-6">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center gap-2">
                                                        <span class="material-symbols-outlined text-primary">group</span>
                                                        <span class="font-bold text-[#111813] dark:text-white">Capacity</span>
                                                    </div>
                                                    <span class="font-bold text-[#111813] dark:text-white">
                                                        <?= $remaining ?> / <?= $capacity ?> spots remaining
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                        $etapesObj = new EtapesVisites();
                                        $steps = $etapesObj->getEtapesByvisiteId($visite->id_visite);
                                        if ($steps && count($steps) > 0):
                                        ?>
                                            <div class="mb-6">
                                                <h3 class="text-lg font-bold text-[#111813] dark:text-white mb-3 flex items-center gap-2">
                                                    <span class="material-symbols-outlined text-primary">route</span>
                                                    Tour Itinerary
                                                </h3>
                                                <div class="space-y-3">
                                                    <?php foreach ($steps as $step): ?>
                                                        <div class="flex gap-3 p-3 bg-[#f6f8f6] dark:bg-[#102216] rounded-lg border border-[#f0f4f2] dark:border-[#2a4535]">
                                                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-primary/20 text-primary flex items-center justify-center font-bold text-sm">
                                                                <?= $step->ordreetape ?>
                                                            </div>
                                                            <div class="flex-1">
                                                                <h4 class="font-bold text-[#111813] dark:text-white mb-1"><?= htmlspecialchars($step->titreetape) ?></h4>
                                                                <p class="text-sm text-[#61896f] dark:text-[#9dbfb0]"><?= htmlspecialchars($step->descriptionetape) ?></p>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <form method="POST" action="" class="border-t border-[#f0f4f2] dark:border-[#2a4535] pt-6">
                                            <input type="hidden" name="book_visite_id" value="<?= $visite->id_visite ?>">

                                            <div class="mb-6">
                                                <label class="block text-sm font-bold text-[#111813] dark:text-white mb-2">
                                                    Number of Persons
                                                </label>
                                                <input
                                                    type="number"
                                                    name="nbr_personnes"
                                                    min="1"
                                                    max="<?= $remaining ?>"
                                                    value="1"
                                                    required
                                                    class="w-full h-12 rounded-xl bg-[#f0f4f2] dark:bg-[#102216] border border-[#dbe5e0] dark:border-[#2a4535] px-4 text-[#111813] dark:text-white focus:ring-2 focus:ring-primary focus:outline-none" />
                                                <p class="text-xs text-[#61896f] dark:text-[#9dbfb0] mt-2">
                                                    Maximum <?= $remaining ?> person(s) available
                                                </p>
                                            </div>

                                            <div class="flex gap-3">
                                                <button
                                                    type="button"
                                                    onclick="closeModal('modal-<?= $visite->id_visite ?>')"
                                                    class="flex-1 h-12 rounded-xl bg-[#f0f4f2] dark:bg-[#102216] text-[#111813] dark:text-white font-bold hover:bg-[#dbe5e0] dark:hover:bg-[#1f3b2a] transition-colors">
                                                    Cancel
                                                </button>
                                                <button
                                                    type="submit"
                                                    class="flex-1 h-12 rounded-xl bg-primary text-[#111813] font-bold hover:bg-[#0fdc52] transition-colors shadow-lg shadow-primary/20">
                                                    Confirm Booking
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Feedback Modal for this tour -->
                        <div id="feedback-<?= $visite->id_visite ?>" class="modal-overlay hidden fixed inset-0 z-50 overflow-y-auto bg-black/60 backdrop-blur-sm" onclick="if(event.target===this) closeFeedbackModal('feedback-<?= $visite->id_visite ?>')">
                            <div class="flex min-h-screen items-center justify-center p-4">
                                <div class="relative bg-white dark:bg-[#1a2e22] rounded-2xl shadow-2xl max-w-2xl w-full border border-[#f0f4f2] dark:border-[#2a4535]">
                                    <div class="sticky top-0 bg-white dark:bg-[#1a2e22] border-b border-[#f0f4f2] dark:border-[#2a4535] px-6 py-4 flex items-center justify-between">
                                        <h2 class="text-2xl font-bold text-[#111813] dark:text-white flex items-center gap-2">
                                            <span class="material-symbols-outlined text-primary">rate_review</span>
                                            Leave Feedback
                                        </h2>
                                        <button onclick="closeFeedbackModal('feedback-<?= $visite->id_visite ?>')" class="text-[#61896f] dark:text-[#9dbfb0] hover:text-primary transition-colors">
                                            <span class="material-symbols-outlined text-3xl">close</span>
                                        </button>
                                    </div>
                                    
                                    <div class="p-6">
                                        <div class="mb-6">
                                            <h3 class="text-xl font-bold text-[#111813] dark:text-white mb-2"><?= htmlspecialchars($visite->titre) ?></h3>
                                            <p class="text-sm text-[#61896f] dark:text-[#9dbfb0]">
                                                <?= date('M d, Y \a\t h:i A', strtotime($visite->dateheure)) ?>
                                            </p>
                                        </div>

                                        <form method="POST" action="">
                                            <input type="hidden" name="visite_id" value="<?= $visite->id_visite ?>">
                                            <input type="hidden" name="submit_feedback" value="1">
                                            
                                            <div class="mb-6">
                                                <label class="block text-sm font-bold text-[#111813] dark:text-white mb-3">
                                                    Rating
                                                </label>
                                                <div class="flex gap-2">
                                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                                        <label class="cursor-pointer">
                                                            <input type="radio" name="rating" value="<?= $i ?>" required class="hidden peer" />
                                                            <div class="w-12 h-12 rounded-lg border-2 border-[#dbe5e0] dark:border-[#2a4535] flex items-center justify-center peer-checked:border-primary peer-checked:bg-primary/10 hover:border-primary transition-all">
                                                                <span class="text-2xl peer-checked:scale-110 transition-transform">⭐</span>
                                                            </div>
                                                        </label>
                                                    <?php endfor; ?>
                                                </div>
                                            </div>

                                            <div class="mb-6">
                                                <label class="block text-sm font-bold text-[#111813] dark:text-white mb-2">
                                                    Your Feedback
                                                </label>
                                                <textarea 
                                                    name="feedback_text" 
                                                    rows="4"
                                                    required
                                                    placeholder="Share your experience with this tour..."
                                                    class="w-full rounded-xl bg-[#f0f4f2] dark:bg-[#102216] border border-[#dbe5e0] dark:border-[#2a4535] px-4 py-3 text-[#111813] dark:text-white placeholder:text-[#61896f] dark:placeholder:text-[#9dbfb0] focus:ring-2 focus:ring-primary focus:outline-none resize-none"></textarea>
                                            </div>

                                            <div class="flex gap-3">
                                                <button
                                                    type="button"
                                                    onclick="closeFeedbackModal('feedback-<?= $visite->id_visite ?>')"
                                                    class="flex-1 h-12 rounded-xl bg-[#f0f4f2] dark:bg-[#102216] text-[#111813] dark:text-white font-bold hover:bg-[#dbe5e0] dark:hover:bg-[#1f3b2a] transition-colors">
                                                    Cancel
                                                </button>
                                                <button
                                                    type="submit"
                                                    class="flex-1 h-12 rounded-xl bg-primary text-[#111813] font-bold hover:bg-[#0fdc52] transition-colors shadow-lg shadow-primary/20">
                                                    Submit Feedback
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>




                </div>

            </div>
        </main>
        <footer class="bg-white dark:bg-[#0a160e] border-t border-[#f0f4f2] dark:border-[#1f3b2a] py-8">
            <div class="layout-container px-10 lg:px-40 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-4">
                    <div class="size-6 flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined">sports_soccer</span>
                    </div>
                    <span class="text-[#111813] dark:text-white font-bold">ASSAD Zoo</span>
                </div>
                <div class="flex gap-6 text-sm text-[#61896f] dark:text-[#9dbfb0]">
                    <a class="hover:text-primary transition-colors" href="#">Privacy Policy</a>
                    <a class="hover:text-primary transition-colors" href="#">Terms of Service</a>
                    <a class="hover:text-primary transition-colors" href="#">Contact Support</a>
                </div>
                <div class="text-sm text-[#61896f] dark:text-[#9dbfb0]">
                    © 2025 ASSAD Zoo. All rights reserved.
                </div>
            </div>
        </footer>
    </div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function openFeedbackModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeFeedbackModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('.modal-overlay').forEach(modal => {
                    modal.classList.add('hidden');
                });
                document.body.style.overflow = 'auto';
            }
        });
    </script>

</body>

</html>
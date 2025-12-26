<?php
include './../../App/bootstrap.php';
$errors = [];
$old = [];
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

    $old = $_POST;
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $user = new inscription($nom, $email, $role, $password);
    $result = $user->validateForm();
    if (!$result) {
        $user->signUp();
        header('Location: ./login.php');
        exit();
    } else {
        $errors = $result;
    }
}
?>

<!DOCTYPE html>

<html class="dark" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Virtual Zoo ASSAD Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Spline+Sans:wght@300;400;500;600;700&family=Noto+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#38e07b",
                        "background-light": "#f6f8f7",
                        "background-dark": "#122017",
                        "surface-dark": "#29382f",
                        "text-muted": "#9eb7a8"
                    },
                    fontFamily: {
                        "display": ["Spline Sans", "Noto Sans", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "1rem",
                        "lg": "2rem",
                        "xl": "3rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <link rel="stylesheet" href="/ASSAD_V2/assets/css/styles.css">
    <style>
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #122017;
        }

        ::-webkit-scrollbar-thumb {
            background: #29382f;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #38e07b;
        }
    </style>
</head>

<body
    class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-white antialiased overflow-hidden h-screen">
    <div id="loader">
        <div class="spinner" aria-hidden="true"></div>
        <div class="text-sm text-white mt-2">Loading...</div>
    </div>
    <div class="h-screen w-full flex flex-col lg:flex-row">
        <div class="hidden lg:flex lg:w-1/2 relative bg-background-dark flex-col justify-between p-8 overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img alt="Close up of a leopard resting on a tree branch in the savanna"
                    class="w-full h-full object-cover opacity-60 mix-blend-overlay"
                    data-alt="Close up of a leopard resting on a tree branch in the savanna"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCXsLRHTjvR50PUHv-mUYuMJra8Hv0Sewdbg5O4UussUKBBPH4n-fDrsPrjeARDIrlVTn029ctL2b9Yxqy1jqCiFdON9Bj6HDRqr7v3lI4-xyu8IN-jZCbI3XCqEh9YC0lyw7Uu7GbyWw2RTYC3Wx7QBS_2RnPmwgZnMXIvyOMEVArTGGcwPDnYtDR_UtI_ytoVCm4vq9uwXVgWjcLSEiyG6lvpYyNdwq2DE4reqSNoYJOvsYSHurauSn6vVwTqa9woCTx2t37--y7B" />
                <div
                    class="absolute inset-0 bg-gradient-to-t from-background-dark via-background-dark/60 to-transparent">
                </div>
            </div>
            <div class="relative z-10 flex items-center gap-3">
                <div
                    class="size-9 text-primary bg-primary/10 rounded-full flex items-center justify-center backdrop-blur-sm">
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
                <div>
                    <h2 class="text-white text-lg font-bold leading-tight tracking-tight">Virtual Zoo ASSAD.</h2>
                    <p class="text-primary text-xs font-medium tracking-wide">CAN 2025 OFFICIAL APP</p>
                </div>
            </div>
            <div class="relative z-10 max-w-lg">
                <h1 class="text-4xl font-black text-white leading-[1.1] tracking-tight mb-4">
                    Experience the Wild <br />
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-emerald-400">From
                        Home</span>
                </h1>
                <p class="text-text-muted text-base font-normal leading-relaxed mb-6">
                    Join thousands of families exploring African wildlife through our interactive virtual tours.
                </p>
                <div class="flex flex-wrap gap-5 pt-4 border-t border-surface-dark">
                    <div class="flex items-center gap-2">
                        <div class="size-9 rounded-full bg-surface-dark flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-xl">verified_user</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-white text-xs font-bold">Secure</span>
                            <span class="text-text-muted text-xs">Family Safe</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="size-9 rounded-full bg-surface-dark flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-xl">videocam</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-white text-xs font-bold">Live Tours</span>
                            <span class="text-text-muted text-xs">Daily Streams</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="flex-1 flex flex-col justify-center items-center p-6 sm:p-8 lg:p-12 bg-[#111714] relative overflow-y-auto">
            <div class="lg:hidden w-full mt-10 flex justify-center mb-6">
                <div class="flex items-center gap-2 text-white">
                    <div class="size-7 text-primary">
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
                    <h2 class="text-base font-bold">Virtual Zoo ASSAD.</h2>
                </div>
            </div>
            <div class="w-full max-w-md animate-fade-in">
                <div class="mb-6">
                    <h2 class="text-white text-3xl font-black leading-tight tracking-[-0.033em] mb-2">Join the Adventure
                    </h2>
                    <p class="text-text-muted text-sm font-normal">Create your account for CAN 2025 Virtual Zoo</p>
                </div>
                <form class="flex flex-col gap-3.5" action="" method="POST">
                    <label class="flex flex-col gap-1.5 group">
                        <span class="text-white text-sm font-semibold ml-1">Username</span>
                        <div class="relative">
                            <input
                                class="w-full bg-surface-dark text-white placeholder-text-muted/50 h-12 rounded-xl border-none focus:ring-2 focus:ring-primary px-4 pl-11 text-sm font-normal transition-all hover:bg-surface-dark/80" placeholder="SafariExplorer25"
                                value="<?= $old['nom'] ?? '' ?>" type="text" name="nom" required />
                            <div
                                class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none text-text-muted group-focus-within:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[18px]">person</span>
                            </div>
                        </div>
                    </label>
                    <p class="text-red-500 text-xs"><?= $errors['nom'] ?? '' ?></p>

                    <label class="flex flex-col gap-1.5 group">
                        <span class="text-white text-sm font-semibold ml-1">Email Address</span>
                        <div class="relative">
                            <input
                                class="w-full bg-surface-dark text-white placeholder-text-muted/50 h-12 rounded-xl border-none focus:ring-2 focus:ring-primary px-4 pl-11 text-sm font-normal transition-all hover:bg-surface-dark/80" placeholder="you@example.com"
                                value="<?= $old['email'] ?? '' ?>" type="email" name="email" />
                            <div
                                class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none text-text-muted group-focus-within:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[18px]">mail</span>
                            </div>
                        </div>
                    </label>
                    <p class="text-red-500 text-xs"><?= $errors['email'] ?? '' ?></p>

                    <label class="flex flex-col gap-1.5 group">
                        <span class="text-white text-sm font-semibold ml-1">I am a...</span>
                        <div class="relative">
                            <select
                                name="role"
                                class="w-full bg-surface-dark text-white h-12 rounded-xl border-none focus:ring-2 focus:ring-primary px-4 pl-11 pr-10 text-sm font-normal transition-all hover:bg-surface-dark/80 appearance-none cursor-pointer">
                                <option value="visitor" <?= ($old['role'] ?? '') == 'visitor' ? 'selected' : '' ?>>Visitor</option>
                                <option value="guide" <?= ($old['role'] ?? '') == 'guide' ? 'selected' : '' ?>>Guide</option>
                            </select>
                            <div
                                class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none text-text-muted group-focus-within:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[18px]">badge</span>
                            </div>
                            <div
                                class="absolute inset-y-0 right-3.5 flex items-center pointer-events-none text-text-muted">
                                <span class="material-symbols-outlined text-[18px]">expand_more</span>
                            </div>
                        </div>
                    </label>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3.5">
                        <label class="flex flex-col gap-1.5 group">
                            <span class="text-white text-sm font-semibold ml-1">Password</span>
                            <div class="relative">
                                <input
                                    id="password"
                                    class="w-full bg-surface-dark text-white placeholder-text-muted/50 h-12 rounded-xl border-none focus:ring-2 focus:ring-primary px-4 pl-11 text-sm font-normal transition-all hover:bg-surface-dark/80"
                                    placeholder="••••••••" type="password" name="password" />
                                <div
                                    class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none text-text-muted group-focus-within:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">lock</span>
                                </div>
                            </div>
                        </label>
                        <label class="flex flex-col gap-1.5 group">
                            <span class="text-white text-sm font-semibold ml-1">Confirm</span>
                            <div class="relative">
                                <input
                                    id="confirmPassword"
                                    class="w-full bg-surface-dark text-white placeholder-text-muted/50 h-12 rounded-xl border-none focus:ring-2 focus:ring-primary px-4 pl-11 text-sm font-normal transition-all hover:bg-surface-dark/80"
                                    placeholder="••••••••" type="password" />
                                <div
                                    class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none text-text-muted group-focus-within:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">lock_reset</span>
                                </div>
                            </div>
                        </label>
                        <p id="matchingmessage" class="text-red-500 text-xs"></p>
                    </div>
                    <p class="text-red-500 text-xs"><?= $errors['password'] ?? '' ?></p>

                    <label class="flex items-start gap-2.5 px-1 mt-1 cursor-pointer group">
                        <input
                            class="mt-0.5 rounded border-surface-dark bg-surface-dark text-primary focus:ring-primary focus:ring-offset-background-dark"
                            type="checkbox" required />
                        <span class="text-xs text-text-muted leading-snug group-hover:text-white transition-colors">
                            I agree to the <a class="text-primary hover:underline" href="#">Terms of Service</a> and <a
                                class="text-primary hover:underline" href="#">Privacy Policy</a> for CAN 2025 events.
                        </span>
                    </label>
                    <button
                        class="group relative flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-full h-12 bg-primary text-[#111714] text-base font-bold leading-normal tracking-[0.015em] mt-2 hover:shadow-[0_0_20px_rgba(56,224,123,0.3)] transition-all duration-300"
                        type="submit">
                        <span class="truncate z-10">Register Now</span>
                        <div
                            class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                        </div>
                        <span
                            class="material-symbols-outlined ml-2 z-10 group-hover:translate-x-1 transition-transform text-lg">arrow_forward</span>
                    </button>
                </form>
                <div class="mt-5 flex flex-col items-center gap-3">
                    <p class="text-text-muted text-xs">
                        Already have an account?
                        <a class="text-white font-bold hover:text-primary transition-colors ml-1" href="./login.php">Log
                            In</a>
                    </p>
                    <div class=" w-full h-px bg-surface-dark my-1">
                    </div>
                    <div class="flex gap-5 text-text-muted">
                        <a class="text-xs hover:text-white transition-colors" href="#">Help Center</a>
                        <a class="text-xs hover:text-white transition-colors" href="#">Parental Controls</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
unset($errors);
?>

</html>
<script src="/ASSAD_V2/assets/js/script.js"></script>
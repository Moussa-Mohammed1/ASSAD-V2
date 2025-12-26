<?php
include './../../App/bootstrap.php';
session_start();
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $user = new Utilisateur();
        if ($user->signIn($email, $pass)) {
            $res = $user->signIn($email, $pass);
            $_SESSION['loggeduser'] = $res;
            if ($res->role == 'NOTAPPROVED') {
                header('Location: ./../auth/unapproved.php');
                exit();
            }

            if ($res->approved = '0') {
                header('Location: ./../auth/approval.php');
                exit();
            }
            switch ($res->role) {
                case 'admin':
                    header('Location: ./../Admin/dashboard.php');
                    break;
                case 'guide':
                    header('Location: ./../Guide/dashboard.php');
                    break;
                case 'Visitor':
                    header('Location: ./../Visitor/home.php');
                    break;
                default:
                    break;
            }
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Virtual Zoo Login | CAN 2025</title>
    <link href="https://fonts.googleapis.com/css2?family=Spline+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#38e07b",
                        "background-light": "#f8f7f6",
                        "background-dark": "#221910",
                    },
                    fontFamily: {
                        "display": ["Spline Sans", "sans-serif"]
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
    class="font-display bg-background-light dark:bg-background-dark text-slate-900 dark:text-white antialiased h-screen overflow-hidden">
    <div id="loader">
        <div class="spinner" aria-hidden="true"></div>
        <div class="text-sm text-white mt-2">Loading...</div>
    </div>
    <div class="flex h-screen w-full">

        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-background-dark">

            <div class="absolute inset-0 bg-cover bg-center bg-no-repeat transition-transform duration-[20s] hover:scale-110 ease-out"
                data-alt="Close up portrait of a lion face in low light with dramatic shadows"
                style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCcGk4gRBwcyBFYCg9FRxXYFAGHIrQ9tO86tEcgbHJr-xye_YEo6DHSYA6MxQXCzk6xkW6nz7lhiFnlCgiqjWDTlCbjq1SjoLN_TSz-Jh0WjifkBzUwWgC3Gg9_WHlgRbkMi-3Sgq3XrcH3vTZULNoN9jYbLhuLhXKUV2LRFzLjE1WrtrUL4PKOB-Trjn8MVVdZew3HE9ePVxZqghYAApicOp-6AG30FlmPeJTr8HEFpzSE51uyMHbUby97cjqzeH2_EmzDUmCeFXxH');">
            </div>

            <div class="absolute inset-0 bg-gradient-to-t from-background-dark via-background-dark/40 to-transparent">
            </div>
            <div class="absolute inset-0 bg-gradient-to-r from-background-dark/80 to-transparent"></div>

            <div class="absolute bottom-0 left-0 p-12 z-10 w-full max-w-2xl">
                <div class="flex items-center gap-3 mb-4">
                    <div class="h-1 w-12 bg-primary rounded-full"></div>
                    <span class="text-primary font-bold tracking-widest uppercase text-xs">CAN 2025 Official
                        Partner</span>
                </div>
                <h1 class="text-white text-5xl font-black leading-tight tracking-tight mb-4 drop-shadow-lg">
                    Virtual Zoo <br /><span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-orange-400">ASSAD.</span>
                </h1>
                <p class="text-gray-300 text-base font-light leading-relaxed max-w-md drop-shadow-md">
                    Experience the wildlife of Africa from your screen. Exclusive guided tours, live cams, and
                    educational content for the whole family.
                </p>
            </div>
        </div>
        <div
            class="flex w-full lg:w-1/2 flex-col items-center justify-center p-6 sm:p-8 relative bg-background-light dark:bg-background-dark overflow-y-auto">
            <div class="absolute inset-0 lg:hidden opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"
                data-alt="Subtle geometric pattern background"></div>
            <div class="w-full max-w-[440px] z-10">
                <div class="lg:hidden mb-6 flex justify-center">
                    <div class="flex flex-col items-center gap-1">
                        <span class="text-primary font-black text-xl tracking-tight">ASSAD.</span>
                        <span class="text-xs font-medium text-slate-500 dark:text-gray-400 tracking-widest">CAN
                            2025</span>
                    </div>
                </div>
                <div class="mb-6 text-left animate-fade-in-up">
                    <h2
                        class="text-3xl font-black text-slate-900 dark:text-white leading-tight tracking-[-0.033em] mb-2">
                        Enter the Wild
                    </h2>
                    <p class="text-slate-500 dark:text-[#b9ab9d] text-sm font-normal leading-normal">
                        Log in to access your guided tours and exclusive content.
                    </p>
                </div>
                <form class="flex flex-col gap-4" action="" method="POST">
                    <div class="flex flex-col gap-1.5">
                        <label class="text-slate-700 dark:text-white text-sm font-medium leading-normal pl-1">Email </label>
                        <div
                            class="group flex w-full items-stretch rounded-xl h-12 bg-white dark:bg-[#393028] border border-gray-200 dark:border-transparent focus-within:ring-2 focus-within:ring-primary focus-within:border-primary overflow-hidden transition-all shadow-sm">
                            <div
                                class="text-slate-400 dark:text-[#b9ab9d] flex items-center justify-center pl-3 pr-2 group-focus-within:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[20px]">person</span>
                            </div>
                            <input
                                class="form-input flex w-full flex-1 bg-transparent border-none focus:ring-0 text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-[#b9ab9d] h-full px-2 text-sm font-normal"
                                placeholder="safari_Fan@zoo.ma" value="" name="email" />
                        </div>
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <div class="flex justify-between items-end pl-1">
                            <label
                                class="text-slate-700 dark:text-white text-sm font-medium leading-normal">Password</label>
                        </div>
                        <div
                            class="group flex w-full items-stretch rounded-xl h-12 bg-white dark:bg-[#393028] border border-gray-200 dark:border-transparent focus-within:ring-2 focus-within:ring-primary focus-within:border-primary overflow-hidden transition-all shadow-sm">
                            <div
                                class="text-slate-400 dark:text-[#b9ab9d] flex items-center justify-center pl-3 pr-2 group-focus-within:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[20px]">lock</span>
                            </div>
                            <input
                                class="form-input flex w-full flex-1 bg-transparent border-none focus:ring-0 text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-[#b9ab9d] h-full px-2 text-sm font-normal"
                                placeholder="••••••••" type="password" value="" name="password" />
                            <button

                                class="text-slate-400 dark:text-[#b9ab9d] flex items-center justify-center pr-3 hover:text-primary transition-colors cursor-pointer focus:outline-none"
                                type="button">
                                <span class="material-symbols-outlined text-[20px]">visibility</span>
                            </button>
                        </div>
                        <div class="flex justify-end pt-0.5">
                            <a class="text-xs font-medium text-slate-500 dark:text-[#b9ab9d] hover:text-primary dark:hover:text-primary hover:underline transition-colors"
                                href="#">Forgot Password?</a>
                        </div>
                    </div>
                    <button type="submit"
                        class="flex w-full items-center justify-center overflow-hidden rounded-full h-12 px-5 bg-primary hover:bg-green-600 text-[#181411] text-base font-bold leading-normal tracking-[0.015em] transition-all transform hover:scale-[1.02] active:scale-[0.98] shadow-lg shadow-orange-500/20 mt-1">
                        <span class="mr-2">Log In</span>
                        <span class="material-symbols-outlined text-lg">arrow_forward</span>
                    </button>

                    <div class="relative flex py-2 items-center">
                        <div class="flex-grow border-t border-slate-200 dark:border-[#54473b]"></div>
                        <span class="flex-shrink-0 mx-3 text-slate-400 dark:text-[#b9ab9d] text-xs">Or continue
                            with</span>
                        <div class="flex-grow border-t border-slate-200 dark:border-[#54473b]"></div>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <button
                            class="flex h-11 items-center justify-center gap-2 rounded-full border border-slate-200 dark:border-[#54473b] bg-white dark:bg-[#27211c] text-slate-700 dark:text-white hover:bg-slate-50 dark:hover:bg-[#393028] transition-colors">
                            <span class="material-symbols-outlined text-[18px]">language</span>
                            <span class="font-bold text-sm">Google</span>
                        </button>
                        <button
                            class="flex h-11 items-center justify-center gap-2 rounded-full border border-slate-200 dark:border-[#54473b] bg-white dark:bg-[#27211c] text-slate-700 dark:text-white hover:bg-slate-50 dark:hover:bg-[#393028] transition-colors">
                            <span class="material-symbols-outlined text-[18px]">smartphone</span>
                            <span class="font-bold text-sm">Apple</span>
                        </button>
                    </div>
                    <div class="mt-2 text-center">
                        <p class="text-slate-500 dark:text-[#b9ab9d] text-xs font-normal">
                            Don't have an account?
                            <a class="text-primary font-bold hover:text-orange-400 transition-colors ml-1"
                                href="./register.php">Join
                                the Pride</a>
                        </p>
                    </div>
                </form>
                <div class="mt-6 flex justify-center gap-4 text-xs text-slate-400 dark:text-[#54473b]">
                    <a class="hover:text-slate-600 dark:hover:text-[#b9ab9d] transition-colors" href="#">Privacy
                        Policy</a>
                    <span>•</span>
                    <a class="hover:text-slate-600 dark:hover:text-[#b9ab9d] transition-colors" href="#">Terms of
                        Service</a>
                    <span>•</span>
                    <a class="hover:text-slate-600 dark:hover:text-[#b9ab9d] transition-colors" href="#">Support</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
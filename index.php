<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlushyFolio — Craft Your Dream Portfolio</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-rose-50 via-pink-50/40 to-amber-50/20 text-slate-700 font-sans min-h-screen flex flex-col justify-between selection:bg-pink-400 selection:text-white">

    <!-- Header -->
    <header class="bg-white/70 backdrop-blur-md border-b border-rose-100/80 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <a href="index.php" class="font-bold text-xl text-rose-600 flex items-center gap-2.5 group">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-rose-400 to-pink-500 text-white flex items-center justify-center shadow-md shadow-pink-500/20 group-hover:scale-105 transition duration-200">
                    <i class="fa-solid fa-wand-magic-sparkles"></i>
                </div>
                <span class="tracking-wide">BlushyFolio</span>
            </a>
            <nav class="flex items-center gap-8 text-sm font-medium">
                <a href="index.php" class="text-rose-600 font-semibold transition">Home</a>
                <a href="select_template.php" class="text-slate-600 hover:text-rose-600 transition">Create Portfolio</a>
                <a href="manage.php" class="text-slate-600 hover:text-rose-600 transition flex items-center gap-1.5">
                    <i class="fa-solid fa-heart text-xs text-rose-400"></i> My Portfolios
                </a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <main class="flex-grow flex items-center justify-center px-6 py-16">
        <div class="max-w-4xl mx-auto text-center">
            <div class="inline-flex items-center gap-2 bg-rose-100/80 text-rose-700 text-xs font-semibold px-4 py-1.5 rounded-full uppercase tracking-wider mb-6 shadow-sm border border-rose-200/60">
                <i class="fa-solid fa-sparkles text-rose-500"></i> Cute & Professional Creator
            </div>
            <h1 class="text-5xl md:text-7xl font-black tracking-tight text-slate-800 mb-6 leading-tight">
                Design a Gorgeous Portfolio <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-500 via-pink-500 to-purple-500">in Minutes ✨</span>
            </h1>
            <p class="text-lg md:text-xl text-slate-600 mb-10 max-w-2xl mx-auto leading-relaxed">
                Share your sweet story, choose from 3 adorable layouts, and publish your professional portfolio effortlessly.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="select_template.php" class="bg-gradient-to-r from-rose-500 to-pink-500 hover:from-rose-600 hover:to-pink-600 text-white font-semibold px-8 py-4 rounded-2xl shadow-xl shadow-pink-500/25 hover:-translate-y-0.5 transition duration-200 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-heart"></i> Create Portfolio Now
                </a>
                <a href="manage.php" class="bg-white/80 hover:bg-white text-slate-700 border border-rose-200/80 font-semibold px-8 py-4 rounded-2xl shadow-sm hover:shadow transition duration-200 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-folder-open text-rose-400"></i> View Saved Portfolios
                </a>
            </div>

            <!-- Feature Badges -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-20 text-left">
                <div class="bg-white/70 backdrop-blur-sm p-6 rounded-3xl border border-rose-100 shadow-sm">
                    <div class="w-10 h-10 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center mb-4">
                        <i class="fa-solid fa-database"></i>
                    </div>
                    <h3 class="font-bold text-slate-800 mb-1">Secure Storage</h3>
                    <p class="text-sm text-slate-500">All your wonderful details are safely stored and easy to update.</p>
                </div>
                <div class="bg-white/70 backdrop-blur-sm p-6 rounded-3xl border border-rose-100 shadow-sm">
                    <div class="w-10 h-10 rounded-2xl bg-pink-50 text-pink-500 flex items-center justify-center mb-4">
                        <i class="fa-solid fa-palette"></i>
                    </div>
                    <h3 class="font-bold text-slate-800 mb-1">3 Chic Templates</h3>
                    <p class="text-sm text-slate-500">Switch effortlessly between Minimalist, Blush Modern, and Chic Dark styles.</p>
                </div>
                <div class="bg-white/70 backdrop-blur-sm p-6 rounded-3xl border border-rose-100 shadow-sm">
                    <div class="w-10 h-10 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center mb-4">
                        <i class="fa-solid fa-bolt-lightning"></i>
                    </div>
                    <h3 class="font-bold text-slate-800 mb-1">Instant Preview</h3>
                    <p class="text-sm text-slate-500">Watch your portfolio transform instantly as you type.</p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white/50 backdrop-blur-sm border-t border-rose-100/80 py-6 text-center text-xs text-rose-400">
        &copy; 2026 BlushyFolio • Made with love & PHP 💕
    </footer>
</body>
</html>
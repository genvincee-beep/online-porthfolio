<?php
include 'db.php';
$stmt = $pdo->query("SELECT * FROM portfolios ORDER BY id DESC");
$portfolios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saved Portfolios — Portfolify</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-rose-50/40 text-slate-700 font-sans min-h-screen flex flex-col justify-between selection:bg-pink-400 selection:text-white">
    <header class="bg-white/70 backdrop-blur-md border-b border-rose-100/80 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <a href="index.php" class="font-bold text-xl text-rose-600 flex items-center gap-2.5">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-rose-400 to-pink-500 text-white flex items-center justify-center shadow-md">
                    <i class="fa-solid fa-wand-magic-sparkles"></i>
                </div>
                <span>Portfolify</span>
            </a>
            <nav class="flex items-center gap-8 text-sm font-medium">
                <a href="index.php" class="text-slate-600 hover:text-rose-600 transition">Home</a>
                <a href="select_template.php" class="text-slate-600 hover:text-rose-600 transition">Create Portfolio</a>
                <a href="manage.php" class="text-rose-600 font-semibold transition">My Portfolios</a>
            </nav>
        </div>
    </header>

    <main class="flex-grow max-w-6xl mx-auto px-6 py-12 w-full">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10">
            <div>
                <h2 class="text-3xl font-black text-slate-800 tracking-tight">Your Saved Portfolios ✨</h2>
                <p class="text-slate-500 mt-1">Manage, edit, or preview all your lovely creations in one place.</p>
            </div>
            <a href="select_template.php" class="bg-gradient-to-r from-rose-500 to-pink-500 hover:from-rose-600 hover:to-pink-600 text-white font-semibold px-6 py-3 rounded-2xl shadow-lg shadow-pink-500/20 hover:-translate-y-0.5 transition duration-200 flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Add New Portfolio
            </a>
        </div>

        <?php if (empty($portfolios)): ?>
            <div class="bg-white/80 rounded-3xl border border-dashed border-rose-200 p-16 text-center">
                <div class="w-16 h-16 rounded-2xl bg-rose-50 text-rose-400 flex items-center justify-center mx-auto mb-4 text-2xl shadow-sm">
                    <i class="fa-solid fa-heart"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-1">No portfolios created yet</h3>
                <p class="text-sm text-slate-500 mb-6">Start crafting your very first professional portfolio template.</p>
                <a href="select_template.php" class="inline-flex items-center gap-2 bg-gradient-to-r from-rose-500 to-pink-500 text-white font-semibold px-6 py-3 rounded-2xl shadow hover:opacity-90 transition">
                    <i class="fa-solid fa-sparkles"></i> Create Portfolio Now
                </a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($portfolios as $p): ?>
                    <div class="bg-white/90 backdrop-blur-sm rounded-3xl border border-rose-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-200 p-6 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex items-center gap-3">
                                    <img src="<?= htmlspecialchars($p['profile_picture']) ?>" class="w-12 h-12 rounded-2xl object-cover shadow-sm border border-rose-100">
                                    <div>
                                        <h3 class="font-bold text-slate-800 text-lg leading-snug"><?= htmlspecialchars($p['full_name']) ?></h3>
                                        <span class="text-xs text-rose-400"><?= date('M d, Y', strtotime($p['created_at'])) ?></span>
                                    </div>
                                </div>
                                <span class="bg-rose-100 text-rose-700 text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wider"><?= htmlspecialchars($p['template']) ?></span>
                            </div>
                            <div class="space-y-1.5 text-sm text-slate-600 mb-6">
                                <p class="flex items-center gap-2 truncate"><i class="fa-solid fa-envelope text-rose-300 w-4"></i><?= htmlspecialchars($p['email']) ?></p>
                                <p class="flex items-center gap-2"><i class="fa-solid fa-phone text-rose-300 w-4"></i><?= htmlspecialchars($p['contact_number']) ?></p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between pt-4 border-t border-rose-50">
                            <a href="preview.php?id=<?= $p['id'] ?>" class="text-rose-500 font-semibold text-sm hover:text-rose-600 flex items-center gap-1.5"><i class="fa-solid fa-eye"></i> Preview</a>
                            <a href="edit.php?id=<?= $p['id'] ?>" class="text-slate-600 font-semibold text-sm hover:text-slate-800 flex items-center gap-1.5"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                            <a href="delete.php?id=<?= $p['id'] ?>" onclick="return confirm('Are you sure you want to delete this portfolio?');" class="text-rose-400 font-semibold text-sm hover:text-rose-600 flex items-center gap-1"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <footer class="bg-white/50 backdrop-blur-sm border-t border-rose-100/80 py-6 text-center text-xs text-rose-400">
        &copy; 2026 Portfolify
    </footer>
</body>
</html>
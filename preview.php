<?php
include 'db.php';
$id = $_GET['id'] ?? null;
if (!$id) { header("Location: manage.php"); exit; }

$stmt = $pdo->prepare("SELECT * FROM portfolios WHERE id = ?");
$stmt->execute([$id]);
$p = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$p) { die("Portfolio not found."); }

$skills = json_decode($p['skills'] ?? '[]', true);
$template = $p['template'] ?? 'simple';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><= htmlspecialchars($p['full_name']) ?> — Portfolio Preview</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="<?= $template === 'creative' ? 'bg-slate-950 text-white' : 'bg-rose-50/30 text-slate-700' ?> font-sans min-h-screen flex flex-col justify-between selection:bg-pink-400 selection:text-white">

    <!-- Floating Top Toolbar -->
    <header class="bg-slate-900/90 backdrop-blur-md text-white py-3.5 px-6 flex justify-between items-center sticky top-0 z-50 border-b border-slate-800">
        <div class="flex items-center gap-3">
            <span class="w-3 h-3 rounded-full bg-pink-400 animate-pulse"></span>
            <span class="text-sm">Template Style: <strong class="uppercase text-pink-300 font-bold"><?= htmlspecialchars($template) ?></strong></span>
        </div>
        <div class="space-x-3">
            <a href="edit.php?id=<?= $p['id'] ?>" class="bg-slate-800 hover:bg-slate-700 text-slate-200 px-4 py-2 rounded-xl text-xs font-semibold transition border border-slate-700"><i class="fa-solid fa-pen-to-square mr-1.5"></i> Edit Portfolio</a>
            <a href="manage.php" class="bg-gradient-to-r from-rose-500 to-pink-500 hover:opacity-90 text-white px-4 py-2 rounded-xl text-xs font-semibold shadow transition"><i class="fa-solid fa-arrow-left mr-1.5"></i> Dashboard</a>
        </div>
    </header>

    <main class="flex-grow">
        <?php if ($template === 'simple'): ?>
            <!-- TEMPLATE 1: SIMPLE -->
            <div class="max-w-3xl mx-auto px-8 py-16 bg-white my-12 shadow-xl shadow-pink-500/5 rounded-3xl border border-rose-100">
                <div class="flex flex-col sm:flex-row items-center gap-8 border-b border-rose-50 pb-10 text-center sm:text-left">
                    <img src="<?= htmlspecialchars($p['profile_picture']) ?>" class="w-32 h-32 rounded-3xl object-cover shadow-lg border-4 border-rose-50">
                    <div>
                        <h1 class="text-4xl font-black text-slate-800"><?= htmlspecialchars($p['full_name']) ?></h1>
                        <p class="text-rose-500 font-medium mt-1"><?= htmlspecialchars($p['email']) ?> • <?= htmlspecialchars($p['contact_number']) ?></p>
                        <p class="text-sm text-slate-400 mt-1 flex items-center justify-center sm:justify-start gap-1.5"><i class="fa-solid fa-location-dot"></i><?= htmlspecialchars($p['address']) ?></p>
                    </div>
                </div>
                <div class="py-8 border-b border-rose-50">
                    <h2 class="text-xl font-bold text-slate-800 mb-3">About Me</h2>
                    <p class="text-slate-600 leading-relaxed text-lg"><?= nl2br(htmlspecialchars($p['about_me'])) ?></p>
                </div>
                <?php if (!empty($skills)): ?>
                    <div class="pt-8">
                        <h2 class="text-xl font-bold text-slate-800 mb-4">Skills & Expertise</h2>
                        <div class="flex flex-wrap gap-2.5">
                            <?php foreach ($skills as $s): ?>
                                <span class="bg-rose-50 text-rose-600 font-medium px-4 py-2 rounded-2xl text-sm border border-rose-100"><?= htmlspecialchars($s) ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

        <?php elseif ($template === 'modern'): ?>
            <!-- TEMPLATE 2: MODERN -->
            <div class="max-w-4xl mx-auto px-6 py-12">
                <div class="bg-gradient-to-r from-rose-400 via-pink-500 to-purple-500 text-white rounded-3xl p-10 shadow-2xl flex flex-col md:flex-row items-center gap-8 mb-8">
                    <img src="<?= htmlspecialchars($p['profile_picture']) ?>" class="w-36 h-36 rounded-3xl object-cover border-4 border-white/30 shadow-xl">
                    <div class="text-center md:text-left">
                        <h1 class="text-4xl md:text-5xl font-black"><?= htmlspecialchars($p['full_name']) ?></h1>
                        <p class="text-pink-100 mt-2 font-medium"><?= htmlspecialchars($p['email']) ?> | <?= htmlspecialchars($p['contact_number']) ?></p>
                        <p class="text-pink-200 text-sm mt-1 opacity-90"><i class="fa-solid fa-location-dot mr-1"></i><?= htmlspecialchars($p['address']) ?></p>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-2 bg-white/90 backdrop-blur-sm p-8 rounded-3xl shadow-sm border border-rose-100 text-slate-700">
                        <h2 class="font-bold text-xl mb-4 text-rose-500 flex items-center gap-2"><i class="fa-solid fa-heart"></i> About Me</h2>
                        <p class="text-slate-600 leading-relaxed text-lg"><?= nl2br(htmlspecialchars($p['about_me'])) ?></p>
                    </div>
                    <div class="bg-white/90 backdrop-blur-sm p-8 rounded-3xl shadow-sm border border-rose-100 text-slate-700">
                        <h2 class="font-bold text-xl mb-4 text-rose-500 flex items-center gap-2"><i class="fa-solid fa-sparkles"></i> Skills</h2>
                        <div class="flex flex-wrap gap-2.5">
                            <?php foreach ($skills as $s): ?>
                                <span class="bg-rose-50 text-rose-600 px-4 py-2 rounded-2xl text-sm font-semibold border border-rose-100"><?= htmlspecialchars($s) ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

        <?php elseif ($template === 'creative'): ?>
            <!-- TEMPLATE 3: CREATIVE -->
            <div class="max-w-4xl mx-auto py-20 px-6">
                <div class="flex flex-col md:flex-row items-center gap-8 mb-16 text-center md:text-left">
                    <img src="<?= htmlspecialchars($p['profile_picture']) ?>" class="w-36 h-36 rounded-3xl object-cover ring-4 ring-pink-500 shadow-2xl shadow-pink-500/20">
                    <div>
                        <span class="text-pink-400 font-mono text-sm uppercase tracking-widest bg-pink-500/10 px-3 py-1 rounded-full border border-pink-500/20">Chic Portfolio</span>
                        <h1 class="text-5xl md:text-6xl font-black mt-3"><?= htmlspecialchars($p['full_name']) ?></h1>
                        <p class="text-slate-400 mt-2 font-mono"><?= htmlspecialchars($p['email']) ?> // <?= htmlspecialchars($p['address']) ?></p>
                    </div>
                </div>
                <div class="bg-slate-900 border border-slate-800 p-10 rounded-3xl mb-8 shadow-2xl">
                    <h2 class="text-pink-400 font-mono text-sm mb-3">// ABOUT_ME</h2>
                    <p class="text-slate-300 text-xl leading-relaxed"><?= nl2br(htmlspecialchars($p['about_me'])) ?></p>
                </div>
                <?php if (!empty($skills)): ?>
                    <div class="bg-slate-900 border border-slate-800 p-10 rounded-3xl shadow-2xl">
                        <h2 class="text-pink-400 font-mono text-sm mb-6">// EXPERTISE_&_SKILLS</h2>
                        <div class="flex flex-wrap gap-3">
                            <?php foreach ($skills as $s): ?>
                                <span class="bg-slate-950 text-pink-300 border border-pink-500/30 px-5 py-2.5 rounded-2xl text-sm font-mono"><?= htmlspecialchars($s) ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </main>

    <footer class="<?= $template === 'creative' ? 'bg-slate-950 border-slate-800 text-slate-500' : 'bg-white border-rose-100 text-rose-400' ?> border-t py-6 text-center text-xs">
        &copy; 2026 Portfolify
    </footer>
</body>
</html>
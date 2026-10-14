<?php
include 'db.php';
$id = $_GET['id'] ?? null;
if (!$id) { header("Location: manage.php"); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $contact = $_POST['contact_number'] ?? '';
    $address = $_POST['address'] ?? '';
    $about = $_POST['about_me'] ?? '';
    $template = $_POST['template'] ?? 'simple';
    $profilePic = $_POST['profile_picture'] ?? '';
    $skills = json_encode(array_filter(array_map('trim', explode(',', $_POST['skills_string'] ?? ''))));

    $stmt = $pdo->prepare("UPDATE portfolios SET full_name=?, email=?, contact_number=?, address=?, about_me=?, profile_picture=?, template=?, skills=? WHERE id=?");
    $stmt->execute([$fullName, $email, $contact, $address, $about, $profilePic, $template, $skills, $id]);

    header("Location: preview.php?id=$id");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM portfolios WHERE id = ?");
$stmt->execute([$id]);
$p = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$p) { die("Portfolio not found."); }

$skillsArr = json_decode($p['skills'] ?? '[]', true);
$skillsString = implode(', ', $skillsArr);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Portfolio — BlushyFolio</title>
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
                <a href="manage.php" class="text-slate-600 hover:text-rose-600 transition">My Portfolios</a>
            </nav>
        </div>
    </header>

    <main class="flex-grow max-w-3xl mx-auto px-6 py-12 w-full">
        <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl shadow-pink-500/5 border border-rose-100 p-8 md:p-12">
            <div class="mb-8">
                <h2 class="text-3xl font-black text-slate-800 tracking-tight">Edit Portfolio ✨</h2>
                <p class="text-slate-500 mt-1">Update your professional details or choose a new template.</p>
            </div>
            
            <form method="POST" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Full Name</label>
                        <input type="text" name="full_name" required value="<?= htmlspecialchars($p['full_name']) ?>" class="w-full px-4 py-3 bg-rose-50/30 border border-rose-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-pink-400 focus:outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email Address</label>
                        <input type="email" name="email" required value="<?= htmlspecialchars($p['email']) ?>" class="w-full px-4 py-3 bg-rose-50/30 border border-rose-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-pink-400 focus:outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Contact Number</label>
                        <input type="text" name="contact_number" required value="<?= htmlspecialchars($p['contact_number']) ?>" class="w-full px-4 py-3 bg-rose-50/30 border border-rose-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-pink-400 focus:outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Profile Picture URL</label>
                        <input type="url" name="profile_picture" value="<?= htmlspecialchars($p['profile_picture']) ?>" class="w-full px-4 py-3 bg-rose-50/30 border border-rose-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-pink-400 focus:outline-none transition">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Address / Location</label>
                    <input type="text" name="address" required value="<?= htmlspecialchars($p['address']) ?>" class="w-full px-4 py-3 bg-rose-50/30 border border-rose-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-pink-400 focus:outline-none transition">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">About Me / Bio</label>
                    <textarea name="about_me" rows="4" required class="w-full p-4 bg-rose-50/30 border border-rose-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-pink-400 focus:outline-none transition"><?= htmlspecialchars($p['about_me']) ?></textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Skills <span class="text-xs font-normal text-rose-400">(comma separated)</span></label>
                    <input type="text" name="skills_string" value="<?= htmlspecialchars($skillsString) ?>" class="w-full px-4 py-3 bg-rose-50/30 border border-rose-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-pink-400 focus:outline-none transition">
                </div>

                <div class="border-t border-rose-100 pt-8 mt-8">
                    <label class="block text-lg font-bold text-slate-800 mb-4">Choose Template Style</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <label class="relative border-2 border-rose-100 rounded-2xl p-5 flex flex-col items-center cursor-pointer hover:border-pink-500 hover:bg-rose-50/40 transition group">
                            <input type="radio" name="template" value="simple" <?= $p['template'] === 'simple' ? 'checked' : '' ?> class="mb-3 accent-pink-500">
                            <span class="font-bold text-slate-800 group-hover:text-pink-600">Template 1</span>
                            <span class="text-xs text-slate-400 text-center mt-1">Simple & Minimal</span>
                        </label>
                        <label class="relative border-2 border-rose-100 rounded-2xl p-5 flex flex-col items-center cursor-pointer hover:border-pink-500 hover:bg-rose-50/40 transition group">
                            <input type="radio" name="template" value="modern" <?= $p['template'] === 'modern' ? 'checked' : '' ?> class="mb-3 accent-pink-500">
                            <span class="font-bold text-slate-800 group-hover:text-pink-600">Template 2</span>
                            <span class="text-xs text-slate-400 text-center mt-1">Blush Gradient</span>
                        </label>
                        <label class="relative border-2 border-rose-100 rounded-2xl p-5 flex flex-col items-center cursor-pointer hover:border-pink-500 hover:bg-rose-50/40 transition group">
                            <input type="radio" name="template" value="creative" <?= $p['template'] === 'creative' ? 'checked' : '' ?> class="mb-3 accent-pink-500">
                            <span class="font-bold text-slate-800 group-hover:text-pink-600">Template 3</span>
                            <span class="text-xs text-slate-400 text-center mt-1">Chic Dark Vibe</span>
                        </label>
                    </div>
                </div>

                <div class="pt-6 flex flex-col-reverse sm:flex-row justify-end gap-4">
                    <a href="manage.php" class="px-6 py-3.5 rounded-2xl border border-rose-200 text-slate-600 hover:bg-rose-50/50 font-semibold text-center transition">Cancel</a>
                    <button type="submit" class="px-8 py-3.5 rounded-2xl bg-gradient-to-r from-rose-500 to-pink-500 hover:from-rose-600 hover:to-pink-600 text-white font-semibold shadow-lg shadow-pink-500/20 hover:-translate-y-0.5 transition duration-200">Update Portfolio</button>
                </div>
            </form>
        </div>
    </main>

    <footer class="bg-white/50 backdrop-blur-sm border-t border-rose-100/80 py-6 text-center text-xs text-rose-400">
        &copy; 2026 BlushyFolio
    </footer>
</body>
</html>
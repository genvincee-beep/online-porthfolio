<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $contact = $_POST['contact_number'] ?? '';
    $address = $_POST['address'] ?? '';
    $about = $_POST['about_me'] ?? '';
    $template = $_POST['template'] ?? 'simple';
    $profilePic = $_POST['profile_picture'] ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=400';
    
    $skills = json_encode(array_filter(array_map('trim', explode(',', $_POST['skills_string'] ?? ''))));

    $stmt = $pdo->prepare("INSERT INTO portfolios (full_name, email, contact_number, address, about_me, profile_picture, template, skills) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$fullName, $email, $contact, $address, $about, $profilePic, $template, $skills]);
    
    $newId = $pdo->lastInsertId();
    header("Location: preview.php?id=$newId");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Portfolio — Portfolify</title>
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
                <a href="select_template.php" class="text-rose-600 font-semibold transition">Create Portfolio</a>
                <a href="manage.php" class="text-slate-600 hover:text-rose-600 transition">My Portfolios</a>
            </nav>
        </div>
    </header>

    <main class="flex-grow max-w-3xl mx-auto px-6 py-12 w-full">
        <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl shadow-pink-500/5 border border-rose-100 p-8 md:p-12">
            <div class="mb-8">
                <h2 class="text-3xl font-black text-slate-800 tracking-tight">Create Your Portfolio ✨</h2>
                <p class="text-slate-500 mt-1">Fill in your professional details and pick a gorgeous style template.</p>
            </div>
            
            <form method="POST" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Full Name</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-rose-300"><i class="fa-solid fa-user"></i></span>
                            <input type="text" name="full_name" required placeholder="Sophia Taylor" class="w-full pl-10 pr-4 py-3 bg-rose-50/30 border border-rose-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-pink-400 focus:outline-none transition">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email Address</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-rose-300"><i class="fa-solid fa-envelope"></i></span>
                            <input type="email" name="email" required placeholder="sophia@example.com" class="w-full pl-10 pr-4 py-3 bg-rose-50/30 border border-rose-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-pink-400 focus:outline-none transition">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Contact Number</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-rose-300"><i class="fa-solid fa-phone"></i></span>
                            <input type="text" name="contact_number" required placeholder="+1 (555) 000-0000" class="w-full pl-10 pr-4 py-3 bg-rose-50/30 border border-rose-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-pink-400 focus:outline-none transition">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Profile Picture URL</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-rose-300"><i class="fa-solid fa-image"></i></span>
                            <input type="url" name="profile_picture" placeholder="https://images.unsplash.com/..." class="w-full pl-10 pr-4 py-3 bg-rose-50/30 border border-rose-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-pink-400 focus:outline-none transition">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Address / Location</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-rose-300"><i class="fa-solid fa-location-dot"></i></span>
                        <input type="text" name="address" required placeholder="Paris, France" class="w-full pl-10 pr-4 py-3 bg-rose-50/30 border border-rose-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-pink-400 focus:outline-none transition">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">About Me / Bio</label>
                    <textarea name="about_me" rows="4" required placeholder="Tell the world a little bit about yourself..." class="w-full p-4 bg-rose-50/30 border border-rose-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-pink-400 focus:outline-none transition"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Skills <span class="text-xs font-normal text-rose-400">(comma separated)</span></label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-rose-300"><i class="fa-solid fa-code"></i></span>
                        <input type="text" name="skills_string" placeholder="Design, PHP, Tailwind, Branding, UI/UX" class="w-full pl-10 pr-4 py-3 bg-rose-50/30 border border-rose-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-pink-400 focus:outline-none transition">
                    </div>
                </div>

                <!-- Template Selection Grid -->
                <div class="border-t border-rose-100 pt-8 mt-8">
                    <label class="block text-lg font-bold text-slate-800 mb-4">Choose Your Template Style</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <label class="relative border-2 border-rose-100 rounded-2xl p-5 flex flex-col items-center cursor-pointer hover:border-pink-500 hover:bg-rose-50/40 transition group">
                            <input type="radio" name="template" value="simple" checked class="mb-3 accent-pink-500">
                            <span class="font-bold text-slate-800 group-hover:text-pink-600">Template 1</span>
                            <span class="text-xs text-slate-400 text-center mt-1">Simple & Minimal</span>
                        </label>
                        <label class="relative border-2 border-rose-100 rounded-2xl p-5 flex flex-col items-center cursor-pointer hover:border-pink-500 hover:bg-rose-50/40 transition group">
                            <input type="radio" name="template" value="modern" class="mb-3 accent-pink-500">
                            <span class="font-bold text-slate-800 group-hover:text-pink-600">Template 2</span>
                            <span class="text-xs text-slate-400 text-center mt-1">Blush Gradient</span>
                        </label>
                        <label class="relative border-2 border-rose-100 rounded-2xl p-5 flex flex-col items-center cursor-pointer hover:border-pink-500 hover:bg-rose-50/40 transition group">
                            <input type="radio" name="template" value="creative" class="mb-3 accent-pink-500">
                            <span class="font-bold text-slate-800 group-hover:text-pink-600">Template 3</span>
                            <span class="text-xs text-slate-400 text-center mt-1">Chic Dark Vibe</span>
                        </label>
                    </div>
                </div>

                <div class="pt-6 flex justify-end">
                    <button type="submit" class="w-full md:w-auto px-8 py-4 rounded-2xl bg-gradient-to-r from-rose-500 to-pink-500 hover:from-rose-600 hover:to-pink-600 text-white font-semibold shadow-xl shadow-pink-500/20 hover:-translate-y-0.5 transition duration-200 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-sparkles"></i> Save & Generate Portfolio
                    </button>
                </div>
            </form>
        </div>
    </main>

    <footer class="bg-white/50 backdrop-blur-sm border-t border-rose-100/80 py-6 text-center text-xs text-rose-400">
        &copy; 2026 Portfolify
    </footer>
</body>
</html>
<?php
/**
 * Apply Lavender Theme
 * Mengganti warna biru gelap dengan warna lavender yang lebih terang
 */

$files = [
    'resources/views/layouts/app.blade.php',
    'resources/views/auth/login.blade.php',
    'resources/views/auth/register.blade.php',
    'resources/views/mahasiswa/dashboard.blade.php',
    'resources/views/mahasiswa/create.blade.php',
    'resources/views/teknisi/dashboard.blade.php',
    'resources/views/admin/dashboard.blade.php',
    'resources/views/admin/reports/index.blade.php',
    'resources/views/admin/users/index.blade.php',
    'resources/views/admin/users/create.blade.php',
    'resources/views/admin/users/edit.blade.php',
    'resources/views/admin/users/show.blade.php',
    'resources/views/welcome.blade.php',
];

// Mapping warna dari dark blue ke lavender
$colorMap = [
    // Gradient classes - 3 colors
    'from-[#6567dd] via-[#5658cc] to-[#4a4bcc]' => 'from-[#B1B2FF] via-[#A0A1F5] to-[#9091EB]',
    
    // Gradient classes - 2 colors
    'from-[#6567dd] to-[#4a4bcc]' => 'from-[#B1B2FF] to-[#9091EB]',
    
    // Background colors
    'bg-[#6567dd]' => 'bg-[#B1B2FF]',
    'bg-[#4a4bcc]' => 'bg-[#9091EB]',
    
    // Hover states
    'hover:from-[#4a4bcc]' => 'hover:from-[#9091EB]',
    'hover:to-[#3a3bbb]' => 'hover:to-[#8081D9]',
    
    // Shadow colors
    'shadow-[#4a4bcc]/30' => 'shadow-[#B1B2FF]/30',
    'shadow-[#4a4bcc]/50' => 'shadow-[#B1B2FF]/50',
];

$totalReplacements = 0;

foreach ($files as $file) {
    if (!file_exists($file)) {
        echo "⚠️  File tidak ditemukan: $file\n";
        continue;
    }
    
    $content = file_get_contents($file);
    $originalContent = $content;
    
    foreach ($colorMap as $old => $new) {
        $count = 0;
        $content = str_replace($old, $new, $content, $count);
        $totalReplacements += $count;
    }
    
    if ($content !== $originalContent) {
        file_put_contents($file, $content);
        echo "✅ Updated: $file\n";
    }
}

echo "\n🎯 Total penggantian: $totalReplacements\n";
echo "✨ Warna lavender diterapkan!\n";
echo "💡 Catatan: Avatar, tombol, dan badge sekarang menggunakan warna lavender yang lebih terang (#B1B2FF → #9091EB)\n";

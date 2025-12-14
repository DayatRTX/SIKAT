<?php
/**
 * Apply Solid Lavender to Card Boxes
 * Mengganti warna lavender muda dengan warna solid lavender seperti tombol "Tambah User"
 */

$files = [
    'resources/views/dashboard.blade.php',
    'resources/views/mahasiswa/reports/index.blade.php',
    'resources/views/mahasiswa/reports/show.blade.php',
    'resources/views/admin/reports/show.blade.php',
    'resources/views/admin/users/index.blade.php',
    'resources/views/admin/users/show.blade.php',
    'resources/views/teknisi/tasks/index.blade.php',
    'resources/views/teknisi/tasks/show.blade.php',
];

// Mapping warna dari lavender muda ke solid lavender
$colorMap = [
    // Gradient classes - 2 colors (light lavender to solid)
    "from-[#f5f5ff]0 to-[#93b5ff]" => "from-[#B1B2FF] via-[#A0A1F5] to-[#9091EB]",
    "from-[#f5f5ff]0 to-[#bbc5ff]" => "from-[#B1B2FF] via-[#A0A1F5] to-[#9091EB]",
    "from-[#f5f5ff]0 to-[#9a9bff]" => "from-[#B1B2FF] via-[#A0A1F5] to-[#9091EB]",
    
    // Border colors
    "border-[#f5f5ff]0" => "border-[#B1B2FF]",
    
    // Shadow colors
    "shadow-[#f0f4ff]0/30" => "shadow-[#B1B2FF]/30",
    "shadow-[#f0f4ff]0/40" => "shadow-[#B1B2FF]/40",
    
    // Background colors in arrays (for card colors)
    "'from-[#f5f5ff]0'" => "'from-[#B1B2FF]'",
    "'to-[#93b5ff]'" => "'to-[#9091EB]'",
    "'bg-[#ebebff]'" => "'bg-[#B1B2FF]'",
    "'border-[#f5f5ff]0'" => "'border-[#B1B2FF]'",
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
echo "✨ Card box sekarang menggunakan warna solid lavender!\n";
echo "💡 Catatan: Semua card dengan warna lavender muda (#f5f5ff → #93b5ff) diubah menjadi solid lavender (#B1B2FF → #9091EB)\n";

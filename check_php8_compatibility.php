<?php
/**
 * Script de vérification de compatibilité PHP 8.3
 * 
 * Usage: php check_php8_compatibility.php
 */

echo "=== Vérification de compatibilité PHP 8.3 ===\n\n";

$baseDir = __DIR__;
$issues = [];

// Fonctions et patterns à vérifier
$checks = [
    '__autoload' => 'Fonction dépréciée, utiliser spl_autoload_register()',
    'each(' => 'Fonction supprimée en PHP 8.0, utiliser foreach()',
    'create_function' => 'Fonction supprimée en PHP 8.0',
    'mysql_' => 'Extension mysql supprimée, utiliser mysqli',
    'get_magic_quotes' => 'Fonction supprimée en PHP 8.0',
    'ereg(' => 'Fonction supprimée, utiliser preg_match()',
    'split(' => 'Fonction supprimée, utiliser explode() ou preg_split()',
    'count(' => 'Vérifier usage sur non-countable (warning PHP 8.0+)',
];

// Dossiers à scanner
$directories = [
    $baseDir . '/dev/rezo_flash_code',
    $baseDir . '/dev/rezo_code',
    $baseDir . '/application',
];

foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        continue;
    }
    
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir)
    );
    
    foreach ($iterator as $file) {
        if ($file->isFile() && $file->getExtension() === 'php') {
            $filePath = $file->getPathname();
            $content = file_get_contents($filePath);
            $lines = explode("\n", $content);
            
            foreach ($checks as $pattern => $description) {
                $lineNumber = 1;
                foreach ($lines as $line) {
                    // Vérifier si le pattern est présent (mais pas dans un commentaire)
                    if (stripos($line, $pattern) !== false && 
                        !preg_match('/^\s*\/\//', $line) && 
                        !preg_match('/^\s*\*/', $line)) {
                        
                        // Pour count(), vérifier si c'est sur une variable (potentiellement non-countable)
                        if ($pattern === 'count(') {
                            // Vérifier si count() est utilisé sur une variable simple
                            if (preg_match('/count\s*\(\s*\$[a-zA-Z_][a-zA-Z0-9_]*\s*\)/', $line)) {
                                $issues[] = [
                                    'file' => str_replace($baseDir . '/', '', $filePath),
                                    'line' => $lineNumber,
                                    'pattern' => $pattern,
                                    'description' => $description,
                                    'code' => trim($line)
                                ];
                            }
                        } else {
                            $issues[] = [
                                'file' => str_replace($baseDir . '/', '', $filePath),
                                'line' => $lineNumber,
                                'pattern' => $pattern,
                                'description' => $description,
                                'code' => trim($line)
                            ];
                        }
                    }
                    $lineNumber++;
                }
            }
        }
    }
}

// Afficher les résultats
if (empty($issues)) {
    echo "✅ Aucun problème de compatibilité détecté !\n";
} else {
    echo "⚠️  " . count($issues) . " problème(s) de compatibilité détecté(s) :\n\n";
    
    // Grouper par type de problème
    $grouped = [];
    foreach ($issues as $issue) {
        $key = $issue['pattern'];
        if (!isset($grouped[$key])) {
            $grouped[$key] = [];
        }
        $grouped[$key][] = $issue;
    }
    
    foreach ($grouped as $pattern => $groupIssues) {
        echo "\n" . str_repeat("=", 70) . "\n";
        echo "🔍 " . $pattern . " - " . $checks[$pattern] . "\n";
        echo str_repeat("=", 70) . "\n";
        echo "Nombre d'occurrences : " . count($groupIssues) . "\n\n";
        
        // Afficher les 10 premiers
        $displayCount = min(10, count($groupIssues));
        for ($i = 0; $i < $displayCount; $i++) {
            $issue = $groupIssues[$i];
            echo sprintf(
                "  📄 %s:%d\n     %s\n",
                $issue['file'],
                $issue['line'],
                $issue['code']
            );
        }
        
        if (count($groupIssues) > 10) {
            echo "  ... et " . (count($groupIssues) - 10) . " autres occurrences\n";
        }
    }
    
    echo "\n" . str_repeat("=", 70) . "\n";
    echo "📊 Résumé :\n";
    foreach ($grouped as $pattern => $groupIssues) {
        echo "  - $pattern : " . count($groupIssues) . " occurrence(s)\n";
    }
}

echo "\n=== Fin de la vérification ===\n";


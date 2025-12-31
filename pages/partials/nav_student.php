<?php
/**
 * PARTIAL: Navigation Étudiant
 * Barre de navigation pour les étudiants
 */

// Calculer les initiales
$userName = $userName ?? $_SESSION['user_nom'] ?? 'User';
$initials = strtoupper(substr($userName, 0, 1) . substr(explode(' ', $userName)[1] ?? '', 0, 1));

// Déterminer le chemin de base selon l'emplacement du fichier
$basePath = '';
if (strpos($_SERVER['PHP_SELF'], '/student/') !== false) {
    $basePath = '../';
}
?>

<style>
    .nav-gradient {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
    }
    
    .nav-link {
        position: relative;
        transition: all 0.3s ease;
    }
    
    .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, #4CAF50, #45a049);
        transition: width 0.3s ease;
    }
    
    .nav-link:hover::after,
    .nav-link.active::after {
        width: 100%;
    }
    
    .nav-link:hover {
        color: #4CAF50 !important;
    }
    
    .avatar-gradient {
        background: linear-gradient(135deg, #4CAF50, #45a049);
    }
    
    .badge-gradient {
        background: linear-gradient(135deg, rgba(76, 175, 80, 0.2), rgba(69, 160, 73, 0.2));
        border: 1px solid rgba(76, 175, 80, 0.3);
    }
    
    .logout-btn {
        transition: all 0.3s ease;
    }
    
    .logout-btn:hover {
        transform: scale(1.1);
        color: #ef4444 !important;
    }
</style>

<!-- Navigation Étudiant -->
<nav class="nav-gradient fixed w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <i class="fas fa-graduation-cap text-3xl text-green-500"></i>
                    <span class="ml-2 text-2xl font-bold text-white">QuizMaster</span>
                    <span class="ml-3 px-3 py-1 badge-gradient text-green-400 text-xs font-semibold rounded-full">
                        Étudiant
                    </span>
                </div>
                
                <!-- Menu Principal -->
                <div class="hidden md:ml-10 md:flex md:space-x-8">
                    <!-- Dashboard -->
                    <a href="<?= $basePath ?>student/dashboard.php" 
                       class="nav-link <?= ($currentPage ?? '') === 'dashboard' ? 'active text-green-400' : 'text-gray-300' ?> inline-flex items-center px-1 pt-1 text-sm font-medium">
                        <i class="fas fa-home mr-2"></i>Tableau de bord
                    </a>
                    
                    <!-- Catégories -->
                    <a href="<?= $basePath ?>student/categories.php" 
                       class="nav-link <?= ($currentPage ?? '') === 'categories' ? 'active text-green-400' : 'text-gray-300' ?> inline-flex items-center px-1 pt-1 text-sm font-medium" >
                        <i class="fas fa-th-large mr-2"></i>Catégories
                    </a>
                    
                    <!-- Historique -->
                    <a href="<?= $basePath ?>student/historique.php" 
                       class="nav-link <?= ($currentPage ?? '') === 'historique' ? 'active text-green-400' : 'text-gray-300' ?> inline-flex items-center px-1 pt-1 text-sm font-medium">
                        <i class="fas fa-history mr-2"></i>Historique
                    </a>
                </div>
            </div>
            
            <!-- Profil & Déconnexion -->
            <div class="flex items-center">
                <div class="flex items-center space-x-4">
                    <!-- Avatar -->
                    <div class="w-10 h-10 rounded-full avatar-gradient flex items-center justify-center text-white font-semibold shadow-lg">
                        <?= $initials ?>
                    </div>
                    
                    <!-- Nom (caché sur mobile) -->
                    <div class="hidden md:block">
                        <div class="text-sm font-medium text-white"><?= htmlspecialchars($userName) ?></div>
                        <div class="text-xs text-gray-400">Étudiant</div>
                    </div>
                    
                    <!-- Bouton Déconnexion -->
                    <a href="<?= $basePath ?>auth/logout.php?token=<?= Security::generateCSRFToken() ?>" 
                       class="logout-btn text-red-400 hover:text-red-500" 
                       title="Déconnexion">
                        <i class="fas fa-sign-out-alt text-xl"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Menu Mobile -->
    <div class="md:hidden" id="mobile-menu" style="display: none;">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="<?= $basePath ?>student/dashboard.php" 
               class="<?= ($currentPage ?? '') === 'dashboard' ? 'bg-gray-900 text-green-400' : 'text-gray-300 hover:bg-gray-800 hover:text-white' ?> block px-3 py-2 rounded-md text-base font-medium">
                <i class="fas fa-home mr-2"></i>Tableau de bord
            </a>
            
            <a href="<?= $basePath ?>student/categories.php" 
               class="<?= ($currentPage ?? '') === 'categories' ? 'bg-gray-900 text-green-400' : 'text-gray-300 hover:bg-gray-800 hover:text-white' ?> block px-3 py-2 rounded-md text-base font-medium">
                <i class="fas fa-th-large mr-2"></i>Catégories
            </a>
            
            <a href="<?= $basePath ?>student/mes_quiz.php" 
               class="<?= ($currentPage ?? '') === 'quiz' ? 'bg-gray-900 text-green-400' : 'text-gray-300 hover:bg-gray-800 hover:text-white' ?> block px-3 py-2 rounded-md text-base font-medium">
                <i class="fas fa-clipboard-list mr-2"></i>Mes Quiz
            </a>
            
            <a href="<?= $basePath ?>student/historique.php" 
               class="<?= ($currentPage ?? '') === 'historique' ? 'bg-gray-900 text-green-400' : 'text-gray-300 hover:bg-gray-800 hover:text-white' ?> block px-3 py-2 rounded-md text-base font-medium">
                <i class="fas fa-history mr-2"></i>Historique
            </a>
        </div>
    </div>
</nav>

<script>
    // Toggle mobile menu
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
    }
</script>

<!-- Spacer pour compenser la navbar fixe -->
<div class="h-16"></div>
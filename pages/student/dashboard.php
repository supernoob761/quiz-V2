<?php
/**
 * Page: Tableau de bord Étudiant
 * Affiche les statistiques et les catégories disponibles
 */

require_once '../../config/database.php';
require_once '../../classes/Database.php';
require_once '../../classes/Security.php';
require_once '../../classes/Category.php';
require_once '../../classes/Quiz.php';

// Vérifier l'authentification


// Récupérer les données de l'utilisateur
$studentId = $_SESSION['user_id'];
$userName = $_SESSION['user_nom'];
$currentPage = 'dashboard';

// Récupérer les statistiques réelles (à implémenter dans vos classes)
// $quizzesCompleted = Quiz::getCompletedCount($studentId);
// $avgScore = Quiz::getAverageScore($studentId);
// $perfectScores = Quiz::getPerfectScoresCount($studentId);

// Statistiques d'exemple
$quizzesCompleted = 24;
$avgScore = 87;
$perfectScores = 5;

// Récupérer les catégories


// Catégories d'exemple si la base est vide
$exampleCategories = [
    [
        'id' => 1,
        'name' => 'Mathématiques',
        'description' => 'Algèbre, géométrie, calcul et statistiques',
        'icon' => 'calculator',
        'quiz_count' => 12
    ],
    [
        'id' => 2,
        'name' => 'Sciences',
        'description' => 'Physique, chimie, biologie et sciences naturelles',
        'icon' => 'flask',
        'quiz_count' => 8
    ],
    [
        'id' => 3,
        'name' => 'Informatique',
        'description' => 'Programmation, algorithmes et bases de données',
        'icon' => 'code',
        'quiz_count' => 15
    ],
    [
        'id' => 4,
        'name' => 'Histoire',
        'description' => 'Histoire mondiale, civilisations et événements marquants',
        'icon' => 'landmark',
        'quiz_count' => 6
    ]
];

// Utiliser les catégories d'exemple si la base est vide
if (empty($categories)) {
    $categories = $exampleCategories;
}
?>

<?php include '../partials/header.php'; ?>
<?php include '../partials/nav_student.php'; ?>
<?php include '../partials/student_styles.php'; ?>

<div class="container">
    <!-- Dashboard Section -->
    <div id="dashboard" class="section">
        <h2 class="section-title">
            <i class="fas fa-chart-line"></i>
            Tableau de bord
        </h2>
        
        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <i class="fas fa-clipboard-check"></i>
                <div class="stat-value"><?= $quizzesCompleted ?></div>
                <div class="stat-label">Quiz Complétés</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-trophy"></i>
                <div class="stat-value"><?= $avgScore ?>%</div>
                <div class="stat-label">Score Moyen</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-fire"></i>
                <div class="stat-value">7</div>
                <div class="stat-label">Jours Consécutifs</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-star"></i>
                <div class="stat-value"><?= $perfectScores ?></div>
                <div class="stat-label">Scores Parfaits</div>
            </div>
        </div>

        <!-- Categories Section -->
        <h3 class="section-title">
            <i class="fas fa-book"></i>
            Catégories Disponibles
        </h3>
        <div class="categories-grid">
            <?php foreach ($categories as $category): ?>
                <a href="quiz_list.php?category_id=<?= $category['id'] ?>" class="category-card">
                    <div class="category-header">
                        <div class="category-icon">
                            <i class="fas fa-<?= $category['icon'] ?? 'folder' ?>"></i>
                        </div>
                        <div class="category-title"><?= htmlspecialchars($category['name']) ?></div>
                    </div>
                    <div class="category-description">
                        <?= htmlspecialchars($category['description']) ?>
                    </div>
                    <span class="category-badge">
                        <i class="fas fa-clipboard-list"></i> 
                        <?= $category['quiz_count'] ?> Quiz
                    </span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php include '../partials/footer.php'; ?>
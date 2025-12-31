<?php
/**
 * Page: Catégories - Étudiant
 * Affiche toutes les catégories disponibles
 */

require_once '../../config/database.php';
require_once '../../classes/Database.php';
require_once '../../classes/Security.php';
require_once '../../classes/Category.php';
require_once '../../classes/Quiz.php';

// Vérifier l'authentification

$studentId = $_SESSION['user_id'];
$userName = $_SESSION['user_nom'];
$currentPage = 'categories';

$categoryObj = new Category();
$cata = $categoryObj->getAll();

// Récupérer toutes les catégories avec le nombre de quiz
// Catégories d'exemple si la base est vide

// Utiliser les catégories d'exemple si la base est vide
$categories = $cata;


?>

<?php include '../partials/header.php'; ?>
<?php include '../partials/nav_student.php'; ?>
<?php include '../partials/student_styles.php'; ?>

<div class="container">
    <div id="categories" class="section">
        <h2 class="section-title">
            <i class="fas fa-th-large"></i>
            Toutes les Catégories
        </h2>
        
        <div class="categories-grid">
            <?php foreach ($categories as $category): ?>
                <?php
             $count = $categoryObj->countQuizzesByCategory($category['id']);
          ?>

                <a href="quiz_list.php?category_id=<?= $category['id'] ?>" class="category-card">
                    <div class="category-header">
                        <div class="category-icon">
                            <i class="fas fa-<?= $category['icon'] ?? 'folder' ?>"></i>
                        </div>
                        <div class="category-title"><?= htmlspecialchars($category['nom']) ?></div>
                    </div>
                    <div class="category-description">
                        <?= htmlspecialchars($category['description']) ?>
                    </div>
                    <span class="category-badge">
                        <i class="fas fa-clipboard-list"></i> 
                        <?= $count ?> Quiz disponibles
                    </span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php include '../partials/footer.php'; ?>
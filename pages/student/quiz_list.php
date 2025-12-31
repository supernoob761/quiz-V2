<?php
/**
 * Page: Quiz List - Étudiant
 * Affiche tous les quiz d'une catégorie
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

// Récupérer l'ID de la catégorie
$categoryId = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;

if ($categoryId <= 0) {
    header('Location: categories.php');
    exit;
}

$categoryObj = new Category();
$quizObj = new Quiz();

// Récupérer les informations de la catégorie
$category = $categoryObj->getById($categoryId);

if (!$category) {
    header('Location: categories.php');
    exit;
}

// Récupérer tous les quiz de cette catégorie
$quizzes = $quizObj->getquizbycataid($categoryId);

?>

<?php include '../partials/header.php'; ?>
<?php include '../partials/nav_student.php'; ?>
<?php include '../partials/student_styles.php'; ?>

<style>
.quiz-list-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

.breadcrumb {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 2rem;
    font-size: 0.95rem;
    color: #666;
}

.breadcrumb a {
    color: #667eea;
    text-decoration: none;
    transition: color 0.2s;
}

.breadcrumb a:hover {
    color: #5568d3;
}

.breadcrumb i {
    font-size: 0.8rem;
}

.category-header-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 20px;
    padding: 2.5rem;
    color: white;
    margin-bottom: 2.5rem;
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
}

.category-header-section h1 {
    font-size: 2.2rem;
    margin: 0 0 0.5rem 0;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.category-header-section .icon-large {
    font-size: 2.5rem;
    opacity: 0.9;
}

.category-header-section p {
    font-size: 1.1rem;
    margin: 0;
    opacity: 0.95;
}

.quiz-count-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(255, 255, 255, 0.2);
    padding: 0.5rem 1rem;
    border-radius: 50px;
    margin-top: 1rem;
    font-weight: 500;
}

.quizzes-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
}

.quiz-card {
    background: white;
    border-radius: 16px;
    padding: 1.8rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
    transition: all 0.3s ease;
    border: 1px solid #f0f0f0;
    display: flex;
    flex-direction: column;
    text-decoration: none;
    color: inherit;
}

.quiz-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 24px rgba(102, 126, 234, 0.15);
    border-color: #667eea;
}

.quiz-card-header {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    margin-bottom: 1rem;
}

.quiz-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.quiz-card-title {
    flex: 1;
}

.quiz-card-title h3 {
    margin: 0 0 0.3rem 0;
    font-size: 1.25rem;
    color: #2d3748;
    line-height: 1.3;
}

.quiz-difficulty {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.difficulty-facile {
    background: #d4edda;
    color: #155724;
}

.difficulty-moyen {
    background: #fff3cd;
    color: #856404;
}

.difficulty-difficile {
    background: #f8d7da;
    color: #721c24;
}

.quiz-description {
    color: #666;
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 1.2rem;
    flex-grow: 1;
}

.quiz-meta {
    display: flex;
    gap: 1.5rem;
    padding-top: 1rem;
    border-top: 1px solid #f0f0f0;
    font-size: 0.9rem;
    color: #666;
}

.quiz-meta-item {
    display: flex;
    align-items: center;
    gap: 0.4rem;
}

.quiz-meta-item i {
    color: #667eea;
}

.quiz-card-footer {
    margin-top: 1rem;
}

.btn-start-quiz {
    width: 100%;
    padding: 0.9rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.btn-start-quiz:hover {
    transform: scale(1.02);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
}

.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
}

.empty-state-icon {
    font-size: 4rem;
    color: #cbd5e0;
    margin-bottom: 1rem;
}

.empty-state h3 {
    color: #2d3748;
    margin-bottom: 0.5rem;
}

.empty-state p {
    color: #666;
    margin-bottom: 1.5rem;
}

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background: #667eea;
    color: white;
    text-decoration: none;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-back:hover {
    background: #5568d3;
    transform: translateX(-3px);
}

@media (max-width: 768px) {
    .quiz-list-container {
        padding: 1rem;
    }
    
    .quizzes-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .category-header-section {
        padding: 1.5rem;
    }
    
    .category-header-section h1 {
        font-size: 1.5rem;
    }
}
</style>

<div class="quiz-list-container">
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="categories.php"><i class="fas fa-home"></i> Catégories</a>
        <i class="fas fa-chevron-right"></i>
        <span><?= htmlspecialchars($category['nom']) ?></span>
    </div>

    <!-- Category Header -->
    <div class="category-header-section">
        <h1>
            <i class="fas fa-<?= $category['icon'] ?? 'folder' ?> icon-large"></i>
            <?= htmlspecialchars($category['nom']) ?>
        </h1>
        <p><?= htmlspecialchars($category['description']) ?></p>
        <div class="quiz-count-badge">
            <i class="fas fa-clipboard-list"></i>
            <?= count($quizzes) ?> Quiz disponibles
        </div>
    </div>

    <?php if (empty($quizzes)): ?>
        <!-- Empty State -->
        <div class="empty-state">
            <div class="empty-state-icon">
                <i class="fas fa-inbox"></i>
            </div>
            <h3>Aucun quiz disponible</h3>
            <p>Il n'y a pas encore de quiz dans cette catégorie.</p>
            <a href="categories.php" class="btn-back">
                <i class="fas fa-arrow-left"></i>
                Retour aux catégories
            </a>
        </div>
    <?php else: ?>
        <!-- Quizzes Grid -->
        <div class="quizzes-grid">
            <?php foreach ($quizzes as $quiz): ?>
                <div class="quiz-card">
                    <div class="quiz-card-header">
                        <div class="quiz-icon">
                            <i class="fas fa-brain"></i>
                        </div>
                        <div class="quiz-card-title">
                            <h3><?= htmlspecialchars($quiz['titre']) ?></h3>
                            <?php if ($quiz['is_active']): ?>
                                <span class="quiz-difficulty difficulty-facile">
                                    <i class="fas fa-check-circle"></i> Actif
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="quiz-description">
                        <?= htmlspecialchars($quiz['description'] ?: 'Testez vos connaissances avec ce quiz !') ?>
                    </div>

                    <div class="quiz-meta">
                        <div class="quiz-meta-item">
                            <i class="fas fa-calendar"></i>
                            <span><?= date('d/m/Y', strtotime($quiz['created_at'])) ?></span>
                        </div>
                        <?php if ($quiz['is_active']): ?>
                            <div class="quiz-meta-item">
                                <i class="fas fa-play-circle"></i>
                                <span>Disponible</span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="quiz-card-footer">
                        <a href="take_quiz.php?quiz_id=<?= $quiz['id'] ?>" class="btn-start-quiz">
                            <i class="fas fa-play"></i>
                            Commencer le Quiz
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include '../partials/footer.php'; ?>
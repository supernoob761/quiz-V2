<?php
/**
 * Page: Historique - Étudiant
 * Affiche l'historique des quiz complétés
 */

require_once '../../config/database.php';
require_once '../../classes/Database.php';
require_once '../../classes/Security.php';
require_once '../../classes/Category.php';
require_once '../../classes/Quiz.php';
require_once '../../classes/Result.php';

// Vérifier l'authentification


$studentId = $_SESSION['user_id'];
$userName = $_SESSION['user_nom'];
$currentPage = 'history';

$resultObj = new Result();
$myresult = $resultObj->getMyResults($studentId);

// Récupérer l'historique réel (à implémenter dans vos classes)
// $history = Quiz::getStudentHistory($studentId);

// Historique d'exemple
$exampleHistory = [
    [
        'id' => 1,
        'quiz_title' => 'Les bases de l\'algèbre',
        'category_name' => 'Mathématiques',
        'score' => 95,
        'total_questions' => 20,
        'correct_answers' => 19,
        'completed_at' => '2024-12-28 14:30:00',
        'time_spent' => '12:45'
    ],
    [
        'id' => 2,
        'quiz_title' => 'Introduction à la physique',
        'category_name' => 'Sciences',
        'score' => 80,
        'total_questions' => 15,
        'correct_answers' => 12,
        'completed_at' => '2024-12-27 10:15:00',
        'time_spent' => '18:20'
    ],
    [
        'id' => 3,
        'quiz_title' => 'Les boucles en PHP',
        'category_name' => 'Informatique',
        'score' => 100,
        'total_questions' => 10,
        'correct_answers' => 10,
        'completed_at' => '2024-12-26 16:45:00',
        'time_spent' => '08:15'
    ],
    [
        'id' => 4,
        'quiz_title' => 'La Révolution française',
        'category_name' => 'Histoire',
        'score' => 75,
        'total_questions' => 20,
        'correct_answers' => 15,
        'completed_at' => '2024-12-25 11:20:00',
        'time_spent' => '15:30'
    ],
    [
        'id' => 5,
        'quiz_title' => 'Grammaire anglaise avancée',
        'category_name' => 'Langues',
        'score' => 88,
        'total_questions' => 25,
        'correct_answers' => 22,
        'completed_at' => '2024-12-24 09:00:00',
        'time_spent' => '20:10'
    ],
    [
        'id' => 6,
        'quiz_title' => 'Les capitales européennes',
        'category_name' => 'Géographie',
        'score' => 92,
        'total_questions' => 30,
        'correct_answers' => 27,
        'completed_at' => '2024-12-23 13:45:00',
        'time_spent' => '10:25'
    ]
];

$history = $myresult;

// Fonction pour obtenir la classe CSS du score
function getScoreClass($score) {
    if ($score >= 90) return 'score-excellent';
    if ($score >= 75) return 'score-good';
    if ($score >= 60) return 'score-average';
    return 'score-poor';
}
?>

<?php include '../partials/header.php'; ?>
<?php include '../partials/nav_student.php'; ?>
<?php include '../partials/student_styles.php'; ?>

<style>
.history-card {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1rem;
    transition: all 0.3s ease;
}

.history-card:hover {
    background: rgba(255, 255, 255, 0.08);
    border-color: rgba(139, 92, 246, 0.5);
    transform: translateY(-2px);
}

.history-header {
    display: flex;
    justify-content: space-between;
    align-items: start;
    margin-bottom: 1rem;
}

.history-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #fff;
    margin-bottom: 0.5rem;
}

.history-category {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(139, 92, 246, 0.2);
    color: #a78bfa;
    padding: 0.25rem 0.75rem;
    border-radius: 6px;
    font-size: 0.875rem;
}

.history-score {
    font-size: 2rem;
    font-weight: 700;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    min-width: 80px;
    text-align: center;
}

.score-excellent {
    background: rgba(34, 197, 94, 0.2);
    color: #4ade80;
}

.score-good {
    background: rgba(59, 130, 246, 0.2);
    color: #60a5fa;
}

.score-average {
    background: rgba(251, 146, 60, 0.2);
    color: #fb923c;
}

.score-poor {
    background: rgba(239, 68, 68, 0.2);
    color: #f87171;
}

.history-details {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    color: #9ca3af;
    font-size: 0.875rem;
}

.history-detail {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.history-detail i {
    color: #8b5cf6;
}

.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    color: #9ca3af;
}

.empty-state i {
    font-size: 4rem;
    color: #4b5563;
    margin-bottom: 1rem;
}
</style>

<div class="container">
    <div id="history" class="section">
        <h2 class="section-title">
            <i class="fas fa-history"></i>
            Historique des Quiz
        </h2>
        
        <?php if (empty($history)): ?>
            <div class="empty-state">
                <i class="fas fa-clipboard-list"></i>
                <p style="font-size: 1.125rem; margin-top: 1rem;">Aucun quiz complété pour le moment</p>
                <p>Commencez à répondre aux quiz pour voir votre historique ici</p>
            </div>
        <?php else: ?>
            <?php foreach ($history as $item): ?>
                <?php
                    $quiztitle = $resultObj->getById($item['id'], $studentId);
                    $title  = $quiztitle['quiz_titre'];
                    ?>

                <div class="history-card">
                    <div class="history-header">
                        <div>
                            <h3 class="history-title"><?= htmlspecialchars($title) ?></h3>
                            <span class="history-category">
                                <i class="fas fa-folder"></i>
                                <?= htmlspecialchars($item['categorie_nom']) ?>
                            </span>
                        </div>
                        <div class="history-score <?= getScoreClass($item['score']) ?>">
                            <?= $item['score'] ?>%
                        </div>
                    </div>
                    
                    <div class="history-details">
                        <div class="history-detail">
                            <i class="fas fa-clock"></i>
                            <span><h3>Comleted at :</h3> <?= $item['completed_at'] ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php include '../partials/footer.php'; ?>
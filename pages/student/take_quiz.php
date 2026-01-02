<?php
require_once '../../config/database.php';
require_once '../../classes/Database.php';
require_once '../../classes/Question.php';
require_once '../../classes/Quiz.php';
require_once '../../classes/Security.php';

Security::requireStudent();

$quizId = (int)($_GET['quiz_id'] ?? 0);
if ($quizId <= 0) {
    header('Location: quiz_list.php');
    exit;
}

$quizObj = new Quiz();
$questionObj = new Question();

$quiz = $quizObj->getById($quizId);
$questions = $questionObj->getAllByQuiz($quizId);

if (!$quiz || empty($questions)) {
    die('Quiz introuvable ou vide');
}
?>

<form id="quizForm">
    <input type="hidden" name="quiz_id" value="<?= $quizId ?>">

    <?php foreach ($questions as $i => $q): ?>
        <p><strong><?= ($i+1) ?>. <?= htmlspecialchars($q['question']) ?></strong></p>

        <?php for ($o = 1; $o <= 4; $o++): ?>
            <label>
                <input type="radio"
                       name="answers[<?= $q['id'] ?>]"
                       value="<?= $o ?>"
                       required>
                <?= htmlspecialchars($q["option$o"]) ?>
            </label><br>
        <?php endfor; ?>
        <hr>
    <?php endforeach; ?>

    <button type="submit">Soumettre</button>
</form>

<div id="quizResult"></div>

<script src="../../Content/js/take_quiz.js"></script>

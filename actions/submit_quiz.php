<?php
session_start();
header('Content-Type: application/json');

require_once '../config/database.php';
require_once '../classes/Database.php';
require_once '../classes/Question.php';
require_once '../classes/Result.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$quizId = (int)($_POST['quiz_id'] ?? 0);
$answers = $_POST['answers'] ?? [];

$questionObj = new Question();
$resultObj = new Result();

$questions = $questionObj->getAllByQuiz($quizId);

$total = count($questions);
$score = 0;

foreach ($questions as $q) {
    if (isset($answers[$q['id']]) && $answers[$q['id']] == $q['correct_option']) {
        $score++;
    }
}

$resultObj->save($quizId, $_SESSION['user_id'], $score, $total);

echo json_encode([
    'success' => true,
    'score' => $score,
    'total' => $total,
    'percent' => round(($score / $total) * 100, 2)
]);

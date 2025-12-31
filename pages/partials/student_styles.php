<?php
/**
 * PARTIAL: Styles pour l'interface étudiant
 * Styles globaux pour toutes les pages étudiants
 */
?>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #0f0f0f 0%, #1a1a1a 50%, #000000 100%);
        min-height: 100vh;
        color: #fff;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Dashboard Stats */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .stat-card {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        padding: 25px;
        border-radius: 12px;
        border: 1px solid #333;
        transition: all 0.3s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        border-color: #4CAF50;
        box-shadow: 0 10px 20px rgba(76, 175, 80, 0.2);
    }

    .stat-card i {
        font-size: 36px;
        margin-bottom: 15px;
        color: #4CAF50;
    }

    .stat-value {
        font-size: 32px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .stat-label {
        color: #888;
        font-size: 14px;
    }

    /* Categories Grid */
    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .category-card {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        padding: 25px;
        border-radius: 12px;
        border: 1px solid #333;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .category-card:hover {
        transform: translateY(-5px);
        border-color: #4CAF50;
        box-shadow: 0 10px 20px rgba(76, 175, 80, 0.2);
    }

    .category-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
    }

    .category-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #4CAF50, #45a049);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .category-title {
        font-size: 20px;
        font-weight: bold;
    }

    .category-description {
        color: #888;
        margin-bottom: 15px;
    }

    .category-badge {
        display: inline-block;
        padding: 5px 12px;
        background: #333;
        border-radius: 20px;
        font-size: 12px;
        color: #4CAF50;
    }

    /* Quiz List */
    .quiz-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .quiz-item {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        padding: 20px;
        border-radius: 12px;
        border: 1px solid #333;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.3s;
    }

    .quiz-item:hover {
        border-color: #4CAF50;
        transform: translateX(5px);
    }

    .quiz-info {
        flex: 1;
    }

    .quiz-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 8px;
    }

    .quiz-meta {
        display: flex;
        gap: 20px;
        color: #888;
        font-size: 14px;
    }

    .quiz-meta i {
        color: #4CAF50;
        margin-right: 5px;
    }

    .btn-start {
        padding: 10px 25px;
        background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
        border: none;
        color: #fff;
        border-radius: 8px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: bold;
        transition: all 0.3s;
        text-decoration: none;
    }

    .btn-start:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(76, 175, 80, 0.4);
    }

    /* Quiz Taking */
    .quiz-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .quiz-header {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        padding: 25px;
        border-radius: 12px;
        border: 1px solid #333;
        margin-bottom: 30px;
    }

    .quiz-progress {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        color: #888;
    }

    .progress-bar {
        width: 100%;
        height: 8px;
        background: #333;
        border-radius: 10px;
        overflow: hidden;
        margin-top: 10px;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #4CAF50, #45a049);
        transition: width 0.3s;
    }

    .question-card {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        padding: 30px;
        border-radius: 12px;
        border: 1px solid #333;
        margin-bottom: 20px;
    }

    .question-text {
        font-size: 20px;
        margin-bottom: 25px;
        line-height: 1.6;
    }

    .options-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .option {
        padding: 15px 20px;
        background: #2d2d2d;
        border: 2px solid #333;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .option:hover {
        border-color: #4CAF50;
        background: #333;
    }

    .option.selected {
        border-color: #4CAF50;
        background: linear-gradient(135deg, rgba(76, 175, 80, 0.2), rgba(69, 160, 73, 0.2));
    }

    .option-letter {
        width: 30px;
        height: 30px;
        background: #333;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    .option.selected .option-letter {
        background: #4CAF50;
    }

    .quiz-actions {
        display: flex;
        justify-content: space-between;
        gap: 15px;
    }

    .btn {
        padding: 12px 30px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-secondary {
        background: #2d2d2d;
        color: #fff;
        border: 1px solid #333;
    }

    .btn-secondary:hover {
        background: #333;
    }

    .btn-primary {
        background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
        color: #fff;
    }

    .btn-primary:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(76, 175, 80, 0.4);
    }

    /* Results */
    .result-container {
        max-width: 600px;
        margin: 0 auto;
        text-align: center;
    }

    .result-card {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        padding: 40px;
        border-radius: 12px;
        border: 1px solid #333;
    }

    .result-icon {
        font-size: 80px;
        color: #4CAF50;
        margin-bottom: 20px;
    }

    .result-score {
        font-size: 48px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .result-message {
        font-size: 20px;
        color: #888;
        margin-bottom: 30px;
    }

    /* History Table */
    .history-table {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        border-radius: 12px;
        border: 1px solid #333;
        overflow: hidden;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background: #2d2d2d;
        padding: 15px;
        text-align: left;
        font-weight: bold;
        border-bottom: 1px solid #333;
    }

    td {
        padding: 15px;
        border-bottom: 1px solid #333;
    }

    tr:last-child td {
        border-bottom: none;
    }

    tr:hover {
        background: #2d2d2d;
    }

    .score-badge {
        display: inline-block;
        padding: 5px 15px;
        border-radius: 20px;
        font-weight: bold;
    }

    .score-high {
        background: rgba(76, 175, 80, 0.2);
        color: #4CAF50;
    }

    .score-medium {
        background: rgba(255, 193, 7, 0.2);
        color: #FFC107;
    }

    .score-low {
        background: rgba(244, 67, 54, 0.2);
        color: #F44336;
    }

    .section-title {
        font-size: 28px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .section-title i {
        color: #4CAF50;
    }

    /* Utility Classes */
    .text-center {
        text-align: center;
    }

    .mb-4 {
        margin-bottom: 1rem;
    }

    .mb-6 {
        margin-bottom: 1.5rem;
    }

    .mb-8 {
        margin-bottom: 2rem;
    }

    .mt-8 {
        margin-top: 2rem;
    }

    .py-12 {
        padding-top: 3rem;
        padding-bottom: 3rem;
    }

    .text-gray-400 {
        color: #888;
    }

    .text-gray-600 {
        color: #666;
    }

    .text-green-400 {
        color: #4CAF50;
    }

    .text-green-300 {
        color: #66BB6A;
    }

    .text-lg {
        font-size: 1.125rem;
    }

    .text-6xl {
        font-size: 3.75rem;
    }
</style>
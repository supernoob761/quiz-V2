# Mini Quiz Platform – V2
## Student Interface (Main Objective)

---

## 1. General Context (V2 – Student-Centered)

In this version **V2**, the **Student** interface becomes the project's primary focus.

Students have **no creation rights**.

They only interact with quizzes **already created by teachers in V1**.

The student can:

- Explore available categories
- View active quizzes
- Take a quiz
- Securely submit answers
- See their score immediately
- View their personal history

The entire application is based on:

- Object-Oriented Programming (OOP)
- A clear and maintainable architecture
- Strict application security rules

---

---

## 3. Object Model – OOP Classes (Student Focus)

### User

Represents an authenticated student user.

- id
- name
- email
- password_hash
- role (`student`)
- created_at

---

### Category

Represents a quiz category.

- id
- name
- description

Read-only for the student.

---

### Quiz

Represents an available quiz.

- id
- title
- description
- category_id
- is_active
- created_at

Only active quizzes are visible.

--

### Question

Represents a quiz question.

- id
- quiz_id
- question
- option1
- option2
- option3
- option4
- correct_option

The correct answer is never displayed client-side.

--

### Result

Represents the final result of a quiz.

- id
- quiz_id
- student_id
- score
- total_questions
- completed_at

Results are read-only.

--

### Attempt (bonus)

Represents a quiz attempt.

- id
- quiz_id
- student_id
- started_at
- completed_at
- is_finished

This class allows you to:

- Limit the number of attempts
- Block resubmissions
- Track the quiz status (in progress / completed)

---

## 4. Student Features (V2)

### Student Navigation

- Access the dashboard
- View all categories
- View quizzes by category
- Start a quiz
- Answer questions
- Submit the quiz
- View the score
- View personal history

---

### Taking Quiz

- Only one attempt per quiz (or configurable)
- All questions must be answered
- Score calculated server-side
- Result cannot be modified
- Attempt automatically closed after submission

---

## 5. Security (Mandatory)

All features must comply with the following rules:

- CSRF protection on all forms
- Exclusive use of prepared statements (PDO)
- Validation and sanitization of user input
- Protection against:

- SQL Injection

- XSS
- Session Hijacking

- Unauthorized access to data
- Systematic verification of student role:

- `Security::checkStudent();`
- Complete restriction on access to other students' results

---

## 6. User Stories – Student (V2)

### US1 – Viewing Categories

As a student, I want to see the list of categories in order to choose a quiz.

Security Constraints:

- Valid session
- Display only active quizzes

---

### US2 – View quizzes in a category

As a student, I want to see the quizzes available for a given category.

Security Constraints:

- ID verification
- Active quiz only

---

### US3 – Take a quiz

As a student, I want to answer the questions in a quiz and submit my answers.

Security Constraints:

- Valid CSRF token
- Active quiz
- Validation of all answers
- Only one attempt allowed

---

### US4 – View my score

As a student, I want to see my score immediately after submission.

Security constraints:

- Result linked to my `user_id`
- No modifications possible

---

### US5 – Personal History

As a student, I want to view my past quiz history.

Security Constraints:

- Strictly personal access
- No other students' data

---

## 7. Learning Objectives (Duration: 1 week)

- Apply object-oriented programming in PHP
- Understand the separation between:

- business logic
- security
- display
- Manipulate:

- SQL relationships
- PHP sessions
- secure forms
- Get closer to a real-world SaaS mini-project

---

## 8. Bonus (Optional)

- Quiz timer
- Quiz pagination
- Permanent blocking of retries
- `ScoreService` class
- Simple personal statistics
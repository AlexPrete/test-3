const nameEntryContainer = document.getElementById('name-entry');
const quizContainer = document.getElementById('quiz-container');
const leaderboardContainer = document.getElementById('leaderboard-container');
const nameInput = document.getElementById('participant-name');
const questionContainer = document.getElementById('question');
const answersContainer = document.getElementById('answers');
const timerContainer = document.getElementById('timer');
const leaderboardList = document.getElementById('leaderboard-list');

let participants = [];
let currentQuestionIndex = 0;
let score = 0;
let questions = [];
let timer;



//Start the quiz
function startQuiz() {
    const name = nameInput.value.trim();
    if (name !== '') {
        nameEntryContainer.classList.add('hidden');
        quizContainer.classList.remove('hidden');
        fetchQuestions();
    } else {
        alert('Please enter your name to start the quiz.');
    }
}







// Fetch questions from OpenTDB API
function fetchQuestions() {
    fetch('https://opentdb.com/api.php?amount=10&type=multiple')
        .then(response => response.json())
        .then(data => {
            questions = data.results;
            displayQuestion();
            startTimer();
        });
}

// Display question and answer choices
function displayQuestion() {
    const currentQuestion = questions[currentQuestionIndex];
    questionContainer.textContent = currentQuestion.question;
    answersContainer.innerHTML = '';
    const allAnswers = currentQuestion.incorrect_answers.concat(currentQuestion.correct_answer);
    const shuffledAnswers = shuffleArray(allAnswers);
    shuffledAnswers.forEach(answer => {
        const button = document.createElement('button');
        button.textContent = answer;
        button.classList.add('answer-btn');
        button.addEventListener('click', () => checkAnswer(button, currentQuestion.correct_answer));
        answersContainer.appendChild(button);
    });
}

// Check selected answer
function checkAnswer(button, correctAnswer) {
    if (button.textContent === correctAnswer) {
        score++;
    }
    clearTimeout(timer);
    nextQuestion();
}

// Go to the next question
function nextQuestion() {
    currentQuestionIndex++;
    if (currentQuestionIndex < questions.length) {
        displayQuestion();
        startTimer();
    } else {
        endQuiz();
    }
}

// End the quiz
function endQuiz() {
    quizContainer.classList.add('hidden');
    leaderboardContainer.classList.remove('hidden');
    participants.push({ name: nameInput.value.trim(), score });
    showLeaderboard();
}

// Show leaderboard
function showLeaderboard() {
    participants.sort((a, b) => b.score - a.score);
    leaderboardList.innerHTML = '';
    participants.forEach(participant => {
        const li = document.createElement('li');
        li.textContent = `${participant.name}:  Il tuo score è ${participant.score}`;
        leaderboardList.appendChild(li);
    });
}

// Start the timer for each question
function startTimer() {
    let timeLeft = 10;
    timerContainer.textContent = `Time Left: ${timeLeft}`;
    timer = setInterval(() => {
        timeLeft--;
        timerContainer.textContent = `Time Left: ${timeLeft}`;
        if (timeLeft === 0) {
            clearInterval(timer);
            nextQuestion();
        }
    }, 1000);
}

// Utility function to shuffle array
function shuffleArray(array) {
    return array.sort(() => Math.random() - 0.5);
}


function startNewGame() {
    participants = [];
    currentQuestionIndex = 0;
    score = 0;
    questions = [];
    clearTimeout(timer);
    quizContainer.classList.add('hidden');
    leaderboardContainer.classList.add('hidden');
    nameEntryContainer.classList.remove('hidden');
    nameInput.value = '';
    leaderboardList.innerHTML = '';
}

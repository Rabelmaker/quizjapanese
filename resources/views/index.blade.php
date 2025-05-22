<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Japanese Vocabulary & Kanji Quiz</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
        .kanji-card {
            transition: all 0.3s ease;
            perspective: 1000px;
        }
        .kanji-inner {
            transition: transform 0.6s;
            transform-style: preserve-3d;
        }
        .kanji-card.flipped .kanji-inner {
            transform: rotateY(180deg);
        }
        .kanji-front, .kanji-back {
            backface-visibility: hidden;
            position: absolute;
            width: 100%;
            height: 100%;
        }
        .kanji-back {
            transform: rotateY(180deg);
        }
        .progress-bar {
            transition: width 0.5s ease;
        }
        .correct-answer {
            background-color: #4ade80 !important;
            color: white !important;
        }
        .incorrect-answer {
            background-color: #f87171 !important;
            color: white !important;
        }
        .category-badge {
            font-size: 0.7rem;
            padding: 0.2rem 0.5rem;
            border-radius: 9999px;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen font-sans">
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <!-- Header -->
    <header class="text-center mb-8">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">
            <i class="fas fa-language text-red-500 mr-2"></i>
            Japanese Learning Quiz
        </h1>
        <p class="text-gray-600">Master Japanese vocabulary and kanji with interactive quizzes</p>
    </header>

    <!-- Quiz Mode Selector -->
    <div id="mode-selector" class="bg-white rounded-xl shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Select Quiz Mode</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <button id="vocab-mode" class="quiz-mode-btn bg-blue-100 text-blue-800 hover:bg-blue-200 py-4 px-6 rounded-lg text-lg font-medium transition flex items-center justify-center">
                <i class="fas fa-book mr-2"></i> Vocabulary
            </button>
            <button id="kanji-mode" class="quiz-mode-btn bg-green-100 text-green-800 hover:bg-green-200 py-4 px-6 rounded-lg text-lg font-medium transition flex items-center justify-center">
                <i class="fas fa-kanji mr-2"></i> Kanji
            </button>
            <button id="mixed-mode" class="quiz-mode-btn bg-purple-100 text-purple-800 hover:bg-purple-200 py-4 px-6 rounded-lg text-lg font-medium transition flex items-center justify-center">
                <i class="fas fa-random mr-2"></i> Mixed Mode
            </button>
        </div>
    </div>

    <!-- Category Selection -->
    <div id="category-selector" class="hidden bg-white rounded-xl shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Select Categories</h2>
        <div id="category-container" class="grid grid-cols-1 md:grid-cols-2 gap-4"></div>
        <div class="mt-6 flex justify-between">
            <button id="back-to-mode" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-6 rounded-lg transition">
                <i class="fas fa-arrow-left mr-2"></i> Back
            </button>
            <button id="start-quiz" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition">
                Start Quiz <i class="fas fa-play ml-2"></i>
            </button>
        </div>
    </div>

    <!-- Quiz Settings -->
    <div id="quiz-settings" class="hidden bg-white rounded-xl shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Quiz Settings</h2>
        <div class="space-y-4">
            <div>
                <label class="block text-gray-700 mb-2">Number of Questions</label>
                <select id="question-count" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="0">Unlimited (Loop Mode)</option>
                </select>
            </div>
            <div>
                <label class="flex items-center space-x-2">
                    <input type="checkbox" id="shuffle-answers" class="rounded text-blue-600" checked>
                    <span class="text-gray-700">Shuffle answer options</span>
                </label>
            </div>
            <div>
                <label class="flex items-center space-x-2">
                    <input type="checkbox" id="show-hint" class="rounded text-blue-600">
                    <span class="text-gray-700">Show hints</span>
                </label>
            </div>
        </div>
        <div class="mt-6 flex justify-between">
            <button id="back-to-category" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-6 rounded-lg transition">
                <i class="fas fa-arrow-left mr-2"></i> Back
            </button>
            <button id="confirm-settings" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition">
                Confirm <i class="fas fa-check ml-2"></i>
            </button>
        </div>
    </div>

    <!-- Quiz Container -->
    <div id="quiz-container" class="hidden bg-white rounded-xl shadow-md p-6 mb-8">
        <!-- Progress Bar -->
        <div class="mb-6">
            <div class="flex justify-between mb-1">
                <span id="progress-text" class="text-sm font-medium text-gray-700">Question 1 of 10</span>
                <span id="score-text" class="text-sm font-medium text-gray-700">Score: 0</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div id="progress-bar" class="progress-bar bg-blue-600 h-2.5 rounded-full" style="width: 0%"></div>
            </div>
        </div>

        <!-- Question Display -->
        <div id="question-container" class="mb-8 text-center">
            <div id="question-category" class="category-badge bg-gray-200 text-gray-800 inline-block mb-2"></div>
            <div id="question" class="text-2xl md:text-3xl font-bold mb-4 text-gray-800"></div>
            <div id="question-type" class="text-sm text-gray-500 mb-4"></div>
            <div id="kanji-display" class="hidden">
                <div class="kanji-card w-32 h-32 mx-auto mb-4 cursor-pointer" onclick="flipKanjiCard(this)">
                    <div class="kanji-inner relative w-full h-full">
                        <div class="kanji-front absolute inset-0 flex items-center justify-center bg-blue-50 rounded-lg text-5xl">
                            <span id="kanji-character"></span>
                        </div>
                        <div class="kanji-back absolute inset-0 flex items-center justify-center bg-green-50 rounded-lg p-2 text-center">
                            <div>
                                <div id="kanji-meaning" class="font-semibold mb-1"></div>
                                <div id="kanji-reading" class="text-sm text-gray-600"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="text-sm text-gray-500">Click the card to flip</p>
            </div>
            <div id="hint-container" class="hidden mt-4 p-3 bg-yellow-50 rounded-lg text-sm text-yellow-800">
                <i class="fas fa-lightbulb mr-2"></i>
                <span id="hint-text"></span>
            </div>
        </div>

        <!-- Answer Options -->
        <div id="options-container" class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6"></div>

        <!-- Feedback -->
        <div id="feedback" class="hidden text-center p-4 rounded-lg mb-6"></div>

        <!-- Word Details -->
        <div id="wordDetails" class="hidden text-sm text-gray-700 p-4 rounded-lg bg-gray-50 border border-gray-200 mb-6"></div>


        <!-- Navigation Buttons -->
        <div class="flex justify-between mt-6">
            <button id="next-btn" class="hidden bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition">
                Next Question <i class="fas fa-arrow-right ml-2"></i>
            </button>
            <button id="finish-btn" class="hidden bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 px-6 rounded-lg transition">
                Finish Quiz <i class="fas fa-flag-checkered ml-2"></i>
            </button>
        </div>
    </div>

    <!-- Results Container -->
    <div id="results-container" class="hidden bg-white rounded-xl shadow-md p-6 text-center">
        <div class="text-5xl mb-4">
            <i class="fas fa-award text-yellow-500"></i>
        </div>
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Quiz Completed!</h2>
        <div id="final-score" class="text-4xl font-bold text-blue-600 mb-4">8/10</div>
        <div id="score-message" class="text-lg text-gray-600 mb-6"></div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-blue-50 p-4 rounded-lg">
                <div class="text-sm text-blue-800 mb-1">Correct Answers</div>
                <div id="correct-count" class="text-2xl font-bold text-blue-600">8</div>
            </div>
            <div class="bg-red-50 p-4 rounded-lg">
                <div class="text-sm text-red-800 mb-1">Incorrect Answers</div>
                <div id="incorrect-count" class="text-2xl font-bold text-red-600">2</div>
            </div>
            <div class="bg-green-50 p-4 rounded-lg">
                <div class="text-sm text-green-800 mb-1">Accuracy</div>
                <div id="accuracy" class="text-2xl font-bold text-green-600">80%</div>
            </div>
        </div>
        <div class="flex justify-center space-x-4">
            <button id="restart-btn" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-6 rounded-lg transition">
                <i class="fas fa-redo mr-2"></i> Try Again
            </button>
            <button id="new-quiz-btn" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition">
                <i class="fas fa-plus mr-2"></i> New Quiz
            </button>
        </div>
    </div>
</div>
<script>

    // Mock database for Japanese vocabulary and kanji
    const japaneseDB = @json($data);

    console.log(japaneseDB);

    // Quiz variables
    let currentQuiz = [];
    let currentQuestionIndex = 0;
    let score = 0;
    let quizMode = '';
    let selectedAnswer = null;
    let answerSelected = false;
    let selectedCategories = [];
    let questionCount = 10;
    let shuffleAnswers = true;
    let showHints = false;
    let unlimitedMode = false;
    let correctAnswers = 0;
    let incorrectAnswers = 0;

    // DOM elements
    const modeSelector = document.getElementById('mode-selector');
    const categorySelector = document.getElementById('category-selector');
    const quizSettings = document.getElementById('quiz-settings');
    const quizContainer = document.getElementById('quiz-container');
    const resultsContainer = document.getElementById('results-container');
    const categoryContainer = document.getElementById('category-container');
    const questionElement = document.getElementById('question');
    const questionCategoryElement = document.getElementById('question-category');
    const questionTypeElement = document.getElementById('question-type');
    const optionsContainer = document.getElementById('options-container');
    const feedbackElement = document.getElementById('feedback');
    const nextBtn = document.getElementById('next-btn');
    const finishBtn = document.getElementById('finish-btn');
    const restartBtn = document.getElementById('restart-btn');
    const newQuizBtn = document.getElementById('new-quiz-btn');
    const progressText = document.getElementById('progress-text');
    const scoreText = document.getElementById('score-text');
    const progressBar = document.getElementById('progress-bar');
    const finalScoreElement = document.getElementById('final-score');
    const correctCountElement = document.getElementById('correct-count');
    const incorrectCountElement = document.getElementById('incorrect-count');
    const accuracyElement = document.getElementById('accuracy');
    const scoreMessageElement = document.getElementById('score-message');
    const kanjiDisplay = document.getElementById('kanji-display');
    const kanjiCharacter = document.getElementById('kanji-character');
    const kanjiMeaning = document.getElementById('kanji-meaning');
    const kanjiReading = document.getElementById('kanji-reading');
    const hintContainer = document.getElementById('hint-container');
    const hintText = document.getElementById('hint-text');
    const questionCountSelect = document.getElementById('question-count');
    const shuffleAnswersCheckbox = document.getElementById('shuffle-answers');
    const showHintCheckbox = document.getElementById('show-hint');

    // Event listeners
    document.getElementById('vocab-mode').addEventListener('click', () => selectMode('vocabulary'));
    document.getElementById('kanji-mode').addEventListener('click', () => selectMode('kanji'));
    document.getElementById('mixed-mode').addEventListener('click', () => selectMode('mixed'));
    document.getElementById('back-to-mode').addEventListener('click', backToMode);
    document.getElementById('back-to-category').addEventListener('click', backToCategory);
    document.getElementById('start-quiz').addEventListener('click', showQuizSettings);
    document.getElementById('confirm-settings').addEventListener('click', startQuiz);
    nextBtn.addEventListener('click', showNextQuestion);
    finishBtn.addEventListener('click', finishQuiz);
    restartBtn.addEventListener('click', resetQuiz);
    newQuizBtn.addEventListener('click', newQuiz);
    questionCountSelect.addEventListener('change', updateQuestionCount);
    shuffleAnswersCheckbox.addEventListener('change', updateShuffleSetting);
    showHintCheckbox.addEventListener('change', updateHintSetting);

    // Select quiz mode
    function selectMode(mode) {
        quizMode = mode;
        modeSelector.classList.add('hidden');
        categorySelector.classList.remove('hidden');

        // Clear previous selections
        categoryContainer.innerHTML = '';
        selectedCategories = [];

        // Add categories based on mode
        if (mode === 'mixed') {
            // Combine vocabulary and kanji categories
            const vocabCategories = Object.keys(japaneseDB.vocabulary);
            const kanjiCategories = Object.keys(japaneseDB.kanji);
            const allCategories = [...new Set([...vocabCategories, ...kanjiCategories])];

            allCategories.forEach(category => {
                addCategoryCheckbox(category, true);
            });
        } else {
            // Single mode (vocabulary or kanji)
            const categories = Object.keys(japaneseDB[quizMode]);
            categories.forEach(category => {
                addCategoryCheckbox(category, false);
            });
        }
    }

    // Add category checkbox to the container
    function addCategoryCheckbox(category, isMixed) {
        const div = document.createElement('div');
        div.classList.add('flex', 'items-center', 'space-x-2');

        const checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.id = `category-${category.replace(/\s+/g, '-').toLowerCase()}`;
        checkbox.value = category;
        checkbox.checked = true;
        checkbox.classList.add('rounded', 'text-blue-600');
        checkbox.addEventListener('change', (e) => {
            if (e.target.checked) {
                selectedCategories.push(category);
            } else {
                selectedCategories = selectedCategories.filter(c => c !== category);
            }
        });

        const label = document.createElement('label');
        label.htmlFor = checkbox.id;
        label.classList.add('text-gray-700');

        // Add icon based on content type for mixed mode
        if (isMixed) {
            const hasVocab = japaneseDB.vocabulary[category] !== undefined;
            const hasKanji = japaneseDB.kanji[category] !== undefined;

            if (hasVocab && hasKanji) {
                label.innerHTML = `<i class="fas fa-random text-purple-500 mr-1"></i> ${category}`;
            } else if (hasVocab) {
                label.innerHTML = `<i class="fas fa-book text-blue-500 mr-1"></i> ${category}`;
            } else {
                label.innerHTML = `<i class="fas fa-kanji text-green-500 mr-1"></i> ${category}`;
            }
        } else {
            const iconClass = quizMode === 'vocabulary' ? 'fa-book text-blue-500' : 'fa-kanji text-green-500';
            label.innerHTML = `<i class="fas ${iconClass} mr-1"></i> ${category}`;
        }

        div.appendChild(checkbox);
        div.appendChild(label);
        categoryContainer.appendChild(div);

        // Add to selected categories
        selectedCategories.push(category);
    }

    // Go back to mode selection
    function backToMode() {
        categorySelector.classList.add('hidden');
        modeSelector.classList.remove('hidden');
    }

    // Go back to category selection
    function backToCategory() {
        quizSettings.classList.add('hidden');
        categorySelector.classList.remove('hidden');
    }

    // Show quiz settings
    function showQuizSettings() {
        categorySelector.classList.add('hidden');
        quizSettings.classList.remove('hidden');
    }

    // Update question count setting
    function updateQuestionCount() {
        questionCount = parseInt(questionCountSelect.value);
        unlimitedMode = questionCount === 0;
    }

    // Update shuffle setting
    function updateShuffleSetting() {
        shuffleAnswers = shuffleAnswersCheckbox.checked;
    }

    // Update hint setting
    function updateHintSetting() {
        showHints = showHintCheckbox.checked;
    }

    // Start the quiz
    function startQuiz() {
        // Get settings from UI
        questionCount = parseInt(questionCountSelect.value);
        unlimitedMode = questionCount === 0;
        shuffleAnswers = shuffleAnswersCheckbox.checked;
        showHints = showHintCheckbox.checked;

        // Prepare quiz questions
        currentQuiz = [];
        correctAnswers = 0;
        incorrectAnswers = 0;

        if (quizMode === 'mixed') {
            // Combine vocabulary and kanji questions from selected categories
            selectedCategories.forEach(category => {
                if (japaneseDB.vocabulary[category]) {
                    japaneseDB.vocabulary[category].forEach(item => {
                        currentQuiz.push(createVocabularyQuestion(item, category));
                    });
                }
                if (japaneseDB.kanji[category]) {
                    japaneseDB.kanji[category].forEach(item => {
                        currentQuiz.push(createKanjiQuestion(item, category));
                    });
                }
            });
        } else {
            // Single mode (vocabulary or kanji)
            selectedCategories.forEach(category => {
                japaneseDB[quizMode][category].forEach(item => {
                    if (quizMode === 'vocabulary') {
                        currentQuiz.push(createVocabularyQuestion(item, category));
                    } else {
                        currentQuiz.push(createKanjiQuestion(item, category));
                    }
                });
            });
        }

        // Shuffle the questions
        shuffleArray(currentQuiz);

        // If not unlimited mode, limit the number of questions
        if (!unlimitedMode && currentQuiz.length > questionCount) {
            currentQuiz = currentQuiz.slice(0, questionCount);
        }

        // Start quiz
        quizSettings.classList.add('hidden');
        quizContainer.classList.remove('hidden');
        currentQuestionIndex = 0;
        score = 0;
        answerSelected = false;

        showQuestion();
    }

    // Create a vocabulary question
    function createVocabularyQuestion(item, category) {
        // Tentukan jenis pertanyaan: meaning, translation, atau reading (acak)
        const rand = Math.random();
        let questionType;

        if (rand < 0.33) {
            questionType = 'meaning';
        } else if (rand < 0.66) {
            questionType = 'translation';
        } else {
            questionType = 'reading';
        }

        if (questionType === 'meaning') {
            // Question: What does X mean?
            const incorrectOptions = getRandomVocabularyItems(3, item.id, 'meaning');
            const options = shuffleArray([item.meaning, ...incorrectOptions]);

            return {
                type: 'vocabulary-meaning',
                category: category,
                question: `What does "${item.japanese}" mean?`,
                hint: item.hint,
                options: options,
                answer: options.indexOf(item.meaning),
                data: item
            };
        } else if (questionType === 'translation') {
            // Question: How do you say X in Japanese?
            const incorrectOptions = getRandomVocabularyItems(3, item.id, 'japanese');
            const options = shuffleArray([item.japanese, ...incorrectOptions]);

            return {
                type: 'vocabulary-translation',
                category: category,
                question: `How do you say "${item.meaning}" in Japanese?`,
                hint: item.hint,
                options: options,
                answer: options.indexOf(item.japanese),
                data: item
            };
        } else {
            // Question: What is the reading of this word?
            if (!item.reading) {
                // Jika tidak ada reading, fallback ke pertanyaan meaning
                return createVocabularyQuestion({ ...item, id: item.id }, category);
            }

            const incorrectOptions = getRandomVocabularyItems(3, item.id, 'reading');
            const options = shuffleArray([item.reading, ...incorrectOptions]);

            return {
                type: 'vocabulary-reading',
                category: category,
                question: `What is the reading (hiragana) for "${item.japanese}"?`,
                hint: item.hint,
                options: options,
                answer: options.indexOf(item.reading),
                data: item
            };
        }
    }

    // Create a kanji question
    function createKanjiQuestion(item, category) {
        // Determine question type (50/50 chance for meaning or reading)
        const questionType = Math.random() < 0.5 ? 'meaning' : 'reading';

        if (questionType === 'meaning') {
            // Question: What is the meaning of this kanji?
            const incorrectOptions = getRandomKanjiItems(3, item.id, 'meaning');
            const options = shuffleArray([item.meaning, ...incorrectOptions]);

            return {
                type: 'kanji-meaning',
                category: category,
                question: `What is the meaning of this kanji?`,
                hint: item.hint,
                options: options,
                answer: options.indexOf(item.meaning),
                data: item
            };
        } else {
            // Question: What is the reading for this kanji?
            // Combine onyomi and kunyomi readings
            const readings = [];
            if (item.onyomi) readings.push(...item.onyomi.split(', '));
            if (item.kunyomi) readings.push(...item.kunyomi.split(', ').filter(k => k !== '-'));

            if (readings.length === 0) {
                // If no readings, default to meaning question
                return createKanjiQuestion(item, category);
            }

            const correctReading = readings[0]; // Use first reading
            const incorrectOptions = getRandomKanjiItems(3, item.id, 'reading');
            const options = shuffleArray([correctReading, ...incorrectOptions]);

            return {
                type: 'kanji-reading',
                category: category,
                question: `What is the reading for this kanji?`,
                hint: item.hint,
                options: options,
                answer: options.indexOf(correctReading),
                data: item
            };
        }
    }

    // Get random vocabulary items for incorrect options
    function getRandomVocabularyItems(count, excludeId, field) {
        const allItems = [];
        Object.values(japaneseDB.vocabulary).forEach(category => {
            category.forEach(item => {
                if (item.id !== excludeId) {
                    allItems.push(item[field]);
                }
            });
        });

        shuffleArray(allItems);
        return allItems.slice(0, count);
    }

    // Get random kanji items for incorrect options
    function getRandomKanjiItems(count, excludeId, field) {
        const allItems = [];
        Object.values(japaneseDB.kanji).forEach(category => {
            category.forEach(item => {
                if (item.id !== excludeId) {
                    if (field === 'reading') {
                        // Combine onyomi and kunyomi readings
                        const readings = [];
                        if (item.onyomi) readings.push(...item.onyomi.split(', '));
                        if (item.kunyomi) readings.push(...item.kunyomi.split(', ').filter(k => k !== '-'));
                        allItems.push(...readings);
                    } else {
                        allItems.push(item[field]);
                    }
                }
            });
        });

        shuffleArray(allItems);
        return allItems.slice(0, count);
    }

    // Show current question
    function showQuestion() {
        resetState();

        if (currentQuestionIndex >= currentQuiz.length && !unlimitedMode) {
            finishQuiz();
            return;
        }

        // For unlimited mode, loop back to the beginning if we reach the end
        if (unlimitedMode && currentQuestionIndex >= currentQuiz.length) {
            currentQuestionIndex = 0;
            shuffleArray(currentQuiz);
        }

        const currentQuestion = currentQuiz[currentQuestionIndex];

        // Update progress
        if (unlimitedMode) {
            progressText.textContent = `Question ${currentQuestionIndex + 1}`;
        } else {
            progressText.textContent = `Question ${currentQuestionIndex + 1} of ${currentQuiz.length}`;
        }

        scoreText.textContent = `Score: ${score}`;
        progressBar.style.width = `${(currentQuestionIndex / (unlimitedMode ? currentQuiz.length : currentQuiz.length)) * 100}%`;

        // Set question and type
        questionElement.textContent = currentQuestion.question;
        questionCategoryElement.textContent = currentQuestion.category;

        // Show kanji card if needed
        if (currentQuestion.type.includes('kanji')) {
            kanjiDisplay.classList.remove('hidden');
            kanjiCharacter.textContent = currentQuestion.data.character;
            kanjiMeaning.textContent = currentQuestion.data.meaning;

            // Combine readings for display
            let readings = [];
            if (currentQuestion.data.onyomi) readings.push(`On: ${currentQuestion.data.onyomi}`);
            if (currentQuestion.data.kunyomi && currentQuestion.data.kunyomi !== '-') {
                readings.push(`Kun: ${currentQuestion.data.kunyomi}`);
            }
            kanjiReading.textContent = readings.join(' / ');

            // Reset kanji card to front
            const kanjiCard = document.querySelector('.kanji-card');
            if (kanjiCard) kanjiCard.classList.remove('flipped');
        } else {
            kanjiDisplay.classList.add('hidden');
        }

        // Set question type indicator
        let typeText = '';
        switch(currentQuestion.type) {
            case 'vocabulary-meaning':
                typeText = 'Vocabulary: Meaning';
                break;
            case 'vocabulary-translation':
                typeText = 'Vocabulary: Translation';
                break;
            case 'kanji-meaning':
                typeText = 'Kanji: Meaning';
                break;
            case 'kanji-reading':
                typeText = 'Kanji: Reading';
                break;
        }
        questionTypeElement.textContent = typeText;

        // Show hint if enabled
        if (showHints && currentQuestion.hint) {
            hintContainer.classList.remove('hidden');
            hintText.textContent = currentQuestion.hint;
        } else {
            hintContainer.classList.add('hidden');
        }

        // Create answer options
        const options = shuffleAnswers ? shuffleArray([...currentQuestion.options]) : currentQuestion.options;

        options.forEach((option, index) => {
            const button = document.createElement('button');
            button.classList.add('bg-gray-100', 'hover:bg-gray-200', 'text-gray-800', 'py-3', 'px-4', 'rounded-lg', 'text-left', 'transition');
            button.textContent = option;
            button.addEventListener('click', () => selectAnswer(index));
            optionsContainer.appendChild(button);
        });

        // Hide next button initially
        nextBtn.classList.add('hidden');
        finishBtn.classList.add('hidden');
    }

    // Reset question state
    function resetState() {
        answerSelected = false;
        selectedAnswer = null;
        feedbackElement.classList.add('hidden');
        feedbackElement.textContent = '';
        optionsContainer.innerHTML = '';
    }

    // Select answer
    function selectAnswer(index) {
        if (answerSelected) return;

        answerSelected = true;
        selectedAnswer = index;
        const currentQuestion = currentQuiz[currentQuestionIndex];
        const options = optionsContainer.children;

        // Disable all options
        for (let i = 0; i < options.length; i++) {
            options[i].classList.add('cursor-not-allowed');
            options[i].classList.remove('hover:bg-gray-200');
        }

        // Check if correct
        if (index === currentQuestion.answer) {
            options[index].classList.add('correct-answer');
            feedbackElement.textContent = 'Correct! 🎉';
            feedbackElement.classList.remove('hidden', 'bg-red-100', 'text-red-800');
            feedbackElement.classList.add('bg-green-100', 'text-green-800');
            score++;
            correctAnswers++;
            scoreText.textContent = `Score: ${score}`;
        } else {
            options[index].classList.add('incorrect-answer');
            options[currentQuestion.answer].classList.add('correct-answer');
            feedbackElement.textContent = `Incorrect. The correct answer is: ${currentQuestion.options[currentQuestion.answer]}`;
            feedbackElement.classList.remove('hidden', 'bg-green-100', 'text-green-800');
            feedbackElement.classList.add('bg-red-100', 'text-red-800');
            incorrectAnswers++;
        }

        feedbackElement.classList.remove('hidden');

        // Create and show word details after answering
        const wordDetailsElement = document.createElement('div');
        wordDetailsElement.id = 'word-details';
        wordDetailsElement.classList.add('mt-4', 'p-4', 'bg-blue-50', 'rounded-lg');

        // Different details for vocabulary vs kanji questions
        if (currentQuestion.type.includes('vocabulary')) {
            wordDetailsElement.innerHTML = `
                <h3 class="font-bold text-lg mb-2">Word Details:</h3>
                <p><strong>Japanese:</strong> ${currentQuestion.data.japanese}</p>
                <p><strong>Reading:</strong> ${currentQuestion.data.reading || 'N/A'}</p>
                <p><strong>Meaning:</strong> ${currentQuestion.data.meaning}</p>
                <p><strong>Category:</strong> ${currentQuestion.data.category}</p>
                ${currentQuestion.data.hint ? `<p><strong>Hint:</strong> ${currentQuestion.data.hint}</p>` : ''}
            `;
        } else if (currentQuestion.type.includes('kanji')) {
            wordDetailsElement.innerHTML = `
                <h3 class="font-bold text-lg mb-2">Kanji Details:</h3>
                <p><strong>Character:</strong> ${currentQuestion.data.character}</p>
                <p><strong>Meaning:</strong> ${currentQuestion.data.meaning}</p>
                <p><strong>Onyomi:</strong> ${currentQuestion.data.onyomi || 'N/A'}</p>
                <p><strong>Kunyomi:</strong> ${currentQuestion.data.kunyomi || 'N/A'}</p>
                <p><strong>Category:</strong> ${currentQuestion.category}</p>
                ${currentQuestion.data.hint ? `<p><strong>Hint:</strong> ${currentQuestion.data.hint}</p>` : ''}
            `;
        }

        // Insert the word details after the feedback element
        feedbackElement.insertAdjacentElement('afterend', wordDetailsElement);

        // Show next or finish button
        if (unlimitedMode || currentQuestionIndex < currentQuiz.length - 1) {
            nextBtn.classList.remove('hidden');
        } else {
            finishBtn.classList.remove('hidden');
        }
    }

    // Show next question
    function showNextQuestion() {
        // Reset all answer-related elements
        resetAnswerState();

        currentQuestionIndex++;
        showQuestion();
    }

    // Reset answer state including word details
    function resetAnswerState() {
        // Remove the word details element if it exists
        const wordDetailsElement = document.getElementById('word-details');
        if (wordDetailsElement) {
            wordDetailsElement.remove();
        }

        // Reset other answer-related elements
        feedbackElement.classList.add('hidden');
        feedbackElement.textContent = '';
        nextBtn.classList.add('hidden');
        finishBtn.classList.add('hidden');

        // Reset kanji card if it exists
        const kanjiCard = document.querySelector('.kanji-card');
        if (kanjiCard) kanjiCard.classList.remove('flipped');
    }

    // Finish quiz
    function finishQuiz() {
        quizContainer.classList.add('hidden');
        resultsContainer.classList.remove('hidden');

        // Calculate results
        const totalQuestions = unlimitedMode ? correctAnswers + incorrectAnswers : currentQuiz.length;
        const percentage = totalQuestions > 0 ? Math.round((correctAnswers / totalQuestions) * 100) : 0;

        finalScoreElement.textContent = `${correctAnswers}/${totalQuestions}`;
        correctCountElement.textContent = correctAnswers;
        incorrectCountElement.textContent = incorrectAnswers;
        accuracyElement.textContent = `${percentage}%`;

        // Set score message
        let message = '';
        if (percentage >= 90) {
            message = 'Excellent! You know your Japanese very well!';
        } else if (percentage >= 70) {
            message = 'Good job! Keep practicing!';
        } else if (percentage >= 50) {
            message = 'Not bad! Try reviewing some more.';
        } else {
            message = 'Keep studying! You\'ll improve with practice.';
        }
        scoreMessageElement.textContent = message;
    }

    // Reset quiz
    function resetQuiz() {
        resultsContainer.classList.add('hidden');
        quizContainer.classList.remove('hidden');
        currentQuestionIndex = 0;
        score = 0;
        correctAnswers = 0;
        incorrectAnswers = 0;
        answerSelected = false;
        showQuestion();
    }

    // Start a new quiz
    function newQuiz() {
        resultsContainer.classList.add('hidden');
        modeSelector.classList.remove('hidden');
    }

    // Flip kanji card
    function flipKanjiCard(card) {
        card.classList.toggle('flipped');
    }

    // Utility function to shuffle array
    function shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
        return array;
    }

</script>
</body>
</html>

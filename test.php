
<head>
    <meta charset="UTF-8">
    <title>Слово дня</title>
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Russo One;
            background-color: #FFB6C1;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }

        .container {
            border: 2px solid white;
            background-color: #8EE2DE;
            padding: 80px;
            border-radius: 45px; 
            text-align: center;
            max-width: 600px;
            margin-top: 20px;
        }

        .word-container {
            border: 2px solid white;
            border-radius: 15px; 
            padding: 0px; 
            background-color: #E0F7FF;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        .word {
            font-size: 3.3em;
            color: black;
            display: inline-block;
            margin-left: 10px;
        }

        .volume {
            cursor: pointer;
            font-size: 3.5em;
            color: black;
        }

        .navigation {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .navigation a {
            text-decoration: none;
            color: white;
            background-color: #007BFF;
            padding: 10px 20px;
            border-radius: 15px;
        }

        .date {
            margin-top: -70px;
            color: black;
            font-size: 1.5em;
        }

        .definition {
            font-size: 2em;
            color: black;
            margin-top: 10px;
        }

        .archive-item, .favorite-item {
            margin-bottom: 100px;
            text-align: left;
        }
		
		.favorite-item {
			margin-bottom: 20px;
			text-align: left;
		}
		
			.favorite-item {
		margin-bottom: 0;
		text-align: left;
		padding-top: ;
		padding-bottom: 0; 
		}

        .archive-item .word-container, .favorite-item .word-container {
            border: 2px solid white;
            border-radius: 15px; 
            padding: 0px; 
            background-color: #E0F7FF;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        .archive-item .word, .favorite-item .word {
            font-size: 1.5em;
            margin-left: 10px;
        }

        .archive-item .heart, .favorite-item .heart {
            cursor: pointer;
            font-size: 3em;
            margin-right: 10px;
            color: #ddd;
        }

        .archive-item .heart.favorited, .favorite-item .heart.favorited {
            color: red;
        }

        .archive-item .definition, .favorite-item .definition {
            font-size: 1.2em;
            margin-top: 10px;
            color: black;
        }

        .heart {
            cursor: pointer;
            color: #ddd;
        }

        .heart.favorited {
            color: red;
        }

        .heart-large {
            font-size: 7em;
            position: absolute;
            bottom: 310px; 
            left: 1040px;
            color: #ddd;
        }

        .heart-large.favorited {
            color: red;
        }

        .logo {
            position: absolute;
            left: 0;
            width: 23%;
        }
		
		.empty-message {
            font-size: 2em;
            color: black;
            margin-top: 20px;
            text-align: center;
        }
		.repost {
    cursor: pointer;
    font-size: 6em;
    color: black;
    position: absolute;
    bottom: 300px;
    left: 400px;
}

    </style>
</head>
<body>
    <img src="logo.png" alt="Логотип" class="logo"> 
    <div class="navigation">
        <a href="#" onclick="showWordOfTheDay()">Слово дня</a>
        <a href="#" onclick="showArchive()">Архив слов</a>
        <a href="#" onclick="showFavorites()">Избранное</a>
    </div>
    <div class="container" id="word-container">
        <div class="date" id="date"></div>
<div class="word-container">
    <div class="word" id="word"></div>
    <div class="volume" id="volume" onclick="speakWord()">🔊</div>
    <div class="repost" id="repost" onclick="copyToClipboard()">↻</div>
</div>
<div class="heart heart-large" id="heart" onclick="toggleFavorite()">&hearts;</div>
<div class="definition" id="definition"></div>
    </div>
    <div class="container archive" id="archive-container">
        <div id="archive"></div>
    </div>
    <div class="container favorites" id="favorites-container">
        <div id="favorites"></div>
        <div class="empty-message"></div>
    </div>
    <div class="container" id="random-container">
        <button id="random-button" onclick="toggleRandomWord()">Наугад</button>
        <div id="random-word"></div>
    </div>
</body>

    <script>
        const wordsByDate = [
            { date: '2024-07-01', word: 'Интенсификация', definition: 'Усиление, увеличение напряжённости чего-либо.' },
            { date: '2024-07-02', word: 'Диверсификация', definition: 'Расширение ассортимента продукции или услуг, предоставляемых компанией.' },
            { date: '2024-07-03', word: 'Конгломерат', definition: 'Крупная компания, состоящая из разнородных предприятий.' },
            { date: '2024-07-04', word: 'Пролиферация', definition: 'Быстрое размножение или увеличение количества чего-либо.' },
            { date: '2024-07-05', word: 'Априори', definition: 'Знание, полученное до опыта и независимое от него.' },
            { date: '2024-07-06', word: 'Эмпиризм', definition: 'Философское направление, утверждающее, что основой знаний является опыт.' },
            { date: '2024-07-07', word: 'Эффективность', definition: 'Соотношение достигнутого результата и затраченных ресурсов.' },
            { date: '2024-07-08', word: 'Иррациональность', definition: 'Неспособность быть объяснённым или понятым разумом.' },
            { date: '2024-07-09', word: 'Коннотация', definition: 'Дополнительное значение или оттенок, присущий слову или выражению.' },
            { date: '2024-07-10', word: 'Синергия', definition: 'Совместное действие, результат которого превышает сумму отдельных эффектов.' },
            { date: '2024-07-11', word: 'Дискурсивность', definition: 'Свойство речи, заключающееся в её последовательности и логичности.' },
            { date: '2024-07-12', word: 'Когерентность', definition: 'Связность, последовательность, законченность чего-либо.' },
            { date: '2024-07-13', word: 'Эволюция', definition: 'Постепенное изменение организмов под воздействием наследственных мутаций.' },
            { date: '2024-07-14', word: 'Эквивалентность', definition: 'Полное или частичное равенство по значению, силе, стоимости и т.д.' },
            { date: '2024-07-15', word: 'Сюрреализм', definition: 'Художественное направление, стремящееся выразить бессознательное и иррациональное.' },
            { date: '2024-07-16', word: 'Легитимность', definition: 'Законность, соответствие закону или праву.' },
            { date: '2024-07-17', word: 'Экспоненциальный', definition: 'Резкое увеличение в размере или значении, экспоненциональный рост.' },
            { date: '2024-07-18', word: 'Эмпатия', definition: 'Способность понимать эмоции и чувства других людей.' },
            { date: '2024-07-19', word: 'Прокрастинация', definition: 'Систематическое откладывание дел на потом.' },
            { date: '2024-07-20', word: 'Гедонизм', definition: 'Учение, признающее наслаждение главной целью жизни.' },
            { date: '2024-07-21', word: 'Метафизика', definition: 'Философская дисциплина, изучающая первоосновы бытия и познания.' },
            { date: '2024-07-22', word: 'Революция', definition: 'Радикальное изменение в общественно-политической жизни государства или общества.' },
            { date: '2024-07-23', word: 'Транспарентность', definition: 'Прозрачность, открытость информации или процесса.' },
            { date: '2024-07-24', word: 'Парадигма', definition: 'Совокупность основных научных достижений, образующих основу для дальнейших исследований.' },
            { date: '2024-07-25', word: 'Амбивалентность', definition: 'Сочетание противоположных чувств или мыслей по отношению к одному и тому же объекту.' },
            { date: '2024-07-26', word: 'Экстраполяция', definition: 'Прогнозирование, основанное на продолжении тенденций, наблюдаемых в прошлом.' },
            { date: '2024-07-27', word: 'Катарсис', definition: 'Эмоциональная разрядка, освобождение от накопившихся негативных эмоций.' },
            { date: '2024-07-28', word: 'Квантовый', definition: 'Связанный с квантовой механикой, описывающей поведение частиц на микроскопическом уровне.' },
            { date: '2024-07-29', word: 'Конгруэнтность', definition: 'Соответствие, согласованность между различными частями чего-либо.' },
            { date: '2024-07-30', word: 'Антропоцентризм', definition: 'Воззрение, признающее человека центром и целью мироздания.' }
        ];

        let favorites = [];

        function getCurrentDate() {
            const date = new Date();
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return date.toLocaleDateString('ru-RU', options);
        }

        function getWordOfTheDay() {
            const today = new Date();
            const formattedDate = today.toISOString().slice(0, 10);

            const wordData = wordsByDate.find(item => item.date === formattedDate);
            if (wordData) {
                return { word: wordData.word, definition: wordData.definition };
            } else {
                return { word: wordsByDate[0].word, definition: wordsByDate[0].definition };
            }
        }

        function showWordOfTheDay() {
            document.getElementById('word-container').style.display = 'block';
            document.getElementById('archive-container').style.display = 'none';
            document.getElementById('favorites-container').style.display = 'none';
            document.getElementById('random-container').style.display = 'none';

            document.getElementById('date').textContent = getCurrentDate();
            const wordOfTheDay = getWordOfTheDay();
            document.getElementById('word').textContent = wordOfTheDay.word;
            document.getElementById('definition').textContent = wordOfTheDay.definition;

            const heart = document.getElementById('heart');
            if (favorites.some(fav => fav.word === wordOfTheDay.word)) {
                heart.classList.add('favorited');
            } else {
                heart.classList.remove('favorited');
            }
        }

        function showArchive() {
            document.getElementById('word-container').style.display = 'none';
            document.getElementById('archive-container').style.display = 'block';
            document.getElementById('favorites-container').style.display = 'none';
            document.getElementById('random-container').style.display = 'none';

            const archive = document.getElementById('archive');
            archive.innerHTML = '';
            const today = new Date();

            const reversedWordsByDate = [...wordsByDate].reverse();

            reversedWordsByDate.forEach(entry => {
                const entryDate = new Date(entry.date);
                if (entryDate <= today && entryDate >= new Date('2024-07-01')) {
                    const options = { year: 'numeric', month: 'long', day: 'numeric' };
                    const formattedDate = entryDate.toLocaleDateString('ru-RU', options);

                    const archiveItem = document.createElement('div');
                    archiveItem.classList.add('archive-item');
                    archiveItem.innerHTML = `
                        <div>
                            <div class="date">${formattedDate}</div>
                            <div class="word-container">
                                <div class="word">${entry.word}</div>
                                <div class="heart ${favorites.some(fav => fav.word === entry.word) ? 'favorited' : ''}" onclick="toggleFavoriteFromList('${entry.word}', this)">&hearts;</div>
                            </div>
                            <div class="definition">${entry.definition}</div>
                        </div>
                    `;
                    archive.appendChild(archiveItem);
                }
            });
        }

        function showFavorites() {
            document.getElementById('word-container').style.display = 'none';
            document.getElementById('archive-container').style.display = 'none';
            document.getElementById('favorites-container').style.display = 'block';
            document.getElementById('random-container').style.display = 'none';

            const favoritesContainer = document.getElementById('favorites');
            favoritesContainer.innerHTML = '';
            if (favorites.length === 0) {
                const emptyMessage = document.createElement('div');
                emptyMessage.classList.add('empty-message');
                emptyMessage.textContent = 'Добавьте какое-то слово в избранное';
                favoritesContainer.appendChild(emptyMessage);
            } else {
                favorites.forEach(entry => {
                    const favoriteItem = document.createElement('div');
                    favoriteItem.classList.add('favorite-item');
                    favoriteItem.innerHTML = `
                        <div class="word-container">
                            <div>
                                <div class="word">${entry.word}</div>
                                <div class="definition">${entry.definition}</div>
                            </div>
                            <div class="heart favorited" onclick="toggleFavoriteFromList('${entry.word}', this)">&hearts;</div>
                        </div>
                    `;
                    favoritesContainer.appendChild(favoriteItem);
                });
            }
        }

        function toggleFavorite() {
            const word = getWordOfTheDay();
            const heart = document.getElementById('heart');
            if (favorites.some(fav => fav.word === word.word)) {
                favorites = favorites.filter(fav => fav.word !== word.word);
                heart.classList.remove('favorited');
            } else {
                favorites.push(word);
                heart.classList.add('favorited');
            }
        }

        function toggleFavoriteFromList(word, heartElement) {
            if (favorites.some(fav => fav.word === word)) {
                favorites = favorites.filter(fav => fav.word !== word);
                heartElement.classList.remove('favorited');
            } else {
                const wordObj = wordsByDate.find(w => w.word === word);
                favorites.push(wordObj);
                heartElement.classList.add('favorited');
            }
        }

        function speakWord() {
            const word = document.getElementById('word').textContent;
            const utterance = new SpeechSynthesisUtterance(word);
            window.speechSynthesis.speak(utterance);
        }

        function showRandom() {
            document.getElementById('word-container').style.display = 'none';
            document.getElementById('archive-container').style.display = 'none';
            document.getElementById('favorites-container').style.display = 'none';
            document.getElementById('random-container').style.display = 'block';
        }

        function toggleRandomWord() {
            const randomContainer = document.getElementById('random-word');
            const randomWord = getRandomWord();

            if (randomContainer.innerHTML === '') {
                const wordItem = document.createElement('div');
                wordItem.classList.add('word-container');
                wordItem.innerHTML = `
                    <div class="word">${randomWord.word}</div>
                    <div class="definition">${randomWord.definition}</div>
                `;
                randomContainer.appendChild(wordItem);
            } else {
                randomContainer.innerHTML = '';
            }
        }

        function getRandomWord() {
            const randomIndex = Math.floor(Math.random() * wordsByDate.length);
            return wordsByDate[randomIndex];
        }
		function copyToClipboard() {
    const word = document.getElementById('word').textContent;
    const definition = document.getElementById('definition').textContent;
    const textToCopy = `Привет, а ты знал что ${word} - это ${definition}`;

    navigator.clipboard.writeText(textToCopy)
        .then(() => {
            console.log('Текст скопирован в буфер обмена: ', textToCopy);
            alert('Текст скопирован в буфер обмена!');
        })
        .catch(err => {
            console.error('Ошибка при копировании: ', err);
            alert('Ошибка при копировании текста!');
        });
}
        showWordOfTheDay();
    </script>
</body>
</html>
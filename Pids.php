<?php
/*
    Назва файлу: stress_test.php
    Опис: Форма перевірки та тест на оцінку рівня стресу.
    Автор: Владислав
    Дата створення: 13 листопада 2024
    Призначення: Цей файл використовується для збору даних користувача та проведення тесту для оцінки рівня стресу з обробкою результатів на сервері.
*/

$questions = [
    'Ви відчуваєте себе втомленими або виснаженими навіть після відпочинку?',
    'Ви часто переживаєте через дрібниці?',
    'Вам важко концентруватися на завданнях?',
    'Ви помічаєте зниження мотивації до роботи або навчання?',
    'У вас є проблеми зі сном?',
    'Ви легко дратуєтесь у повсякденних ситуаціях?',
    'Ви відчуваєте постійне занепокоєння про майбутнє?',
    'Вам важко знайти час для відпочинку через зайнятість?',
    'Ви відчуваєте емоційне вигорання?'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && !isset($_POST['question_0'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        ?>
        <!DOCTYPE html>
        <html lang="uk">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Тест - Оцінка рівня стресу</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f2f2f2;
                    color: #333;
                    margin: 0;
                    padding: 20px;
                }
                .test-container, .result-container, .form-container {
                    background-color: #fff;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    padding: 20px;
                    margin: 20px auto;
                    max-width: 500px;
                }
                h1, h2 {
                    color: #4CAF50;
                }
                label {
                    display: block;
                    margin-top: 10px;
                }
                .question {
                    margin: 10px 0;
                }
                button {
                    background-color: #4CAF50;
                    color: white;
                    border: none;
                    padding: 10px 20px;
                    text-align: center;
                    display: inline-block;
                    font-size: 16px;
                    margin-top: 20px;
                    cursor: pointer;
                    border-radius: 4px;
                }
                button:hover {
                    background-color: #45a049;
                }
            </style>
        </head>
        <body>
            <h2>ТЕСТ: Оцінка рівня стресу</h2>
            <div class="test-container">
                <form method="POST">
                    <input type="hidden" name="name" value="<?php echo htmlspecialchars($name); ?>">
                    <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                    <input type="hidden" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                    
                    <?php foreach ($questions as $index => $question): ?>
                        <div class="question"><?php echo ($index + 1) . ". " . $question; ?></div>
                        <label><input type="radio" name="question_<?php echo $index; ?>" value="yes"> Так</label>
                        <label><input type="radio" name="question_<?php echo $index; ?>" value="no"> Ні</label>
                    <?php endforeach; ?>
                    <button type="submit">Отримати результат</button>
                </form>
            </div>
        </body>
        </html>
        <?php
    } elseif (isset($_POST['question_0'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $points = 0;

        foreach ($questions as $index => $question) {
            if (isset($_POST["question_$index"]) && $_POST["question_$index"] === 'yes') {
                $points++;
            }
        }

        ?>
        <!DOCTYPE html>
        <html lang="uk">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Результат тесту - Оцінка рівня стресу</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f2f2f2;
                    color: #333;
                    margin: 0;
                    padding: 20px;
                }
                .test-container, .result-container, .form-container {
                    background-color: #fff;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    padding: 20px;
                    margin: 20px auto;
                    max-width: 500px;
                }
                h1, h2 {
                    color: #4CAF50;
                }
                label {
                    display: block;
                    margin-top: 10px;
                }
                .question {
                    margin: 10px 0;
                }
                button {
                    background-color: #4CAF50;
                    color: white;
                    border: none;
                    padding: 10px 20px;
                    text-align: center;
                    display: inline-block;
                    font-size: 16px;
                    margin-top: 20px;
                    cursor: pointer;
                    border-radius: 4px;
                }
                button:hover {
                    background-color: #45a049;
                }
            </style>
        </head>
        <body>
            <h1>Результат тесту</h1>
            <div class="result-container">
                <p>Ім'я: <?php echo htmlspecialchars($name); ?></p>
                <p>Email: <?php echo htmlspecialchars($email); ?></p>
                <p>Телефон: <?php echo htmlspecialchars($phone); ?></p>
                <p>Кількість балів: <?php echo $points; ?></p>

                <?php if ($points <= 3): ?>
                    <p>Ваш рівень стресу низький. Продовжуйте дотримуватись здорового способу життя!</p>
                <?php elseif ($points <= 6): ?>
                    <p>Ваш рівень стресу середній. Рекомендується знайти час для відпочинку та релаксації.</p>
                <?php else: ?>
                    <p>Ваш рівень стресу високий. Рекомендуємо звернутися за допомогою до спеціаліста або знайти методи для зниження стресу.</p>
                <?php endif; ?>
            </div>
        </body>
        </html>
        <?php
    }
} else {
    ?>
    <!DOCTYPE html>
    <html lang="uk">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Форма перевірки - Оцінка рівня стресу</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f2f2f2;
                color: #333;
                margin: 0;
                padding: 20px;
            }
            .test-container, .result-container, .form-container {
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                padding: 20px;
                margin: 20px auto;
                max-width: 500px;
            }
            h1, h2 {
                color: #4CAF50;
            }
            label {
                display: block;
                margin-top: 10px;
            }
            .question {
                margin: 10px 0;
            }
            button {
                background-color: #4CAF50;
                color: white;
                border: none;
                padding: 10px 20px;
                text-align: center;
                display: inline-block;
                font-size: 16px;
                margin-top: 20px;
                cursor: pointer;
                border-radius: 4px;
            }
            button:hover {
                background-color: #45a049;
            }
        </style>
    </head>
    <body>
        <h1>Форма перевірки</h1>
        <div class="form-container">
            <form method="POST">
            <label>Ім'я</label>
                <input type="text" name="name" required>

                <label>Email</label>
                <input type="email" name="email" required>

                <label>Телефон</label>
                <input type="tel" name="phone" required>

                <button type="submit">Почати тест</button>
            </form>
        </div>
    </body>
    </html>
<?php
}
?>

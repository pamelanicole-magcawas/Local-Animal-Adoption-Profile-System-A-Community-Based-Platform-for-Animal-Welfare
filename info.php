<?php
// Define the FAQ items
$faq_items = [
    [
        'question' => 'What is the largest land animal?',
        'answer' => 'The African bush elephant is the largest land animal. Adult males can weigh up to 13,000 pounds (5,900 kg) and stand up to 13 feet (4 meters) tall at the shoulder.'
    ],
    [
        'question' => 'Which animal has the longest lifespan?',
        'answer' => 'The Greenland shark is believed to have the longest lifespan of any vertebrate, with some individuals estimated to be over 500 years old.'
    ],
    [
        'question' => 'How many species of animals are there?',
        'answer' => 'It\'s difficult to give an exact number, but scientists estimate there are about 8.7 million species of animals on Earth. However, only about 1.2 million have been identified and described.'
    ],
    [
        'question' => 'What is the fastest land animal?',
        'answer' => 'The cheetah is the fastest land animal, capable of running at speeds up to 70 mph (113 km/h) in short bursts.'
    ],
    [
        'question' => 'Do all birds fly?',
        'answer' => 'No, not all birds can fly. Some flightless birds include penguins, ostriches, emus, and kiwis. These birds have evolved to be better adapted to their specific environments.'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal FAQ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            color: #2c3e50;
            text-align: center;
        }
        .faq-item {
            background-color: #fff;
            border-radius: 5px;
            margin-bottom: 20px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .question {
            font-weight: bold;
            color: #2980b9;
            margin-bottom: 10px;
            font-size: 1.1em;
        }
        .answer {
            margin-left: 20px;
        }
    </style>
</head>
<body>
    <h1>Animal FAQ</h1>
    
    <?php foreach ($faq_items as $item): ?>
        <div class="faq-item">
            <div class="question"><?php echo htmlspecialchars($item['question']); ?></div>
            <div class="answer"><?php echo htmlspecialchars($item['answer']); ?></div>
        </div>
    <?php endforeach; ?>
</body>
</html>
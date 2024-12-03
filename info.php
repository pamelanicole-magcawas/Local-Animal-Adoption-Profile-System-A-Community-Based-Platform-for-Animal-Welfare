<?php
$faq_items = [
    [
        'question' => 'What are stray animals, and why are they a problem in the Philippines?',
        'answer' => 'Stray animals, especially dogs and cats, are common in the Philippines. They are often abandoned or lost pets, and many live in the streets, facing risks like malnutrition, disease, and accidents. Stray animals can also contribute to public health issues, such as the spread of rabies. There are many shelters and organizations working to rescue and rehabilitate these animals.'
    ],
    [
        'question' => 'How can I help stray animals in the Philippines?',
        'answer' => 'You can help stray animals by supporting local shelters, adopting stray pets, or becoming involved in rescue efforts. Donating food, money, or supplies to shelters is also a great way to assist. Additionally, spreading awareness about the importance of spaying and neutering pets helps reduce the stray animal population.'
    ],
    [
        'question' => 'What is the role of animal shelters in the Philippines?',
        'answer' => 'Animal shelters in the Philippines play a crucial role in rescuing, rehabilitating, and rehoming abandoned, abused, or neglected animals. They provide medical care, food, and shelter for these animals while working to find them loving forever homes. Many shelters also advocate for animal welfare and promote responsible pet ownership.'
    ],
    [
        'question' => 'What should I expect when adopting a shelter animal?',
        'answer' => 'When adopting a shelter animal, expect to go through an adoption process that may include an application form, a home visit, and an interview. Shelters typically want to ensure that the animals are going to a safe, loving home. You’ll also be required to pay adoption fees that help cover medical expenses, vaccinations, and spaying/neutering costs.'
    ],
    [
        'question' => 'Why is it important to adopt, not shop?',
        'answer' => 'Adopting animals from shelters or rescue organizations saves lives. It helps reduce the stray animal population and provides a second chance for animals that might otherwise be euthanized. Shelters usually screen animals for temperament and health, ensuring that adopted animals are well-suited to their new homes.'
    ],
    [
        'question' => 'What are the challenges faced by animal shelters in the Philippines?',
        'answer' => 'Animal shelters in the Philippines often face financial difficulties, lack of space, and limited resources. Many shelters rely on donations and volunteer work to sustain their operations. The overwhelming number of abandoned and abused animals makes it difficult for shelters to provide long-term care for all animals in need.'
    ],
    [
        'question' => 'How can I support local animal shelters?',
        'answer' => 'You can support local animal shelters by donating money, food, or supplies such as blankets, toys, and pet care items. Volunteering your time to assist with daily tasks at shelters or helping with fundraising efforts is also a valuable way to contribute.'
    ],
    [
        'question' => 'What is the importance of spaying and neutering pets?',
        'answer' => 'Spaying and neutering pets help control the stray animal population by preventing unwanted litters. This reduces the number of animals that end up in shelters or on the streets. It also improves the health and behavior of pets, contributing to their overall well-being.'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style/faq.css">
    <title>Animal FAQ</title>
</head>

<body>
    <nav class="nav">
        <ul>
            <li><a href="user_homepage.php"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="view_animals.php"><i class="fas fa-paw"></i> Our Animals</a></li>
            <li><a href="about.php"><i class="fas fa-info-circle"></i> About</a></li>
            <li><a href="report.php"><i class="fas fa-exclamation-circle"></i> Report</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </nav>

    <h1>Animal FAQ</h1>
    
    <?php foreach ($faq_items as $item): ?>
        <div class="faq-item">
            <div class="question"><?php echo htmlspecialchars($item['question']); ?></div>
            <div class="answer"><?php echo htmlspecialchars($item['answer']); ?></div>
        </div>
    <?php endforeach; ?>

    <footer>
        Copyright &copy; 2024 Animal Adoption Organization. All Rights Reserved.
    </footer>
</body>
</html>
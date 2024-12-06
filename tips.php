<?php
class AnimalTipGenerator {
    protected $animalTips;

    public function __construct() {
        $this->animalTips = [
            "Always provide fresh, clean water.",
            "Ensure your pet has regular vet check-ups.",
            "Offer balanced meals with appropriate nutrition.",
            "Provide a safe and clean environment for your pets.",
            "Spend quality time with your pets to strengthen your bond."
        ];
    }

    public function getRandomTip() {
        $randomIndex = array_rand($this->animalTips);
        return $this->animalTips[$randomIndex];
    }
}

// Dog-specific tips
class DogTipGenerator extends AnimalTipGenerator {
    public function __construct() {
        $this->animalTips = [
            "Exercise your dog daily to keep them healthy and happy.",
            "Use positive reinforcement during training.",
            "Avoid feeding dogs chocolate, onions, or garlic—they are toxic!",
            "Brush your dog's fur regularly to reduce shedding.",
            "Keep your dog’s nails trimmed to prevent discomfort or injury.",
            "Provide chew toys to support dental health and prevent boredom.",
            "Ensure your dog has proper identification, such as a microchip or ID tag.",
            "Monitor your dog's weight to avoid obesity and related health issues."
        ];
    }
}

// Cat-specific tips
class CatTipGenerator extends AnimalTipGenerator {
    public function __construct() {
        $this->animalTips = [
            "Keep your cat’s litter box clean to prevent behavioral issues.",
            "Provide scratching posts to protect your furniture.",
            "Avoid giving milk to cats; many are lactose intolerant.",
            "Play with your cat daily to keep them active and reduce stress.",
            "Brush your cat’s fur regularly to prevent hairballs.",
            "Offer a variety of toys to stimulate your cat’s curiosity.",
            "Provide high perches or cat trees for climbing and observing.",
            "Schedule regular dental check-ups to maintain oral health."
        ];
    }
}
?>
<?php
// Include the StatsCards class
require_once 'statsCards.php';

// Example 1: Basic usage with default colors
$appliedJobsCard = new StatsCards('Applied Jobs', '22');
echo $appliedJobsCard->render();

// Example 2: Customizing colors and icon
$interviewsCard = new StatsCards(
    'Interviews', 
    '5', 
    'calendar', 
    'text-gray-500',
    'text-green-600',
    'text-green-600',
    'bg-green-50'
);
echo $interviewsCard->render();

// Example 3: Using the static create method
echo StatsCards::create(
    'Saved Jobs', 
    '14', 
    'bookmark', 
    'text-gray-500',
    'text-purple-600',
    'text-purple-600',
    'bg-purple-50'
);

// Example 4: Using different Tailwind color classes
echo StatsCards::create(
    'Messages', 
    '8', 
    'mail', 
    'text-gray-500',
    'text-red-600',
    'text-red-600',
    'bg-red-50'
);
?>

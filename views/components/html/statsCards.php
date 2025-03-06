<!-- 
 // Basic usage
$card = new StatsCards('Applied Jobs', '22');
echo $card->render();

// With custom colors and icon
echo StatsCards::create(
    'Saved Jobs', 
    '14', 
    'bookmark', 
    'text-gray-500',
    'text-purple-600',
    'text-purple-600',
    'bg-purple-50'
); 
-->

<?php

    class StatsCards {
        private $title;
        private $value;
        private $icon;
        private $titleColor;
        private $valueColor;
        private $iconColor;
        private $bgColor;
        
        /**
         * Constructor for the StatsCards class
         * 
         * @param string $title The title of the stats card
         * @param string $value The value to display in the stats card
         * @param string $icon The Lucide icon name to use
         * @param string $titleColor The color class for the title text (default: 'text-gray-500')
         * @param string $valueColor The color class for the value text (default: 'text-blue-600')
         * @param string $iconColor The color class for the icon (default: 'text-blue-600')
         * @param string $bgColor The background color class for the icon container (default: 'bg-blue-50')
         */
        public function __construct(
            $title, 
            $value, 
            $icon = 'briefcase',
            $titleColor = 'text-gray-500',
            $valueColor = 'text-blue-600',
            $iconColor = 'text-blue-600',
            $bgColor = 'bg-blue-50'
        ) {
            $this->title = $title;
            $this->value = $value;
            $this->icon = $icon;
            $this->titleColor = $titleColor;
            $this->valueColor = $valueColor;
            $this->iconColor = $iconColor;
            $this->bgColor = $bgColor;
        }
        
        /**
         * Render the stats card
         * 
         * @return string The HTML for the stats card
         */
        public function render() {
            return <<<HTML
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center gap-4">
                    <div class="{$this->bgColor} p-3 rounded-md">
                        <i data-lucide="{$this->icon}" class="w-6 h-6 {$this->iconColor}"></i>
                    </div>
                    <div>
                        <div class="text-sm {$this->titleColor}">{$this->title}</div>
                        <div class="text-xl font-bold {$this->valueColor}">{$this->value}</div>
                    </div>
                </div>
            </div>
HTML;
        }
        
        /**
         * Static method to quickly create and render a stats card
         */
        public static function create($title, $value, $icon = 'briefcase', $titleColor = 'text-gray-500', $valueColor = 'text-blue-600', $iconColor = 'text-blue-600', $bgColor = 'bg-blue-50') {
            $card = new self($title, $value, $icon, $titleColor, $valueColor, $iconColor, $bgColor);
            return $card->render();
        }
    }
?>


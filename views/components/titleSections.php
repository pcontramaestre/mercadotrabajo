<?php
/**
  * $titleSection = [
 *    'translate_es' => 'Trabajos más populares',
 *    'translate_en' => 'Most Popular Jobs'
 * ];
 * $titleSectionText = [
 * 'translate_es' => 'Conoce tu valor y encuentra el trabajo que califique tu vida', 
 * 'translate_en' => 'Know your worth and find the job that qualify your life'
 * ];
 * 
 * @var array $titleSection
 * @var array $titleSectionText
 * @var string $titleSectionClass
 */
 $titleSectionClassDiv = $titleSectionClass ?? $titleSectionClass = '';
?>

<div class="text-center mb-6 aos-init aos-animate auto-container <?php echo $titleSectionClassDiv ?>" data-aos="fade-up">
    <h1 class="text-3xl font-bold text-gray-800" data-translate-es="<?php echo $titleSection['translate_es'] ?>" data-translate-en="<?php echo $titleSection['translate_en'] ?>">
        <?php echo $titleSectionText['translate_en'] ?>
    </h1>
    <p class="text-gray-500" data-translate-es="<?php echo $titleSectionText['translate_es'] ?>" data-translate-en="<?php echo $titleSectionText['translate_en'] ?>">
        <?php echo $titleSectionText['translate_en'] ?>
    </p>
</div>
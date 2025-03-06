<?php
// views/components/pageTitleInternal.php
/**
 * $titleSection = [
 *    'translate_es' => 'Trabajos más populares',
 *    'translate_en' => 'Most Popular Jobs'
 * ];
 * 
 * @var array $titleSection
 * 
*/
?>


<section class="page-title pt-32 pb-160 bg-dark" style="background-image:url(<?php echo SYSTEM_BASE_DIR ?>assets/img/banner-home.png)">">
    <div class="auto-container">
        <div class="title-outer">
            <h1 data-translate-es="<?php echo $titleSection['translate_es'] ?>" data-translate-en="<?php echo $titleSection['translate_en'] ?>">
                <?php echo $titleSection['translate_en']?>
            </h1>
            <ul class="page-breadcrumb">
                <li>
                    <a href="/" class="text-white">Home</a>
                </li>
                <li data-translate-es="<?php echo $titleSection['translate_es'] ?>" data-translate-en="<?php echo $titleSection['translate_en'] ?>" class="text-white">
                    <?php echo $titleSection['translate_en']?>
                </li>
            </ul>
        </div>
    </div>
</section>
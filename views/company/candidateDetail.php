<?php

if (empty($_SESSION['company_id']) || $_SESSION['role_id'] != 3) {
    echo "Acceso denegado. Por favor, inicia sesión.";
    die(); // Detener la ejecución del script";
}

/**
 * Data received
 * 
 * @param array $dataUserProfile
 */

/*
 $dataUserProfile 
/**
 * Data received
 * 
 * @param array $dataUserProfile
 *
 * education          => Array (
 *     [0] => Array (
 *         [id] => 3
 *         [user_id] => 8
 *         [degree] => Bachiller en ciencias
 *         [institution] => Escuela Deportiva
 *         [start_year] => 1992
 *         [end_year] => 1997
 *         [description] => Titulo de bachiller en ciencias
 *         [created_at] => 2025-03-04 20:33:37
 *         [updated_at] => 2025-03-05 20:15:07
 *     )
 * )
 * education          => Array (
 *     [0] => Array (
 *         [id] => 3
 *         [user_id] => 8
 *         [degree] => Bachiller en ciencias
 *         [institution] => Escuela Deportiva
 *         [start_year] => 1992
 *         [end_year] => 1997
 *         [description] => Titulo de bachiller en ciencias
 *         [created_at] => 2025-03-04 20:33:37
 *         [updated_at] => 2025-03-05 20:15:07
 *     )
 *     [1] => Array (
 *         [id] => 1
 *         [user_id] => 8
 *         [degree] => TECNICO EN INFORMATICA
 *         [institution] => IUFRONT
 *         [start_year] => 1998
 *         [end_year] => 2000
 *         [description] => Tecnico superior en informatica
 *         [created_at] => 2025-03-04 17:57:10
 *         [updated_at] => 2025-03-04 20:36:42
 *     )
 * )
 * experience         => Array (
 *     [0] => Array (
 *         [id] => 2
 *         [user_id] => 8
 *         [jobTitle] => Docente de informatica
 *         [company] => Ministerio de educación
 *         [startDate] => 2001
 *         [endDate] => 2014
 *         [description] => Docente de informatica en bachillerato
 *         [created_at] => 2025-03-05 09:06:19
 *         [updated_at] => 2025-03-05 09:06:19
 *     )
 * )
 * awards             => Array (
 *     [0] => Array (
 *         [id] => 1
 *         [user_id] => 8
 *         [title] => RECONOCIMIENTO UPEL
 *         [organization] => UPEL
 *         [year] => 2010
 *         [description] => RECONOCIMIENTO COMO PONENTE EN EL 2010
 *         [created_at] => 2025-03-04 18:25:16
 *         [updated_at] => 2025-03-04 18:25:43
 *     )
 * )
 * skills             => Array (
 *     [0] => Array (
 *         [id] => 5
 *         [user_id] => 8
 *         [name] => SCSS
 *         [level] => 89
 *         [created_at] => 2025-03-05 20:15:43
 *         [updated_at] => 2025-03-06 09:13:15
 *     )
 * )
 * user_profile       => Array ( 
 *     [0] => Array (
 *         [user_id] => 8
 *         [description] => Esto es otra prueba de guardado
 *         [created_at] => 2025-03-04 16:34:54
 *         [updated_at] => 2025-03-06 08:27:37
 *         [logo_path] => http://mercadotrabajo.localdev:8080/uploads/67c994b929542_candidate-1.webp
 *         [full_name] => Pablo Contramaestre
 *         [job_title] => Developer Pablo
 *         [phone] => 123123123
 *         [allow_show_phone] => 1
 *         [email_address] => pcontramaestre@gmail.com
 *         [website] => https://www.mercadotrabajo.com
 *         [experience] => 10
 *         [age] => 21
 *         [education_levels] => Universitario
 *         [languages] => Español, Ingles
 *         [allow_in_search_listing] => 1
 *         [description_profile] => Esto es otra prueba de guardado
 *         [country_id] => 1
 *         [city_id] => 1
 *         [complete_address] => Prueba de direccion 2222
 *         [facebook] => www.facebook.com/pcontramaestre
 *         [twitter] => @pcontramaestre
 *         [linkedin] => pcontramaestre
 *         [current_salary_range_id] => 2
 *         [expected_salary_range_id] => 5
 *     )
 * )
 * cvs                => Array (
 *     [0] => Array (
 *         [id] => 14
 *         [user_id] => 8
 *         [path] => uploads/resumes/65668c2a5d9e8/cv_67ccfcdc60d7a4.28189541.pdf
 *         [filename] => invoice_67b66a9372256.pdf
 *         [file_type] => application/pdf
 *         [file_size] => 11192
 *         [status] => active
 *         [is_deleted] => 0
 *         [created_at] => 2025-03-08 22:28:44
 *         [updated_at] => 2025-03-08 22:28:44
 *     )
 * )
*/

include_once 'config/config.php';
include_once 'views/company/header.php';
?>

<!-- Main Content -->
<main class="flex-1 md:ml-64 md:pl-0 pl-0 pt-16 md:pt-0 bg-white">
    <div class="p-6">
        <section class="mx-auto candidate-detail-section">
            <div class="upper-box bg-blue2-100">
                <div class="auto-container">
                    <div class="candidate-block-five">
                        <div class="inner-box">
                            <div class="content">
                                <figure class="image">
                                    <img
                                        class="w-24 h-24 rounded-full object-cover"
                                        src="<?php echo htmlspecialchars($dataUserProfile['user_profile'][0]['logo_path']) ?>"
                                        alt="avatar" loading="lazy" width="100" height="100" style="color: transparent;">
                                </figure>
                                <h4 class="name"><?php echo $dataUserProfile['user_profile'][0]['full_name'] ?></h4>
                                <ul class="candidate-info">
                                    <li class="designation"><?php echo $dataUserProfile['user_profile'][0]['job_title'] ?></li>
                                    <li class="flex items-center gap-2">
                                        <i data-lucide="calendar"></i> 
                                        Member Since, <?php echo date('F d, Y', strtotime ($dataUserProfile['user_profile'][0]['created_at'])) ?>
                                    </li>
                                </ul>
                            </div>
                            <div class="btn-box">
                                <a class="theme-btn btn-style-one" href="<?php echo htmlspecialchars($dataUserProfile['cvs'][0]['path']) ?>" download="" target="_blank" data-text="Download CV">
                                    Download CV
                                </a>
                                <button class="bookmark-btn" data-text="Guardar en favoritos"><i data-lucide="bookmark"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="candidate-detail-outer">
                <div class="auto-container">
                    <div class="row">
                        <div class="content-column col-lg-8 col-md-12 col-sm-12">
                            <div class="job-detail">
                                <h2 class="title font-bold text-2xl mb-4">Sobre <?php echo $dataUserProfile['user_profile'][0]['full_name'] ?></h2>
                                <div class="description mb-4">
                                    <?php echo $dataUserProfile['user_profile'][0]['description_profile'] ?>
                                </div>
                                <h2 class="title font-bold text-2xl mb-4">Resumen de experiencia</h2>
                                <div class="description mb-4">
                                    <?php echo $dataUserProfile['user_profile'][0]['description'] ?>
                                </div>                                
                                <div class="resume-outer">
                                    <div class="education">
                                        <div class="upper-title">
                                            <h3 class="title font-bold text-lg mb-4">Educación</h3>
                                        </div>
                                        <?php foreach ($dataUserProfile['education'] as $education) { ?>
                                        <div class="resume-block">
                                            <div class="inner">
                                                <span class="name"><?php echo ucfirst(substr($education['institution'], 0, 1)) ?></span>
                                                <div class="title-box">
                                                    <div class="info-box">
                                                        <h3><?php echo $education['degree'] ?></h3>
                                                        <span><?php echo $education['institution'] ?></span>
                                                    </div>
                                                    <div class="edit-box">
                                                        <span class="year"><?php echo $education['start_year'] ?> - <?php echo $education['end_year'] ?></span>
                                                    </div>
                                                </div>
                                                <div class="text">
                                                    <?php echo $education['description'] ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } 
                                        if (empty($dataUserProfile['education'])) {
                                            echo '<div class="resume-block"><div class="inner"><div class="title-box"><div class="info-box"><h3>No education</h3></div></div></div></div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="resume-outer theme-blue">
                                    <div class="experience">
                                        <div class="upper-title">
                                            <h3 class="title font-bold text-lg mb-4">Experiencia</h3>
                                        </div>
                                        <?php foreach ($dataUserProfile['experience'] as $experience) { ?>
                                        <div class="resume-block">
                                            <div class="inner">
                                                <span class="name"><?php echo ucfirst(substr($experience['company'], 0, 1)) ?></span>
                                                <div class="title-box">
                                                    <div class="info-box">
                                                        <h3><?php echo $experience['jobTitle'] ?></h3>
                                                        <span><?php echo $experience['company'] ?></span>
                                                    </div>
                                                    <div class="edit-box">
                                                        <span class="year"><?php echo $experience['startDate'] ?> - <?php echo $experience['endDate'] ?></span>
                                                    </div>
                                                </div>
                                                <div class="text">
                                                    <?php echo $experience['description'] ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } 
                                            if (empty($dataUserProfile['experience'])) {
                                                echo '<div class="resume-block"><div class="inner"><div class="title-box"><div class="info-box"><h3>No experience</h3></div></div></div></div>';
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="resume-outer theme-yellow">
                                    <div class="awards">
                                        <div class="upper-title">
                                            <h3 class="title font-bold text-lg mb-4">Premios</h3>
                                        </div>
                                        <?php foreach ($dataUserProfile['awards'] as $award) { ?>
                                        <div class="resume-block">
                                            <div class="inner">
                                                <span class="name"><?php echo ucfirst(substr($award['title'], 0, 1)) ?></span>
                                                <div class="title-box">
                                                    <div class="info-box">
                                                        <h3><?php echo $award['title'] ?></h3>
                                                        <span><?php echo $award['organization'] ?></span>
                                                    </div>
                                                    <div class="edit-box">
                                                        <span class="year"><?php echo $award['year'] ?></span>
                                                    </div>
                                                </div>
                                                <div class="text">
                                                    <?php echo $award['description'] ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } 
                                            if (empty($dataUserProfile['awards'])) {
                                                echo '<div class="resume-block"><div class="inner"><div class="title-box"><div class="info-box"><h3>No awards</h3></div></div></div></div>';
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-column col-lg-4 col-md-12 col-sm-12">
                            <aside class="sidebar">
                                <div class="sidebar-widget">
                                    <div class="widget-content">
                                        <ul class="job-overview">
                                            <li>
                                                <i data-lucide="calendar" class="w-5 h-5"></i>
                                                <h5>Experience:</h5>
                                                <span><?php echo $dataUserProfile['user_profile'][0]['experience'] ?> years</span>
                                            </li>
                                            <li>
                                                <i data-lucide="phone" class="w-5 h-5"></i>
                                                <h5>Phone:</h5>
                                                <span><?php echo $dataUserProfile['user_profile'][0]['phone'] ?></span>
                                            </li>
                                            <li>
                                                <i data-lucide="mail" class="w-5 h-5"></i>
                                                <h5>Email:</h5>
                                                <span><?php echo $dataUserProfile['user_profile'][0]['email_address'] ?></span>
                                            </li>
                                            <li>
                                                <i data-lucide="globe" class="w-5 h-5"></i>
                                                <h5>Website:</h5>
                                                <span><?php echo $dataUserProfile['user_profile'][0]['website'] ?></span>
                                            </li>
                                            <li>
                                                <i data-lucide="briefcase" class="w-5 h-5"></i>
                                                <h5>Job Title:</h5>
                                                <span><?php echo $dataUserProfile['user_profile'][0]['job_title'] ?></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="sidebar-widget social-media-widget">
                                    <h5 class="font-bold" data-translate-es="Redes sociales" data-translate-en="Social media">Social media</h5>
                                    <div class="widget-content">
                                        <div class="social-links">
                                            <div class="social-links">
                                                <a href="<?php echo $dataUserProfile['user_profile'][0]['facebook'] ?>" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a>
                                                <a href="<?php echo $dataUserProfile['user_profile'][0]['twitter'] ?>" target="_blank" rel="noopener noreferrer"><i class="fab fa-twitter"></i></a>
                                                <a href="<?php echo $dataUserProfile['user_profile'][0]['linkedin'] ?>" target="_blank" rel="noopener noreferrer"><i class="fab fa-linkedin-in"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="sidebar-widget">
                                    <h4 class="font-bold">Professional Skills</h4>
                                    <div class="widget-content">
                                        <ul class="job-skills mt-8">
                                            <?php foreach ($dataUserProfile['skills'] as $skill) { ?>
                                                <li class="bg-gray-200 rounded px-2 py-1 text-sm uppercase">
                                                    <?php echo $skill['name'] ?>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        </section>
    </div>
</main>

<?php include_once 'views/company/footer.php'; ?>
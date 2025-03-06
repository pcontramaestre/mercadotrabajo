<?php
include_once 'config/config.php';
include_once 'views/candidate/header.php';
?>
<section class="user-dashboard">
    <div class="dashboard-outer">
        <div class="upper-title-box">
            <h3>Shortlisted jobs!</h3>
            <div class="text">Ready to jump back in?</div>
        </div>
        <div class="mb-4 ms-0 show-1023"><button type="button" class="theme-btn toggle-filters"><span class="flaticon-menu-1"></span> Menu</button></div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ls-widget">
                    <div class="tabs-box">
                        <div class="widget-title">
                            <h4>My Favorite Jobs</h4>
                            <div class="chosen-outer"><select class="chosen-single form-select">
                                    <option>Last 6 Months</option>
                                    <option>Last 12 Months</option>
                                    <option>Last 16 Months</option>
                                    <option>Last 24 Months</option>
                                    <option>Last 5 year</option>
                                </select></div>
                        </div>
                        <div class="widget-content">
                            <div class="table-outer">
                                <div class="table-outer">
                                    <table class="default-table manage-job-table">
                                        <thead>
                                            <tr>
                                                <th>Job Title</th>
                                                <th>Date Applied</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="job-block">
                                                        <div class="inner-box">
                                                            <div class="content"><span class="company-logo"><img alt="logo" loading="lazy" width="48" height="48" decoding="async" data-nimg="1" srcset="/_next/image?url=%2Fimages%2Fresource%2Fcompany-logo%2F1-3.png&amp;w=48&amp;q=75 1x, /_next/image?url=%2Fimages%2Fresource%2Fcompany-logo%2F1-3.png&amp;w=96&amp;q=75 2x" src="/_next/image?url=%2Fimages%2Fresource%2Fcompany-logo%2F1-3.png&amp;w=96&amp;q=75" style="color: transparent;"></span>
                                                                <h4><a href="/job-single-v3/9">Product Manager, Studio</a></h4>
                                                                <ul class="job-info">
                                                                    <li><span class="icon flaticon-briefcase"></span>Segment</li>
                                                                    <li><span class="icon flaticon-map-locator"></span>London, UK</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Dec 5, 2020</td>
                                                <td class="status">Active</td>
                                                <td>
                                                    <div class="option-box">
                                                        <ul class="option-list">
                                                            <li><button data-text="View Aplication"><span class="la la-eye"></span></button></li>
                                                            <li><button data-text="Delete Aplication"><span class="la la-trash"></span></button></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="job-block">
                                                        <div class="inner-box">
                                                            <div class="content"><span class="company-logo"><img alt="logo" loading="lazy" width="48" height="48" decoding="async" data-nimg="1" srcset="/_next/image?url=%2Fimages%2Fresource%2Fcompany-logo%2F1-6.png&amp;w=48&amp;q=75 1x, /_next/image?url=%2Fimages%2Fresource%2Fcompany-logo%2F1-6.png&amp;w=96&amp;q=75 2x" src="/_next/image?url=%2Fimages%2Fresource%2Fcompany-logo%2F1-6.png&amp;w=96&amp;q=75" style="color: transparent;"></span>
                                                                <h4><a href="/job-single-v3/10">Web Developer</a></h4>
                                                                <ul class="job-info">
                                                                    <li><span class="icon flaticon-briefcase"></span>Segment</li>
                                                                    <li><span class="icon flaticon-map-locator"></span>London, UK</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Dec 5, 2020</td>
                                                <td class="status">Active</td>
                                                <td>
                                                    <div class="option-box">
                                                        <ul class="option-list">
                                                            <li><button data-text="View Aplication"><span class="la la-eye"></span></button></li>
                                                            <li><button data-text="Delete Aplication"><span class="la la-trash"></span></button></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="job-block">
                                                        <div class="inner-box">
                                                            <div class="content"><span class="company-logo"><img alt="logo" loading="lazy" width="48" height="48" decoding="async" data-nimg="1" srcset="/_next/image?url=%2Fimages%2Fresource%2Fcompany-logo%2F1-4.png&amp;w=48&amp;q=75 1x, /_next/image?url=%2Fimages%2Fresource%2Fcompany-logo%2F1-4.png&amp;w=96&amp;q=75 2x" src="/_next/image?url=%2Fimages%2Fresource%2Fcompany-logo%2F1-4.png&amp;w=96&amp;q=75" style="color: transparent;"></span>
                                                                <h4><a href="/job-single-v3/11">Senior Product Designer</a></h4>
                                                                <ul class="job-info">
                                                                    <li><span class="icon flaticon-briefcase"></span>Segment</li>
                                                                    <li><span class="icon flaticon-map-locator"></span>London, UK</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Dec 5, 2020</td>
                                                <td class="status">Active</td>
                                                <td>
                                                    <div class="option-box">
                                                        <ul class="option-list">
                                                            <li><button data-text="View Aplication"><span class="la la-eye"></span></button></li>
                                                            <li><button data-text="Delete Aplication"><span class="la la-trash"></span></button></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="job-block">
                                                        <div class="inner-box">
                                                            <div class="content"><span class="company-logo"><img alt="logo" loading="lazy" width="48" height="48" decoding="async" data-nimg="1" srcset="/_next/image?url=%2Fimages%2Fresource%2Fcompany-logo%2F2-1.png&amp;w=48&amp;q=75 1x, /_next/image?url=%2Fimages%2Fresource%2Fcompany-logo%2F2-1.png&amp;w=96&amp;q=75 2x" src="/_next/image?url=%2Fimages%2Fresource%2Fcompany-logo%2F2-1.png&amp;w=96&amp;q=75" style="color: transparent;"></span>
                                                                <h4><a href="/job-single-v3/12">Software Engineer</a></h4>
                                                                <ul class="job-info">
                                                                    <li><span class="icon flaticon-briefcase"></span>Segment</li>
                                                                    <li><span class="icon flaticon-map-locator"></span>London, UK</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Dec 5, 2020</td>
                                                <td class="status">Active</td>
                                                <td>
                                                    <div class="option-box">
                                                        <ul class="option-list">
                                                            <li><button data-text="View Aplication"><span class="la la-eye"></span></button></li>
                                                            <li><button data-text="Delete Aplication"><span class="la la-trash"></span></button></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include_once 'views/candidate/footer.php';
?>
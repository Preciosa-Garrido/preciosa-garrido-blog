<?php get_header(); ?>
    <style>
        <?php if(get_the_post_thumbnail()) { ?>
            .blog_banner .banner_inner .overlay {
                background: url("<?php the_post_thumbnail_url() ?>") no-repeat scroll center center;
                background-size: cover;
            }
        <?php } else { ?>
            .blog_banner .banner_inner .overlay {
                background: url("<?php bloginfo('template_directory') ?>/img/banner/banner-2.jpg") no-repeat scroll center center;
            }
        <?php } ?>
    </style>


    <!--================Home Banner Area =================-->
    <section class="banner_area" style="margin-top: -50px">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content text-center">
                    <h2>Blog</h2>
                    <div class="page_link">
                        <a href="preciosa.ces">Página inicial</a>
                        <a href="">Detalhes do Blog</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Blog Area =================-->
    <section class="blog_area mt-25">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog_left_sidebar">
                        <?php query_posts('post_type=post&post_per_page=2'); ?>
                        <?php if(have_posts()){ ?>
                            <?php while(have_posts()): the_post(); ?>
                                <article class="row blog_item">
                                    <div class="col-md-3">
                                        <div class="blog_info text-right">
                                            <div class="post_tag">
                                                <a href="#">Food,</a>
                                                <a class="active" href="#">Technology,</a>
                                                <a href="#">Politics,</a>
                                                <a href="#">Lifestyle</a>
                                            </div>
                                            <ul class="blog_meta list">
                                                <li>
                                                    <a href="#">Mark wiens
                                                        <i class="lnr lnr-user"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#"><?php the_weekday().' '.the_date() ?>
                                                        <i class="lnr lnr-calendar-full"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">1.2M Views
                                                        <i class="lnr lnr-eye"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">06 Comments
                                                        <i class="lnr lnr-bubble"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="blog_post">
                                            <img src="<?php the_post_thumbnail_url(); ?>" alt="Imagem do post" />
                                            <div class="blog_details">
                                                <a href="<?php the_permalink() ?>">
                                                    <h2><?php the_title() ?></h2>
                                                </a>
                                                <p><?php the_content() ?></p>
                                                <a href="<?php the_permalink() ?>" class="white_bg_btn">Ver mais</a>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            <?php endwhile ?>
                        <?php } else { ?>
                            Ainda não há posts
                        <?php } ?>
                        <?php wp_reset_query(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->

<?php get_footer(); ?>
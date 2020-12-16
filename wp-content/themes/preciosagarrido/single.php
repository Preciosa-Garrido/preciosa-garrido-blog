<?php get_header() ?>

    <!--================Blog Area =================-->
    <section class="blog_area single-post-area p_120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post row">
                    	<?php /*query_posts('post_type=post');*/ ?>
                    	<?php if(have_posts()):  the_post() ?>
	                        <div class="col-lg-12">
	                            <div class="feature-img">
	                                <img class="img-fluid" src="<?php the_post_thumbnail_url() ?>" alt="">
	                            </div>
	                        </div>
	                        <div class="col-lg-3  col-md-3">
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
	                                        <a href="#">12 Dec, 2017
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
	                                <ul class="social-links">
	                                    <li>
	                                        <a href="#">
	                                            <i class="fa fa-facebook"></i>
	                                        </a>
	                                    </li>
	                                    <li>
	                                        <a href="#">
	                                            <i class="fa fa-twitter"></i>
	                                        </a>
	                                    </li>
	                                    <li>
	                                        <a href="#">
	                                            <i class="fa fa-github"></i>
	                                        </a>
	                                    </li>
	                                    <li>
	                                        <a href="#">
	                                            <i class="fa fa-behance"></i>
	                                        </a>
	                                    </li>
	                                </ul>
	                            </div>
	                        </div>
	                        <div class="col-lg-9 col-md-9 blog_details">
	                            <h2><?php the_title() ?></h2>
	                            <p class="excert">
	                                <?php the_content() ?>
	                            </p>
	                        </div>
	                    <?php endif; ?>
                    </div>
                    
                    <div class="comments-area">
                        <h4>Comentários</h4>
                        <?php query_posts('post_type=posts'); ?>
                        <?php var_dump(query_posts('post_type=comments')) ?>
                            <div class="comment-list">
                                <div class="single-comment justify-content-between d-flex">
                                    <div class="user justify-content-between d-flex">
                                        <div class="thumb">
                                            <img src="<?php bloginfo('template_directory') ?>/img/blog/c1.jpg" alt="">
                                        </div>
                                        <div class="desc">
                                            <h5>
                                                <a href="#">Emilly Blunt</a>
                                            </h5>
                                            <p class="date">December 4, 2017 at 3:12 pm </p>
                                            <p class="comment">
                                                Never say goodbye till the end comes!
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php wp_reset_query() ?>
                    </div>
                    <div class="comment-form">
                        <h4>Deixe seu comentário</h4>
                        <form>
                            <div class="form-group form-inline">
                                <div class="form-group col-lg-6 col-md-6 name">
                                    <input type="text" class="form-control" id="name" placeholder="Enter Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Name'">
                                </div>
                                <div class="form-group col-lg-6 col-md-6 email">
                                    <input type="email" class="form-control" id="email" placeholder="Enter email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="subject" placeholder="Subject" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Subject'">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control mb-10" rows="5" name="message" placeholder="Messege" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'"
                                    required=""></textarea>
                            </div>
                            <a href="#" class="primary-btn submit_btn">Post Comment</a>
                        </form>
                    </div>
                </div>
                    <?php get_sidebar() ?>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->

<?php get_footer() ?>
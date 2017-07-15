 <?php
/**
 * Makr Theme: Blog, front page
 * @package WordPress
 * @subpackage Makr Theme
 * @since 1.0
 */
	get_header();
 ?>
 
<!-- Header Image -->
<?php if (get_header_image() != '') : ?>

<div class="header_image_container"> <img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php echo get_bloginfo('name'); ?>" class="header_image" />
  <div class="headerWelcome">
    <h1>
      <?php bloginfo('name'); ?>
    </h1>
    <h2><a href="#" class="readTheBlogBtn"><?php esc_html_e( 'Read the blog', 'makr' );?></a></h2>
  </div>
</div>
<?php endif;?>
<!-- Header Image End --> 

<!-- blog content -->
<div class="row blogPosts <?php echo (isset($hgr_options['blog_color_scheme']) ? $hgr_options['blog_color_scheme'] : '');?>" id="blogPosts">
  <div class="container"> 
    <!-- posts -->
    <div class="vc_col-md-9 vc_col-sm-12 vc_col-xs-12">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <?php 
	  	$format = get_post_format();
	  ?>
      <div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
        <?php 
			if ( has_post_thumbnail() ) {
			  the_post_thumbnail('full', array('class' => 'img-responsive'));
			} 
		 ?>
        <?php if($format != 'aside') : ?>
        <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php esc_html_e('Permanent Link to', 'makr');?> <?php the_title_attribute(); ?>">
          <?php the_title(); ?>
          </a></h1>
        <?php endif;?>
        <small> <span class="highlight"><i class="icon blog-date"></i>
        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php esc_html_e('Permanent Link to', 'makr');?> <?php the_title_attribute(); ?>"><?php the_time('F jS, Y') ?></a>
        </span> <span class="highlight"><i class="icon blog-user"></i>
        <?php esc_html_e('Posted by ', 'makr');?>
        <?php the_author_posts_link() ?>
        </span> <span class="highlight"><i class="icon blog-category"></i>
        <?php the_category(', '); ?>
        </span> <span class="highlight"><i class="icon blog-comments"></i>
        <?php
			$comments_number = get_comments_number();
			if ( 1 === $comments_number ) {
				/* translators: %s: post title */
				printf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'makr' ), get_the_title() );
			} else {
				printf(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s thought on &ldquo;%2$s&rdquo;',
						'%1$s thoughts on &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'makr'
					),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			}
		?>
        </span> </small>
        <div class="entry">
          <?php if(has_excerpt()) : ?>
          <?php the_excerpt(); ?>
          <?php else : ?>
          <?php the_content(); ?>
          <?php endif;?>
        </div>
        <div class="entry-meta">
          <?php the_tags(); ?>
        </div>
      </div>
      
      <?php endwhile; ?>
      
	<?php
		$prev_link = get_previous_posts_link( esc_html__('&larr; Previous', 'makr') );
		$next_link = get_next_posts_link( esc_html__('Next &rarr;', 'makr') );
		if ($prev_link || $next_link) : ?>
		  <div class="navigation">
			<div class="alignleft">
			  <?php echo( !empty($prev_link) ? $prev_link : '' ); ?>
			</div>
			<div class="alignright">
			  <?php echo ( !empty($next_link) ? $next_link : ''); ?>
			</div>
		  </div>
	<?php endif;?>

      
      
      <?php else: ?>
      <p>
        <?php esc_html_e('Sorry, no posts matched your criteria.', 'makr'); ?>
      </p>
      <?php endif; ?>
      <?php wp_reset_postdata();?>
    </div>
    <!-- / posts --> 
    
    <!-- sidebar -->
    <div class="vc_col-md-3 vc_col-sm-12 vc_col-xs-12">
      <?php 
		get_sidebar();
	 ?>
    </div>
    <!-- / sidebar --> 
  </div>
</div>
<!-- blog content end -->

 <?php 
 	get_footer();
 ?>
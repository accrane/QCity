<div class="small-post-sponsored"> 
     <a href="<?php the_permalink(); ?>">
        <div class="small-post-thumb">
        <?php if ( has_post_thumbnail() ) {
                        the_post_thumbnail('thumbnail');
                        
                    } ?>
        </div><!-- small post thumb -->
        <div class="small-post-content">
            <h3>Sponsored Content</h3>
            <div class="clear"></div>
            <h2><?php the_title(); ?></h2>
        </div><!-- small post content -->
        </a>
</div><!-- small post sponsored --> 
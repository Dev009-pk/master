<?php
/**
* Template Name: Promo
*/
get_header(); ?>
<style>
.proj {width: 31%!important;float: left;}
.proj.develop-box {border: 1px solid gainsboro;margin: 10px 15px 15px 10px;box-shadow: rgb(17 17 26 / 5%) 0px 1px 0px, rgb(17 17 26 / 10%) 0px 0px 8px;}
.proj.develop-box .develop-image a img {max-height: 433px;object-fit: cover;}
.pagination {line-height:13px; margin: 0 auto;padding-bottom: 25px;display: table;}
.pagination span, .pagination a {display:block;float:left;margin: 2px 2px 2px 0;padding:6px 9px 5px 9px;text-decoration:none;width:auto;color:#fff;background: #555;-webkit-transition: background .15s ease-in-out;-moz-transition: background .15s ease-in-out;-ms-transition: background .15s ease-in-out;-o-transition: background .15s ease-in-out;transition: background .15s ease-in-out;}
.pagination a:hover{color:#fff;background: #6AAC70;}
.pagination .current{padding:6px 9px 5px 9px;background: #6AAC70;color:#fff;}
</style>
<div id="content">
    <div id="contentwide">
        <div class="postarea_wide">
            <?php
            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $args = array(
                'posts_per_page' => 3,
                'post_type' => 'promo',
                'paged' => $paged
            );
            $custom_query = new WP_Query( $args );
            while($custom_query->have_posts()) {
                $custom_query->the_post(); ?>
                <div class="proj develop-box">
                    <div class="develop-underbox">
                        <div class="develop-title"><h3 class="smNew"><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h3>
                        </div>
                        <div class="develop-uei"><a href="<?php the_permalink(); ?>">View</a></div>
                    </div>
                    <div class="develop-image">
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a>
                    </div>
                </div>
            </div>
            <?php       
			/*Break Row for post after 3 coloum*/
             if(($query->current_post+1)%3 == 0){ 
                 echo '<div class="clear" style="clear:left"></div>';
             }
            ?>
            <?php
        }    
        ?>
    </div>
</div>
</div>
<?php 
if (function_exists("pagination")) {
    pagination($custom_query->max_num_pages);
} 
?>
<?php get_footer(); ?>


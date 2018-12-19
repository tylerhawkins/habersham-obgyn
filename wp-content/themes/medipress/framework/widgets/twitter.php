<?php

include_once 'TwitterAPP/Config.php';
include_once 'TwitterAPP/Response.php';
include_once 'TwitterAPP/SignatureMethod.php';
include_once 'TwitterAPP/HmacSha1.php';
include_once 'TwitterAPP/Consumer.php';
include_once 'TwitterAPP/Token.php';
include_once 'TwitterAPP/Request.php';

include_once 'TwitterAPP/Util.php';
include_once 'TwitterAPP/Util/JsonDecoder.php';
require_once 'TwitterAPP/TwitterOAuth.php';

add_action('widgets_init', 'jws_theme_twitter_load_widgets');

function jws_theme_twitter_load_widgets()
{
    register_widget('Jws_Theme_Tweets_Widget');
}

class Jws_Theme_Tweets_Widget extends WP_Widget {

    function Jws_Theme_Tweets_Widget()
    {
        $widget_ops = array('classname' => 'tweets', 'description' => '');

        $control_ops = array('id_base' => 'ro-tweets-widget');

        parent::__construct('ro-tweets-widget', __('Twitter', 'medipress'), $widget_ops, $control_ops);
    }

    function widget($args, $instance)
    {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $consumer_key = $instance['consumer_key'];
        $consumer_secret = $instance['consumer_secret'];
        $access_token = $instance['access_token'];
        $access_token_secret = $instance['access_token_secret'];
        $count = (int) $instance['count'];

        echo balanceTags($before_widget);

        if($title) {
            echo balanceTags($before_title.$title.$after_title);
        }

        if($consumer_key && $consumer_secret && $access_token && $access_token_secret && $count) {
			
			$connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);

			$twitter = $connection->get('statuses/user_timeline', array('count' => $count));
            if($twitter && is_array($twitter)) {
                ?>
				<div class="jws-theme-twitter-widget">
					<ul>
						<?php foreach($twitter as $tweet):
							$tweet = (array) $tweet;
							if( ! empty( $tweet ) ):
							$the_tweet = $tweet['text'];
							
							
							// i. User_mentions must link to the mentioned user's profile.
					        $tweet['entities'] = (array)$tweet['entities'];
					        if(is_array($tweet['entities']['user_mentions'])){
					            foreach($tweet['entities']['user_mentions'] as $key => $user_mention){
					            	$user_mention = (array) $user_mention;
					                $the_tweet = preg_replace(
					                    '/@'.$user_mention['screen_name'].'/i',
					                    '<a href="http://www.twitter.com/'.$user_mention['screen_name'].'" target="_blank">@'.$user_mention['screen_name'].'</a>',
					                    $the_tweet);
					            }
					        }

					        // ii. Hashtags must link to a twitter.com search with the hashtag as the query.
					        if(is_array($tweet['entities']['hashtags'])){
					            foreach($tweet['entities']['hashtags'] as $key => $hashtag){
					            	$hashtag = (array) $hashtag;
					                $the_tweet = preg_replace(
					                    '/#'.$hashtag['text'].'/i',
					                    '<a href="https://twitter.com/search?q=%23'.$hashtag['text'].'&src=hash" target="_blank">#'.$hashtag['text'].'</a>',
					                    $the_tweet);
					            }
					        }

					        // iii. Links in Tweet text must be displayed using the display_url
					        //      field in the URL entities API response, and link to the original t.co url field.
					        if(is_array($tweet['entities']['urls'])){
					            foreach($tweet['entities']['urls'] as $key => $link){
					            	$link = (array) $link;
					                $the_tweet = preg_replace(
					                    '`'.$link['url'].'`',
					                    '<a href="'.$link['url'].'" target="_blank">'.$link['url'].'</a>',
					                    $the_tweet);
					            }
					        }
							$tweet['user'] = (array) $tweet['user'];
							?>
							<li class="jws-theme-tweet">
								
								<div class="jws-theme-image">
									<i class="fa fa-twitter"></i>
								</div>
								<div class="jws-theme-content">
									<div class="jws-theme-tweet-text">
										<?php //echo '<span class="jws-theme-name">@'.esc_attr( $tweet['user']['name']).': </span>';
											echo $the_tweet; ?>
									</div>
									<div class="jws-theme-tweet-meta">
										<span class="jws-theme-name"><?php echo human_time_diff( strtotime($tweet['created_at']. '- 8 hours') ) . esc_html__(' ago','medipress');?></span>
									</div>
								</div>
							</li>
						<?php endif; endforeach; ?>
					</ul>
				</div>
            <?php }
        }

        echo balanceTags($after_widget);
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['consumer_key'] = $new_instance['consumer_key'];
        $instance['consumer_secret'] = $new_instance['consumer_secret'];
        $instance['access_token'] = $new_instance['access_token'];
        $instance['access_token_secret'] = $new_instance['access_token_secret'];
        $instance['count'] = $new_instance['count'];

        return $instance;
    }

    function form($instance)
    {
        $defaults = array('title' => 'Twitter Feeds', 'twitter_id' => '', 'count' => 3, 'consumer_key' => '', 'consumer_secret' => '', 'access_token' => '', 'access_token_secret' => '');
        $instance = wp_parse_args((array) $instance, $defaults); ?>

        <p><a href="<?php echo esc_url("http://dev.twitter.com/apps"); ?>">Find or Create your Twitter App</a></p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title:</label>
            <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('consumer_key')); ?>">Consumer Key:</label>
            <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('consumer_key')); ?>" name="<?php echo esc_attr($this->get_field_name('consumer_key')); ?>" value="<?php echo esc_attr($instance['consumer_key']); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('consumer_secret')); ?>">Consumer Secret:</label>
            <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('consumer_secret')); ?>" name="<?php echo esc_attr($this->get_field_name('consumer_secret')); ?>" value="<?php echo esc_attr($instance['consumer_secret']); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('access_token')); ?>">Access Token:</label>
            <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('access_token')); ?>" name="<?php echo esc_attr($this->get_field_name('access_token')); ?>" value="<?php echo esc_attr($instance['access_token']); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('access_token_secret')); ?>">Access Token Secret:</label>
            <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('access_token_secret')); ?>" name="<?php echo esc_attr($this->get_field_name('access_token_secret')); ?>" value="<?php echo esc_attr($instance['access_token_secret']); ?>" />
        </p>
		
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('count')); ?>">Number of Tweets:</label>
            <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>" value="<?php echo esc_attr($instance['count']); ?>" />
        </p>

    <?php
    }
}
?>
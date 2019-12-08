<?php
/**
 * Plugin Name: Post/Page specific custom CSS
 * Plugin URI: https://wordpress.org/plugins/postpage-specific-custom-css/
 * Description: Post/Page specific custom CSS will allow you to add cascade stylesheet to specific posts/pages. It will give you special area in the post/page edit field to attach your CSS. It will also let you decide if this CSS has to be added in multi-page/post view (like archive posts) or only in a single view.
 * Version: 0.1.4
 * Author: Łukasz Nowicki
 * Author URI: https://lukasznowicki.info/
 * Requires at least: 4.7
 * Tested up to: 4.9.6
 * Text Domain: phylaxppsccss
 * Domain Path: /languages
 */

namespace Phylax\WPPlugin\PPCustomCSS;

if ( ! defined( 'ABSPATH' ) ) {
	die;
} # famous cheatin', huh?

class Plugin {

	function __construct() {
		add_action( 'init', [
			$this,
			'init',
		] );
		add_filter( 'the_content', [
			$this,
			'the_content',
		] );
		if ( is_admin() ) {
			add_action( 'add_meta_boxes', [
				$this,
				'add_meta_boxes',
			] );
			add_action( 'save_post', [
				$this,
				'save_post',
			] );
		}
	}

	function the_content( $content ) {
		if ( isset( $GLOBALS['post'] ) ) {
			$post_id                    = $GLOBALS['post']->ID;
			$phylax_ppsccss_single_only = get_post_meta( $post_id, '_phylax_ppsccss_single_only', true );
			$phylax_ppsccss_css         = get_post_meta( $post_id, '_phylax_ppsccss_css', true );
			if ( '' != $phylax_ppsccss_css ) {
				# mamy css!
				if ( is_single() || is_page() ) {
					$content = $this->join( $content, $phylax_ppsccss_css );
				} elseif ( '0' == $phylax_ppsccss_single_only ) {
					$content = $this->join( $content, $phylax_ppsccss_css );
				}
			}
		}

		return $content;
	}

	function join( $content, $css ) {
		return '<!-- ' . __( 'Added by Post/Page specific custom CSS plugin, thank you for using!', 'phylaxppsccss' ) . ' -->' . PHP_EOL . '<style type="text/css">' . $css . '</style>' . PHP_EOL . $content;
	}

	function add_meta_boxes() {
		if ( current_user_can( 'manage_options' ) ) {
			add_meta_box( 'phylax_ppsccss', __( 'Custom CSS', 'phylaxppsccss' ), [
					$this,
					'render_phylax_ppsccss',
				], [
					'post',
					'page',
				], 'advanced', 'high' );
		}
	}

	function save_post( $post_id ) {
	    $test_id = (int)$post_id;
	    if ( $test_id < 1 ) {
	        return $post_id;
        }
		if ( ! isset( $_POST['phylax_ppsccss_nonce'] ) ) {
			return $post_id;
		}
		$nonce = $_POST['phylax_ppsccss_nonce'];
		if ( ! wp_verify_nonce( $nonce, 'phylax_ppsccss' ) ) {
			return $post_id;
		}
		if ( ( 'page' != $_POST['post_type'] ) && ( 'post' != $_POST['post_type'] ) ) {
			return $post_id;
		}
		if ( ( 'post' == $_POST['post_type'] ) && ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
		if ( ( 'page' == $_POST['post_type'] ) && ! current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		}
		# why not?
		#if ( defined( 'DOING_AUTOSAVE' ) && \DOING_AUTOSAVE ) {
		#	return $post_id;
		#}
		$phylax_ppsccss_css         = trim( strip_tags( $_POST['phylax_ppsccss_css'] ) );
		$phylax_ppsccss_single_only = (int) $_POST['phylax_ppsccss_single_only'];
		if ( ( $phylax_ppsccss_single_only < 0 ) || ( $phylax_ppsccss_single_only > 1 ) ) {
			$phylax_ppsccss_single_only = 0;
		}
		update_post_meta( $post_id, '_phylax_ppsccss_css', $phylax_ppsccss_css );
		update_post_meta( $post_id, '_phylax_ppsccss_single_only', $phylax_ppsccss_single_only );
	}

	function render_phylax_ppsccss( $post ) {
		wp_nonce_field( 'phylax_ppsccss', 'phylax_ppsccss_nonce' );
		$screen = '';
		switch ( $post->post_type ) {
			case 'post':
				$screen = __( 'Post custom CSS', 'phylaxppsccss' );
				break;
			case 'page':
				$screen = __( 'Page custom CSS', 'phylaxppsccss' );
				break;
		}
		if ( '' == $screen ) {
			return;
		}
		$phylax_ppsccss_css         = get_post_meta( $post->ID, '_phylax_ppsccss_css', true );
		$phylax_ppsccss_single_only = get_post_meta( $post->ID, '_phylax_ppsccss_single_only', true );
		if ( '' == $phylax_ppsccss_single_only ) {
			$phylax_ppsccss_single_only = 0;
		}
		if ( $phylax_ppsccss_single_only ) {
			$checked = ' checked="checked"';
		} else {
			$checked = '';
		}
		?>
        <p class="post-attributes-label-wrapper">
            <label for="phylax_ppsccss_css"><?php echo $screen; ?></label>
        </p>
        <textarea name="phylax_ppsccss_css" id="phylax_ppsccss_css" class="large-text code" rows="4"><?php echo $phylax_ppsccss_css; ?></textarea>
        <p class="post-attributes-label-wrapper">
            <label for="phylax_ppsccss_single_only"><input type="hidden" name="phylax_ppsccss_single_only" value="0"><input type="checkbox" name="phylax_ppsccss_single_only" value="1" id="phylax_ppsccss_single_only"<?php echo $checked; ?>> <?php echo __( 'Attach this CSS code only on single page view', 'phylaxppsccss' ); ?>
            </label>
        </p>
        <p>
			<?php
			echo __( 'Please add only valid CSS code, it will be placed between &lt;script&gt; tags.', 'phylaxppsccss' ); ?>
        </p>
		<?php
	}

	function init() {
		load_plugin_textdomain( 'phylaxppsccss', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	function text() {
		__( 'Post/Page specific custom CSS will allow you to add cascade stylesheet to specific posts/pages. It will give you special area in the post/page edit field to attach your CSS. It will also let you decide if this CSS has to be added in multi-page/post view (like archive posts) or only in a single view.', 'phylaxppsccss' );
	}

}

new Plugin();
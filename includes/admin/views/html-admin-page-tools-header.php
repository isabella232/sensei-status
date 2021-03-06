<?php
/**
 * File containing header view for the tools page.
 *
 * @package sensei-lms-status
 * @since 1.0.0
 *
 * @global Sensei_Tool_Interface $tool     Active tool, if set.
 * @global array                 $messages Messages to show user.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<?php
?>
<div class="wrap">
	<h1><?php
		esc_html_e( 'Tools', 'sensei-lms' );

		if ( ! empty( $tool ) ) {
			$back_url = admin_url( 'admin.php?page=sensei-tools' );
			?>
			<a href="<?php echo $back_url; ?>" class="button"><?php echo __( 'All Tools', 'sensei-lms-status' ); ?></a>
			<?php
		}
	?></h1>
	<?php
	if ( ! empty( $tool ) ) {
		echo '<h2>'. esc_html( $tool->get_name() ) . '</h2>';
	}

	foreach ( $messages as $message ) {
		$div_class = 'notice below-h2 ';
		if ( ! empty( $message['is_error'] ) ) {
			$div_class .= 'notice-warning';
		} else {
			$div_class .= 'notice-info';
		}

		echo '<div class="' . esc_attr( $div_class ) . '"><p>';
		echo wp_kses_post( $message['message'] );
		echo '</p></div>';
	}


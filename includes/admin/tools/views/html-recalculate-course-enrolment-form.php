<?php
/**
 * File containing course recalculation form.
 *
 * @package sensei-lms-status
 * @since 1.0.0
 *
 * @global false|WP_Post $courses List of all courses or false if too big.
 * @global string        $tool_id Tool ID for this tool.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<form method="post" action="">
	<?php wp_nonce_field( Sensei_Tool_Recalculate_Course_Enrolment::NONCE_ACTION, '_wpnonce', false ); ?>
	<input type="hidden" name="page" value="sensei-tools">
	<input type="hidden" name="tool" value="<?php echo esc_attr( $tool_id ); ?>">
	<table class="form-table" role="presentation">
		<tr class="form-field form-required">
			<th scope="row"><label for="course_id"><?php esc_html_e( 'Course', 'sensei-lms-status' ); ?> <span class="description">(<?php esc_html_e( 'Required', 'sensei-lms-status' ); ?>)</span></label></th>
			<td>
			<?php
			$course_value = isset( $_GET['course_id'] ) ? intval( $_GET['course_id'] ) : null;
			if ( $courses) {
				?>
				<select name="course_id" id="course_id" class="input">
					<option value="""></option>
					<?php
					foreach ( $courses as $course ) {
						echo '<option value="' . intval( $course->ID ) . '"';
						if ( $course_value === $course->ID ) {
							echo ' selected="selected"';
						}
						echo '>';
						echo esc_html( $course->post_title ) .' (' . intval( $course->ID ) . ')';
						echo '</option>';
					}
					?>
				</select>
				<?php
			} else {
				echo '<input type="number" name="course_id" class="input" value="' . esc_attr( $course_value ) . '" size="20" placeholder="' . esc_attr__( 'Course ID', 'sensei-lms-status' ) . '">';
			}
			?>
			</td>
		</tr>
	</table>
	<p class="submit">
		<input type="submit" class="button button-primary" name="submit" value="<?php esc_attr_e( 'Trigger Course Enrollment Recalculation', 'sensei-lms-status' ); ?>" />
	</p>
</form>

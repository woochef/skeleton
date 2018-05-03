<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

final class WCSkeleton_Admin {
	public function action_index() {
		?>
		<div class="wrap woocommerce">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<?php
			if ( isset( $_GET['action'] ) && 'view' === $_GET['action'] && $_GET['item'] ) {
				$list_table = new WCSkeleton_MySQL_Record_List_Table( $_GET['item'] );
				$list_table->prepare_items();
				$list_table->display();
			} else {
				$list_table = new WCSkeleton_MySQL_Table_List_Table();
				$list_table->prepare_items();
				$list_table->display();
			}
			?>
		</div>
		<?php
	}
}

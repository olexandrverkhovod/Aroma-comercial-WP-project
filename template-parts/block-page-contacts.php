<?php
/**
 * Block Name: Page contacts
 *
 * This is the template that displays the equipment overview block.
 */

$options = get_fields( 'options' );

$page_contacts_address = ( isset( $options['contacts_on_page']['page_contact_address'] ) ) ? $options['contacts_on_page']['page_contact_address'] : null;
$page_contacts_time    = ( isset( $options['contacts_on_page']['page_contact_time'] ) ) ? $options['contacts_on_page']['page_contact_time'] : null;
$page_contacts_email   = ( isset( $options['contacts_on_page']['page_contact_email'] ) ) ? $options['contacts_on_page']['page_contact_email'] : null;

$page_contacts_phones  = ( isset( $options['contacts_on_page']['page_contact_phones'] ) ) ? $options['contacts_on_page']['page_contact_phones'] : null;
$page_contacts_phones_arr = explode( ',', $page_contacts_phones );

?>

<div id="page-contacts" class="page-contacts">
    <div class="page-contacts__wrapper">
					<div class="page-contacts__address-wrapper">
						<?php
							if ( ! empty( $page_contacts_address ) ) {
								echo '<p class="page-contacts__address">' . $page_contacts_address . '</p>';
							}
						?>
					</div>
					<div class="page-contacts__phones-wrapper">
						<?php
							if ( ! empty( $page_contacts_phones_arr ) ) {
								foreach ( $page_contacts_phones_arr as $phone ) {
									echo '<a class="page-contacts__phones" href="tel:' . str_replace( ' ', '', $phone ) . '">' . $phone . '</a>';
								}
							}
						?>
					</div>
					<div class="page-contacts__times-wrapper">
						<?php
							if ( ! empty( $page_contacts_time ) ) {
								echo '<p class="page-contacts__time" >' . $page_contacts_time . '</p>';
							}
						?>
					</div>
					<div class="page-contacts__email-wrapper">
						<?php
							if ( ! empty( $page_contacts_email ) ) {
								echo '<a class="page-contacts__email" href="mailto:' . $page_contacts_email . '">' . $page_contacts_email . '</a>';
							}
						?>
					</div>
				</div>
</div>
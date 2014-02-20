<?php


class Event {

    function __construct(){
        global $wpdb;
        $wpdb -> tbl_event = $wpdb -> prefix.'event';
        $wpdb -> tbl_depenses = $wpdb -> prefix.'depenses';
        $wpdb -> tbl_repartitions = $wpdb -> prefix.'repartitions';
    }

    public function install() {
        global $wpdb;

        return  new WP_Error('broke', __("I've fallen and can't get up"));

        $charset_collate = '';
        if ( version_compare(mysql_get_server_info(), '4.1.0', '>=') ) {
            if (!empty($wpdb->charset)) {
                $charset_collate .= " DEFAULT CHARACTER SET $wpdb->charset";
            }
            if (!empty($wpdb->collate)) {
                $charset_collate .= " COLLATE $wpdb->collate";
            }
        }
        // Create table required for plugin
        $result = $wpdb->query("
				CREATE TABLE `$wpdb->tbl_event` (
			  `event_id` int(11) NOT NULL,
			  `user_id` int(11) NOT NULL,
			  PRIMARY KEY  (`event_id`)
			) $charset_collate");


        $result_2 = $wpdb->query("
				CREATE TABLE `$wpdb->tbl_depenses` (
			  `event_id` int(11) NOT NULL,
			  `depense_id` int(11) NOT NULL,
			  `user_id_payeur` int(11) NOT NULL,
			  `montant_depense` int(11) NOT NULL default '0',
			  PRIMARY KEY  (`depense_id`)
			) $charset_collate");


        $result_3 = $wpdb->query("
				CREATE TABLE `$wpdb->tbl_repartitions` (
			  `depense_id` int(11) NOT NULL,
			  `user_id_beneficiaire` int(11) NOT NULL,
			  `cout_du` int(11) NOT NULL default '0',
			  PRIMARY KEY  (`event_id`,`user_id_beneficiaire`)
			) $charset_collate");
    }

    public function uninstall() {
        global $wpdb;
        $del_event_tbl = $wpdb->query( "DROP TABLE ".$wpdb -> tbl_event);
        $del_depenses_tbl = $wpdb->query( "DROP TABLE ".$wpdb -> tbl_depenses);
        $del_repartitions_tbl = $wpdb->query( "DROP TABLE ".$wpdb -> tbl_repartitions);
    }
}

register_activation_hook(__FILE__, array('Event','install'));
register_deactivation_hook( __FILE__, array('Event','uninstall'));


?>

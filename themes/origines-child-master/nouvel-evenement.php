<?php
/**
 *Template Name: Form create event
 *
 * Name: Origines WordPress Theme
 * GitHub URI: https://github.com/haroldparis/origines
 * Description: Origines template for pages with left-sidebar.
 * Author: Harold Paris
 * Twitter: @haroldparis
 * Author website: http://www.tribeleadr.com/
 */
?>

<?php
    acf_form_head();
    get_header();
?>

    <div id="o-wrapper" class="container">

        <div class="row">

            <div id="o-main" class="span9">

                <div id="create-event" >
                    <?php
                    $args = array(
                        'post_id' => get_the_ID(), // post id to get field groups from and save data to
                        'field_groups' => array(31), // this will find the field groups for this post (post ID's of the acf post objects)
                        'form' => true, // set this to false to prevent the <form> tag from being created
                        'form_attributes' => array( // attributes will be added to the form element
                            'id' => 'post',
                            'class' => '',
                            'action' => get_permalink( get_the_ID() ),
                            'method' => 'post',
                        ),
                        'return' => add_query_arg( 'updated', 'true', get_permalink() ), // return url
                        'html_before_fields' => '', // html inside form before fields
                        'html_after_fields' => '', // html inside form after fields
                        'submit_value' => 'Update', // value for submit field
                        'updated_message' => 'Post updated.', // default updated message. Can be false to show no message
                    );

                    $options = array(
                        'post_id' => false, // post id to get field groups from and save data to
                        'field_groups' => array(), // this will find the field groups for this post (post ID's of the acf post objects)
                        'form' => true, // set this to false to prevent the <form> tag from being created
                        'form_attributes' => array( // attributes will be added to the form element
                            'id' => 'post',
                            'class' => '',
                            'action' => '',
                            'method' => 'post',
                        ),
                        'return' => add_query_arg( 'updated', 'true', get_permalink() ), // return url
                        'html_before_fields' => '', // html inside form before fields
                        'html_after_fields' => '', // html inside form after fields
                        'submit_value' => 'Update', // value for submit field
                        'updated_message' => 'Post updated.', // default updated message. Can be false to show no message
                    );


                    acf_form( $options );
                    ?>
                </div>

            </div><!-- /#o-main -->

            <?php get_sidebar(); ?>

        </div><!-- /.row -->

    </div><!-- /#o-wrapper -->

<?php get_footer(); ?>
<?php
/**
* Customizer Custom Classes.
* @package Maintenance Works
*/

if ( ! function_exists( 'maintenance_works_sanitize_number_range' ) ) :
    function maintenance_works_sanitize_number_range( $maintenance_works_input, $maintenance_works_setting ) {
        $maintenance_works_input = absint( $maintenance_works_input );
        $maintenance_works_atts = $maintenance_works_setting->manager->get_control( $maintenance_works_setting->id )->input_attrs;
        $maintenance_works_min = ( isset( $maintenance_works_atts['min'] ) ? $maintenance_works_atts['min'] : $maintenance_works_input );
        $maintenance_works_max = ( isset( $maintenance_works_atts['max'] ) ? $maintenance_works_atts['max'] : $maintenance_works_input );
        $maintenance_works_step = ( isset( $maintenance_works_atts['step'] ) ? $maintenance_works_atts['step'] : 1 );
        return ( $maintenance_works_min <= $maintenance_works_input && $maintenance_works_input <= $maintenance_works_max && is_int( $maintenance_works_input / $maintenance_works_step ) ? $maintenance_works_input : $maintenance_works_setting->default );
    }
endif;

/**
 * Upsell customizer section.
 *
 * @since  1.0.0
 * @access public
 */
class Maintenance_Works_Customize_Section_Upsell extends WP_Customize_Section {

    /**
     * The type of customize section being rendered.
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $type = 'upsell';

    /**
     * Custom button text to output.
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $pro_text = '';

    /**
     * Custom pro button URL.
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $pro_url = '';

    public $notice = '';
    public $nonotice = '';

    /**
     * Add custom parameters to pass to the JS via JSON.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function json() {
        $json = parent::json();

        $json['pro_text'] = $this->pro_text;
        $json['pro_url']  = esc_url( $this->pro_url );
        $json['notice']  = esc_attr( $this->notice );
        $json['nonotice']  = esc_attr( $this->nonotice );

        return $json;
    }

    /**
     * Outputs the Underscore.js template.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    protected function render_template() { ?>

        <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">

            <# if ( data.notice ) { #>
                <h3 class="accordion-section-notice">
                    {{ data.title }}
                </h3>
            <# } #>

            <# if ( !data.notice ) { #>
                <h3 class="accordion-section-title">
                    {{ data.title }}

                    <# if ( data.pro_text && data.pro_url ) { #>
                        <a href="{{ data.pro_url }}" class="button button-secondary alignright" target="_blank">{{ data.pro_text }}</a>
                    <# } #>
                </h3>
            <# } #>
            
        </li>
    <?php }
}
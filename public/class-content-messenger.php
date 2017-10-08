<?php


class ContentMessenger {

    /**
     * A reference to the class for retrieving our option values.
     *
     * @access private
     * @var    Deserializer
     */
    private $deserializer;

    /**
     * Initializes the class by setting a reference to the incoming deserializer.
     *
     * @param Deserializer $deserializer Retrieves a value from the database.
     */
    public function __construct( $deserializer ) {
        $this->deserializer = $deserializer;
    }

    /**
     * Initializes the hook responsible for prepending the content with the
     * option created on the options page.
     */
    public function init() {
        add_filter( 'the_content', array( $this, 'display' ) );
    }


    /**
     * The function used during the hook to preprend the option value to the
     * content.
     *
     * @param  string $content The post content.
     * @return string $content The post content prepended with the optiosn value.
     */
    public function display( $content ) {

        //todo нуно выбрать точку где вызывать этот код

        include_once ( plugin_dir_path( __FILE__ ) . '../data-schedule-camps.php' );

        global $wpdb;

        $data = new DataScheduleCamps($wpdb);
        $data->createTableScheduleCamps();
        $data->storeDataPriceCamps();

        /* Return the content as-is, if the value is an empty string or if we're not
         * on a single post page.
         */
//        $message = $this->deserializer->get_value( 'tutsplus-custom-data' );
//        if ( empty( $message ) || ! is_single() ) {
//            return $content;
//        }
//
//        // Escape the data from the database and prepend it to the post content.
//        $message = esc_html( $message );
//        $content = $message . $content;
//
//        return $content;
    }


}
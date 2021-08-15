<?php

/**
 * Description of E2W_Country
 *
 * @author Andrey
 */
if (!class_exists('E2W_Country')) {

    class E2W_Country {

        public function get_countries() {
            $result = json_decode(file_get_contents(E2W()->plugin_path . 'assets/data/countries.json'), true);
            $result = $result["countries"];
            array_unshift($result, array('c' => '', 'n' => 'N/A'));
            return $result;
        }

    }

}
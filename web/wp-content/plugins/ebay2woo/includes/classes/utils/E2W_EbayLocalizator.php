<?php

/**
 * Description of E2W_EbayLocalizator
 *
 * @author Andrey
 */
if (!class_exists('E2W_EbayLocalizator')) {

    class E2W_EbayLocalizator {

        private static $_instance = null;
        public $language='en';
        public $currency='USD';

        protected function __construct() {
            $this->language = strtolower(e2w_get_setting('import_language'));
            $this->currency = strtoupper(e2w_get_setting('local_currency'));
        }

        protected function __clone() {
            
        }

        static public function getInstance() {
            if (is_null(self::$_instance)) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        public function getLocaleCurr($in_curr=false) {
            $out_curr = $in_curr?$in_curr:$this->currency;
            if ($out_curr == 'USD') {
                return '$';
            }
            return $out_curr . ' ';
        }

        public function getLangCode() {
            switch ($this->language) {
                case 'en':
                    return 'en_US';
                case 'fr':
                    return 'fr_FR';
                case 'it':
                    return 'it_IT';
                case 'ru':
                    return 'ru_RU';
                case 'de':
                    return 'de_DE';
                case 'pt':
                    return 'pt_BR';
                case 'es':
                    return 'es_ES';
                case 'nl':
                    return 'nl_NL';
                case 'tr':
                    return 'tr_TR';
                case 'ja':
                    return 'ja_JP';
                case 'ko':
                    return 'ko_KR';
                case 'th':
                    return 'th_TH';
                case 'vi':
                    return 'vi_VN';
                case 'ar':
                    return 'ar_MA';
                case 'he':
                    return 'iw_IL';
                case 'pl':
                    return 'pl_PL';
                case 'id':
                    return 'in_ID';
                default:
                    return 'en_US';
            }
        }

        public function build_params() {
            return '&lang=' . $this->language . '&curr=' . $this->currency;
        }

    }

}

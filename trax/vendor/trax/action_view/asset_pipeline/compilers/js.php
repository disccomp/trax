<?

class Js {

    function __construct() {
        // if(file_exists(Trax::$vendor_path."/phpless/lessc.inc.php")) {
        //     include_once(Trax::$vendor_path."/phpless/lessc.inc.php");
        //     $this->parser = new lessc;
        // } else {
        //     Trax::$current_controller_object->raise("Missing phpless in ".Trax::$vendor_path."<br />Please run 'git clone git@github.com:phpontrax/phpless.git' from inside your apps vendor folder.", "LESS parser", "500");
        // }
    }

    function process($input) {
        #return $this->parser->compile(file_get_contents($input));
    }

}

?>
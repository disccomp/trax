<?php
# $Id$
#
# Copyright (c) 2005 John Peterson
#
# Permission is hereby granted, free of charge, to any person obtaining
# a copy of this software and associated documentation files (the
# "Software"), to deal in the Software without restriction, including
# without limitation the rights to use, copy, modify, merge, publish,
# distribute, sublicense, and/or sell copies of the Software, and to
# permit persons to whom the Software is furnished to do so, subject to
# the following conditions:
#
# The above copyright notice and this permission notice shall be
# included in all copies or substantial portions of the Software.
#
# THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
# EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
# MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
# NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
# LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
# OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
# WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

class FormTagHelper extends Helpers {


    private function convert_options($options) {
        $arr = array('disabled', 'readonly', 'multiple');
        foreach($arr as $a) {
            $this->boolean_attribute($options, $a);
        }
        return $options;
    }

    private function boolean_attribute($options, $attribute) {
        if(isset($options[$attribute])) {
            $options[$attribute] = $attribute;
        } else {
            unset($options[$attribute]);
        }
    }

    function form_tag($url_for_options = array(), $options = array(), $parameters_for_url = array()) {
        $html_options = array_merge($options, array("method" => "post"));

        if(isset($html_options['multipart'])) {
            $html_options['enctype'] = "multipart/form-data";
            unset($html_options['multipart']);
        }

        $html_options['action'] = $this->url_for($url_for_options, $parameters_for_url);
        return $this->tag("form", $html_options, true);
    }

    function start_form_tag() {
        $args = func_get_args();
        return call_user_func_array(array($this, 'form_tag'), $args);
    }

    function select_tag($name, $option_tags = null, $options = array()) {
        return $this->content_tag("select", $option_tags, array_merge(array("name" => $name, "id" => $name), $this->convert_options($options)));
    }

    function text_field_tag($name, $value = null, $options = array()) {
        return $this->tag("input", array_merge(array("type" => "text", "name" => $name, "id" => $name, "value" => $value), $this->convert_options($options)));
    }

    function hidden_field_tag($name, $value = null, $options = array()) {
        return $this->text_field_tag($name, $value, array_merge($options, array("type" => "hidden")));
    }

    function file_field_tag($name, $options = array()) {
        return $this->text_field_tag($name, null, array_merge($this->convert_options($options), array("type" => "file")));
    }

    function password_field_tag($name = "password", $value = null, $options = array()) {
        return $this->text_field_tag($name, $value, array_merge($this->convert_options($options), array("type" => "password")));
    }

    function text_area_tag($name, $content = null, $options = array()) {
        if (isset($options["size"])) {
            $options["cols"] = reset(explode('x', $options["size"]));
            $options["rows"] = end(explode('x', $options["size"]));
            unset($options["size"]);
        }

        return $this->content_tag("textarea", $content, array_merge(array("name" => $name, "id" => $name), $this->convert_options($options)));
    }

    function check_box_tag($name, $value = "1", $checked = false, $options = array()) {
        $html_options = array_merge(array("type" => "checkbox", "name" => $name, "id" => $name, "value" => $value), $this->convert_options($options));
        if (isset($checked)) $html_options["checked"] = "checked";
        return $this->tag("input", $html_options);
    }

    function radio_button_tag($name, $value, $checked = false, $options = array()) {
        $html_options = array_merge(array("type" => "radio", "name" => $name, "id" => $name, "value" => $value), $this->convert_options($options));
        if (isset($checked)) $html_options["checked"] = "checked";
        return $this->tag("input", $html_options);
    }

    function submit_tag($value = "Save changes", $options = array()) {
        return $this->tag("input", array_merge(array("type" => "submit", "name" => "commit", "value" => $value), $this->convert_options($options)));
    }

    function image_submit_tag($source, $options = array()) {
        return $this->tag("input", array_merge(array("type" => "image", "src" => image_path($source)), $this->convert_options($options)));
    }

}

################################################################################################
## Avialble functions for use in views
################################################################################################
function form_tag() {
    $form_tag_helper = new FormTagHelper();
    $args = func_get_args();
    return call_user_func_array(array($form_tag_helper, 'form_tag'), $args);
}

function start_form_tag() {
    $args = func_get_args();
    return call_user_func_array('form_tag', $args);
}

function end_form_tag() {
    return "</form>";
}

function select_tag() {
    $form_tag_helper = new FormTagHelper();
    $args = func_get_args();
    return call_user_func_array(array($form_tag_helper, 'select_tag'), $args);
}

function text_field_tag() {
    $form_tag_helper = new FormTagHelper();
    $args = func_get_args();
    return call_user_func_array(array($form_tag_helper, 'text_field_tag'), $args);
}

function hidden_field_tag() {
    $form_tag_helper = new FormTagHelper();
    $args = func_get_args();
    return call_user_func_array(array($form_tag_helper, 'hidden_field_tag'), $args);
}

function file_field_tag() {
    $form_tag_helper = new FormTagHelper();
    $args = func_get_args();
    return call_user_func_array(array($form_tag_helper, 'file_field_tag'), $args);
}

function password_field_tag() {
    $form_tag_helper = new FormTagHelper();
    $args = func_get_args();
    return call_user_func_array(array($form_tag_helper, 'password_field_tag'), $args);
}

function text_area_tag() {
    $form_tag_helper = new FormTagHelper();
    $args = func_get_args();
    return call_user_func_array(array($form_tag_helper, 'text_area_tag'), $args);
}

function check_box_tag() {
    $form_tag_helper = new FormTagHelper();
    $args = func_get_args();
    return call_user_func_array(array($form_tag_helper, 'check_box_tag'), $args);
}

function radio_button_tag() {
    $form_tag_helper = new FormTagHelper();
    $args = func_get_args();
    return call_user_func_array(array($form_tag_helper, 'radio_button_tag'), $args);
}

function submit_tag() {
    $form_tag_helper = new FormTagHelper();
    $args = func_get_args();
    return call_user_func_array(array($form_tag_helper, 'submit_tag'), $args);
}

function image_submit_tag() {
    $form_tag_helper = new FormTagHelper();
    $args = func_get_args();
    return call_user_func_array(array($form_tag_helper, 'image_submit_tag'), $args);
}

?>
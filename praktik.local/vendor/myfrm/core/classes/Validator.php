<?php

namespace myfrm;
class Validator
{
    protected $errors = [];
    protected $rules_list = ['required', 'min', 'max', 'email', 'unique', 'ext', 'size'];
    protected $messages = [
        'required' => 'The :fieldname:: field is required',
        'min' => 'The :fieldname:: field must be a minimum :rulevalue: characters',
        'max' => 'The :fieldname:: field must be a maximum :rulevalue: characters',
        'email' => 'Not valid email',
        'unique' => 'The :fieldname: is already in use',
        'ext' => 'File :fieldname: extension does not allowed. Allowed :rulevalue:',
        'size' => 'The :fieldname: field must be :rulevalue: bytes',
        ];


    public function validate($data = [], $rules = [])
    {
        foreach ($data as $fieldname => $value) {
            if(in_array($fieldname, array_keys($rules))) {
                $this->check([
                    'fieldname' => $fieldname,
                    'value' => $value,
                    'rules' => $rules[$fieldname]
                ]);
            }
        }
        return $this;
    }



    protected function check($field)
    {
       foreach ($field['rules'] as $rule => $rule_value) {
            if(in_array($rule, $this->rules_list)) {
                if(!call_user_func_array([$this, $rule], [$field['value'], $rule_value])) {
                    $this->addError(
                        $field['fieldname'],
                        str_replace(
                            [':fieldname:', ':rulevalue:'],
                            [$field['fieldname'], $rule_value],
                            $this->messages[$rule])
                    );
                }
            }
       }
    }

    protected function addError($fieldname, $error)
    {
        $this->errors[$fieldname][] = $error;
    }

    public function getErrors()
    {
        return $this->errors;
    }
    public function hasErrors()
    {
        return !empty($this->errors);
    }

    public function listErrors($fieldname)
    {
        $output = '';
        if (isset($this->errors[$fieldname])) {
            $output .= "<div class='invalid-feedback d-block'><ul class='list-unstyled'>";
            foreach ($this->errors[$fieldname] as $error) {
                $output .= "<li>{$error}</li>";
            }
            $output .= "</ul></div>";
        }
        return $output;
    }



    protected function required($value, $rule_value)
    {
        return !empty($value);

    }

    protected function min($value, $rule_value)
    {
        return mb_strlen($value, 'UTF-8') >= $rule_value;
    }
    protected function max($value, $rule_value)
    {
        return mb_strlen(mb_strlen($value, 'UTF-8') <= $rule_value);
    }

    protected function email($value, $rule_value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    protected function unique($value, $rule_value)
    {
        global $db;
        $data=explode(":", $rule_value);
        return !($db->query("SELECT {$data[1]} FROM {$data[0]} WHERE {$data[1]} = ?", [$value])->getColumn());

    }

    protected function ext($value, $rule_value)
    {
        if(empty($value['name'])) {
            return true;
        }
        $allowed_extensions = explode('|', $rule_value);
        $file_ext=get_file_ext($value['name']);

        return in_array($file_ext, $allowed_extensions);
    }

    protected function size($value, $rule_value)
    {

        if(empty($value['name'])) {
            return true;
        }
        return $value['size'] <= $rule_value;
    }
}
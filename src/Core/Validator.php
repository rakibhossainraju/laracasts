<?php
class Validator {
    public function string($validation_fields): bool|string
    {
        $validated = true;
        $value = trim($validation_fields['string']);

        foreach ($validation_fields['rules'] as $rule => $rule_value) {
            if($rule === 'required' && $rule_value) {
                $validated = $this->required($value, $rule_value['message']);
                if(is_string($validated))
                    return $validated;
            }
            if($rule === 'min' && $rule_value) {
                 $validated = $this->minLength($value, $rule_value['message'], $rule_value['value']);
                if(is_string($validated))
                    return $validated;
            }
            if($rule === 'max' && $rule_value) {
                $validated = $this->maxLength($value, $rule_value['message'], $rule_value['value']);
                if(is_string($validated))
                    return $validated;
            }
        }
        return $validated;
    }
    private function required($str, $message)
    {
        if(empty($str)) {
            return $message;
        }
        return true;
    }
    private function minLength($str, $message,  $min = 5)
    {
        if(strlen($str) <= $min) {
            return $message;
        }
        return true;
    }
    private function maxLength($str, $message, $max = INF)
    {
        if(strlen($str) >= $max) {
            return $message;
        }
        return true;
    }

    public static function email($email): bool|string
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email format";
        }
        return true;
    }
}

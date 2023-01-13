<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Το :attribute πρέπει να γίνει αποδεκτό.',
    'accepted_if'          => 'Το :attribute πρέπει να είναι αποδεκτό όταν το :other είναι :value.',
    'active_url'           => 'Το :attribute δεν είναι έγκυρη διεύθυνση URL.',
    'after'                => 'Το :attribute δεν πρέπει να είναι ημερομηνία μετά τη :date.',
    'after_or_equal'       => 'Το :attribute πρέπει να είναι μια ημερομηνία μετά ή ίδια με τη :date.',
    'alpha'                => 'Το :attribute μπορεί να περιέχει μόνο γράμματα.',
    'alpha_dash'           => 'Το :attribute μπορεί να περιέχει μόνο γράμματα, αριθμούς, και παύλες.',
    'alpha_num'            => 'Το :attribute μπορεί να περιέχει μόνο γράμματα και αριθμούς.',
    'array'                => 'Το :attribute πρέπει να είναι πίνακας.',
    'before'               => 'Το :attribute πρέπει να είναι ημερομηνία πριν τη :date.',
    'before_or_equal'      => 'Το :attribute πρέπει να είναι μια ημερομηνία πριν ή ίδια με τη :date.',
    'between'              => [
        'numeric' => 'Το :attribute πρέπει να είναι ανάμεσα σε :min και :max.',
        'file'    => 'Το :attribute πρέπει να είναι ανάμεσα σε :min και :max kilobytes.',
        'string'  => 'Το :attribute πρέπει να είναι ανάμεσα σε :min και :max χαρακτήρες.',
        'array'   => 'Το :attribute πρέπει να είναι ανάμεσα σε :min και :max στοιχεία.',
    ],
    'current_password' => 'Το συνθηματικό δεν είναι σωστό.',
    'boolean'              => 'Το πεδίο :attribute πρέπει να είναι σωστό ή λάθος.',
    'confirmed'            => 'Το :attribute δεν είναι ίδιο με το :attribute επαλήθευσης.',
    'date'                 => 'Το :attribute δεν είναι έγκυρη ημερομηνία.',
    'date_format'          => 'Το :attribute δεν ταιριάζει στη μορφή :format.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'declined' => 'The :attribute must be declined.',
    'declined_if' => 'The :attribute must be declined when :other is :value.',
    'different'            => 'Το :attribute και :other πρέπει να είναι διαφορετικά.',
    'digits'               => 'Το :attribute πρέπει να είναι :digits ψηφία.',
    'digits_between'       => 'Το :attribute πρέπει να είναι ανάμεσα σε :min και :max ψηφία.',
    'dimensions'           => 'Το :attribute έχει μη έγκυρες διαστάσεις εικόνας.',
    'distinct'             => 'Το πεδίο :attribute έχει διπλή τιμή.',
    'email'                => 'Το :attribute πρέπει να είναι μια έγκυρη διεύθυνση ηλεκτρονικής αλληλογραφίας.',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'enum' => 'The selected :attribute is invalid.',
    'exists'               => 'Το επιλεγμένο :attribute δεν είναι έγκυρο.',
    'file'                 => 'Το :attribute πρέπει να είναι αρχείο.',
    'filled'               => 'Το πεδίο :attribute απαιτείται.',
    'image'                => 'Το :attribute πρέπει να είναι εικόνα.',
    'gt' => [
        'numeric' => 'Το :attribute πρέπει να είναι τουλάχιστον :min.',
        'file'    => 'Το :attribute πρέπει να είναι τουλάχιστον :min kilobytes.',
        'string'  => 'Το :attribute πρέπει να είναι τουλάχιστον :min χαρακτήρες.',
        'array'   => 'Το :attribute πρέπει να έχει τουλάχιστον :min στοιχεία.',
    ],
    'gte' => [
        'numeric' => 'Το :attribute πρέπει να είναι τουλάχιστον :min.',
        'file'    => 'Το :attribute πρέπει να είναι τουλάχιστον :min kilobytes.',
        'string'  => 'Το :attribute πρέπει να είναι τουλάχιστον :min χαρακτήρες.',
        'array'   => 'Το :attribute πρέπει να έχει τουλάχιστον :min στοιχεία.',
    ],
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'Το :attribute πρέπει να είναι μικρότερο από :value χαρακτήρες.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal to :value.',
        'file' => 'The :attribute must be less than or equal to :value kilobytes.',
        'string' => 'Το :attribute πρέπει να είναι ίσο ή μικρότερο από :value χαρακτήρες.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'mac_address' => 'The :attribute must be a valid MAC address.',
    'max' => [
        'numeric' => 'The :attribute must not be greater than :max.',
        'file' => 'The :attribute must not be greater than :max kilobytes.',
        'string' => 'Το :attribute δεν πρέπει να είναι μεγαλύτερο από :max χαρακτήρες.',
        'array' => 'The :attribute must not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'Το :attribute πρέπει να είναι τουλάχιστον :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'Το :attribute πρέπει να έχει τουλάχιστον :min χαρακτήρες.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'To :attribute πρέπει να είναι αριθμός.',
    'password' => 'Το συνθηματικό είναι λάνθασμένο.',
    'present' => 'The :attribute field must be present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'regex' => 'The :attribute format is invalid.',
    'required'             => 'Το πεδίο :attribute είναι απαραίτητο.',
    'required_if'          => 'Το πεδίο :attribute είναι απαραίτητο όταν το :other είναι :value.',
    'required_unless'      => 'Το πεδίο :attribute είναι απαραίτητο εκτός αν το :other είναι σε :values.',
    'required_with'        => 'Το πεδίο :attribute είναι απαραίτητο όταν υπάρχουν :values.',
    'required_with_all'    => 'Το πεδίο :attribute είναι απαραίτητο όταν υπάρχουν :values',
    'required_without'     => 'Το πεδίο :attribute είναι απαραίτητο όταν δεν υπάρχουν :values.',
    'required_without_all' => 'Το πεδίο :attribute είναι απαραίτητο όταν δεν υπάρχουν καθόλου :values.',
    'required_array_keys' => 'The :attribute field must contain entries for: :values.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string'               => 'Το :attribute πρέπει να είναι συμβολοσειρά.',
    'timezone'             => 'Το :attribute πρέπει να είναι μια έγκυρη ζώνη.',
    'unique'               => 'Το :attribute χρησιμοποιείται ήδη.',
    'uploaded'             => 'Η φόρτωση του :attribute απέτυχε.',
    'url'                  => 'Η μορφή του :attribute δεν είναι έγκυρη.',
    'uuid' => 'The :attribute must be a valid UUID.',
    // Passwords.
    // Note that this list is the exact same as the one on Laravel, but it is
    // included in here for easier translation to other languages.
    // @see /vendor/laravel/framework/src/Illuminate/Validation/Rules/Password.php
    'password' =>
    [
        'mixed' => 'Το :attribute πρέπει να περιέχει τουλάχιστον ένα κεφαλαίο και ένα μικρό γράμμα.',
        'letters' => 'Το :attribute πρέπει να περιέχει τουλάχιστον ένα γράμμα.',
        'symbols' => 'Το :attribute πρέπει να περιέχει τουλάχιστον ένα σύμβολο.',
        'numbers' => 'Το :attribute πρέπει να περιέχει τουλάχιστον έναν αριθμό.',
        'uncompromised' => 'Το :attribute που χρησιμοποιήσατε έχει συμπεριληφθεί σε δεδομένα που έχουν διαρρεύσει δημόσια (data leak). Για λόγους ασφαλείας χρησιμοποιήστε ένα διαφορετικό :attribute.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'προσαρμοσμένο-μήνυμα',
        ],
        'captcha' => [
            'numeric' => 'Το άρθροισμα των αριθμών στην επιβεβαίωση ασφαλείας πρέπει να είναι ένας αριθμός.',
            'required' => 'Η επιβεβαίωση ασφαλείας είναι υποχρεωτική.',
            'size' => 'Δεν έχετε υπολογίσει σωστά το άρθροισμα των αριθμών για την επιβεβαίωση ασφαλείας.',
        ],
        'email' => [
            'unique' => 'Υπάρχει ήδη λογαριασμός με αυτό το email.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'password' => 'συνθηματικό',
    ],

];

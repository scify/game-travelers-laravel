<?php

return [

    /*
    |--------------------------------------------------------------------------
    | App elements
    |--------------------------------------------------------------------------

    */
    'app_name' => 'Ταξιδιώτες',
    'privacy_policy' => 'Πολιτική απορρήτου',
    /* Generic */
    'close' => 'Κλείσιμο', // i.e. "Close" window
    'congratulations' => 'Συγχαρητήρια',
    'continue' => 'Συνέχεια', // i.e. "Continue" to the next step
    'email' => 'Email',
    'login' => 'Σύνδεση',
    'password' => 'Συνθηματικό',
    'register' => 'Εγγραφή',
    /* Forms Generic */
    'error_form' => 'Για να ολοκληρωθεί επιτυχώς η διαδικασία θα πρέπει να συμπληρώσετε τα πεδία σύμφωνα με τις σχετικές υποδείξεις:',
    /* splash.blade.php */
    'coming_soon' => 'Προσεχώς',
    'coming_soon_description' => 'Ταξιδιώτες: Προσεχώς από τη SciFY',
    /* views/auth/*.blade.php */
    'captcha' => 'Επιβεβαίωση ασφαλείας',
    'captcha_description' => 'Για λόγους ασφαλείας εισάγετε το άθροισμα αυτής της απλής μαθηματικής πράξης.',
    'captcha_placeholder' => 'άθροισμα',
    'login_prompt' => 'Είστε ήδη χρήστης;',
    'login_title' => 'Καλώς ήρθατε!', // Welcome!
    'password_change' => 'Αλλαγή συνθηματικού',
    'password_new' => 'Νέο συνθηματικό', // New Password
    'password_new_label' => 'Νέος επιθυμητός κωδικός πρόσβασης', // New Password
    'password_new_validation' => 'Επαλήθευση νέου συνθηματικού',
    'password_new_validation_label' => 'Επαλήθευση νέου επιθυμητού κωδικού πρόσβασης',
    'password_new_description' => 'Εισάγετε ένα νέο συνθηματικό το οποίο θα μπορείτε να χρησιμοποιείτε από εδώ και στο εξής για τη σύνδεσή σας στους Ταξιδιώτες.',
    'password_label' => 'Επιθυμητός κωδικός πρόσβασης',
    'password_reset' => 'Ανάκτηση συνθηματικού',
    'password_reset_description' => 'Αν δεν θυμάστε το συνθηματικό σας δεν έχετε παρά να συμπληρώσετε το email σας και εμείς θα σας στείλουμε οδηγίες για το πώς θα μπορέσετε να το αλλάξετε.',
    'password_reset_error' => 'Δυστυχώς το email που εισάγατε δεν αντιστοιχεί σε εγγεγραμμένο χρήστη. Βεβαιωθείτε ότι έχετε εισάγει σωστά το email σας και προσπαθήστε ξανά.',
    'password_reset_prompt' => 'Ξεχάσατε το συνθηματικό;',
    'password_reset_success' => 'Το νέο σας συνθηματικό αποθηκεύτηκε επιτυχώς.',
    'password_reset_request_success' => 'Το αίτημά σας για αλλαγή συνθηματικού ήταν επιτυχές. Δείτε το email που σας στείλαμε για να ολοκληρώσετε τη διαδικασία.',
    'password_rules' => 'Χρησιμοποιήστε 8 ή περισσότερους χαρακτήρες με έναν συνδυασμό από τουλάχιστον ένα γράμμα και αριθμό.',
    'password_validation' => 'Επαλήθευση συνθηματικού',
    'password_validation_label' => 'Επαλήθευση επιθυμητού κωδικού πρόσβασης',
    'registration' => 'Δημιουργία λογαριασμού', // Create new account
    'registration_title' => 'Εγγραφή νέου χρήστη',
    'registration_prompt' => 'Νέος χρήστης;', // New user?
    'stay_online' => 'Μείνετε συνδεδεμένοι',

    /* Switcher */
    'switcher' => [
        'break' => 'Διακοπή',
        'continue' => 'Συνέχεια',
        'help_automatic' => 'Για προσωρινή διακοπή της αυτόματης σάρωσης επιλέξτε «Διακοπή». Αν επιλέξετε «Συνέχεια» η αυτόματη σάρωση θα συνεχιστεί.',
        'help_automatic_button_select' => 'Η επιλογή της υποδεδειγμένης ενέργειας πραγματοποιείται με το πλήκτρο:',
        'help_manual_button_navigate' => 'Η μετάβαση στην επόμενη διαθέσιμη επιλογή γίνεται με το πλήκτρο:',
        'help_manual_button_select' => 'Η επικύρωση της υποδεδειγμένης επιλογής γίνεται με το πλήκτρο:',
    ],

    // Most of the following strings have already been moved to validation as
    // custom rules and have been commented out from this file.
    // @todo Fix password_token_error to somehow inject this:
    // <li>{{ __("messages.password_token_error") }}
    //    <a href="{{ route('password.request') }}">
    //      {{ __("messages.password_token_error_link") }}.
    //    </a>
    // </li>
    // Until then we are using the same error via passwords.token without the
    // helpful link.
    //
    // 'error_email_exists' => 'Υπάρχει ήδη λογαριασμός με αυτό το email.',
    // 'error_password_chars' => 'Το συνθηματικό πρέπει να αποτελείται από τουλάχιστον 8 χαρακτήρες.',
    // 'error_password_letter' => 'Το συνθηματικό πρέπει να περιέχει τουλάχιστον ένα γράμμα.',
    // 'error_password_symbol' => 'Το συνθηματικό πρέπει να περιέχει τουλάχιστον ένα σύμβολο.',
    // 'error_password_digit' => 'Το συνθηματικό πρέπει να περιέχει τουλάχιστον έναν αριθμό.',
    // 'error_password_match' => 'Τα δύο συνθηματικά δεν είναι ίδια.',
    'password_token_error' => 'Το διακριτικό δεν είναι πλέον έγκυρο. Θα πρέπει να ξεκινήσετε εκ νέου τη διαδικασία:',
    'password_token_error_link' => 'Ανάκτηση κωδικού.',
    //'error_password_captcha' => 'Το άρθροισμα δεν είναι σωστό.',

];

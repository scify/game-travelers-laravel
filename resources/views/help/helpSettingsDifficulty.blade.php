<!-- /resources/views/help/helpSettingsDifficulty.blade.php -->
{{-- based on https://xd.adobe.com/view/9059ce97-bf80-4c67-81c1-684de09acdf3-c50a/ --}}
<x-modalSettings
    :help="'Movement'"  {{-- id --}}
    :title="'Μετακίνηση'"
    :subtitle="'Ο τρόπος που «κινείται» ο παίκτης στο παιχνίδι.'"
>
    <p>
        <strong>Αυτόματη</strong><br />
        Ο παίκτης ρίχνει το ζάρι και...<br />
        ...το πιόνι πηγαίνει αυτόματα στη σωστή θέση.
    </p>
    <p>
        <strong>Με υπόδειξη</strong><br />
        Ο παίκτης ρίχνει το ζάρι και...<br />
        ...ο υπολογιστής υποδεικνύει που πρέπει να μετακινηθεί το πιόνι.<br />
        Μία φιλική φωνή βοηθάει τον παίκτη αν κάνει λάθος.
    </p>
    <p>
        <strong>Χωρίς υπόδειξη</strong><br />
        Ο παίκτης ρίχνει το ζάρι και...<br />
        ...βρίσκει που πρέπει να μετακινηθεί το πιόνι.<br />
        Μία φιλική φωνή βοηθάει τον παίκτη αν κάνει λάθος.
    </p>

</x-modalSettings>

<x-modalSettings
    :help="'DifficultyLevel'"  {{-- id --}}
    :title="'Επίπεδο δυσκολίας'"
    :subtitle="'Το επίπεδο δυσκολίας για τον παίκτη.'"
>
    <p>
        <strong>Κανονικό</strong><br />
        Τα ζάρια βοηθάνε τον παίκτη.
    </p>
    <p>
        <strong>Δύσκολο</strong><br />
        Τα ζάρια λειτουργούν κανονικά.
    </p>
</x-modalSettings>

<x-modalSettings
    :help="'Duration'"  {{-- id --}}
    :title="'Διάρκεια παιχνιδιού'"
    :subtitle="'Η διάρκεια του παιχνιδιού εξαρτάται από τον αριθμό των θέσεων στην πίστα.'"
>
    <p>
        <strong>Σύντομη</strong><br />
        15 θέσεις - Σύντομο
    </p>
    <p>
        <strong>Κανονική</strong><br />
        30 θέσεις - Μεσαία διάρκεια
    </p>
    <p>
        <strong>Μεγάλη</strong><br />
        45 θέσεις - Μεγάλη διάρκεια
    </p>
</x-modalSettings>

<x-modalSettings
    :help="'Dice'"  {{-- id --}}
    :title="'Ζάρι'"
    :subtitle="'Το ζάρι καθορίζει τον τρόπο μετακίνησης στις θέσεις του παιχνιδιού.'"
>
    <p>
        <strong>Ζάρι με αριθμούς</strong><br />
        Το ζάρι δείχνει αριθμούς.<br />
        Ο παίκτης μετακινείται τόσες θέσεις όσες έφερε στο ζάρι.
    </p>
    <p>
        <strong>Ζάρι με κουκίδες</strong><br />
        Το κλασικό ζάρι με κουκίδες.<br />
        Ο παίκτης μετακινείται τόσες θέσεις όσες έφερε στο ζάρι.
    </p>
    <p>
        <strong>Ζάρι μόνο με χρώματα</strong><br />
        Ο παίκτης μετακινείται αυτόματα στο χρώμα που δείχνει το ζάρι -<br />
        (δηλ. στην πιο κοντινή επόμενη θέση με αυτό το χρώμα).
    </p>
</x-modalSettings>


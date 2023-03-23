<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the index.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $carouselSlides = $this->getRandomActiveHomeCarouselSlides();
        return view('home', compact('carouselSlides'));
    }
    /**
     * Carousel Slides Data Provider
     *
     * Returns an array of carouselSlides. Quick & dirty implementation before
     * this is also converted to a model for full customisation and control.
     *
     * @return array
     */
    private function getHomeCarouselSlides() {
        // All images are stored on images/landing/slides.
        $width = 500; // Image dimensions are fixed for now.
        $height = 500;
        $slides = [
            1 => [  // Slide's Unique ID
                'id' => 1, // Repeating id for convenience.
                'asset' => 'slide_1', // Filename. Extensions .jpg & @2x.jpg are implied.
                'alt' => 'Παιδί κάθεται μπροστά από υπολογιστή σε σχολική αίθουσα και παίζει το παιχνίδι «Ταξιδιώτες»',
                'quote' => 'Τα παιδιά ενθουσιάστηκαν πολύ! Τους κέντρισε το ενδιαφέρον και αύξησε σημαντικά τον χρόνο συγκέντρωσης και ενασχόλησης τους με το παιχνίδι.',
                'source' => 'Απόστολος Μιχαλόπουλος, Διευθυντής Ειδικού Δημοτικού Σχολείου Αγριάς Βόλου',
                'width' => $width,
                'height' => $height,
            ],
            2 => [  // Slide's Unique ID
                'id' => 2, // Repeating id for convenience.
                'asset' => 'slide_2', // Filename. Extensions .jpg & @2x.jpg are implied.
                'alt' => 'Ένα άλλο παιδί κάθεται επίσης μπροστά από υπολογιστή σε σχολική αίθουσα και παίζει το παιχνίδι «Ταξιδιώτες»',
                'quote' => "Εξαιρετικό! Ενδεικτικά, μαθητής μας με τεράστια διάσπαση προσοχής έμεινε συγκεντρωμένος καθ'όλη τη διάρκεια του παιχνιδιού!",
                'source' => 'Χριστίνα Κουζούτη, Δασκάλα Ειδικής Αγωγής ΠΕ71, Ειδικό Δημοτικό Σχολείο Αγριάς Βόλου',
                'width' => $width,
                'height' => $height,
            ],
            3 => [  // Slide's Unique ID
                'id' => 3, // Repeating id for convenience.
                'asset' => 'slide_3', // Filename. Extensions .jpg & @2x.jpg are implied.
                'alt' => 'Παιδί που κάθεται μπροστά από φορητό υπολογιστή και παίζει το παιχνίδι «Ταξιδιώτες» με τη βοήθεια ειδικού μοχλού',
                'quote' => "Είναι πλήρως προσαρμοσμένο στο δυναμικό τους, τα παιδια χαίρονται, βοηθάει στην τριβή τους με την τεχνολογία!",
                'source' => 'Μαριαλένα Ξιξή, Εργοθεραπεύτρια, ΚΑΣΠ Χατζηπατέρειο',
                'width' => $width,
                'height' => $height,
            ],
            4 => [  // Slide's Unique ID
                'id' => 4, // Repeating id for convenience.
                'asset' => 'slide_4', // Filename. Extensions .jpg & @2x.jpg are implied.
                'alt' => 'Οθόνη υπολογιστή στην οποία εμφανιζεται το παιχνίδι «Ταξιδιώτες». Μπροστά από την οθόνη βρίσκονται δύο «διακόπτες» σε σχήμα λουλουδιών (ο ένας με κόκκινο και ο άλλος με πράσινο χρώμα). Το χέρι ενός παιδιού πλησιάζει το διακόπτη με τον κόκκινο χρώμα.',
                'quote' => "Επιτέλους ένα δωρεάν παιχνίδι που είναι προσβάσιμο με διακόπτες. Τα παιδιά διασκεδάζουν ανεξάρτητα από τις γνωστικές, αντιληπτικές και κινητικές δεξιότητές τους.",
                'source' => 'Ρία Κορωνίδου, Εργοθεραπεύτρια, ΕΛΕΠΑΠ',
                'width' => $width,
                'height' => $height,
            ],
            5 => [  // Slide's Unique ID
                'id' => 5, // Repeating id for convenience.
                'asset' => 'slide_5', // Filename. Extensions .jpg & @2x.jpg are implied.
                'alt' => 'Οθόνη υπολογιστή στην οποία εμφανιζεται το παιχνίδι «Ταξιδιώτες». Μπροστά από την οθόνη βρίσκεται ένα λευκό πληκτρολόγιο με λευκά πλήκτρα τα οποία έχουν χρωματιστεί με μαρκαδόρους διαφόρων χρωμάτων, ώστε να είναι πιο ευκρινές το γράμμα της ελληνικής αλφαβήτου που αντιστοιχεί στο καθένα από αυτά. Το πλήκτρο του «κενού διαστήματος» («space») έχει ζωγραφιστεί με μαρκαδόρο έντονου κόκκινου χρώματος και το πλησιάζει το χέρι ενός παιδιού.',
                'quote' => "Το παιχνίδι είναι ξεκάθαρο και ευέλικτο με παιδικές ομιλίες που δημιουργούν ένα ευχάριστο και φιλικό περιβάλλον για κάθε παιδί.",
                'source' => 'Άννυ Αποστολοπούλου, Εργοθεραπεύτρια, ΕΛΕΠΑΠ',
                'width' => $width,
                'height' => $height,
            ],

        ];
        return $slides;

    }
    /**
     * Carousel Slides Data Provider (Random Active Value)
     *
     * Adds active = TRUE in one of the slides provided by the Carousel Slides
     * Data Provider in order to allow Bootstrap's implementation to show a
     * different slide first, on each page refresh. I know.
     *
     * @return void
     */
    private function getRandomActiveHomeCarouselSlides() {
        $slides = $this->getHomeCarouselSlides();
        $randIndex = rand(1, count($slides));
        foreach ($slides as $index => &$slide) {
            $slide['active'] = ($index == $randIndex);
        }
        return $slides;

    }

}

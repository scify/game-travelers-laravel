<x-layoutContent
    :title="'Συντελεστές | ' . __('messages.app_name')"
    :description="'Το παιχνίδι «Ταξιδιώτες» αναπτύχθηκε από τη SciFY - Science For You. Η εικονογράφηση του επιτραπέζιου και των χαρακτήρων έγινε από τη Λέλα Στρούτση, ενώ ακούγονται οι παιδικές φωνές του Γιάννη και της Μαριλίας Γιαννακοπουλου.'"
    :header-background-color="'green'"
>

<section class="landing bg-light px-4 mb-n4">
    <div class="landing-credits container-lg pt-5 px-lg-6 px-xxl-7 text-center">

        <div class="z-2">
            <h1>Συντελεστές</h1>
            <dl>
                <dt><h2>Σχεδιασμός & ανάπτυξη παιχνιδιού</h2></dt>
                <dd><a href="https://www.scify.org/" target="_blank">SciFY</a></dd>

                <dt><h2>Εικονογράφηση επιτραπέζιου & χαρακτήρων</h2></dt>
                <dd>ΛΕΛΑ ΣΤΡΟΥΤΣΗ</dd>

                <dt><h2>Παιδικές φωνές</h2></dt>
                <dd>
                    ΓΙΑΝΝΗΣ ΓΙΑΝΝΑΚΟΠΟΥΛΟΣ, <br />
                    ΜΑΡΙΛΙΑ ΓΙΑΝΝΑΚΟΠΟΥΛΟΥ
                </dd>

                <dt><h2>Μουσική</h2></dt>
                <dd>
                    <a href="https://www.purple-planet.com" target="_blank">https://www.purple-planet.com</a>
                </dd>
            </dl>

            <img
                srcset="{{ asset('images/misc/vase@2x.png') }} 2x"
                src="{{ asset('images/misc/vase.png') }}"
                class="mt-5"
                alt=""
                width="104"
                height="173"
            >
        </div>

    </div>
</section>

</x-layoutContent>

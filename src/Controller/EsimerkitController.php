<?php
// App on "alias" polulle projektikansion /src kansioon asti
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
// tarvitaan näkymää varten
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


// luokan nimi pitää olla sama kuin tiedoston!! tässä EsimerkitController
class EsimerkitController extends AbstractController {

    //Kontrollerit eli metodit tulee tähän (a class method which is used to accept requests, and return a Response object.)
 
    public function laskePalkka() {
    $nettoPalkka = 4500 * 0.7;
    
    // pyydetään response oliota näyttämään tulos
    return new Response('<h2> Bruttopalkkasi on 4500 ja nettopalkkasi on <strong>' . $nettoPalkka . '</strong></h2>');
    }

    public function tarkistaKarkausvuosi() {
        $vuosi=2019;

        if ($vuosi % 4 == 0) { 
            return new Response($vuosi . '<h2> on karkausvuosi! </h2>');
        } else { 
            return new Response('<h2> Ei ole karkausvuosi! </h2>');   
        }
    }

    public function laskePH() {
        $x = 2.13*pow(10, -5);
        $ph = - log10($x);
        
        return new Response('<p><strong> Kun vesiliuoksen vetyionikonsenraatio on 2.13 * 10-5 mol/l sen pH on ' . round($ph,1) . '</strong></p>');    
    }
    public function heitaNoppaa() {
        $luku = (rand(1, 6));
        
        return new Response('<p><strong> Nopan heitto antoi luvun ' . $luku . '</strong></p>');    
    }
    public function naytaJSON() {
        // Henkilo-taulukko
        $nimet = [
            'Etunimi' => 'Pekka',
            'Sukunimi' => 'Puupaa'
        ];
        // Pyydetään JsonResponse-oliota näyttämään tulos
        return new JsonResponse($nimet);    
    }
    
    public function lihapiirakka(){
    $rahamaaraLompakossa = 10;
    $lihapiirakanHinta = 2.5;

    //Onko varaa ostaa lihapiirakka

    if ($rahamaaraLompakossa >= $lihapiirakanHinta) {
        // Rahaa on tarpeeksi, joten vahennetään lompakossa olevaa rahamäärää
        $rahamaaraLompakossa -= $lihapiirakanHinta;
        return new Response("Lompakossa on oston jälkeen rahaa " . $rahamaaraLompakossa);
    } else {
        return new Response("Kehotan sinua paastoamaan!");
    }
    
}
// Koodaa seuraava kontrolleri (a class method which is used to accept requests, and return a Response object.)
// Huomaa miten reitti on määritelty. Reitti määritellään nyt kontrollerin yläpuolelle (@Route)
// Lisää EsimerkitController-luokkaan muiden use-komentojen joukkoon
// useSymfony\Component\Routing\Annotation\Route;
// Kontrollerilla on yksi sääntö. Sen pitää palauttaa Response-olio.
// Harjoituksissa 5 -6 käytettiin komentoja return new Resonse() ja return new JsonResponse.
// Symfonyssa on kolmaskin tapa tulostaa dataa näytölle, nimittäin Twig.
// Asenna Twig alla olevalla komenolla. 
// Komento lisää Symfonyyn uuden kansion nimellä Templates. Kokeillaan Twigiä käytäntöön.
// Tavoitteena on laskea viikon pakkaspäivien keskiarvo ja tulosta näytölle tiistain ja perjantain lukemat.
// Lopuksi lasketaan vielä koko viikon lämpötilojen keskiarvo.

/**
 * @Route("esimerkki/esim8")
 */
public function laskeAsteet() {
    //Muuttujat
    $summa = 0;
    $pakkasPaivat = 0;
    $tekija = "Pia T";
    $mittausViikko = 35;
    $keskiarvo1 = 0;
    $keskiarvo2 = 0;

    //Talletetaan viikon lampötilat taulukkoon
    $asteet = [
        'ma' => 6,
        'ti' => 3,
        'ke' => -2,
        'to' => -4,
        'pe' => 1,
        'la' => 0,
        'su' => -5
    ];

    //Lasketaan pakkaspäivien summa
    foreach ($asteet as $aste) {
        if ($aste < 0) {
            $summa += $aste;
            $pakkasPaivat += 1;
        }
    }

    // Lasketaan pakkaspäivien keskiarvo yhdellä desimaalilla
    $keskiarvo1 = number_format(($summa / $pakkasPaivat),1);
    // Lasketaan viikon keskilämpötila yhdellä desimaalilla
    $keskiarvo2 = number_format(array_sum($asteet) / count($asteet),1);
    
// Kutsutaan näkymää ja lähetetään sille dataa sisältävät muuttujat
return $this ->render('esimerkit/asteet.html.twig', [
    'asteet' => $asteet,
    'keskiarvo1' => $keskiarvo1,
    'keskiarvo2' => $keskiarvo2,
    'viikko' => $mittausViikko,
    'tekija' => $tekija
]);

}

}
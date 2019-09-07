<?php
// App on "alias" polulle projektikansion /src kansioon asti
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


// luokan nimi pitää olla sama kuin tiedoston!!
class EsimerkitController {
    //Kontrollerit eli funktiot tulee tähän
 
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

}
    

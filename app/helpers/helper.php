<?php

use App\Models\Facture;
use App\Models\structure;
use App\Models\volontaire;
use App\Models\Fournisseur;
use App\Models\Materiel;
use App\Models\Medecin;
use App\Models\Specialite;
use App\Models\Patient;
use App\Models\Ordonnance;
use Illuminate\Support\Facades\Auth;

if (!function_exists("referenceStructure")) {
    function referenceStructure()
    {
        $ref = rand(100000, 1000000) . "REF";
        if (structure::where('referenceStructure', $ref)->count() > 0)
            return referenceStructure();
        return $ref;
    }
}

// if (!function_exists("referenceVolontaire")) {
//     function referenceVolontaire()
//     {
//         $ref = rand(100000, 1000000) . "VOL";
//         if (volontaire::where('reference', $ref)->count() > 0)
//             return referenceVolontaire();
//         return $ref;
//     }
// }

if (!function_exists("referenceVolontaire")) {
    function referenceVolontaire()
    {
        $ref = rand(100000, 1000000) . "VOL";
        if (volontaire::where('referenceVolontaire', $ref)->count() > 0)
            return referenceVolontaire();
        return $ref;
    }
}
// if (!function_exists("referenceSpecialite")) {
//     function referenceSpecialite()
//     {
//         $ref = rand(100000, 1000000) . "SPC";
//         if (Specialite::where('reference', $ref)->count() > 0)
//             return referenceSpecialite();
//         return $ref;
//     }
// }

if (!function_exists("referenceFournisseur")) {
    function referenceFournisseur()
    {
        $ref = rand(100000, 1000000) . "FRN";
        if (Fournisseur::where('referenceFournisseur', $ref)->count() > 0)
            return referenceFournisseur();
        return $ref;
    }
}
if (!function_exists("referenceSpecialite")) {
    function referenceSpecialite()
    {
        $ref = rand(100000, 1000000) . "SPC";
        if (Specialite::where('referenceSpecialite', $ref)->count() > 0)
            return referenceSpecialite();
        return $ref;
    }
}

if (!function_exists("reference")) {
    function referenceMateriel()
    {
        $ref = rand(100000, 1000000) . "MTR";
        if (Materiel::where('reference', $ref)->count() > 0)
            return referenceMateriel();
        return $ref;
    }
}

if (!function_exists("referenceMedecin")) {
    function referenceMedecin()
    {
        $ref = rand(100000, 1000000) . "MDC";
        if (Medecin::where('referenceMedecin', $ref)->count() > 0)
            return referenceMedecin();
        return $ref;
    }
}

if (!function_exists("referencePatient")) {
    function referencePatient()
    {
        $ref = rand(100000, 1000000) . "MDC";
        if (Patient::where('referencePatient', $ref)->count() > 0)
            return referencePatient();
        return $ref;
    }
}
if (!function_exists("referenceOrdonnance")) {
    function referenceOrdonnance()
    {
        $ref = rand(100000, 1000000) . "ORD";
        if (Ordonnance::where('idOrdonnance', $ref)->count() > 0)
            return referenceOrdonnance();
        return $ref;
    }
}

if (!function_exists("referenceFacture")) {
    function referenceFacture()
    {
        $ref = rand(100000, 1000000) . "FACT";
        if (Facture::where('reference', $ref)->count() > 0)
            return referenceOrdonnance();
        return $ref;
    }
}


if (!function_exists("accueil")) {
    function accueil()
    {
        if (Auth::user()->profil == "admin") {
            return '/accueiljica';
        } else if (Auth::user()->profil == "medecin")
            return "/accueilmedecin";
        else if (Auth::user()->profil == "volontaire")
            return "/volontaire";
    }
}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="lib/bootstrap/css/bootstrap1.min.css" rel="stylesheet">
    <title>Generation pdf</title>
</head>
<body>
    <div class="container row" style="width: 100%">
        <div class="col-md-6" style="width:200px">
                <img src="img/logo.gif" alt="logo" width="300px"/><br/>        
                {{ ucwords($medecin[0]->nomStructure) }}<br/>
        region : {{ ucfirst($medecin[0]->region) }}<br/>
        telephone : {{ $medecin[0]->telephone }}<br/>
        </div>
        <div class="col-md-6" style="margin-left:500px;width:300px">
            {{ ucwords($patient->prenom."  ".$patient->nom) }}<br/>
            age : {{   explode('/',date('d/m/Y'))[2] - explode('-',$patient->dateDeNaissance)[0] }} ans<br/>
            {{-- age : {{ date('d/m/Y')-$patient->dateDeNaissance }}<br/> --}}
            Tel : {{ $patient->telephone }}<br/>
            Adresse : {{ $patient->adresse }}<br/>
            date: {{ date_format(now(),"d/m/Y H:i:s") }}
        </div>
    </div>
    <div class="">
        <h3 class="text-center">Ordonnance</h3><hr/>
    </div>
    <div class="">
<table style="width: 100%">
    @foreach ($ordonnance->medicaments as $medicament) 
    <tr class="" style="margin-bottom: 20px" class="text-center">
        <td style="font-weight: bold"> {{ $medicament->libelle }}</td>
        <td> {{ $medicament->prix }}</td>
        <td> x  {{ $medicament->pivot->quantite }}</td>
    </tr>
    <tr style="margin-bottom: 50px">
        <td colspan="3">{{ $medicament->pivot->indication }}</td>
        
    </tr>
@endforeach
</table>
    </div>
<div class="" style="font-size: 12px;font-weight:bold;margin-top:200px">
    <div class="col-md-3">
        Total : {{ $ordonnance->cout }}  Franc Cfa
    </div>
    <div class="col-md-5">
        Prise en charge(80%) : {{ $ordonnance->cout * 0.8 }} Franc Cfa
    </div>
    <div class="col-md-4">
        Patient(20%) : {{ $ordonnance->cout * 0.2 }}  Franc Cfa
    </div>
</div>

    </div>
    <div class="" style="position: absolute;bottom:100px;margin-left:70%;">
       <div class="">  Dr. {{ ucwords($medecin[0]->prenom."  ".$medecin[0]->nom ) }}<br/>
        Telephone : {{ $medecin[0]->telephone }}</div>
    </div>
    </div>
</body>
</html>
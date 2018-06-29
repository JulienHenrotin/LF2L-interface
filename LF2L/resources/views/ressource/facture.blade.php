@foreach($ressources as $ressource)
    @if($ressource -> type == $type)
        @foreach($factures_contient as $facture_contient)
            @if($facture_contient -> id_ressources == $ressource -> id_ressources)
                @foreach($factures as $facture)
                    @if($facture_contient -> id_facture == $facture -> id_facture)
                        <p>num facture :
                            <?php echo $facture ->numero_facture ?> </p>
                        <p>prix HT :
                            <?php echo $facture ->prix_ressource_HT ?> </p>
                        <p>quantité :
                            <?php echo $facture ->quantite_ressources_facture ?> </p>
                        @foreach($fournisseurs as $fournisseur)
                            <?php if($fournisseur -> id_fournisseur == $facture -> id_fournisseur){
                                echo "<p>fournisseur :". $fournisseur ->nom_fournisseur. "</p><br><br>";
                            }?>

                        @endforeach
                    @endif
                @endforeach
            @endif
        @endforeach
    @endif
@endforeach
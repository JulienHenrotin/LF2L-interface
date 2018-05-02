
<?php
$url = 'https://api.archives-ouvertes.fr/search/hal/?omitHeader=true&wt=bibtex&q=erpi&fq=NOT+instance_s%3Asfo&fq=NOT+instance_s%3Adumas&fq=NOT+instance_s%3Amemsic&fq=NOT+%28instance_s%3Ainria+AND+docType_s%3A%28MEM+OR+PRESCONF%29%29&fq=NOT+%28instance_s%3Aafssa+AND+docType_s%3AMEM%29&fq=NOT+%28instance_s%3Aenpc+AND+docType_s%3A%28OTHERREPORT+OR+MINUTES+OR+NOTE+OR+SYNTHESE+OR+MEM+OR+PRESCONF%29%29&fq=NOT+%28instance_s%3Auniv-mlv+AND+docType_s%3A%28OTHERREPORT+OR+MINUTES+OR+NOTE+OR+MEM+OR+PRESCONF%29%29&fq=NOT+%28instance_s%3Ademocrite+AND+docType_s%3AMEM%29&fq=NOT+%28instance_s%3Aafrique+AND+docType_s%3AMEM%29&fq=NOT+%28instance_s%3Asaga+AND+docType_s%3A%28PRESCONF+OR+BOOKREPORT%29%29&fq=NOT+%28instance_s%3Aunice+AND+docType_s%3AMEM%29&fq=NOT+%28instance_s%3Alara+AND+docType_s%3AREPACT%29&fq=NOT+%28docType_s%3A%28THESE+OR+HDR%29+AND+submitType_s%3A%28notice+OR+annex%29%29&fq=NOT+%28instance_s%3Alaas+AND+docType_s%3AMEM%29&fq=NOT+%28instance_s%3Aephe+AND+docType_s%3AMEM%29&fq=NOT+instance_s%3Ahceres&fq=NOT+status_i%3A111&fq=%7B%21tag%3Dtag0__docType_s%7DdocType_s%3A%28%22ART%22+OR+%22COMM%22+OR+%22OUV%22+OR+%22COUV%22+OR+%22DOUV%22+OR+%22REPORT%22+OR+%22OTHER%22+OR+%22THESE%22+OR+%22HDR%22+OR+%22LECTURE%22+OR+%22UNDEFINED%22+OR+%22POSTER%22%29&fq=%7B%21tag%3Dtag1__submitType_s%7DsubmitType_s%3A%28%22file%22%29&defType=edismax&rows=2000';
$pattern ="{[a-zA-Z0-9]}";
$subject = htmlspecialchars(implode('', file($url)));
preg_match($pattern, $subject, $matches, PREG_OFFSET_CAPTURE, 3);
print_r($matches);
//$donnees = url.match(/\[(.*?)\]/ig);

?>



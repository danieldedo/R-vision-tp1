

$(document).ready(function () {

    $('.supprimerlogement').on('click', function() {
        let logementId = $(this).data('id');
        console.log(logementId)
        $('#confirmDelete').attr('href', "/logement/__id__/delete".replace('__id__', logementId))
    });
});

$(document).ready(function () {

    $('.supprimersejour').on('click', function() {
        let sejourId = $(this).data('id');
        console.log(sejourId)
        $('#confirmDelete').attr('href', "/sejour/__id__/delete".replace('__id__', sejourId))
    });
});

$(document).ready(function () {

    $('.supprimervoyageur').on('click', function() {
        let voyageurId = $(this).data('id');
        console.log(voyageurId)
        $('#confirmDelete').attr('href', "/voyageur/__id__/delete".replace('__id__', voyageurId))
    });
});


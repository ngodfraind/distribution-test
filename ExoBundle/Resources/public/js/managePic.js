//no call in the code
// Display inline-block to add a new document
//function AddDocument() {
//    if ($('#AddDocuments').css("display") == "none") {
//        $('#AddDocuments').css({"display" : "inline-block"});
//        $('#icon').attr('class', 'fa fa-minus');
//    } else {
//        $('#AddDocuments').css({"display" : "none"});
//        $('#icon').attr('class', 'fa fa-plus');
//    }
//}

//no call in the code
// Display inline-block to sort documents
//function sortDoc() {
//    if ($('#sortDocuments').css("display") == "none") {
//        $('#sortDocuments').css({"display" : "inline-block"});
//    } else {
//        $('#sortDocuments').css({"display" : "none"});
//    }
//}

//no call in the code
// Display inline-block to search documents
//function searchDocuments() {
//    if ($('#searchDocuments').css("display") == "none") {
//        $('#searchDocuments').css({"display" : "inline-block"});
//    } else {
//        $('#searchDocuments').css({"display" : "none"});
//    }
//}

// Sort documents depending on its type
function sortDocument(type, path, page) {

    var searchLabel;

    // If have to sort the search documents
    if ($('#labelToFind').length > 0) {
        searchLabel = $('#labelToFind').val();
    } else {
        searchLabel = '';
    }


    $.ajax({
        type: 'GET',
        url: path,
        data: {
            doctype : type,
            searchLabel: searchLabel,
            page : page
        },
        cache: false,
        success: function (data) {
            $('#sorting').html(data);
        }
    });
}

// Search documents with specific label
function searchPic(path, page) {

    var labelToFind = $('#labelToFind').val();

    $.ajax({
        type: 'GET',
        url: path,
        data: {
            labelToFind : labelToFind,
            page : page
        },
        cache: false,
        success: function (data) {
            $('#sorting').html(data);
        }
    });
}

// Display modal to change name of a picture
function ChangeName(url, i) {
    var oldPicLabel = $('#PicLabel' + i).html().trim();

    $.ajax({
        type: "POST",
        url: url,
        data: {
            oldPicLabel : oldPicLabel,
            i : i
        },
        cache: false,
        success: function (data) {
            changePictureName(data);
        }
    });
}

// change picture name
function changePictureName(data) {
    $('body').append(data);
}

$(document.body).on('hidden.bs.modal', function () {
    $('#modalpicture').remove();
});

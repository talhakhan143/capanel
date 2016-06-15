/**
 * Created by Ishaq Hassan on 6/15/2016.
 */
/*
$(document).ready(function(e){
    testParam(function(a){
       alert(a);
    });
});

function testParam(func){
    func("Hello world");
}*/


$(document).ready(function(e){
    $('.data-table').dataTable();

    $('.light-box').magnificPopup({
        delegate: 'a',
        type: 'image',
        closeOnContentClick: true,
        mainClass: 'mfp-img-mobile',
        image: {
            verticalFit: true
        }

    });
});

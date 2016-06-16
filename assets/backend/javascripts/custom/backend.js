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


$(document).ready(function (e) {
    $('.data-table').dataTable();

    $(document).on("click",'a[href="#"]',function(e){
        e.preventDefault();
    });

    $('.light-box').magnificPopup({
        delegate: 'a',
        type: 'image',
        closeOnContentClick: true,
        mainClass: 'mfp-img-mobile',
        image: {
            verticalFit: true
        }

    });

    $('.delete-confirmation').magnificPopup({
        type: 'inline',
        fixedContentPos: false,
        fixedBgPos: true,
        overflowY: 'auto',
        closeBtnInside: true,
        preloader: false,
        midClick: true,
        removalDelay: 300,
        mainClass: 'my-mfp-zoom-in',
        modal: true
    });
});

function confirmation(title,message,type,confirm_action,dismiss_action,confirm_text,dismiss_text,icon) {
    title = (title != null ? title : "Title");
    message = (message != null ? message : "Message");
    type = (type != null ? type : "primary");
    confirm_text = (confirm_text != null ? confirm_text : "OK");
    dismiss_text = (dismiss_text != null ? dismiss_text : "CANCEL");
    icon = (icon != null ? icon : "fa fa-question-circle");

    $.magnificPopup.open({
        items: {
            src: '<div id="modalAnim" class="zoom-anim-dialog modal-block modal-header-color modal-block-'+type+'"><section class="panel"><header class="panel-heading"><h2 class="panel-title">'+title+'</h2></header><div class="panel-body"><div class="modal-wrapper"><div class="modal-icon"><i class="'+icon+'"></i></div><div class="modal-text"><p>'+message+'</p></div></div></div><footer class="panel-footer"><div class="row"><div class="col-md-12 text-right"><button class="btn btn-'+type+' modal-confirm">'+confirm_text+'</button> <button class="btn btn-default modal-dismiss">'+dismiss_text+'</button></div></div></footer></section></div>',
            type: 'inline'
        },
        fixedContentPos: false,
        fixedBgPos: true,
        overflowY: 'auto',
        closeBtnInside: true,
        preloader: false,
        midClick: true,
        removalDelay: 300,
        mainClass: 'my-mfp-zoom-in',
        modal: true
    });

    $(document).on('click', '.modal-dismiss', function (e) {
        e.preventDefault();
        if(dismiss_action != null){
            dismiss_action();
        }
        $.magnificPopup.close();

    });

    /*
     Modal Confirm
     */
    $(document).on('click', '.modal-confirm', function (e) {
        e.preventDefault();
        confirm_action();
        $.magnificPopup.close();

        /*new PNotify({
            title: 'Success!',
            text: 'Modal Confirm Message.',
            type: 'success'
        });*/
    });
}


function deleteGrid(del_url,me){
    confirmation("Delete Confirmation!","Are You Sure To Delete?","danger",function(){
        $.ajax({
            url:del_url,
            type:"get",
            dataType:"json",
            success:function(r){
                new PNotify({
                    title: r.message,
                    text: 'Data Delete Message',
                    type: (!r.error ? 'success' : 'error')
                });
                if(!r.error){
                    $(me).parent("td").parent("tr").remove();
                }
            },error:function(e){
                new PNotify({
                    title: "There was an error, please try again later!",
                    text: 'Data Delete Message',
                    type: 'error'
                });
            },complete:function(){

            }
        });
    },null,"Yes","No");
}

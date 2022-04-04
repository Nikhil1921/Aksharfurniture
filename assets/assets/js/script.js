"use strict";
$(document).ready(function() {
    // $('.pcoded-header').attr("header-theme", 'theme6');
    // $('.navbar-logo').attr("logo-theme", 'theme6');
    // $('.pcoded-navbar').attr("navbar-theme", 'theme6');
    
    var options = {allowNumeric: true, allowText: false}
    
    $(".input-number").inputfilter(options);

    $('.time-picker').timepicki({
        increase_direction:'up',
        min_hour_value:0,
        max_hour_value:23,
        show_meridian:false
    });
   
    $(document).on('click', '.delete', function(e){ 
        e.preventDefault();
        swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this!",
          icon: "error",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $(this).parents().submit();
          } else {
            return false;
          }
        });
    });

    $(document).on('click', '.approve', function(e){ 
        e.preventDefault();
        swal({
          title: "Are you sure?",
          text: "Once approved, you will not be able to recover this!",
          icon: "info",
          buttons: true,
          dangerMode: false,
        })
        .then((willDelete) => {
          if (willDelete) {
            $(this).parents().submit();
          } else {
            return false;
          }
        });
    });

    $(".custom-select").dateDropper( {
        dropWidth: 200,
        // init_animation: "bounce",
        dropPrimaryColor: "#1abc9c",
        dropBorder: "1px solid #1abc9c",
        minYear: "2019",
        maxYear: "2030",
    });

    var url = $("#url").val();
    
    var table = $('#dataTable').DataTable( {
        
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: 'Bfrtip',
        buttons: [ 'excel','print','pageLength'],
        "processing": true,
        "serverSide": true,
        'language': {
            'loadingRecords': '&nbsp;',
            'processing': '<img src="./assets/loader.gif" />',
            'paginate': {
                        'first': '|',
                        'next': '<i class="fa fa-arrow-circle-right"></i>',
                        'previous': '<i class="fa fa-arrow-circle-left"></i>',
                        'last':'|'
                        }
        },  
        "order":[], 

        "ajax":{  
                url: url,  
                type:"POST",
                data: function ( data ) {
                    data.employee = $('#employee').val();
                    data.s_date = $('#s-date').val();
                    data.e_date = $('#e-date').val();
                },
           }, 
        createdRow:function(row, data, rowIndex)
        {
            if (window.location.href.indexOf("payments") > -1) {
                $.each($('td', row), function(colIndex){
                    if(colIndex == 6)
                    {
                        var pk = $(data[8]);
                        $(this).attr('data-name', 'payment');
                        $(this).attr('class', 'payment');
                        $(this).attr('data-type', 'text');
                        $(this).attr('data-pk', pk.find("input[name=id]").val());
                    }
                });
            }
        },   
        "columnDefs":[
                {  
                    "targets":'target', 
                    "orderable":false,  
                },  
              ],
    });

    $("#employee").change( () => {
        table.ajax.reload();
    });

    $("#date-filter").click( () => {
        table.ajax.reload();
    });

    $('#dataTable').editable({
        container:'body',
        mode: 'inline',
        selector:'td.payment',
        url:'payments/update',
        type:'POST',
        validate:function(value){
            if($.trim(value) == '')
            {
                return 'This field is required';
            }
        }
    });
     /*
     * Notifications
     */
    function notify(title,message,from, align, icon, type, animIn, animOut){
        $.growl({
            icon: icon,
            title: '&nbsp&nbsp&nbsp'+title,
            message: message,
            url: ''
        },{
            element: 'body',
            type: type,
            allow_dismiss: true,
            placement: {
                from: from,
                align: align
            },
            offset: {
                x: 30,
                y: 30
            },
            spacing: 10,
            z_index: 999999,
            delay: 2500,
            timer: 1000,
            url_target: '_blank',
            mouse_over: false,
            animate: {
                enter: animIn,
                exit: animOut
            },
            icon_type: 'class',
            template: '<div data-growl="container" class="alert" role="alert">' +
            '<button type="button" class="close" data-growl="dismiss">' +
            '<span aria-hidden="true">&times;</span>' +
            '<span class="sr-only">Close</span>' +
            '</button>' +
            '<span data-growl="icon"></span>' +
            '<span data-growl="title"></span>' +
            '<span data-growl="message"></span>' +
            '<a href="#" data-growl="url"></a>' +
            '</div>'
        });
    };
    $(document).on('click', '.remove-image', function(e) {
        e.preventDefault();
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this!",
                icon: "error",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var url = $(this).attr('href');
                    var remove = $(this).data('id');

                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(response) {
                            if (response == "TRUE") {
                                alert(remove)
                                $("#" + remove).remove();
                                notify('Success | ',"Image Removed Successfully.",'top', 'right', 'fa fa-check', 'success', 'animated fadeInDown', 'animated fadeOutDown');
                            } else {
                                notify('Error | ',"Image Not Removed.",'top', 'right', 'fa fa-exclamation-triangle', 'danger', 'animated fadeInDown', 'animated fadeOutDown');
                            }
                        }
                    });
                } else {
                    return false;
                }
            });
    })

    $(document).on('click', '.credit-pay', function(){
        document.getElementById("myForm").reset();
        $('#pay_type').trigger('change');
        $('#order_id').val($(this).data('id'));
    });

    $(document).on('change', '#pay_type', function(){
        if ($(this).val() == 'cash') {
            $('#payment_id').val('cash');
            $('#payment_id').attr('readonly', true);
        }else{
            $('#payment_id').val('');
            $('#payment_id').attr('readonly', false);
        }
    });

    $('#pay_type').trigger('change');

    /*$('#myForm').submit(function(e){
        e.preventDefault();
        const form = $(this);
        console.log(form);
        if (form.valid() == true) {
            alert(form.attr('action'));
            return false;
        }else{
            return false;
        }
    });*/
    /*$('.image').on('click', function(){
        var image = $(this).data('value');
        var img = $(this).data('id');
        var url = $('#imageurl').val();
        swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover this!",
              icon: "error",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                $.ajax({  
                     url:url,   
                     method:"POST",  
                     data:{img:image},  
                     async:false,
                     success:function(data)  
                     {  
                        if (!data.includes("not")) {
                            notify('Success | ',data,'top', 'right', 'fa fa-check', 'success', 'animated fadeInDown', 'animated fadeOutDown');
                            $('.'+img).remove();
                            $(this).remove();
                        }else{
                            notify('Error | ',data,'top', 'right', 'fa fa-exclamation-triangle', 'danger', 'animated fadeInDown', 'animated fadeOutDown');    
                        }
                     }  
                });
              } else {
                
              }
            });
    });*/

    $(".js-example-placeholder-multiple").select2({
        placeholder: "Select Vendor Services"
    });

    // card js start
    $(".card-header-right .close-card").on('click', function() {
        var $this = $(this);
        $this.parents('.card').animate({
            'opacity': '0',
            '-webkit-transform': 'scale3d(.3, .3, .3)',
            'transform': 'scale3d(.3, .3, .3)'
        });

        setTimeout(function() {
            $this.parents('.card').remove();
        }, 800);
    });
    $(".card-header-right .reload-card").on('click', function() {
        var $this = $(this);
        $this.parents('.card').addClass("card-load");
        $this.parents('.card').append('<div class="card-loader"><i class="feather icon-radio rotate-refresh"></div>');
        setTimeout(function() {
            $this.parents('.card').children(".card-loader").remove();
            $this.parents('.card').removeClass("card-load");
        }, 3000);
    });
    $(".card-header-right .card-option .open-card-option").on('click', function() {
        var $this = $(this);
        if ($this.hasClass('icon-x')) {
            $this.parents('.card-option').animate({
                'width': '30px',
            });
            $this.parents('.card-option').children('li').children(".open-card-option").removeClass("icon-x").fadeIn('slow');
            $this.parents('.card-option').children('li').children(".open-card-option").addClass("icon-chevron-left").fadeIn('slow');
            $this.parents('.card-option').children(".first-opt").fadeIn();
        } else {
            $this.parents('.card-option').animate({
                'width': '130px',
            });
            $this.parents('.card-option').children('li').children(".open-card-option").addClass("icon-x").fadeIn('slow');
            $this.parents('.card-option').children('li').children(".open-card-option").removeClass("icon-chevron-left").fadeIn('slow');
            $this.parents('.card-option').children(".first-opt").fadeOut();
        }
    });
    $(".card-header-right .minimize-card").on('click', function() {
        var $this = $(this);
        var port = $($this.parents('.card'));
        var card = $(port).children('.card-block').slideToggle();
        $(this).toggleClass("icon-minus").fadeIn('slow');
        $(this).toggleClass("icon-plus").fadeIn('slow');
    });
    $(".card-header-right .full-card").on('click', function() {
        var $this = $(this);
        var port = $($this.parents('.card'));
        port.toggleClass("full-card");
        $(this).toggleClass("icon-minimize");
        $(this).toggleClass("icon-maximize");
    });
    $("#more-details").on('click', function() {
        $(".more-details").slideToggle(500);
    });
    $(".mobile-options").on('click', function() {
        $(".navbar-container .nav-right").slideToggle('slow');
    });
    $(".search-btn").on('click', function() {
        $(".main-search").addClass('open');
        $('.main-search .form-control').animate({
            'width': '200px',
        });
    });
    $(".search-close").on('click', function() {
        $('.main-search .form-control').animate({
            'width': '0',
        });
        setTimeout(function() {
            $(".main-search").removeClass('open');
        }, 300);
    });
    // card js end
    $("#styleSelector .style-cont").slimScroll({
        setTop: "1px",
        height: "calc(100vh - 480px)",
    });
    /*chatbar js start*/
    /*chat box scroll*/
    var a = $(window).height() - 80;
    $(".main-friend-list").slimScroll({
        height: a,
        allowPageScroll: false,
        wheelStep: 5
    });
    var a = $(window).height() - 155;
    $(".main-friend-chat").slimScroll({
        height: a,
        allowPageScroll: false,
        wheelStep: 5
    });

    // search
    $("#search-friends").on("keyup", function() {
        var g = $(this).val().toLowerCase();
        $(".userlist-box .media-body .chat-header").each(function() {
            var s = $(this).text().toLowerCase();
            $(this).closest('.userlist-box')[s.indexOf(g) !== -1 ? 'show' : 'hide']();
        });
    });

    // open chat box
    $('.displayChatbox').on('click', function() {
        var my_val = $('.pcoded').attr('vertical-placement');
        if (my_val == 'right') {
            var options = {
                direction: 'left'
            };
        } else {
            var options = {
                direction: 'right'
            };
        }
        $('.showChat').toggle('slide', options, 500);
    });

    //open friend chat
    $('.userlist-box').on('click', function() {
        var my_val = $('.pcoded').attr('vertical-placement');
        if (my_val == 'right') {
            var options = {
                direction: 'left'
            };
        } else {
            var options = {
                direction: 'right'
            };
        }
        $('.showChat_inner').toggle('slide', options, 500);
    });
    //back to main chatbar
    $('.back_chatBox').on('click', function() {
        var my_val = $('.pcoded').attr('vertical-placement');
        if (my_val == 'right') {
            var options = {
                direction: 'left'
            };
        } else {
            var options = {
                direction: 'right'
            };
        }
        $('.showChat_inner').toggle('slide', options, 500);
        $('.showChat').css('display', 'block');
    });
    $('.back_friendlist').on('click', function() {
        var my_val = $('.pcoded').attr('vertical-placement');
        if (my_val == 'right') {
            var options = {
                direction: 'left'
            };
        } else {
            var options = {
                direction: 'right'
            };
        }
        $('.p-chat-user').toggle('slide', options, 500);
        $('.showChat').css('display', 'block');
    });
    // /*chatbar js end*/
    $('[data-toggle="tooltip"]').tooltip();

    // wave effect js
    Waves.init();
    Waves.attach('.flat-buttons', ['waves-button']);
    Waves.attach('.float-buttons', ['waves-button', 'waves-float']);
    Waves.attach('.float-button-light', ['waves-button', 'waves-float', 'waves-light']);
    Waves.attach('.flat-buttons', ['waves-button', 'waves-float', 'waves-light', 'flat-buttons']);

    // $('#mobile-collapse i').addClass('icon-toggle-right');
    // $('#mobile-collapse').on('click', function() {
    //     $('#mobile-collapse i').toggleClass('icon-toggle-right');
    //     $('#mobile-collapse i').toggleClass('icon-toggle-left');
    // });
    // materia form

    $('.form-control').on('blur', function() {
        if ($(this).val().length > 0) {
            $(this).addClass("fill");
        } else {
            $(this).removeClass("fill");
        }
    });
    $('.form-control').on('focus', function() {
        $(this).addClass("fill");
    });
    $('#mobile-collapse i').addClass('icon-toggle-right');
    $('#mobile-collapse').on('click', function() {
        $('#mobile-collapse i').toggleClass('icon-toggle-right');
        $('#mobile-collapse i').toggleClass('icon-toggle-left');
    });
});
$(document).ready(function() {
    var $window = $(window);
    // $('.loader-bar').animate({
    //     width: $window.width()
    // }, 1000);
    // setTimeout(function() {
    // while ($('.loader-bar').width() == $window.width()) {
    // $(window).on('load',function(){
    $('.loader-bg').fadeOut();
    // });

    // break;

    // }
    // }, 2000);
    // $("#dropper-animation").dateDropper( {
    //                     dropWidth: 200, 
    //                     init_animation: "bounce",
    //                     dropPrimaryColor: "#1abc9c",
    //                     dropBorder: "1px solid #1abc9c"
    //                 });
});

// toggle full screen
function toggleFullScreen() {
    var a = $(window).height() - 10;

    if (!document.fullscreenElement && // alternative standard method
        !document.mozFullScreenElement && !document.webkitFullscreenElement) { // current working methods
        if (document.documentElement.requestFullscreen) {
            document.documentElement.requestFullscreen();
        } else if (document.documentElement.mozRequestFullScreen) {
            document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullscreen) {
            document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
        }
    } else {
        if (document.cancelFullScreen) {
            document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
            document.webkitCancelFullScreen();
        }
    }
    $('.full-screen').toggleClass('icon-maximize');
    $('.full-screen').toggleClass('icon-minimize');
}
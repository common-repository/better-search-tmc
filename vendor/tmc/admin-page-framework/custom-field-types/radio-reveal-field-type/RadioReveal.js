( function ( $ ) {

    $.fn.TMC_RadioReveal = function(reveal ) {

        var radioReveal = {
            fieldObj:           $( this ),
            init:               function() {

                radioReveal.updateAll();

                radioReveal.fieldObj.find( 'input[type="radio"]' ).each( function(){

                    $( this ).on( 'change', function(){

                        radioReveal.updateAll();

                    } );

                } );

            },
            updateAll:           function(  ) {

                radioReveal.fieldObj.find( 'input:not( :checked )[type="radio"]' ).each( function(){

                    var inputId         = $( this ).val();
                    var hideSelector    = reveal[ inputId ] || '';

                    $( this ).closest( 'label' ).removeClass( 'active' );
                    $( hideSelector ).hide();

                } );

                radioReveal.fieldObj.find( 'input:checked[type="radio"]' ).each( function(){

                    var inputId         = $( this ).val();
                    var showSelector    = reveal[ inputId ] || '';

                    $( this ).closest( 'label' ).addClass( 'active' );
                    $( showSelector ).show();

                } );

            }
        };

        radioReveal.init(); //  Initialize

        return this;

    };

}( jQuery ) );
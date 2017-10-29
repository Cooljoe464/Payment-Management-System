/**
 * Created by Joe_Pc on 01/10/2017.
 */
function payWithPaystack(){
    var handler = PaystackPop.setup({
        key: 'pk_test_fa54d1eb988cb51a3e998264e2fd0d2cacec0ff0',
        email: document.getElementById('email').name,
        amount: 450000,  //#2500 here is 250000, 3000 is 300000.
        ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
        metadata: {
            custom_fields: [
                {
                    display_name: "Matric-Number",
                    variable_name: "Bingham University, Computer Science",
                    value: document.getElementById('user_name').name,
                }
            ]
        },
        callback: function(response, address){
            var ref = response.reference;
               if (ref) {

                console.log('Reference: ' + ref);
                console.log('Type: ' + typeof(ref));

                window.location = 'success.php?ref='+ref;
            }

        },
        onClose: function(){
            alert('window closed');
        }
    });
    handler.openIframe();


}
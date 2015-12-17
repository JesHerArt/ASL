$(document).ready(function() {
    
    
    console.log("js is loading");
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    /*$('.loginButton').click(function(e){
        e.preventDefault();
        
        if( $('.loginButton').hasClass('closed') ) {
            $('.loginButton').removeClass('closed').addClass('opened');
            $('#loginModal').css('display','flex');
            console.log("to open");
        } else if( $('.loginButton').hasClass('opened') ) {
            $('.loginButton').removeClass('opened').addClass('closed');
            $('#loginModal').css('display','none');
            console.log("to close");
        }
    });*/
    
    $('[data-toggle="tooltip"]').tooltip();
    
    $('#new').click(function(e){
        e.preventDefault();
        
        $('.createAccnt').hide('slow');
        
        $('#createAccount1').show('slow');
        
        $('#choice').html('New Account and New Contact');
    });
    
    $('#existing').click(function(e){
        e.preventDefault();
        
        $('.createAccnt').hide('slow');
        
        $('#createAccount2').show('slow');
        
        $('#choice').html('Add a New Contact to an Existing Account');
    });
    
    var itemCounter = 0;
    
    $('#addNewItem').click(function(e){
        e.preventDefault();
        
        $.getJSON('http://dciprinting.local/get-products', function(data) {

			var products = data["products"];
            
            var itemHtml = '<div id="' + itemCounter + '" class="itemBlock"><div class="row"><div class="col-lg-4 label"><p>Item ' + itemCounter + '</p></div><div class="col-lg-8 itemsSection"><select id="item' + itemCounter + '" class="invItem" name="item' + itemCounter + '"><option value="">Select a Product / Service</option>';
            
            products.forEach(function(entry){
				itemHtml += '<option value="' + entry["id"] + '">' + entry["name"] + '</option>';
			});
            
            itemHtml += '</select></div></div><div class="row"><div class="col-lg-4 label"><p>Price</p></div><div class="col-lg-8 itemsSection"><input type="number" step="0.01" id="price' + itemCounter + '" name="price' + itemCounter + '" placeholder="0.00" value="" required /></div></div>';
            
            itemHtml += '<div class="row"><div class="col-lg-4 label"><p>Quantity</p></div><div class="col-lg-8 itemsSection"><input type="number" id="qty' + itemCounter + '" name="qty' + itemCounter + '" placeholder="1" value="1" required /></div></div>';
            
            //itemHtml += '<div class="row"><div class="col-lg-4 label"><p>Notes</p></div><div class="col-lg-8 itemsSection"><textarea id="notes' + itemCounter + '" name="notes' + itemCounter + '" placeholder="something about the item here..."></textarea></div></div>';
            
            itemHtml += '</div>';

			attachObject = $(itemHtml);
			attachObject.hide();
			$('#newItemBtn').before(attachObject);
			attachObject.show(200);

		}); //End of .getJSON
        
        itemCounter++;
        
    });
    
    $(document).on('change', '.invItem', function() {
        
        $productId = $(this).val();
        
        var count = $(this).attr('id').substr(4);
        var selector = $('#price' + count);
        
        $.getJSON('http://dciprinting.local/get-price/' + $productId, function(data) {

			var product = data["product"];
            
            selector.val(product['price']);

		}); //End of .getJSON
        
    });
    
    $('#newInvoiceBtn').click(function(e){
        e.preventDefault();
        
        $itemsCount = $('.itemBlock').length;
		
		if ( $itemsCount == 0 )
		{
			console.log("no items added");
		}
		else
		{
            $accountId = $('#account').val();
            $empId = $('#empId').val();
            var total = 0.00;
            
            var invoice = {
                "accountId" : $accountId,
                "empId" : $empId
            };
            
            invoice["items"] = [];
            
            $('.itemBlock').each(function(){
                
                var count = $(this).attr('id');
                
                $itemId = $('#item' + count).val();
                $price = $('#price' + count).val();
                $quantity = $('#qty' + count).val();
                
                total += ($price * $quantity);
                
                var item = {
                    "id" : $itemId,
                    "price" : $price,
                    "quantity" : $quantity
                }
                
                invoice.items.push(item);
            });
            
            invoice["total"] = total;
            
            console.log(invoice);
            
            $.ajax({
                type: 'post',
                cache: false,
                url: 'http://dciprinting.local/portal-new-invoice',
                data: invoice,
                success:function(data){
                    console.log("done!");
                    console.log(data);
                    window.location = 'http://dciprinting.local/portal-invoices';
                }
            });
            
        }
        
    });
    
    $('#calculatePayroll').click(function(e){
        e.preventDefault(); 
        
        $rate = $('#hourlyRate').text();
        $hours = $('#totalHours').text();
        
        $payroll = $rate * $hours;
        
        $payroll = (Math.round( $payroll * 100 ) / 100).toFixed(2);
        
        $('#payrollAmnt').html($payroll);
        
        $('#afterCalculate').show(500);
        
        $(this).prop("disabled",true);
        $(this).css('cursor','not-allowed').css('opacity','0.5');
    });
    
});
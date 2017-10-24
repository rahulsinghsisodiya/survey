$(document).ready(function(){
	lateBinding();
 $(document).on('click','#add_more_price',function(){
        //$('.input_fields_wrap')  
        var totalExisting = $('.price-wrappers').length;
        var clone = $('#price_clone_wrapper').clone(); 
        var myHtml = $(clone).html().replace(/key/g,totalExisting+1);
        $('#price_container').append(myHtml);
        lateBinding();
       
   });
  function lateBinding(){
 	  $('.datepicker').datepicker({
            format:'dd-mm-yyyy',
            autoclose:true,
            format : 'yyyy-mm-dd',
            todayHighlight : true,
        });
    }
 $(document).on('click','.remove_price' ,function(){
        if(confirm('Are you sure to remove?')){
            $(this).parents('div.price-wrappers').remove();
        }
    });   


 $(document).on('click','#add_more_supplier',function(){
        //$('.input_fields_wrap')  
        var totalExisting = $('.supplier-wrappers').length;
        var clone = $('#supplier_clone_wrapper').clone(); 
        var myHtml = $(clone).html().replace(/key/g,totalExisting+1);
        var key = totalExisting+1;
        $('#supplier_container').append(myHtml);
        $('#product-supplier-'+key+'-supplier_id').select2({width : '100%'});
        $('#product-supplier-'+key+'-status_approved').select2({width : '100%'});
   });
  
 $(document).on('click','.remove_supplier' ,function(){
        if(confirm('Are you sure to remove?')){
            $(this).parents('div.supplier-wrappers').remove();
        }
    });   
$(document).on('click','#add_more_competitor',function(){
        //$('.input_fields_wrap')  
        var totalExisting = $('.competitor-wrappers').length;
        var clone = $('#competitor_clone_wrapper').clone(); 
        var myHtml = $(clone).html().replace(/key/g,totalExisting+1);
        var key = totalExisting+1;
        $('#competitor_container').append(myHtml);
        $('#product-competitor-'+key+'-competitior_type').select2({width : '100%',tags:true});
        $('#product-competitor-'+key+'-currency_id').select2({width : '100%'});
        $('.datepicker').datepicker({
              format:'dd-mm-yyyy',
              autoclose:true,
              format : 'yyyy-mm-dd',
              
              todayHighlight : true,
          });
        $('#product-competitor-'+key+'-competitior_type').on("select2:open", function() 
        {
            $(".select2-search__field").attr("placeholder", "Add New");
        });
   });
  
 $(document).on('click','.remove_competitor' ,function(){
        if(confirm('Are you sure to remove?')){
            $(this).parents('div.competitor-wrappers').remove();
        }
    });   
$(document).on('click','#add_more_kit',function(){
        //$('.input_fields_wrap')  
        var totalExisting = $('.kit-wrappers').length;
        var clone = $('#kit_clone_wrapper').clone(); 
        var myHtml = $(clone).html().replace(/key/g,totalExisting+1);
        var key = totalExisting+1;
        $('#kit_container').append(myHtml);
        $('#product-kit-'+key+'-product_code_id').select2({width : '100%'});
        
   });
  
 $(document).on('click','.remove_kit' ,function(){
        if(confirm('Are you sure to remove?')){
            $(this).parents('div.kit-wrappers').remove();
        }
    }); 
   //currency add more   
   $(document).on('click','#add_more_currency',function(){
        //$('.input_fields_wrap')  
        var totalExisting = $('.currency-wrappers').length;
        var clone = $('#currency_clone_wrapper').clone(); 
        var myHtml = $(clone).html().replace(/key/g,totalExisting+1);
        var key = totalExisting+1;
        $('#currency_container').append(myHtml);
        $('.datepicker').datepicker({
              format:'dd-mm-yyyy',
              autoclose:true,
              format : 'yyyy-mm-dd',
              
              todayHighlight : true,
          });
       
   });
  
 $(document).on('click','.remove_currency' ,function(){
        if(confirm('Are you sure to remove?')){
            $(this).parents('div.currency-wrappers').remove();
        }
    });   

});





$(document).on('click','.deleteCustomer',function(){
		console.log($(this).data('url'));
     var checked = []
     $("input[name='selection[]']:checked").each(function ()
            {
                checked.push(parseInt($(this).val()));
            });
     	if(checked != ""){
     		if (confirm("Are you sure you want to delete customer")) 
	     	{
	     	$.ajax({
	       		  url: $(this).data('url'),
	       		type: 'post',
	            data: {
	                 checked: checked ,                 
	             },
	            success: function (data) {
	            toaster(data);
	     		$.pjax({container: '#pjax-grid-view'})
	            }
	 		 });       
	     	}
     	}
     	else
     	{
     		$.toaster({ priority : 'error', message : "Please select customer"});
     	}
     	
       });
$(document).on('click','.deleteCustomerAssign',function(){
		
     var checked = []
     $("input[name='selection[]']:checked").each(function ()
            {
                checked.push(parseInt($(this).val()));
            });
     	if(checked != ""){
     		if (confirm("Are you sure you want to delete customer")) 
	     	{
	     	$.ajax({
	       		  url: $(this).data('url'),
	       		  type: 'post',
	              data: {
	                 checked: checked ,                 
	             },
	            success: function (data) {
	            toaster(data);
	     		$.pjax({container: '#pjax-grid-view'})
	            }
	 		 });       
	     	}
     	}
     	else
     	{
     		$.toaster({ priority : 'error', message : "Please select customer"});
     	}
     	
       });
/*assign group */
$(document).on('click','.assigngroup',function(){
		console.log($(this).data('url'));
		$('.new-group').hide();
     var checked = []
     $("input[name='selection[]']:checked").each(function ()
            {
                checked.push(parseInt($(this).val()));
            });
     	if(checked != ""){
     		$('#assignModal').modal('show');

     	}
     	else
     	{
     		$.toaster({ priority : 'error', message : "Please select customer"});
     	}
     	
       });

$(document).on('change','.customer_assign_group',function(){
	var val = $(this).val();
	if(val == 'add')
	{
		$('.new-group').show();
	}
	else
	{
		$('.new-group').hide();
	}
});

$(document).on('click','.assign_customer_group',function(){
	var checked = []
    $("input[name='selection[]']:checked").each(function ()
       {
          checked.push(parseInt($(this).val()));
       });
    var group = $('.customer_assign_group').val();
    var new_group = $('.group-name').val();
    $.ajax({
	       		url: $(this).data('url'),
	       		type: 'post',
	            data: {
	                 checked: checked ,group:group,new_group:new_group                 
	             },
	            success: function (data) {
	            toaster(data);
	            var status = data.status;
	            if(status == 1)
	            {
	            	$.pjax({container: '#pjax-grid-view'});
	            	$('#assignModal').modal('hide');
	            	$('.customer_assign_group').val('');
	            	$('.group-name').val('');
	            }
	     		
	            }
	 		 });       




});
/*end assign group*/
function toaster(data)
{
	$.toaster({ priority : data.type, message : data.message});
}



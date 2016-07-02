$(document).ready(function(){
	//http://www.nseindia.com/content/historical/EQUITIES/2015/DEC/cm04DEC2015bhav.csv.zip
	var txtObject = '<span class="dynComponent"><input class="form-control inputURLMaker" type="text"></input><button type="button" class="btnRemoveClass btn btn-danger">x</button></span>';
	var dateObject = '<span class="dynComponent"><select class="form-control inputURLMakerDate inputURLMaker"><option id=""></option><option id="dd">dd</option><option id="yyyy">yyyy</option><option id="MON">MON</option><option id="mon">mon</option><option id="Mon">Mon</option><option id="yyyymmdd">yyyymmdd</option><option id="dd/mm/yyyy">dd/mm/yyyy</option><option id="ddMONyyyy">ddMONyyyy</option><option id="ddmonyyyy">ddmonyyyy</option></select><button type="button" class="btnRemoveClass btn btn-danger">x</button></span>';
	var iteratorObject = '<span class="dynComponent"><input class="form-control iterator inputURLMaker" type="text"></input><button type="button" class="btnRemoveClass btn btn-danger">x</button></span>';
	$('#btnText').unbind('click').click(function(){
		$('#divURLAssembler form').append(txtObject);
		attachListener();
	});
	$('#btnDate').unbind('click').click(function(){
		$('#divURLAssembler form').append(dateObject);
		attachListener();
	});
	$('#btnIteratorList').unbind('click').click(function(){
		$('#divURLAssembler form').append(iteratorObject);
		attachListener();
	});
	
	$('#lblSampleURL').change(function(){
		if($(this).text() != ''){
			$('#lblSampleURLLabel').fadeIn();
			$('#btnDoneURL').fadeIn();
			$('#btnCheckURL').fadeIn();
		}else{
			$('#lblSampleURLLabel').fadeOut();
			$('#btnDoneURL').fadeOut();
			$('#btnCheckURL').fadeOut();
		}
	});
	
	function attachListener(){
		$(".inputURLMaker").unbind('change').unbind('keyup').on('change keyup',function(){
			getSampleURL();
		});
		
		$('.btnRemoveClass').unbind('click').click(function(){
			$(this).parents('span').remove();
			getSampleURL();
		});
	}
	var sampleURL = "";
	function getSampleURL(){
		sampleURL = "";
		$('#divURLAssembler').find('.inputURLMaker').each(function(){
			
			if($(this).hasClass('iterator')){
				sampleURL += $(this).val().split(',')[0];
			}else{
				if($(this).hasClass('inputURLMakerDate')){
					var dateToUse = new Date();
					dateToUse.setDate(dateToUse.getDate() - 1);
					
					if(dateToUse.getDay() == 0){
						dateToUse.setDate(dateToUse.getDate() - 2);
					}
					if(dateToUse.getDay() == 6){
						dateToUse.setDate(dateToUse.getDate() - 1);
					}
					
					var valueToUse = getDateFormatValues($(this), dateToUse);
					sampleURL += valueToUse;
				}else{
					sampleURL += $(this).val();
				}
			}
			//$('#btnCheckURL').attr('href',sampleURL);
			$('#lblSampleURL').text(sampleURL);
			$('#lblSampleURL').trigger('change');
		});
	}
	
	function getDateFormatValues(object, dateToUse){
		var monthsFull = ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"];
		var monthsShort = ["Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
		
		var currValue = object.val();
		if(currValue == 'yyyy'){
			return dateToUse.getFullYear();
		}else{
			if(currValue == 'MON'){
				return (monthsShort[dateToUse.getMonth()]).toUpperCase();
			}else{
				if(currValue == 'mon'){
					return (monthsShort[dateToUse.getMonth()]).toLowerCase();
				}else{
					if(currValue == 'Mon'){
						return (monthsShort[dateToUse.getMonth()]);
					}else{
						if(currValue == 'yyyymmdd'){
							return (dateToUse.getFullYear() + '' + ('0' + (dateToUse.getMonth() + 1)).slice(-2) + '' + ('0' + dateToUse.getDate()).slice(-2));
						}else{
							if(currValue == 'dd/mm/yyyy'){
								return (('0' + dateToUse.getDate()).slice(-2) + '/' + ('0' + (dateToUse.getMonth() + 1)).slice(-2) + '/' + dateToUse.getFullYear());
							}else{
								if(currValue == 'ddMONyyyy'){
									return (('0' + dateToUse.getDate()).slice(-2) + '' + (monthsShort[dateToUse.getMonth()]).toUpperCase() + '' + dateToUse.getFullYear());
								}else{
									if(currValue == 'ddmonyyyy'){
										return (('0' + dateToUse.getDate()).slice(-2) + '' + (monthsShort[dateToUse.getMonth()]).toLowerCase() + '' + dateToUse.getFullYear());
									}else{
										if(currValue == 'dd'){
											return ('0' + dateToUse.getDate()).slice(-2);
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}

	$('#btnCheckURL').click(function(){
		window.open($('#lblSampleURL').text());
	});
});
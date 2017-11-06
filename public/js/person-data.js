/* 
* @Author: anchen
* @Date:   2017-05-22 10:37:37
* @Last Modified by:   anchen
* @Last Modified time: 2017-05-22 15:35:49
*/

$(document).ready(function(){


    $('.region-detail').click(function(){
        $('.screen').fadeIn();
    })
    
    $('.sex-choose').click(function(){

        $(this).addClass('choose-active').parent().siblings().children().removeClass('choose-active');
    })


    $('.confirm').click(function(){
        $('.region-detail').val($('.choose-active').parent().text());
        $('.screen').hide();
        
    })
    $('.close').click(function(){
        $('.screen').hide();
    })
  
     $('.cancel').click(function(){
        $('.screen').hide();
    })
     
});
$(function () {  
    $.ms_DatePicker({
        YearSelector: "#sel_year",
        MonthSelector: "#sel_month",
        DaySelector: "#sel_day"
    });
});
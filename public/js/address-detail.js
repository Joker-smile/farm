/* 
* @Author: anchen
* @Date:   2017-05-19 10:56:06
* @Last Modified by:   anchen
* @Last Modified time: 2017-05-25 14:18:42
*/

$(document).ready(function(){
    
     $('.default').on('click', function(){
         var is_default = $('#is_default');
         is_default.val(1 ^ is_default.val());

        $(this).toggleClass('onclick');
    })

     $('#province, #city').citylist({
        data    : data,
        id      : 'id',
        children: 'cities',
        name    : 'name',
        metaTag : 'name'
    });
     $('#txt_city').click(function(){
        $('.screen').show();
     })
     $('.confirm').click(function(){
         var option1 = $("#province option:selected");
         var option2 = $("#city option:selected");
        $('#txt_city').val(option1.text() + ' ' +option2.text());
        $('#province_id').val(option1.attr('name'));
        $('#city_id').val(option2.attr('name'));
        $('.screen').hide();
        
    })
    $('.close').click(function(){
        $('.screen').hide();
    })
  
     $('.cancel').click(function(){
        $('.screen').hide();
    })


    //  $('#txt_city').jcity({
    //     urlOrData: '../js/citydata.json',
    //     animate: { showClass: 'animated flipInX', hideClass: 'animated flipOutX' },  // 需要第一步引用的animate.min.css文件，也可以自己定义动画 
    //     onChoice: function (data) {
    //         console.log(data);
    //     }
    // });
});
/* 
* @Author: anchen
* @Date:   2017-05-18 16:10:03
* @Last Modified by:   anchen
* @Last Modified time: 2017-05-18 18:40:01
*/

$(document).ready(function(){
    // 单选
    // $('.default').on('click', function(){
    //     $(this).addClass('onclick').parents("li").siblings().find('.default').removeClass('onclick');
    // })

   //  // 点击删除的弹窗
   //  $('.delete').on('click', function(){

   //      $('.screen').show();
   // })

    $('.close').click(function(){
        $('.screen').fadeOut();
    })
  
   //   $('.not-go').click(function(){
   //      $('.screen').hide();
        
   //  })

        // 取数组
        var num;
        // 点击弹出弹窗，并且确定所点击的属于数组第几个序列
        $(".address-list").on('click', 'li .delete', function(event) {
            event.preventDefault();
            num = $(this).index()-1;
            $(".screen").fadeIn('fast');
        });

        // 弹窗中确定使得该序列的目标删除
        $(".pop-in").on('click', 'span', function(event) {
            event.preventDefault();
            if($(this).hasClass('confirm')){
                $(".address-list li").eq(num).remove();
                num = "";
                $(".screen").fadeOut();
            }else{
                $(".screen").fadeOut();
                num = "";
            }
        });
});
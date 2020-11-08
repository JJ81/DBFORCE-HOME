(function ($) {
    // var btnCallSetMemo=$('.js-set-memo');
    // var btnModifyInfo=$('.js-customer-modify');
    // var btnDeleteInfo=$('.js-customer-delete');
    // var modalModify=$('#modalModifyCustomerInfo');
    // var modalDelete=$('#modalDeleteCustomerInfo');
    //
    // btnModifyInfo.bind('click', function () {
    //     var _self=$(this);
    //     var id=_self.attr('data-customer-id');
    //     var name=_self.attr('data-customer-name');
    //     var phone=_self.attr('data-customer-phone');
    //     var status_id=_self.attr('data-status-id');
    //     var created_dt=moment(_self.attr('data-created-dt')).format('YYYY-MM-DD');
    //
    //     modalModify.find('.js-customer-id').val(id);
    //     modalModify.find('input[name="name"]').val(name);
    //     modalModify.find('input[name="phone"]').val(phone);
    //     modalModify.find('.js-select-status').val(status_id);
    //     modalModify.find('.js-customer-created-dt').val(created_dt);
    //     modalModify.modal('show');
    // });
    //
    // btnDeleteInfo.bind('click', function () {
    //     var _self=$(this);
    //     var id=_self.attr('data-customer-id');
    //     var name=_self.attr('data-customer-name');
    //     var phone=_self.attr('data-customer-phone');
    //
    //     modalDelete.find('.js-customer-id').val(id);
    //     modalDelete.find('input[name="name"]').val(name);
    //     modalDelete.find('input[name="phone"]').val(phone);
    //
    //     modalDelete.modal('show');
    // });
    //
    // var tableTr=$('.memo_box');
    // tableTr.bind('mouseenter', function () {
    //     $(this).addClass('memo_box_active');
    // });
    //
    // tableTr.bind('mouseleave', function () {
    //     $(this).removeClass('memo_box_active');
    // });
    //
    //
    // btnCallSetMemo.bind('click', function () {
    //     var id=$(this).attr('data-customer-id');
    //     var name=$(this).attr('data-customer-name');
    //     vue_memo.openModal(id, name);
    // });
    //
    // //window.prevSelectIdx=0;
    // $(".jp-customer-record").bind('mouseenter', function () {
    //     var _self=$(this), target=_self.find(".phone-place"), idx=$(this).index();
    //
    //     recoverHideNumber();
    //
    //     target.select(function () {
    //         var phone=target.attr('data-phone');
    //         target.val(phone);
    //         $(".phone-place")[idx].select()
    //     });
    // });
    //
    // $(".jp-customer-record").bind('mouseleave', function(){
    //     recoverHideNumber();
    // });
    //
    // function recoverHideNumber() {
    //     $(".phone-place").each(function(i, el){
    //         // console.log(el);
    //         // console.log( $(el).attr('data-phone') );
    //         var newNum=hidePartialNumber($(el).attr('data-phone'))
    //         $(this).val(newNum);
    //     });
    // }
    //
    // function hidePartialNumber(num){
    //     var num_arr=num.split('-'), newNum="";
    //     for(var i=0,size=num_arr.length;i<size;i++){
    //         if(size-1 === i){
    //             newNum += "****";
    //         }else{
    //             newNum += num_arr[i] + '-';
    //         }
    //     }
    //     return newNum;
    // }
    //
    // window.recoverHideNumber=recoverHideNumber;

}(jQuery));
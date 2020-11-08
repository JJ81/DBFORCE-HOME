var vueCommon=new Vue({
    el: "#vueCommon",
    data: {

    },
    methods: {
        hidePhoneNumber: function (phone) {
            var arr_num=phone.split('-');

            if(arr_num.length===2){
                return arr_num[0] + '-****';
            }else if(arr_num.length===3){
                return arr_num[0] + '-' + arr_num[1] + '-****';
            }

            return phone;
        },

        /**
         * 전화번호에 하이픈 자동 완성.
         * @param str
         * @returns {*}
         */
        checkPhoneNumberType: function (str){
            var newStr = str.replace(/[^0-9]/g, '');
            var size=newStr.length;
            var tmp='';


            if(size < 7){
                //console.log('under 7 ' + newStr);

                return str;
            }else if(size === 7){  // 7자리는 3-4
                //console.log('digit 7 ' + newStr);

                tmp += newStr.substr(0, 3);
                tmp += '-';
                tmp += newStr.substr(3, 4);
                return tmp;
            }else if(size === 8){  // 8자리는 4-4
                console.log('digit 8 ' + newStr);

                tmp += newStr.substr(0, 4);
                tmp += '-';
                tmp += newStr.substr(4, 8);
                return tmp;
            }else if(size === 9){
                //console.log('digit 9 ' + newStr);

                tmp += newStr.substr(0, 2);
                tmp += '-';
                tmp += newStr.substr(2, 3);
                tmp += '-';
                tmp += newStr.substr(5, 9);
                return tmp;
            }else if(size === 10){
                //console.log('digit 10');

                // 02-0000-0000
                // 앞자리에 02가 있을 경우를 제외하고는 모두 3-3-4
                if(newStr.substr(0, 2) === '02'){
                    //console.log('digit 10 and 02 ' + newStr);

                    tmp += newStr.substr(0, 2);
                    tmp += '-';
                    tmp += newStr.substr(2, 4);
                    tmp += '-';
                    tmp += newStr.substr(6, 4);

                    return tmp;
                }else{
                    console.log('digit 10 and !02 ' + newStr);

                    tmp += newStr.substr(0, 3);
                    tmp += '-';
                    tmp += newStr.substr(3, 3);
                    tmp += '-';
                    tmp += newStr.substr(6, 4);

                    return tmp;
                }
            }else if(size === 11){
                //console.log('digit 11 ' + newStr);
                tmp += newStr.substr(0, 3);
                tmp += '-';
                tmp += newStr.substr(3, 4);
                tmp += '-';
                tmp += newStr.substr(7, 4);
                return tmp;
            }
        },

        separateMemo: function (memo, memo_dt, employees) {
            if(memo === null || memo === ''){
                return "<div class='center'>-</div>";
            }

            var memo_array=memo.split('{}');
            var memo_dt_array=memo_dt.split('{}');
            var memo_writer=employees.split('{}');
            var el="";

            for(var i=0,size=memo_array.length;i<size;i++){
                var memo=memo_array[i];
                var date=memo_dt_array[i];
                var writer=memo_writer[i];

                el += "<div>"+date+" <i class='fa fa-arrow-circle-o-right'></i> " + memo;
                el += "<small>("+writer+")</small>";
                el += "</div>";
            }

            return el;

        },

        extractDateFromDateTime: function (datetime) {
            if(datetime){
                return new moment(datetime).format('YYYY-MM-DD');
            }
            return '날짜없음';
        },

        replaceSlashes: function (data){
            return data.replace(/\\/gi, '');
        }

    }
});